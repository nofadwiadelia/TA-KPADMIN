<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Dosen;
use App\User;
use App\Roles;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = Dosen::leftJoin('users', 'dosen.users_id', 'users.id_users')
                        ->select('dosen.id', 'dosen.users_id', 'users.nama_lengkap')
                        ->orderBy('nama_lengkap')
                        ->get();
        return view('admin.dosen.daftar_dosen',compact('dosen'));
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
        $data = Dosen::leftJoin('users', 'dosen.users_id', 'users.id_users')
                        ->leftJoin('roles', 'users.roles_id', 'roles.id_roles')
                        ->select('dosen.id', 'dosen.users_id', 'users.id_users', 'users.nama_lengkap', 'roles.id_roles', 'roles.nama')
                        ->where('dosen.id', '=', $id)
                        ->first();
        return view('admin.dosen.detail_dosen',compact('data'));
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
