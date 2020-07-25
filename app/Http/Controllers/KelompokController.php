<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Kelompok;
use App\Periode;
use App\Dosen;
use App\Magang;
use App\Mahasiswa;
use DB;

class KelompokController extends Controller
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
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                            ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                            ->leftJoin('instansi', 'magang.id_instansi', 'instansi.id_instansi')
                            ->where('kelompok.id_periode', $request->id_periode)
                            ->where('kelompok.tahap', 'diterima')
                            ->where('kelompok.isDeleted', 0) 
                            ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama', 'periode.tahun_periode', 'instansi.nama as instansi_nama', 'magang.status')
                            ->get();
            }else{
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                            ->leftJoin('instansi', 'magang.id_instansi', 'instansi.id_instansi')
                            ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama', 'instansi.nama as instansi_nama', 'magang.status')
                            ->where('kelompok.tahap', 'diterima')
                            ->where('kelompok.isDeleted', 0)
                            ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($kelompok){
                $btn = '<a href="/admin/kelompok/magang/'.$kelompok->id_kelompok.'/detail" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.magang.magangListing',compact('periode'));
    }

    public function detailmagang($id_kelompok){
        $kelompok = Kelompok::join('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->select('kelompok.nama_kelompok', 'dosen.nama')
                            ->where('kelompok.id_kelompok', $id_kelompok)
                            ->first();
        $magang = Magang::leftJoin('kelompok', 'magang.id_kelompok', 'kelompok.id_kelompok')
                        ->leftJoin('instansi','magang.id_instansi', 'instansi.id_instansi')
                        ->select('instansi.nama as instansi_nama', 'magang.tanggal_mulai', 'magang.tanggal_selesai', 'instansi.alamat', 'instansi.deskripsi','instansi.website', 'magang.jobdesk')
                        ->where('magang.id_kelompok', $id_kelompok)
                        ->first();
        $kelompoks = Kelompok::join('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->join('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where(function($q) {
                                $q->where('kelompok_detail.status_join', 'create')
                                ->orWhere('kelompok_detail.status_join', 'diterima');
                            })
                            ->where('kelompok_detail.isDeleted', 0)
                            ->select('mahasiswa.id_mahasiswa','mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.no_hp', 'kelompok_detail.status_keanggotaan', 'kelompok.id_kelompok')
                            ->where('kelompok_detail.id_kelompok', '=', $id_kelompok)
                            ->get();
        return view('admin.magang.detailMagang',compact('kelompok', 'magang', 'kelompoks'));
    }

    public function indexdosen()
    {
        $kelompok = Kelompok::get();
        return view('dosen.kelompok.kelompok',compact('kelompok'));
    }
    
    public function acckelompok(Request $request)
    {
        $periode = Periode::where('isDeleted', 0)->get();
        $dosen = Dosen::select('id_dosen','nama')
                        ->where('status', 'open')
                        ->where('isDeleted', '0')
                        ->get();
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                            ->where('kelompok.id_periode', $request->id_periode)
                            ->select('periode.tahun_periode','kelompok.id_kelompok','kelompok.nama_kelompok','kelompok.tahap', 'mahasiswa.nama', 'dosen.nama as dosen_nama')
                            ->where('kelompok.isDeleted', 0)
                            ->get();
            }else{
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                            ->select('periode.tahun_periode','kelompok.id_kelompok','kelompok.nama_kelompok','kelompok.tahap', 'mahasiswa.nama', 'dosen.nama as dosen_nama')
                            ->where('kelompok.isDeleted', 0)
                            ->get();
            }
            return datatables()->of($data)
            ->addColumn('action', function($kelompok){
                $disable = $kelompok->tahap != 'diproses'? "disabled" : " ";

                $btn = '<a href="#"  id="'.$kelompok->id_kelompok.'" class="btn btn-sm btn-info editbtn '.$disable.'"><i class="fas fa-check"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a href="#" id="'.$kelompok->id_kelompok.'" class="btn btn-danger btn-sm declinebtn '.$disable.'"><i class="fas fa-times"></i></a>';
                return $btn;
            })
            ->addColumn('detail', function($kelompok){
                $btn = '<div class="btn-group btn-group-sm"><a href="/admin/kelompok/'.$kelompok->id_kelompok.'"  class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a></div>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<div class="btn-group btn-group-sm"><button type="button" id="'.$kelompok->id_kelompok.'" class="btn btn-danger btn-sm deleteKelompok"><i class="fas fa-trash"></i></button></div>';
                return $btn;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'detail'])
            ->make(true);
        }
        return view('admin.kelompok.persetujuan_kelompok',compact('periode', 'dosen'));
    }

    public function createkelompok(){
        $userId= Auth::id();
        $periode = Periode::select('id_periode')
        ->where('status', 'open')->first();

        $data1 = Mahasiswa::join('kelompok_detail', 'kelompok_detail.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
        ->where('kelompok_detail.status_join', '!=', 'ditolak')
        ->select('mahasiswa.id_mahasiswa')
        ->get();
        $mahasiswa_memiliki_kelompok = $data1->pluck('id_mahasiswa');  
        $mahasiswa_memiliki_kelompok->all();

        $data2 = Mahasiswa::join('kelompok_detail', 'kelompok_detail.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
        ->join('kelompok', 'kelompok.id_kelompok', '=', 'kelompok_detail.id_kelompok')
        ->where('kelompok_detail.status_join', '=', "create")
        ->where('kelompok.tahap', '!=', 'ditolak')
        ->select('mahasiswa.id_mahasiswa')
        ->get();
        $mahasiswa_menjadi_ketua = $data2->pluck('id_mahasiswa');
        $mahasiswa_menjadi_ketua->all();

        $data3 = Mahasiswa::join('kelompok_detail', 'kelompok_detail.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
        ->where('kelompok_detail.status_join', "=", "diinvite")
        ->select('mahasiswa.id_mahasiswa')
        ->get();
        $mahasiswa_terinvite_users = $data3->pluck('id_mahasiswa');  
        $mahasiswa_terinvite_users->all();

        $mahasiswa_tersedia = Mahasiswa::where('mahasiswa.id_periode', '=', $periode->id_periode)
        ->whereNotIn('mahasiswa.id_mahasiswa', $mahasiswa_memiliki_kelompok)
        ->whereNotIn('mahasiswa.id_mahasiswa', $mahasiswa_menjadi_ketua)
        ->whereNotIn('mahasiswa.id_mahasiswa', $mahasiswa_terinvite_users)
        ->where('mahasiswa.isDeleted', 0)
        ->select('mahasiswa.id_mahasiswa', 'mahasiswa.nama', 'mahasiswa.nim')
        ->get();

        return view('admin.kelompok.create_kelompoks', compact('userId','mahasiswa_tersedia'));
    }

    //CREATE KELOMPOK DI ADMIN
    public function storekelompok(Request $request)
    {
        $this->validate($request, [
            'nama_kelompok' => 'required|string|max:100',
        ],
        [
            'nama_kelompok.required' => 'Nama Kelompok tidak boleh kosong !',
            'nama_kelompok.max' => 'Nama Kelompok gerlalu panjang !',
        
        ]);
        $periode =  Periode::where('status', 'open')->first();
        $data = Kelompok::create([
            'nama_kelompok' => $request->nama_kelompok,
            'id_periode' => $periode->id_periode,
            'tahap' => 'diproses',
            'created_by' => $request->created_by,
        ]);

        $data = DB::table('kelompok_detail')->insert([
            'id_kelompok' => $data->id_kelompok,
            'id_mahasiswa' => $request->id_mahasiswa,
            'status_keanggotaan' => 'Ketua',
            'status_join' => 'create',
            'created_by' => $request->created_by,
        ]);
        return response()->json(['message' => 'Kelompok berhasil ditambahkan.']);
    }

    public function detailacckelompok($id_kelompok)
    {
        $kelompoks = Kelompok::findOrFail($id_kelompok);
        $kelompok = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->select('mahasiswa.id_mahasiswa','mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.no_hp', 'kelompok_detail.status_keanggotaan', 'kelompok_detail.id_kelompok_detail')
                                ->where('kelompok_detail.id_kelompok', $id_kelompok)
                                ->where('kelompok_detail.status_join', '!=', 'ditolak')
                                ->get();
        
        $periode = Periode::select('id_periode')
        ->where('status', 'open')->first();

        $data1 = Mahasiswa::join('kelompok_detail', 'kelompok_detail.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
        ->where('kelompok_detail.status_join', '!=', 'ditolak')
        ->where('kelompok_detail.isDeleted', "=", "0")
        ->select('mahasiswa.id_mahasiswa')
        ->get();
        $mahasiswa_memiliki_kelompok = $data1->pluck('id_mahasiswa');  
        $mahasiswa_memiliki_kelompok->all();

        $data2 = Mahasiswa::join('kelompok_detail', 'kelompok_detail.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
        ->join('kelompok', 'kelompok.id_kelompok', '=', 'kelompok_detail.id_kelompok')
        ->where('kelompok_detail.status_join', '=', "create")
        ->where('kelompok.tahap', '!=', 'ditolak')
        ->select('mahasiswa.id_mahasiswa')
        ->get();
        $mahasiswa_menjadi_ketua = $data2->pluck('id_mahasiswa');
        $mahasiswa_menjadi_ketua->all();

        $data3 = Mahasiswa::join('kelompok_detail', 'kelompok_detail.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
        ->where('kelompok_detail.status_join', "=", "diinvite")
        ->where('kelompok_detail.isDeleted', "=", "0")
        ->select('mahasiswa.id_mahasiswa')
        ->get();
        $mahasiswa_terinvite_users = $data3->pluck('id_mahasiswa');  
        $mahasiswa_terinvite_users->all();

        $mahasiswa_tersedia = Mahasiswa::where('mahasiswa.id_periode', '=', $periode->id_periode)
        ->whereNotIn('mahasiswa.id_mahasiswa', $mahasiswa_memiliki_kelompok)
        ->whereNotIn('mahasiswa.id_mahasiswa', $mahasiswa_menjadi_ketua)
        ->whereNotIn('mahasiswa.id_mahasiswa', $mahasiswa_terinvite_users)
        ->select('mahasiswa.id_mahasiswa', 'mahasiswa.nama', 'mahasiswa.nim')
        ->where('mahasiswa.isDeleted', 0)
        ->get();
                    

        return view('admin.kelompok.detailKelompok', compact('kelompok', 'kelompoks', 'mahasiswa_tersedia'));
    }

    public function postacckelompok(Request $request)
    {
        $kelompok = Kelompok::findOrFail($request->id_kelompok);
        $kelompok->id_dosen = $request->id_dosen;
        $kelompok->tahap = 'diterima';
        $kelompok->save();

        $dosen = Dosen::findOrFail($request->id_dosen);
        $dosen->slot = $dosen->slot - 1;
        $dosen->save();

        return response()->json(['message' => 'Kelompok berhasil diterima.']);
    }

    public function declinekelompok(Request $request)
    {
        $kelompok = Kelompok::findOrFail($request->id_kelompok);
        $kelompok->tahap = 'ditolak';

        $kelompok->save();
        return response()->json(['message' => 'Kelompok berhasil ditolak.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function showdosen($id)
    {
        $kelompok = Kelompok::findOrFail($id);
        return view('dosen.kelompok.detail_kelompok', compact('kelompok'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function addAnggotaMerge(Request $request)
    {
        $data = DB::table('kelompok_detail')->insert([
            'id_kelompok' => $request->id_kelompok,
            'id_mahasiswa' => $request->id_mahasiswa,
            'status_keanggotaan' => 'Anggota',
            'status_join' => 'diterima',
        ]);
        return response()->json(['message' => 'Anggota berhasil ditambahkan.']);
    }

    public function kick($id_kelompok_detail)
    {
        $anggota = DB::table('kelompok_detail')->where('id_kelompok_detail',$id_kelompok_detail);
        $anggota->delete();
        return response()->json(['message' => 'Anggota berhasil dikeluarkan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kelompok)
    {
        $kelompok = Kelompok::find($id_kelompok);
        $lowongan->isDeleted = 1;
        $lowongan->save();
        return response()->json(['message' => 'Kelompok berhasil dihapus.']);
    }
}
