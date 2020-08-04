<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
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
                            ->select('admin.*','users.id_users')
                            ->where('admin.isDeleted', '0')
                            ->get();

            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($admin){
                $btn = '<a href="/admin/admin/'.$admin->id_users.'/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<button type="button" name="delete" id="'.$admin->id_users.'" class="btn btn-danger btn-sm deleteUser" ><i class="fas fa-trash"></i></button>';
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
        $userId = Auth::id();
        return view('admin.add_admin', compact('userId'));
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
            'username' => 'required|string|unique:users,username|max:25',
            'password' => 'required|min:6|max:191',
            'confirm_password' => 'same:password',
            'email' => 'required|email|max:191',
            'no_hp' => 'required|max:20|regex:/^[0-9]+$/',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:1024',
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
            'no_hp.required' => 'no hp tidak boleh kosong !',
            'no_hp.max' => 'no hp terlalu panjang !',
            'foto.required' => 'foto tidak boleh kosong !',
            'foto.mimes' => 'format foto tidak sesuai !',
            'foto.max' => 'foto terlalu besar !',
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
            'created_by' => $request->created_by,
            'updated_by' => $request->created_by,
            'id_roles' => 1
        ])->admin()->create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => $foto,
            'created_by' => $request->created_by,
        ]);
        $data->save();
        return response()->json(['message' => 'Admin berhasil ditambahkan.']);
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
    public function edit($id_users)
    {
        $userId = Auth::id();
        $data = User::findOrFail($id_users);
        return view('admin.edit_admin', compact('data', 'userId'));
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
            'no_hp' => 'required|max:20|regex:/^[0-9]+$/',
        ],
        [
            'nama.required' => 'nama tidak boleh kosong !',
            'nama.max' => 'nama terlalu panjang !',
            'username.required' => 'username tidak boleh kosong !',
            'username.max' => 'username terlalu panjang !',
            'email.required' => 'email tidak boleh kosong !',
            'email.max' => 'email terlalu panjang !',
            'no_hp.required' => 'no hp tidak boleh kosong !',
            'no_hp.max' => 'no hp terlalu panjang !',
        ]);

        $data = User::findOrFail($id_users);
        $data->update([
            'username' => $request->username,
            'updated_by' => $request->updated_by,
        ]);
        $data->admin()->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
        return response()->json(['message' => 'Data berhasil diubah .']);
    }

    public function updateAvatar(Request $request, $id_admin){
        $this->validate($request, [
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:1024',
        ],
        [
            'foto.mimes' => 'format foto tidak sesuai !',
            'foto.max' => 'foto terlalu besar !',
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
            'message' => 'Photo berhasil diubah.']);
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
        if(Auth::id() != $id_users && $admin->id_users != $id_users){
            $data = User::find($id_users);
            $data->isDeleted = 1;
            $data->admin()->update([
                'isDeleted' => 1,
            ]);
            $data->save();
            return response()->json(['message' => 'Data berhasil dihapus.']);
        }else{
            return response()->json(['message' => 'Peringatan!, data tidak dapat dihapus']);
        }
    }
}
