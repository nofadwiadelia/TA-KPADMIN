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
        $dosen = Dosen::get();
        return view('admin.dosen.daftar_dosen',compact('dosen'));
    }

    public function changeStatus(Request $request){
        $dosen = Dosen::findOrFail($request->dosen_id);
        $dosen->status = $request->status;
        $dosen->save();

        return response()->json(['message' => 'Dosen status updated successfully.']);

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
    public function show($id_dosen)
    {
        $dosen = Dosen::findOrFail($id_dosen);
        $role = Dosen::leftJoin('users', 'dosen.id_users', 'users.id_users')
                        ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                        ->select('dosen.id_dosen', 'roles.roles')
                        ->where('dosen.id_dosen', '=', $id_dosen)
                        ->first();
        return view('admin.dosen.detail_dosen',compact('role', 'dosen'));
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
