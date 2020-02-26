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
        $data = Lowongan::leftJoin('instansi', 'lowongan.instansi_id', 'instansi.id')
                        ->leftJoin('users', 'instansi.users_id', 'users.id_users')
                        ->leftJoin('periode', 'lowongan.periode_id', 'periode.id')
                        ->select('lowongan.id', 'lowongan.posisi', 'lowongan.persyaratan', 'lowongan.slot', 'users.nama_lengkap', 'periode.tahun')
                        ->orderBy('lowongan.created_at')
                        ->get();
        return view('admin.lowongan.lowongan',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Instansi::leftJoin('users', 'instansi.users_id', 'users.id_users')
                        ->select('instansi.id', 'instansi.users_id', 'users.nama_lengkap')
                        ->orderBy('nama_lengkap')
                        ->get();
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
            'posisi' => 'required|string|max:100',
            'persyaratan' => 'required',
            'slot' => 'required',
        ]);
        $data = Lowongan::create([
            'posisi' => $request->posisi,
            'persyaratan' => $request->persyaratan,
            'slot' => $request->slot,
            'instansi_id' => $request->instansi_id,
            'periode_id' => $request->periode_id
        ]);
        $data->save();
        return redirect(route('lowongan.index'))
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
        $data = Lowongan::findOrFail($id);
        $lowongan = Lowongan::leftJoin('instansi', 'lowongan.instansi_id', 'instansi.id')
                        ->leftJoin('users', 'instansi.users_id', 'users.id_users')
                        ->select('lowongan.id', 'lowongan.posisi', 'lowongan.persyaratan', 'lowongan.slot', 'lowongan.instansi_id', 'instansi.id', 'users.id_users', 'users.nama_lengkap')
                        ->where('lowongan.id', '=', $id)
                        ->first();
        return view('admin.lowongan.detail_lowongan',compact('lowongan', 'data'));
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
        $lowongan = Lowongan::find($id);
        $lowongan->delete();
        return redirect()->back()->with(['success' => '<strong>' . $lowongan->posisi . '</strong> Telah Dihapus!']);
    }
}
