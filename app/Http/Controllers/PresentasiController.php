<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon;
use App\Dosen;
use App\Periode;
use App\Kelompok;
use App\Sesiwaktu;
use App\Ruang;
use App\Presentasi;

class PresentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::get();
       
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Presentasi::leftJoin('kelompok', 'jadwal_presentasi.id_kelompok', 'kelompok.id_kelompok')
                                ->leftJoin('periode', 'jadwal_presentasi.id_periode', 'periode.id_periode')
                                ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                                ->leftJoin('sesiwaktu', 'jadwal_presentasi.id_sesiwaktu', 'sesiwaktu.id_sesiwaktu')
                                ->leftJoin('ruang', 'jadwal_presentasi.id_ruang', 'ruang.id_ruang')
                                ->select('jadwal_presentasi.*', 'kelompok.nama_kelompok' ,'dosen.nama as dosen_nama', 'periode.tahun_periode', 'sesiwaktu.sesi', 'ruang.ruang')
                                ->where('jadwal_presentasi.id_periode',  $request->id_periode)
                                ->get()
                                ->load('dosen');
            }else{
                $data = Presentasi::leftJoin('kelompok', 'jadwal_presentasi.id_kelompok', 'kelompok.id_kelompok')
                                ->leftJoin('periode', 'jadwal_presentasi.id_periode', 'periode.id_periode')
                                ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                                ->leftJoin('sesiwaktu', 'jadwal_presentasi.id_sesiwaktu', 'sesiwaktu.id_sesiwaktu')
                                ->leftJoin('ruang', 'jadwal_presentasi.id_ruang', 'ruang.id_ruang')
                                ->select('jadwal_presentasi.*', 'kelompok.nama_kelompok' ,'dosen.nama as dosen_nama', 'periode.tahun_periode', 'sesiwaktu.sesi', 'ruang.ruang')
                                ->get()
                                ->load('dosen');
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($presentasi){
                $btn = '<a href="/admin/presentasi/'.$presentasi->id_jadwal_presentasi.'/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<button type="button" name="delete" id="'.$presentasi->id_jadwal_presentasi.'" class="btn btn-danger btn-sm deletePresentasi" ><i class="fas fa-trash"></i></button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.presentasi.presentasi_kelompok', compact('periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelompok = Kelompok::select('id_kelompok', 'nama_kelompok')->get();
        $dosen = Dosen::select('id_dosen', 'nama')->get();
        $sesi = Sesiwaktu::select('id_sesiwaktu', 'sesi')->get();
        $ruang = Ruang::select('id_ruang', 'ruang')->get();
        $periode = Periode::where('status', 'open')->first();
        return view('admin.presentasi.add_presentasi', compact('kelompok', 'sesi', 'ruang', 'dosen', 'periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_kelompok' => 'required|max:4',
            'id_dosen' => 'required',
            'id_sesiwaktu' => 'required',
            'id_ruang' => 'required',
            'tanggal' => 'required',
            'id_periode' => 'required',
        ]);
        $presentasi = Presentasi::create([
            'id_kelompok' => $request->id_kelompok,
            'id_dosen' => $request->id_dosen,
            'id_sesiwaktu' => $request->id_sesiwaktu,
            'id_ruang' => $request->id_ruang,
            'tanggal' => $request->tanggal,
            'id_periode' => $request->id_periode,
        ]);
        $presentasi->save();
        return response()->json(['message' => 'Jadwal status added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_jadwal_presentasi)
    {
        $kelompok = Kelompok::get();
        $dosen = Dosen::get();
        $presentasi = Presentasi::findOrFail($id_jadwal_presentasi);
        return view('admin.presentasi.edit_presentasi', compact('presentasi', 'kelompok', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jadwal_presentasi)
    {
        $this->validate($request, [
            'id_kelompok' => $request->id_kelompok,
            'id_dosen' => $request->id_dosen,
            'id_sesiwaktu' => $request->id_sesiwaktu,
            'id_ruang' => $request->id_ruang,
            'tanggal' => $request->tanggal,
        ]);
        $presentasi = Presentasi::findOrFail($id_jadwal_presentasi);
        $presentasi->update([
            'id_kelompok' => $request->id_kelompok,
            'id_dosen' => $request->id_dosen,
            'id_sesiwaktu' => $request->id_sesiwaktu,
            'id_ruang' => $request->id_ruang,
            'tanggal' => $request->tanggal,
        ]);
        $presentasi->save();
        return response()->json(['message' => 'Jadwal status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jadwal_presentasi)
    {
        $presentasi = Presentasi::find($id_jadwal_presentasi);
        $presentasi->delete();
        return response()->json(['message' => 'Jadwal deleted successfully.']);
    }
}
