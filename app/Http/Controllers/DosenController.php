<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Dosen;
use App\User;
use App\Roles;
use App\Periode;
use App\Kelompok;
use DB;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Dosen::leftJoin('users', 'dosen.id_users', 'users.id_users')
                    ->where('users.isDeleted', '0')
                    ->get();
        return view('admin.dosen.daftar_dosen',compact('data'));
    }

    public function changeStatus(Request $request){
        $dosen = Dosen::findOrFail($request->dosen_id);
        $dosen->status = $request->status;
        $dosen->save();

        return response()->json(['message' => 'Dosen status updated successfully.']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        return view('admin.dosen.add_dosen', compact('userId'));
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
            'nip' => 'required|string|max:191',
            'no_hp' => 'required|max:25',
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
            'foto.mimes' => 'format foto tidak sesuai !',
        ]);

        $foto = null;
        if($request->hasFile('foto')){
            $files=$request->file('foto');
            $foto=str_slug($request->nama) . time() . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/users/dosen'),$foto);
        }

        $data = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'created_by' => $request->created_byy,
            'id_roles' => 2
        ])->dosen()->create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => $foto,
            'slot' => $request->kapasitas,
            'kapasitas' => $request->kapasitas,
            'created_by' => $request->created_by,
        ]);
        $data->save();
        return response()->json(['message' => 'Dosen added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_dosen)
    {
        $periode = DB::table('periode')->select('id_periode', 'tahun_periode')->get();
        $dosen = Dosen::findOrFail($id_dosen);
        $role = Dosen::leftJoin('users', 'dosen.id_users', 'users.id_users')
                        ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                        ->select('dosen.id_dosen', 'roles.roles')
                        ->where('dosen.id_dosen', '=', $id_dosen)
                        ->first();
        
        if(request()->ajax()){
            if(!empty($request->id_periode)){

                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                                ->leftJoin('instansi', 'magang.id_instansi', 'instansi.id_instansi')
                                ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                                ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                                ->where('kelompok.id_periode', $request->id_periode)
                                ->where('kelompok.id_dosen', $id_dosen)
                                ->select('kelompok.*', 'mahasiswa.nama', 'periode.tahun_periode', 'instansi.nama as nama_instansi')
                                ->get();
            }else{
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                                ->leftJoin('instansi', 'magang.id_instansi', 'instansi.id_instansi')
                                ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                                ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                                ->where('kelompok.id_dosen', $id_dosen)
                                ->select('kelompok.*', 'mahasiswa.nama', 'periode.tahun_periode', 'instansi.nama as nama_instansi')
                                ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($kelompok){
                $btn = '<a href="/admin/kelompok/magang/'.$kelompok->id_kelompok.'/detail" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('admin.dosen.detail_dosen',compact('role', 'dosen', 'periode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editaccount($id_dosen)
    {
        $dosen = Dosen::findOrFail($id_dosen);
        return view('admin.dosen.edit_dosen', compact('dosen'));
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
            'nip' => 'required|string|max:191',
            'no_hp' => 'required|max:25',
        ],
        [
            'nama.required' => 'can not be empty !',
            'nama.max' => 'nama is to long !',
            'username.required' => 'username can not be empty !',
            'username.max' => 'username is to long !',
            'email.required' => 'email can not be empty !',
            'nip.required' => 'nip can not be empty !',
            'no_hp.required' => 'no hp can not be empty !',
            'no_hp.max' => 'no hp is to long !',
        ]);

        $data = User::findOrFail($id_users);
        $data->update([
            'username' => $request->username,
        ]);
        $data->dosen()->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'kapasitas' => $request->kapasitas,
            'slot' => $request->slot,
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
        $data->dosen()->update([
            'isDeleted' => 1,
        ]);
        $data->save();
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}
