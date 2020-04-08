<?php

namespace App\Http\Controllers;

use App\User;
use App\Mahasiswa;
use App\Role;
use App\Periode;
use App\Imports\UsersImport;
use DB;
use Datatables;
use Excel;
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
            if($akun->id_roles == 1){
                Auth::guard('administrator')->LoginUsingId($akun->id_users);
                return redirect('/admin/dasboard')->with('sukses','Anda Berhasil Login');
            } else if($akun->id_roles == 2){
                Auth::guard('dosen')->LoginUsingId($akun->id_users);
                return redirect('/dosen/dashboard')->with('sukses','Anda Berhasil Login');
            }elseif ($akun->id_roles == 3) {
              Auth::guard('instansi')->LoginUsingId($akun->id_users);
              return redirect('/admin')->with('sukses','Anda Berhasil Login');
            }elseif ($akun->id_roles == 4) {
              Auth::guard('mahasiswa')->LoginUsingId($akun->id_users);
              return redirect('/mahasiswa/index')->with('sukses','Anda Berhasil Login');
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
    public function index(Request $request)
    {
        $roles = Role::select('id_roles', 'roles')->get();

        if(request()->ajax()){
            if(!empty($request->id_roles)){
                $data = DB::table('users')
                    ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                    ->leftJoin('instansi', 'users.id_users', 'instansi.id_users')
                    ->leftJoin('dosen', 'users.id_users', 'dosen.id_users')
                    ->leftJoin('mahasiswa', 'users.id_users', 'mahasiswa.id_users')
                    ->select('users.id_users', 'users.username', 'roles.roles', 'roles.id_roles', 'mahasiswa.nama as namamahasiswa', 'dosen.nama as namadosen', 'instansi.nama as namainstansi')
                    ->where('users.id_roles', $request->id_roles)
                    ->get();
            }else{
                $data = DB::table('users')
                    ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                    ->leftJoin('instansi', 'users.id_users', 'instansi.id_users')
                    ->leftJoin('dosen', 'users.id_users', 'dosen.id_users')
                    ->leftJoin('mahasiswa', 'users.id_users', 'mahasiswa.id_users')
                    ->select('users.id_users', 'users.username', 'roles.roles', 'roles.id_roles', 'mahasiswa.nama as namamahasiswa', 'dosen.nama as namadosen', 'instansi.nama as namainstansi')
                    ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($users){

                   $btn = '<a href="/admin/users/'.$users->id_users.'/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                   $btn .= '&nbsp;&nbsp;';
                   $btn .= '<button type="button" name="delete" id="'.$users->id_users.'" class="btn btn-danger btn-sm deleteUser" ><i class="fas fa-trash"></i></button>';
                   return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.akun.daftar_akun',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id_roles', 'roles')->get();
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
            'nama' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'password' => 'required|min:6|max:191'
        ],
        [
            'nama' => 'can not be empty !',
            'username.required' => 'can not be empty !',
            'username.unique' => 'username has already been taken !',
            'password.max' => 'password is to long !',
        ]);
        
        $data = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_roles' => $request->id_roles
        ]);
        $data->save();

        if($request->id_roles == 2){
            $data->dosen()->create([
                'nama' => $request->nama,
            ]);
        }
        else if($request->id_roles == 3){
            $data->instansi()->create([
                'nama' => $request->nama,
            ]);
        }
        else if($request->id_roles == 4){
            $data->mahasiswa()->create([
                'nama' => $request->nama,
                'id_periode' => 3,
            ]);
        }

        return redirect(route('users.index'))
                ->with('alert-success','Berhasil Menambahkan Data!');
    }

    public function import(Request $request) 
    {
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new UsersImport,request()->file('file'));
           
        return back();
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
        $roles = Role::select('id_roles', 'roles')->get();
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
            'nama' => 'required|string|max:191',
            'username' => 'required|string|max:191'
        ],
        [
            'nama.required' => 'can not be empty !',
            'username.required' => 'can not be empty !',
            'username.unique' => 'username has already been taken !'
        ]);
        $data = User::where ('id_users',$id_users)->first();
        $data->username = $request->username;

        if($request->id_roles == 2){
            $data->dosen()->update([
                'nama' => $request->nama,
            ]);
        }
        else if($request->id_roles == 3){
            $data->instansi()->update([
                'nama' => $request->nama,
            ]);
        }
        else if($request->id_roles == 4){
            $data->mahasiswa()->update([
                'nama' => $request->nama,
            ]);
        }

        $data->save();

        return redirect()->back()->with(
            'alert-success','Data berhasil diubah!');
    }

    public function updatePassword(Request $request, $id_users){
        $this->validate($request, [
            'password' => 'required|min:6|max:191'
        ],
        [
            'password.max' => 'password is to long !',
        ]);
        $data = User::where ('id_users',$id_users)->first();
        $data->password = Hash::make($request->password);
        $data->save();
        return response()->json(['message'=>'Password updated successfully.']);
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
        return response()->json(['message' => 'User deleted successfully.']);
    }
}
