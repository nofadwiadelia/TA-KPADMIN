<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usulan;
use App\Kelompok;
use App\Periode;
use DB;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function usulan(){
        $periode = Periode::get();
        $usulan = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status', 'Ketua')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama')
                            ->get();
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->where('kelompok_detail.status', 'Ketua')
                                ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                                ->leftJoin('usulan', 'kelompok.id_kelompok', 'usulan.id_kelompok')
                                ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                                ->where('kelompok.id_periode', $request->id_periode)
                                ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama', 'usulan.status')
                                ->get();
            }else{
                // $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                //                 ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                //                 ->where('kelompok_detail.status', 'Ketua')
                //                 ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                //                 ->leftJoin('usulan', 'kelompok.id_kelompok', 'usulan.id_kelompok')
                //                 ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                //                 ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama', 'usulan.status')
                //                 ->get();
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->where('kelompok_detail.status', 'Ketua')
                                ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                                ->leftJoin('usulan', 'kelompok.id_kelompok', 'usulan.id_kelompok')
                                ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama', 'usulan.status')
                                ->whereRaw('usulan.id_usulan in (select max(usulan.id_usulan) from usulan group by (usulan.id_kelompok))')
                                ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($kelompok){
                $btn = '<a href="/admin/usulan/kelompok/'.$kelompok->id_kelompok.'/detail" class="btn btn-sm btn-info editbtn"><i class="fa fa-arrow-right"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.usulan.usulan_pkl',compact('usulan', 'periode'));
    }
    public function detailusulan( $id_kelompok){
        $kelompok = Kelompok::findOrFail($id_kelompok);
        $kelompoks = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->select('mahasiswa.id_mahasiswa','mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.no_hp', 'kelompok_detail.status')
                            ->where('kelompok_detail.id_kelompok', '=', $id_kelompok)
                            ->get();
        $usulan = Usulan::select('usulan.*')
                        ->where('usulan.id_kelompok', '=', $id_kelompok)
                        ->get();
        return view('admin.usulan.detail_usulan',compact('kelompok', 'kelompoks', 'usulan'));
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
