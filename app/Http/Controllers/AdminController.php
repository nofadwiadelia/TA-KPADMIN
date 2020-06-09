<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\User;
use App\Role;
use File;
use Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Admin::leftJoin('users', 'admin.id_users', 'users.id_users')
                            ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                            ->select('admin.*','users.id_users', 'roles.roles')
                            ->get();

            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($admin){
                $btn = '<a href="/admin/admin/'.$admin->id_admin.'/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<button type="button" name="delete" id="'.$admin->id_users.'" class="btn btn-danger btn-sm deleteUser" ><i class="fas fa-trash"></i></button>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a href="/admin/mahasiswa/'.$admin->id_admin.'" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.daftar_admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_admin');
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
            'email.unique' => 'Email has already been taken !',
            'no_hp.required' => 'can not be empty !',
        ]);

        $foto = null;
        if($request->hasFile('foto')){
            $files=$request->file('foto');
            $foto=str_slug($request->nama) . time() . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/users/admin'),$foto);
        }

        $data = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_roles' => 1
        ])->admin()->create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => $foto,
        ]);
        $data->save();
        return response()->json(['message' => 'Admin added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_admin)
    {
        $data = Admin::findOrFail($id_admin);
        return view('admin.edit_admin', compact('data'));
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
            'username.unique' => 'username has already been taken !',
            'email.required' => 'can not be empty !',
            'no_hp.required' => 'can not be empty !',
        ]);

        $data = User::findOrFail($id_users);
        $data->update([
            'username' => $request->username,
        ]);
        $data->admin()->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp
        ]);
        return response()->json(['message' => 'Data updated successfully.']);
    }

    public function updateAvatar(Request $request, $id_admin){
        $this->validate($request, [
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        $data = Admin::findOrFail($id_admin);
        $foto = $data->foto;

        if ($request->hasFile('foto')) {
            !empty($foto) ? File::delete(public_path('uploads/users/admin/' . $foto)):null;

            $files=$request->file('foto');
            $foto=str_slug($data->nama) . time() . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/users/admin/'),$foto);
        }
        $data->update([
            'foto' => $foto
        ]);

        return response()->json(['data' => $data,
            'message' => 'Photo updated successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_users)
    {
        $admin = User::where('id_users', '=', 1)->first();
        if(Auth::user()->id_users != $id_users && $admin->id_users != $id_users){
            $data = User::find($id_users)->delete();
            return response()->json(['message' => 'Data berhasil dihapus.']);
        }else{
            return response()->json(['message' => 'Peringatan!, data tidak dapat dihapus']);
        }
    }
}
