<?php

namespace App\Http\Controllers;
use App\Lowongan;
use App\Instansi;
use App\Periode;

use Illuminate\Http\Request;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lowongan = Lowongan::get();
        return view('admin.lowongan.lowongan',compact('lowongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Instansi::get();
        $datas = Periode::get();
        return view('admin.lowongan.add_lowongan',compact('data', 'datas'));
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
            'persyaratan' => 'required',
            'kapasitas' => 'required',
        ]);
        $data = Lowongan::create([
            'pekerjaan' => $request->pekerjaan,
            'persyaratan' => $request->persyaratan,
            'kapasitas' => $request->kapasitas,
            'id_instansi' => $request->id_instansi,
            'id_periode' => $request->id_periode
        ]);
        $data->save();
        return response()->json(['message' => 'Lowongan status added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_lowongan)
    {
        $data = Lowongan::findOrFail($id_lowongan);
        return view('admin.lowongan.detail_lowongan',compact('data'));
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
        $instansi = Instansi::get();
        $periode = Periode::get();
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
        ]);
        $data = Lowongan::findOrFail($id_lowongan);
        $data->update([
            'pekerjaan' => $request->pekerjaan,
            'persyaratan' => $request->persyaratan,
            'kapasitas' => $request->kapasitas,
            'id_instansi' => $request->id_instansi,
            'id_periode' => $request->id_periode
        ]);
        $data->save();
        return response()->json(['message' => 'Periode update successfully.']);
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
        $lowongan->delete();
        return response()->json(['message' => 'Lowongan deleted successfully.']);
    }
}
