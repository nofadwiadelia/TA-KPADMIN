<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function indexlogin(){
        return view('login');
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        if (auth()->attempt(['username' => $username, 'password' => $password])) {
            return redirect(route('/admin'));
        }else{
            return "Maaf username atau password yang anda masukan tidak sesuai.";
        }
        // return redirect(route('welcome'));
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
        return view('akun.daftar_akun',compact('user','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id_roles', 'nama')->get();
        return view('akun.add_akun', compact('roles'));
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
        ]
    );
      
        // $data = User::create($request->except(['_token']));
        $data = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'roles_id' => $request->roles_id
        ]);

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
        //
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
        //
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
