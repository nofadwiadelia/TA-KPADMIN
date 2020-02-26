<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Instansi;
use App\User;
use App\Periode;
use App\Lowongan;
use App\Role;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = Instansi::leftJoin('users', 'instansi.users_id', 'users.id_users')
                        ->select('instansi.id', 'instansi.users_id', 'users.nama_lengkap')
                        ->orderBy('nama_lengkap')
                        ->get();
        return view('admin.instansi.daftar_instansi',compact('instansi'));
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
        $periode =  Periode::select('id', 'tahun')->get();
        $data = Instansi::leftJoin('users', 'instansi.users_id', 'users.id_users')
                        ->leftJoin('roles', 'users.roles_id', '=','roles.id_roles')
                        ->select('users.nama_lengkap', 'roles.nama')
                        ->where('instansi.id', '=', $id)
                        ->first();
        $lowongan = Lowongan::leftJoin('instansi', 'lowongan.instansi_id', 'instansi.id')
                            ->leftJoin('users', 'instansi.users_id', 'users.id_users')
                            ->leftJoin('periode', 'lowongan.periode_id', 'periode.id')
                            ->select('lowongan.id', 'lowongan.posisi', 'lowongan.persyaratan', 'lowongan.slot', 'lowongan.instansi_id', 'instansi.id', 'users.id_users', 'users.nama_lengkap')
                            ->where('lowongan.instansi_id', '=', $id)
                            ->first();
        return view('admin.instansi.detail_instansi',compact('data', 'periode', 'lowongan'));
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
