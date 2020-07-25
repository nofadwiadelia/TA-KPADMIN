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
use Illuminate\Support\Facades\Auth;



class UsersController extends Controller
{

    public function indexlogin(){
        return view('admin.login');
    }

    public function loginadmin(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|string'
        ]);
        $auth = $request->only('username', 'password');
        $auth['id_roles'] = 1;

        if(Auth::attempt($auth)){
            $user = Auth::user();
            $user->api_token = str_random(100);
            $user->save();
            return redirect('/admin/dasboard')->with('sukses','Anda Berhasil Login');
           
    	}
    	return redirect('admin/login')->with('error','Akun Belum Terdaftar');
    }
    public function loginmahasiswa(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|string'
        ]);
        $auth = $request->only('username', 'password');
        $auth['id_roles'] = 4;

        if(Auth::attempt($auth)){
            $user = Auth::user();
            $user->api_token = str_random(100);
            $user->save();
            return redirect('/mahasiswa/index')->with('sukses','Anda Berhasil Login');
           
    	}
    	return redirect('/login')->with('error','Akun Belum Terdaftar');
    }

    public function logout(Request $request){
        if (Auth::check()) {
            $user = Auth::user();
            $user->api_token = null;
            $user->save();
            Auth::logout();
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function import(Request $request) 
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ],
        [
            'file.required' => 'file tidak boleh kosong !',
            'file.mimes' => 'format salah !',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            Excel::import(new UsersImport, $file); //IMPORT FILE 
            return redirect('/admin/mahasiswa');
        }  
        return redirect()->back()->with(['error' => 'Pilih file terlebih dahulu']);

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
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        
    }

    public function updatePassword(Request $request, $id_users){
        $this->validate($request, [
            'password' => 'required|min:6|max:191',
            'confirm_password' => 'same:password'
        ],
        [
            'password.min' => 'password kurang dari 6 karakter !',
            'password.max' => 'password terlalu panjang !',
        ]);
        $data = User::where ('id_users',$id_users)->first();
        $data->password = Hash::make($request->password);
        $data->save();
        return response()->json(['message'=>'Password berhasil diubah.']);
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
        $data->isDeleted = 1;
        $data->save();
        return response()->json(['message' => 'User berhasil dihapus.']);
    }
}
