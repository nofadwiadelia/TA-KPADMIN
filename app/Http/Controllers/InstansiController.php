<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Instansi;
use App\User;
use App\Kelompok;
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
        $instansi = Instansi::get();
        return view('admin.instansi.daftar_instansi',compact('instansi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instansi.add_instansi');
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
            'nama' => 'required|string|max:191',
            'username' => 'required|string|unique:users|max:191',
            'password' => 'required|min:6|max:191',
            'email' => 'required|email|max:191',
            'no_hp' => 'required|max:25',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ],
        [
            'nama.required' => 'can not be empty !',
            'username.required' => 'can not be empty !',
            'username.unique' => 'username has already been taken !',
            'password.max' => 'password is to long !',
            'email.required' => 'can not be empty !',
            'no_hp.required' => 'can not be empty !',
        ]);

        $foto = null;
        if($request->hasFile('foto')){
            $files=$request->file('foto');
            $foto=str_slug($request->nama) . time() . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/users/instansi'),$foto);
        }

        $data = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_roles' => 2
        ])->instansi()->create([
            'nama' => $request->nama,
            'alamat' => $request->nama, 
            'deskripsi' => $request->deskripsi,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => $foto,
        ]);
        $data->save();
        return response()->json(['message' => 'Dosen added successfully.']);
    }

    public function changeStatus(Request $request){
        $instansi = Instansi::findOrFail($request->instansi_id);
        $instansi->status = $request->status;
        $instansi->save();

        return response()->json(['message' => 'Periode status updated successfully.']);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_instansi)
    {
        $periode = Periode::get();
        // $periode =  Periode::select('id_periode', 'tahun_periode')->get();
        $instansi = Instansi::findOrFail($id_instansi);
        $role = Instansi::leftJoin('users', 'instansi.id_users', 'users.id_users')
                        ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                        ->select('instansi.id_instansi', 'roles.roles')
                        ->where('instansi.id_instansi', '=', $id_instansi)
                        ->first();
        $lowongan = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                            ->leftJoin('periode', 'lowongan.id_periode', 'periode.id_periode')
                            ->select('lowongan.id_lowongan', 'lowongan.pekerjaan', 'lowongan.persyaratan', 'lowongan.kapasitas', 'lowongan.id_instansi', 'instansi.id_instansi', 'instansi.nama', 'periode.tahun_periode')
                            ->where('lowongan.id_instansi', '=', $id_instansi)
                            ->get();
        $kelompok = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->where('magang.id_instansi', $id_instansi)
                            ->select('kelompok.*', 'mahasiswa.nama', 'periode.tahun_periode')
                            ->get();
                            
        return view('admin.instansi.detail_instansi',compact('role', 'periode','instansi', 'lowongan', 'kelompok'));
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

    public function editaccount($id_instansi)
    {
        $instansi = Instansi::findOrFail($id_instansi);
        return view('admin.instansi.edit_instansi', compact('instansi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_users)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'no_hp' => 'required|max:25',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ],
        [
            'nama.required' => 'can not be empty !',
            'username.required' => 'can not be empty !',
            'password.max' => 'password is to long !',
            'email.required' => 'can not be empty !',
            'no_hp.required' => 'can not be empty !',
        ]);

        $data = User::findOrFail($id_users);
        $data->update([
            'username' => $request->username,
        ]);
        $data->instansi()->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat, 
            'deskripsi' => $request->deskripsi,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
        return response()->json(['message' => 'Data updated successfully.']);
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
