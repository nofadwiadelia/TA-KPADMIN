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
        $data = Dosen::get();
        // if(request()->ajax()){
        //     $data = Dosen::get();
        //     return datatables()->of($data)->addIndexColumn()
        //         // ->addColumn('status', function($dosen){
        //         //     $input .= '<input type="checkbox" data-id="'. $dosen->id_dosen.'" name="status" class="js-switch" {{ '.$dosen->status == 'open' ? 'checked' : ''.' }}>';
        //         //    return $input;
        //         // })
        //         ->addColumn('action', function($dosen){
        //             $btn = '<a href="/admin/dosen/'.$dosen->id_dosen.'" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
        //            return $btn;
        //         })
        //         // ->rawColumns(['status'])
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
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
        return view('admin.dosen.add_dosen');
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
            'username.required' => 'can not be empty !',
            'username.unique' => 'username has already been taken !',
            'password.max' => 'password is to long !',
            'email.required' => 'can not be empty !',
            'nip.required' => 'can not be empty !',
            'no_hp.required' => 'can not be empty !',
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
            'id_roles' => 2
        ])->dosen()->create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => $foto,
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
        

        $kelompok = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->where('kelompok.id_dosen', $id_dosen)
                            ->select('kelompok.*', 'mahasiswa.nama', 'periode.tahun_periode')
                            ->get();
        
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
                $btn = '<a href="/admin/kelompok/'.$kelompok->id_kelompok.'" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('admin.dosen.detail_dosen',compact('role', 'dosen', 'periode', 'kelompok'));
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
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ],
        [
            'nama.required' => 'can not be empty !',
            'username.required' => 'can not be empty !',
            'email.required' => 'can not be empty !',
            'nip.required' => 'can not be empty !',
            'no_hp.required' => 'can not be empty !',
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
