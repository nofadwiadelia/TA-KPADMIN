<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Lowongan;
use App\Instansi;
use App\Periode;
use App\Magang;
use App\Pelamar;
use DB;

use Illuminate\Http\Request;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periode = DB::table('periode')->where('isDeleted', 0)->get();
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                                ->select('lowongan.*', 'instansi.nama')
                                ->where('lowongan.id_periode',  $request->id_periode)
                                ->where('lowongan.isDeleted', '0')
                                ->where('instansi.isDeleted', '0')
                                ->get();
            }else{
                $data = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                                ->select('lowongan.*', 'instansi.nama')
                                ->where('lowongan.isDeleted', '0')
                                ->where('instansi.isDeleted', '0')
                                ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($lowongan){
                $btn = '<a href="/admin/lowongan/'.$lowongan->id_lowongan.'/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<button type="button" name="delete" id="'.$lowongan->id_lowongan.'" class="btn btn-danger btn-sm deleteLowongan" ><i class="fas fa-trash"></i></button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.lowongan.lowongan',compact('periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        $data = Instansi::select('id_instansi','nama')
                    ->where('status', 'open')
                    ->where('isDeleted', '0')
                    ->where('isBlacklist', '0')
                    ->get();
        $periode = Periode::where('status', 'open')->first();
        return view('admin.lowongan.add_lowongan',compact('data', 'periode', 'userId'));
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
            'pekerjaan' => 'required|string|max:100',
            'persyaratan' => 'required|string|max:1000',
            'kapasitas' => 'required',
            'slot' => 'required',
        ],
        [
            'pekerjaan.required' => 'pekerjaan tidak boleh kosong !',
            'pekerjaan.max' => 'pekerjaan terlalu panjang !',
            'persyaratan.required' => 'persyaratan tidak boleh kosong !',
            'persyaratan.max' => 'persyaratan terlalu panjang !',
            'kapasitas.required' => 'kapasitas tidak boleh kosong !',
            'slot.required' => 'slot tidak boleh kosong !',
        ]);

        $data = Lowongan::create([
            'pekerjaan' => $request->pekerjaan,
            'persyaratan' => $request->persyaratan,
            'kapasitas' => $request->kapasitas,
            'slot' => $request->slot,
            'id_instansi' => $request->id_instansi,
            'id_periode' => $request->id_periode,
            'created_by' => $request->created_by,
        ]);
        $data->save();
        return response()->json(['message' => 'Lowongan berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_lowongan)
    {
        $lowongan = Lowongan::findOrFail($id_lowongan);
        $applylowongan = DB::table('pelamar')
                            ->leftJoin('lowongan', 'pelamar.id_lowongan', 'lowongan.id_lowongan')
                            ->leftJoin('periode', 'lowongan.id_periode', 'periode.id_periode')
                            ->leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                            ->leftJoin('kelompok', 'pelamar.id_kelompok', '=', 'kelompok.id_kelompok')
                            ->leftJoin('kelompok_detail', 'kelompok.id_kelompok', '=', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->select('kelompok.nama_kelompok', 'kelompok.id_kelompok', 'mahasiswa.nama', 'pelamar.id_pelamar', 'pelamar.status', 'pelamar.tanggal_daftar', 'instansi.id_instansi', 'periode.id_periode', 'lowongan.pekerjaan')
                            ->where('lowongan.id_lowongan', $id_lowongan)
                            ->get();
        if(request()->ajax()){
            $data = DB::table('pelamar')
                    ->leftJoin('lowongan', 'pelamar.id_lowongan', 'lowongan.id_lowongan')
                    ->leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                    ->leftJoin('kelompok', 'pelamar.id_kelompok', '=', 'kelompok.id_kelompok')
                    ->leftJoin('kelompok_detail', 'kelompok.id_kelompok', '=', 'kelompok_detail.id_kelompok')
                    ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                    ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                    ->select('kelompok.nama_kelompok', 'kelompok.id_kelompok', 'mahasiswa.nama', 'pelamar.id_pelamar', 'pelamar.status', 'pelamar.tanggal_daftar', 'instansi.id_instansi')
                    ->where('lowongan.id_lowongan', $id_lowongan)
                    ->get();
            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function($lowongan){
                    $btn = '<a href="#" id="'.$lowongan->id_lowongan.'" class="btn btn-sm btn-info editbtn"><i class="fas fa-check"></i></a>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<button type="button" id="'.$id_lowongan->id_lowongan.'" class="btn btn-danger btn-sm declinebtn"><i class="fas fa-times"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.lowongan.detail_lowongan',compact('lowongan', 'applylowongan'));
    }

    public function acclowongan(Request $request){
        $lowongan = Lowongan::findOrFail($request->id_lowongan);

        if($lowongan->slot <= 0){
            return response()->json(['message' => 'Maaf slot sudah penuh']);
        }else{

            $lowongan->slot = $lowongan->slot - 1;
            $lowongan->save();

            $pelamar = Pelamar::findOrFail($request->id_pelamar);
            $pelamar->status = 'diterima';
            $pelamar->save();

            $pelamar = Magang::create([
                    'id_instansi' =>$request->id_instansi,
                    'id_periode' =>$request->id_periode,
                    'id_kelompok' => $request->id_kelompok,
                    'jobdesk' => $request->jobdesk,
                    'status' => 'belum magang',
            ]);
            return response()->json(['message' => 'Lamaran berhasil diterima']);
        }
    }

    public function declinelowongan(Request $request){
        $pelamar = Pelamar::findOrFail($request->id_pelamar);
        $pelamar->status = 'ditolak';

        $pelamar->save();
        return response()->json(['message' => 'Lamaran ditolak']);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_lowongan)
    {
        $lowongan = Lowongan::findOrFail($id_lowongan);
        $instansi = Instansi::select('id_instansi','nama')
        ->where('status', 'open')
        ->where('isDeleted', '0')
        ->where('isBlacklist', '0')
        ->get();
        $periode = Periode::where('isDeleted', 0)->get();
        return view('admin.lowongan.edit_lowongan',compact('instansi', 'periode', 'lowongan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_lowongan)
    {
        $this->validate($request, [
            'pekerjaan' => 'required|string|max:100',
            'persyaratan' => 'required',
            'kapasitas' => 'required',
            'slot' => 'required',
        ],
        [
            'pekerjaan.required' => 'pekerjaan tidak boleh kosong !',
            'pekerjaan.max' => 'pekerjaan terlalu panjang !',
            'persyaratan.required' => 'persyaratan tidak boleh kosong !',
            'persyaratan.max' => 'persyaratan terlalu panjang !',
            'kapasitas.required' => 'kapasitas tidak boleh kosong !',
            'slot.required' => 'slot tidak boleh kosong !',
        ]);
        
        $data = Lowongan::findOrFail($id_lowongan);
        $data->update([
            'pekerjaan' => $request->pekerjaan,
            'persyaratan' => $request->persyaratan,
            'kapasitas' => $request->kapasitas,
            'slot' => $request->slot,
            'id_instansi' => $request->id_instansi,
            'id_periode' => $request->id_periode
        ]);
        $data->save();
        return response()->json(['message' => 'Lowongan berhasil diubah.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_lowongan)
    {
        $lowongan = Lowongan::find($id_lowongan);
        $lowongan->isDeleted = 1;
        $lowongan->save();
        return response()->json(['message' => 'Lowongan berhasil dihapus.']);
    }
}
