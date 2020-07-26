<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
    public function index(Request $request)
    {
        $periode = Periode::where('isDeleted', 0)->get();
       
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Presentasi::join('dosen as d2', 'jadwal_presentasi.id_dospeng', 'd2.id_dosen')
                                ->leftJoin('kelompok', 'jadwal_presentasi.id_kelompok', 'kelompok.id_kelompok')
                                ->leftJoin('periode', 'jadwal_presentasi.id_periode', 'periode.id_periode')
                                ->leftJoin('dosen as d1', 'kelompok.id_dosen', 'd1.id_dosen')
                                ->leftJoin('sesiwaktu', 'jadwal_presentasi.id_sesiwaktu', 'sesiwaktu.id_sesiwaktu')
                                ->leftJoin('ruang', 'jadwal_presentasi.id_ruang', 'ruang.id_ruang')
                                ->select('jadwal_presentasi.*', 'kelompok.nama_kelompok' ,'d1.nama as dosen_nama', 'd2.nama as dospeng','periode.tahun_periode', 'sesiwaktu.sesi', 'ruang.ruang')
                                ->where('jadwal_presentasi.id_periode',  $request->id_periode)
                                ->get();
            }else{
                $data = Presentasi::join('dosen as d2', 'jadwal_presentasi.id_dospeng', 'd2.id_dosen')
                                ->leftJoin('kelompok', 'jadwal_presentasi.id_kelompok', 'kelompok.id_kelompok')
                                ->leftJoin('periode', 'jadwal_presentasi.id_periode', 'periode.id_periode')
                                ->leftJoin('dosen as d1', 'kelompok.id_dosen', 'd1.id_dosen')
                                ->leftJoin('sesiwaktu', 'jadwal_presentasi.id_sesiwaktu', 'sesiwaktu.id_sesiwaktu')
                                ->leftJoin('ruang', 'jadwal_presentasi.id_ruang', 'ruang.id_ruang')
                                ->select('jadwal_presentasi.*', 'kelompok.nama_kelompok' ,'d1.nama as dosen_nama', 'd2.nama as dospeng','periode.tahun_periode', 'sesiwaktu.sesi', 'ruang.ruang')
                                ->get();
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
        $userId = Auth::id();
        $kelompok = DB::table('kelompok')->where('isDeleted', 0)
                        ->whereNotIn('id_kelompok', function($q){
                            $q->select('id_kelompok')->from('jadwal_presentasi');
                        })->get();

        $dosen = Dosen::select('id_dosen', 'nama')->where('status', 'open')->where('isDeleted', 0)->get();
        $sesi = Sesiwaktu::select('id_sesiwaktu', 'sesi')->get();
        $ruang = Ruang::select('id_ruang', 'ruang')->get();
        $periode = Periode::where('status', 'open')->first();
        return view('admin.presentasi.add_presentasi', compact('userId','kelompok', 'sesi', 'ruang', 'dosen', 'periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //chect dospeng dengan dosbing belumm
        $che = Presentasi::join('kelompok as k', 'jadwal_presentasi.id_kelompok', 'k.id_kelompok')
                        ->join('dosen as d', 'k.id_dosen', 'd.id_dosen')
                        ->select('d.id_dosen', 'k.id_kelompok')
                        ->where('d.id_dosen', $request->id_dospeng)
                        ->where('k.id_kelompok', $request->id_kelompok)
                        ->first();

        //dospeng, waktu, ruang, tanggal periode yang sama
        $check = Presentasi::where('id_dospeng', $request->id_dospeng)
                            ->where('id_sesiwaktu', $request->id_sesiwaktu)
                            ->where('tanggal', $request->tanggal)
                            ->where('id_ruang', $request->id_ruang)
                            ->where('id_periode', $request->id_periode)
                            ->first();

        //dospeng, waktu, tanggal periode yang sama
        $check1 = Presentasi::where('id_dospeng', $request->id_dospeng)
                            ->where('id_sesiwaktu', $request->id_sesiwaktu)
                            ->where('tanggal', $request->tanggal)
                            ->where('id_periode', $request->id_periode)
                            ->first();
        //waktu, tanggal, ruang, periode yang sama
        $check2 = Presentasi::where('id_sesiwaktu', $request->id_sesiwaktu)
                            ->where('id_ruang', $request->id_ruang)
                            ->where('tanggal', $request->tanggal)
                            ->where('id_periode', $request->id_periode)
                            ->first();

        if($check){
            return response()->json(['message' => 'Jadwal dosen bentrok']);
        }else if($check1){
            return response()->json(['message' => 'Jadwal dosen bentrok']);
        }else if($check2){
            return response()->json(['message' => 'Jadwal presentasi bentrok']);
        }else{

            $this->validate($request, [
                'id_kelompok' => 'required|max:4',
                'id_dospeng' => 'required',
                'id_sesiwaktu' => 'required',
                'id_ruang' => 'required',
                'tanggal' => 'required',
                'id_periode' => 'required',
            ],
            [
                'judul.required' => 'kelompok tidak boleh kosong !',
                'id_dospeng.required' => 'dosen penguji tidak boleh kosong !',
                'id_sesiwaktu.required' => 'sesi tidak boleh kosong !',
                'id_ruang.required' => 'ruang tidak boleh kosong !',
                'tanggal.required' => 'tanggal tidak boleh kosong !'
            ]);
    
    
            $presentasi = Presentasi::create([
                'id_kelompok' => $request->id_kelompok,
                'id_dospeng' => $request->id_dospeng,
                'id_sesiwaktu' => $request->id_sesiwaktu,
                'id_ruang' => $request->id_ruang,
                'tanggal' => $request->tanggal,
                'id_periode' => $request->id_periode,
                'created_by' => $request->created_by,
            ]);
            $presentasi->save();
            return response()->json(['message' => 'Jadwal berhasil ditambahkan.']);
        }
        
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
        $presentasi = Presentasi::findOrFail($id_jadwal_presentasi);
        $data = Presentasi::join('dosen', 'jadwal_presentasi.id_dospeng', 'dosen.id_dosen')
                            ->join('kelompok', 'jadwal_presentasi.id_kelompok', 'kelompok.id_kelompok')
                            ->select('dosen.nama as dospeng', 'dosen.id_dosen', 'kelompok.nama_kelompok', 'kelompok.id_kelompok')
                            ->where('jadwal_presentasi.id_jadwal_presentasi', $id_jadwal_presentasi)
                            ->first();

        $kelompok = Kelompok::select('id_kelompok', 'nama_kelompok')->get();
        $dosen = Dosen::select('id_dosen', 'nama')->where('status', 'open')->where('isDeleted', 0)->get();
        $sesi = Sesiwaktu::select('id_sesiwaktu', 'sesi')->get();
        $ruang = Ruang::select('id_ruang', 'ruang')->get();
        $periode = Periode::where('status', 'open')->first();
        return view('admin.presentasi.edit_presentasi', compact('presentasi','data','kelompok', 'sesi', 'ruang', 'dosen', 'periode'));
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
        //chect dospeng dengan dosbing belumm
        $che = Presentasi::join('kelompok as k', 'jadwal_presentasi.id_kelompok', 'k.id_kelompok')
                        ->join('dosen as d', 'k.id_dosen', 'd.id_dosen')
                        ->select('d.id_dosen', 'k.id_kelompok')
                        ->where('d.id_dosen', $request->id_dospeng)
                        ->where('k.id_kelompok', $request->id_kelompok)
                        ->first();

        //dospeng, waktu, ruang, tanggal periode yang sama
        $check = Presentasi::where('id_dospeng', $request->id_dospeng)
                            ->where('id_sesiwaktu', $request->id_sesiwaktu)
                            ->where('tanggal', $request->tanggal)
                            ->where('id_ruang', $request->id_ruang)
                            ->where('id_periode', $request->id_periode)
                            ->first();

        //dospeng, waktu, tanggal periode yang sama
        $check1 = Presentasi::where('id_dospeng', $request->id_dospeng)
                            ->where('id_sesiwaktu', $request->id_sesiwaktu)
                            ->where('tanggal', $request->tanggal)
                            ->where('id_periode', $request->id_periode)
                            ->first();
        //waktu, tanggal, ruang, periode yang sama
        $check2 = Presentasi::where('id_sesiwaktu', $request->id_sesiwaktu)
                            ->where('id_ruang', $request->id_ruang)
                            ->where('tanggal', $request->tanggal)
                            ->where('id_periode', $request->id_periode)
                            ->first();

        if($check){
            return response()->json(['message' => 'Jadwal dosen bentrok']);
        }else if($check1){
            return response()->json(['message' => 'Jadwal dosen bentrok']);
        }else if($check2){
            return response()->json(['message' => 'Jadwal presentasi bentrok']);
        }else{

            $this->validate($request, [
                'id_kelompok' => 'required|max:4',
                'id_dospeng' => 'required',
                'id_sesiwaktu' => 'required',
                'id_ruang' => 'required',
                'tanggal' => 'required',
                'id_periode' => 'required',
            ],
            [
                'id_kelompok.required' => 'kelompok tidak boleh kosong !',
                'id_dospeng.required' => 'dosen penguji tidak boleh kosong !',
                'id_sesiwaktu.required' => 'sesi tidak boleh kosong !',
                'id_ruang.required' => 'ruang tidak boleh kosong !',
                'tanggal.required' => 'tanggal tidak boleh kosong !'
            ]);

            $presentasi = Presentasi::findOrFail($id_jadwal_presentasi);
            $presentasi->update([
                'id_kelompok' => $request->id_kelompok,
                'id_dospeng' => $request->id_dospeng,
                'id_sesiwaktu' => $request->id_sesiwaktu,
                'id_ruang' => $request->id_ruang,
                'tanggal' => $request->tanggal,
            ]);
            $presentasi->save();
            return response()->json(['message' => 'Jadwal berhasil diubah.']);
        }
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
        return response()->json(['message' => 'Jadwal berhasil dihapus.']);
    }
}
