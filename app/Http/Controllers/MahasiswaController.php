<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use File;
use Image;

use App\Mahasiswa;
use App\User;
use App\Role;
use App\Periode;
use App\LaporanHarian;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mahasiswa::get();
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
    public function show(Request $request, $id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::findOrFail($id_mahasiswa);
        $role = Mahasiswa::leftJoin('users', 'mahasiswa.id_users', 'users.id_users')
                        ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                        ->select('mahasiswa.id_mahasiswa', 'roles.roles')
                        ->where('mahasiswa.id_mahasiswa', '=', $id_mahasiswa)
                        ->first();
        $bukuharian =  LaporanHarian::leftJoin('mahasiswa', 'buku_harian.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->select('mahasiswa.nama', 'buku_harian.id_buku_harian', 'buku_harian.tanggal', 'buku_harian.waktu_mulai', 'buku_harian.waktu_selesai', 'buku_harian.kegiatan', 'buku_harian.status')
                                ->where('mahasiswa.id_mahasiswa', '=', $id_mahasiswa)
                                ->get();
        return view('admin.mahasiswa.detail_mahasiswa',compact('mahasiswa', 'role', 'bukuharian'));
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

        return redirect('mahasiswa/profile');
    }

    public function updateAvatar(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $file = $request->file('photo');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = $data->nim . '.' . $extension;
        Storage::put('images/uploads/avatar/' . $filename, File::get($file));
        $file_server = Storage::get('images/uploads/avatar/' . $filename);
        $img = Image::make($file_server)->resize(141, 141);
        $img->save(base_path('public/images/uploads/avatar/' . $filename));

        $mahasiswa->photo=$filename;
        $mahasiswa->save();
        Alert::success('Success', 'Avatar has been changed!');
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
