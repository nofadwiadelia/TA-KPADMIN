<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Mahasiswa;
use App\User;
use App\Role;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mahasiswa::leftJoin('users', 'mahasiswa.users_id', 'users.id_users')
                        ->select('mahasiswa.id', 'mahasiswa.users_id', 'users.nama_lengkap')
                        ->orderBy('nama_lengkap')
                        ->get();
        // return response()->json([
        //     'status'=>'succes',
        //     'message'=>'Berhasil',
        //     'data' => $data
        // ]);
        return view('admin.mahasiswa.daftar_mahasiswa',compact('data'));
    }

    public function indexmahasiswa()
    {
        $mahasiswa = Mahasiswa::leftJoin('users', 'mahasiswa.users_id', 'users.id_users')
                            ->leftJoin('roles', 'users.roles_id', 'roles.id_roles')
                            ->select('mahasiswa.id', 'mahasiswa.users_id', 'users.id_users', 'users.nama_lengkap', 'roles.id_roles', 'roles.nama', 'mahasiswa.no_hp', 'mahasiswa.email', 'mahasiswa.pengalaman', 'mahasiswa.keahlian', 'mahasiswa.nim')
                            ->first();
        return view('mahasiswa.profile', compact('mahasiswa'));
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
    public function show(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $data = Mahasiswa::leftJoin('users', 'mahasiswa.users_id', 'users.id_users')
                        ->leftJoin('roles', 'users.roles_id', 'roles.id_roles')
                        ->select('mahasiswa.id', 'mahasiswa.users_id', 'users.id_users', 'users.nama_lengkap', 'roles.id_roles', 'roles.nama')
                        ->where('mahasiswa.id', '=', $id)
                        ->first();
        return view('admin.mahasiswa.detail_mahasiswa',compact('mahasiswa', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::leftJoin('users', 'mahasiswa.users_id', 'users.id_users')
                                ->select('mahasiswa.id', 'mahasiswa.users_id', 'users.id_users', 'users.nama_lengkap', 'mahasiswa.nim', 'mahasiswa.no_hp', 'mahasiswa.pengalaman', 'mahasiswa.keahlian')
                                ->where('id',$id)->first();
        return view('mahasiswa.editprofil', compact('mahasiswa'));
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
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->email = $request->email;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->keahlian = $request->keahlian;
        $mahasiswa->pengalaman = $request->pengalaman;
        $mahasiswa->save();

        $users = User::where('id_users', $mahasiswa->users_id)->first();
        $users->nama_lengkap = $request->nama_lengkap;

        
        $users->save();
        return redirect('mahasiswa/profile');
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
