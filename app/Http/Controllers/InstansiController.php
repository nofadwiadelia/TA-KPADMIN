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
        $instansi = Instansi::leftJoin('users', 'instansi.id_users', 'users.id_users')
                            ->where('users.isDeleted', '0')
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
            'username' => 'required|string|unique:users|max:191',
            'password' => 'required|min:6|max:191',
            'email' => 'required|email|max:191',
            'no_hp' => 'required|max:25',
            'website' => 'max:25',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ],
        [
            'nama.required' => 'can not be empty !',
            'nama.max' => 'nama is to long !',
            'username.required' => 'username can not be empty !',
            'username.unique' => 'username has already been taken !',
            'username.max' => 'username is to long !',
            'password.required' => 'password can not be empty !',
            'password.max' => 'password is to long !',
            'email.required' => 'email can not be empty !',
            'nip.required' => 'nip can not be empty !',
            'no_hp.required' => 'no hp can not be empty !',
            'no_hp.max' => 'no hp is to long !',
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
            'id_roles' => 2
        ])->instansi()->create([
            'nama' => $request->nama,
            'alamat' => $request->nama, 
            'deskripsi' => $request->deskripsi,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'website' => $request->website,
            'foto' => $foto,
            'created_by' => $request->created_by,
        ]);
        $data->save();
        return response()->json(['message' => 'Instansi added successfully.']);
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
    public function show(Request $request, $id_instansi)
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

    // public function getLowongan(Request $request, $id_instansi){
        
    //     if(request()->ajax()){
    //         if(!empty($request->id_periode)){
    //             $lowongan = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
    //                         ->leftJoin('periode', 'lowongan.id_periode', 'periode.id_periode')
    //                         ->select('lowongan.id_lowongan', 'lowongan.pekerjaan', 'lowongan.persyaratan', 'lowongan.kapasitas', 'lowongan.id_instansi', 'instansi.id_instansi', 'instansi.nama', 'periode.tahun_periode')
    //                         ->where('kelompok.id_periode', $request->id_periode)
    //                         ->where('lowongan.id_instansi', '=', $id_instansi)
    //                         ->get();
    //         }else{
    //             $lowongan = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
    //                         ->leftJoin('periode', 'lowongan.id_periode', 'periode.id_periode')
    //                         ->select('lowongan.id_lowongan', 'lowongan.pekerjaan', 'lowongan.persyaratan', 'lowongan.kapasitas', 'lowongan.id_instansi', 'instansi.id_instansi', 'instansi.nama', 'periode.tahun_periode')
    //                         ->where('lowongan.id_instansi', '=', $id_instansi)
    //                         ->get();
    //         }
    //         return datatables()->of($lowongan)->addIndexColumn()
    //         ->addColumn('action', function($kelompok){
    //             $btn = '<div class="text-center py-0 align-middle"><a href="/admin/kelompok/magang/'.$kelompok->id_kelompok.'" class="btn btn-info btn-sm"><i class="fas fa-list-alt"></i></a></div>';
    //             return $btn;
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    //     }
    // }

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
            'website' => 'max:25',
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
            'alamat' => $request->alamat, 
            'deskripsi' => $request->deskripsi,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'website' => $request->website,
        ]);
        return response()->json(['message' => 'Data updated successfully.']);
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
