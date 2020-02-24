<?php

namespace App\Http\Controllers;

use App\User;
use App\Mahasiswa;
use App\Role;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function indexlogin(){
        return view('admin.login');
    }

    public function login(Request $request){
        if(Auth::attempt($request->only('username','password'))){
            $akun = DB::table('users')->where('username', $request->username)->first();
            //dd($akun);
            if($akun->roles_id == 1){
                Auth::guard('administrator')->LoginUsingId($akun->id_users);
                return redirect('/admin')->with('sukses','Anda Berhasil Login');
            } else if($akun->roles_id == 2){
                Auth::guard('dosen')->LoginUsingId($akun->id_users);
                return redirect('admin/pengumuman')->with('sukses','Anda Berhasil Login');
            }elseif ($akun->roles_id == 3) {
              Auth::guard('mahasiswa')->LoginUsingId($akun->id_users);
              return redirect('/index')->with('sukses','Anda Berhasil Login');
            }elseif ($akun->roles_id == 4) {
              Auth::guard('instansi')->LoginUsingId($akun->id_users);
              return redirect('/admin')->with('sukses','Anda Berhasil Login');
            }
    	}
    	return redirect('admin/login')->with('error','Akun Belum Terdaftar');
    }

    public function logout(Request $request){
        if(Auth::guard('administrator')->check()){
            Auth::guard('administrator')->logout();
        } else if(Auth::guard('dosen')->check()){
            Auth::guard('dosen')->logout();
        } else if(Auth::guard('mahasiswa')->check()){
            Auth::guard('mahasiswa')->logout();
        } else if(Auth::guard('instansi')->check()){
            Auth::guard('instansi')->logout();
        }
    	return redirect('admin/login')->with('sukses','Anda Telah Logout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::select('id_roles', 'nama')->get();
        $user = User::get();
        return view('admin.akun.daftar_akun',compact('user','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id_roles', 'nama')->get();
        return view('admin.akun.add_akun', compact('roles'));
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
            'nama_lengkap' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'password' => 'required|min:6|max:191'
        ],
        [
            'nama_lengkap.required' => 'can not be empty !',
            'username.required' => 'can not be empty !',
            'username.unique' => 'username has already been taken !',
            'password.max' => 'password is to long !',
        ]);
            
        // return $request;
        // $data = User::create($request->except(['_token']));
        
        $data = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'roles_id' => $request->roles_id
        ]);
        $data->save();

        if($request->roles_id == 2){
            $data->dosen()->create();
        }
        else if($request->roles_id == 3){
            $data->mahasiswa()->create();
        }
        else if($request->roles_id == 4){
            $data->instansi()->create();
        }

        return redirect(route('users.index'))
                ->with('alert-success','Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id_users)
    {
        $roles = Role::select('id_roles', 'nama')->get();
        $data = User::findOrFail($id_users);
        return view('admin.akun.edit_akun', compact('data','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_users)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'password' => 'required|min:6|max:191'
        ],
        [
            'nama_lengkap.required' => 'can not be empty !',
            'username.required' => 'can not be empty !',
            'username.unique' => 'username has already been taken !',
            'password.max' => 'password is to long !',
        ]);
        $data = User::where ('id_users',$id_users)->first();
        $data->nama_lengkap = $request->nama_lengkap;
        $data->username = $request->username;
        $data->password = Hash::make($request->password);

        $data->save();
        return redirect()->route('users.index')->with(
            'alert-success','Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_users)
    {
        $data = User::find($id_users);
        $data->delete();
        return redirect()->back()->with(['success' => '<strong>' . $data->username . '</strong> Telah Dihapus!']);
    }
}
