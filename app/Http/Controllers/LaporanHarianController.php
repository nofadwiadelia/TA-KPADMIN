<?php

namespace App\Http\Controllers;

use App\LaporanHarian;
use App\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporanharian = LaporanHarian::get();
        return view('mahasiswa/laporanharian', compact('laporanharian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = LaporanHarian::all();
        return view('mahasiswa.laporanharian',compact('data'));
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
            'tanggal' => 'required',
            'datang' => 'required',
            'pulang' => 'required',
            'kegiatan' => 'required',
        ]);
        $data = LaporanHarian::create([
            'tanggal' => $request->tanggal,
            'datang' => $request->datang,
            'pulang' => $request->pulang,
            'kegiatan' => $request->kegiatan,
            'mahasiswa_id' => $request->mahasiswa_id,
        ]);
        $data->save();
        return view('mahasiswa.laporanharian')
        ->with('alert-success','Berhasil Menambahkan Data!');
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
