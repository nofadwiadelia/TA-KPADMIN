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
        $instansi = Instansi::where('isDeleted', '0')
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
        $userId = Auth::id();
        return view('admin.instansi.add_instansi', compact('userId'));
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
            'username' => 'required|string|unique:users|max:25',
            'password' => 'required|min:6|max:191',
            'email' => 'required|email|max:191',
            'alamat' => 'required|max:1000',
            'deskripsi' => 'required|max:1000',
            'website' => 'required|max:25',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:1024',
        ],
        [
            'nama.required' => 'nama tidak boleh kosong !',
            'nama.max' => 'nama terlalu panjang !',
            'username.required' => 'username tidak boleh kosong !',
            'username.unique' => 'username sudah terdaftar !',
            'username.max' => 'username terlalu panjang !',
            'password.required' => 'password tidak boleh kosong !',
            'password.max' => 'password terlalu panjang !',
            'email.required' => 'email tidak boleh kosong !',
            'email.max' => 'email terlalu panjang !',
            'alamat.required' => 'alamat tidak boleh kosong !',
            'alamat.max' => 'no hp terlalu panjang !',
            'deskripsi.required' => 'deskripsi tidak boleh kosong !',
            'deskripsi.max' => 'no hp terlalu panjang !',
            'website.max' => 'website terlalu panjang !',
            'foto.mimes' => 'format foto tidak sesuai !',
            'foto.max' => 'foto terlalu besar !',
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
            'created_by' => $request->created_by,
            'id_roles' => 3
        ])->instansi()->create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'website' => $request->website,
            'foto' => $foto,
            'created_by' => $request->created_by,
        ]);
        $data->save();
        return response()->json(['message' => 'Instansi berhasil ditambahkan.']);
    }

    public function changeStatus(Request $request){
        $instansi = Instansi::findOrFail($request->instansi_id);
        $instansi->status = $request->status;
        $instansi->save();

        return response()->json(['message' => 'Status instansi berhasil diubah']);
    }
    public function changeBlacklist(Request $request){
        $instansi = Instansi::findOrFail($request->instansi_id);
        $instansi->isBlacklist = $request->isBlacklist;
        $instansi->save();
        return response()->json(['message' => 'Status blacklist berhasil diubah.']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_instansi)
    {
        $periode = Periode::where('isDeleted', 0)->get();
        $instansi = Instansi::findOrFail($id_instansi);
        $role = Instansi::leftJoin('users', 'instansi.id_users', 'users.id_users')
                        ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                        ->select('instansi.id_instansi', 'roles.roles')
                        ->where('instansi.id_instansi', '=', $id_instansi)
                        ->first();
        $lowongan = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                            ->leftJoin('periode', 'lowongan.id_periode', 'periode.id_periode')
                            ->select('lowongan.id_lowongan', 'lowongan.pekerjaan', 'lowongan.persyaratan', 'lowongan.kapasitas','lowongan.slot', 'lowongan.id_instansi', 'instansi.id_instansi', 'instansi.nama', 'periode.tahun_periode')
                            ->where('lowongan.id_instansi', '=', $id_instansi)
                            ->get();
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                    ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                                    ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                    ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                                    ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                                    ->where('kelompok.id_periode', $request->id_periode)
                                    ->where('magang.id_instansi', $id_instansi)
                                    ->select('kelompok.*', 'mahasiswa.nama', 'periode.tahun_periode')
                                    ->get();
            }else{
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                    ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                                    ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                    ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                                    ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                                    ->where('magang.id_instansi', $id_instansi)
                                    ->select('kelompok.*', 'mahasiswa.nama', 'periode.tahun_periode')
                                    ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($kelompok){
                $btn = '<div class="text-center py-0 align-middle"><a href="/admin/kelompok/magang/'.$kelompok->id_kelompok.'/detail" class="btn btn-info btn-sm"><i class="fas fa-list-alt"></i></a></div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
            }
                            
        return view('admin.instansi.detail_instansi',compact('role', 'periode','instansi', 'lowongan'));
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
        $userId = Auth::id();
        $instansi = Instansi::findOrFail($id_instansi);
        return view('admin.instansi.edit_instansi', compact('instansi', 'userId'));
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
            'username' => 'required|string|max:25',
            'email' => 'required|email|max:191',
            'website' => 'required|max:25',
            'alamat' => 'required|string|max:1000',
        ],
        [
            'nama.required' => 'nama tidak boleh kosong !',
            'nama.max' => 'nama terlalu panjang !',
            'username.required' => 'username tidak boleh kosong !',
            'username.max' => 'username terlalu panjang !',
            'email.required' => 'email tidak boleh kosong !',
            'email.max' => 'email terlalu panjang !',
            'alamat.required' => 'alamat tidak boleh kosong !',
            'alamat.max' => 'no hp terlalu panjang !',
            'website.requires' => 'website tidak boleh kosong !',
            'website.max' => 'website terlalu panjang !',
        ]);

        $data = User::findOrFail($id_users);
        $data->update([
            'username' => $request->username,
            'updated_by' => $request->updated_by,
        ]);
        $data->instansi()->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'website' => $request->website,
        ]);
        return response()->json(['message' => 'Data berhasil diubah.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_users)
    {
        $data = User::find($id_users);
        $data->isDeleted = 1;
        $data->instansi()->update([
            'isDeleted' => 1,
        ]);
        $data->save();
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}
