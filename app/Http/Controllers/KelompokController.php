<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelompok;
use App\Periode;
use App\Dosen;
use App\Mahasiswa;

class KelompokController extends Controller
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
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                            ->where('kelompok.id_periode', $request->id_periode)
                            ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama', 'periode.tahun_periode')
                            ->get();

                            //pembeda pembimbing penguji blm
            }else{
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama')
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
        $kelompok = Kelompok::findOrFail($id_kelompok);
        $kelompoks = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->select('mahasiswa.id_mahasiswa','mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.no_hp', 'kelompok_detail.status_keanggotaan')
                            ->where('kelompok_detail.id_kelompok', '=', $id_kelompok)
                            ->get();
        return view('admin.magang.detailMagang',compact('kelompok', 'kelompoks'));
    }

    public function indexdosen()
    {
        $kelompok = Kelompok::get();
        return view('dosen.kelompok.kelompok',compact('kelompok'));
    }
    
    public function acckelompok()
    {
        $periode = Periode::get();
        $dosen = Dosen::get();
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                            ->where('kelompok.id_periode', $request->id_periode)
                            ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama')
                            ->get();
            }else{
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                            ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama')
                            ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($kelompok){
                $btn = '<a href="#" id="'.$kelompok->id_kelompok.'" class="btn btn-sm btn-info editbtn"><i class="fas fa-check"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<button type="button" id="'.$kelompok->id_kelompok.'" class="btn btn-danger btn-sm declinebtn"><i class="fas fa-times"></i></button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.kelompok.persetujuan_kelompok',compact('periode', 'dosen'));
    }

    public function detailacckelompok($id_kelompok)
    {
        $kelompok = Kelompok::findOrFail($id_kelompok);
        return view('admin.kelompok.detailKelompok', compact('kelompok'));
    }
    
    public function detail($id_kelompok)
    {
        if(request()->ajax()){
            $kelompoks = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->select('mahasiswa.id_mahasiswa','mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.no_hp', 'kelompok_detail.status_keanggotaan')
                                ->where('kelompok_detail.id_kelompok', $id_kelompok)
                                ->get();
        }
        return response()->json($kelompoks);
    }

    public function postacckelompok(Request $request)
    {
        $kelompok = Kelompok::findOrFail($request->id_kelompok);
        $kelompok->id_dosen = $request->id_dosen;
        $kelompok->persetujuan = 'diterima';

        $kelompok->save();
        return response()->json(['message' => 'Acc Kelompok updated successfully.']);
    }

    public function declinekelompok(Request $request)
    {
        $kelompok = Kelompok::findOrFail($request->id_kelompok);
        $kelompok->persetujuan = 'ditolak';

        $kelompok->save();
        return response()->json(['message' => 'Decline Kelompok updated successfully.']);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
