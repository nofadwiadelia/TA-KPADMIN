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
        //
    }

    public function indexdosen()
    {
        $kelompok = Kelompok::get();
        return view('dosen.kelompok.kelompok',compact('kelompok'));
    }
    
    public function acckelompok()
    {
        $dosen = Dosen::get();
        $kelompok = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok_detail')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->select('kelompok.id_kelompok','kelompok.nama_kelompok','kelompok.persetujuan', 'mahasiswa.nama', 'dosen.id_dosen')
                            ->get();
        return view('admin.kelompok.persetujuan_kelompok',compact('kelompok', 'dosen'));
    }

    public function postacckelompok(Request $request)
    {
        $kelompok = Kelompok::findOrFail($request->id_kelompok);
        $kelompok->id_dosen = $request->id_dosen;
        $kelompok->persetujuan = $request->persetujuan;

        $kelompok->save();
        return response()->json(['message' => 'Acc Kelompok updated successfully.']);
    }

    public function declinekelompok(Request $request)
    {
        $kelompok = Kelompok::findOrFail($request->id_kelompok);
        $kelompok->persetujuan = $request->persetujuan;

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
