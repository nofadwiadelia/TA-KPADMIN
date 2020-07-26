<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Usulan;
use App\Kelompok;
use App\Periode;
use App\Instansi;
use App\User;
use App\Magang;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function usulan(Request $request){
        $periode = DB::table('periode')->where('isDeleted', 0)->get();
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                                ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                                ->leftJoin('usulan', 'kelompok.id_kelompok', 'usulan.id_kelompok')
                                ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                                ->where('kelompok.id_periode', $request->id_periode)
                                ->whereRaw('usulan.updated_at in (select max(usulan.updated_at) from usulan group by (usulan.id_kelompok))')
                                ->select('kelompok.*', 'mahasiswa.nama', 'dosen.nama as dosen_nama', 'usulan.status')
                                ->get();
            }else{
                $data = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                                ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                                ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                                ->leftJoin('usulan', 'kelompok.id_kelompok', 'usulan.id_kelompok')
                                ->select('kelompok.id_kelompok', 'kelompok.nama_kelompok', 'mahasiswa.nama', 'dosen.nama as dosen_nama', 'usulan.status')
                                ->whereRaw('usulan.updated_at in (select max(usulan.updated_at) from usulan group by (usulan.id_kelompok))')
                                ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($kelompok){
                $btn = '<a href="/admin/usulan/kelompok/'.$kelompok->id_kelompok.'/detail" class="btn btn-sm btn-info editbtn"><i class="fa fa-arrow-right"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.usulan.usulan_pkl',compact('periode'));
    }
    public function detailusulan( $id_kelompok){
        $userId = Auth::id();
        $kelompok = Kelompok::findOrFail($id_kelompok);
        $anggota = Kelompok::leftJoin('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->select('mahasiswa.id_mahasiswa','mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.no_hp', 'kelompok_detail.status_keanggotaan', 'kelompok.nama_kelompok', 'kelompok.id_kelompok')
                            ->where('kelompok_detail.id_kelompok', $id_kelompok)
                            ->get();
        $usulan = Usulan::select('usulan.*')
                        ->where('usulan.id_kelompok', $id_kelompok)
                        ->get();

        $instansi = Instansi::select('id_instansi','nama')
                    ->where('status', 'open')
                    ->where('isDeleted', '0')
                    ->where('isBlacklist', '0')
                    ->get();

        return view('admin.usulan.detail_usulan',compact('userId','kelompok', 'anggota', 'usulan', 'instansi'));
    }

    public function editusulan($id_usulan)
    {
        $usulan = Usulan::find($id_usulan);
        return response()->json($usulan);
    }

    public function accusulan(Request $request){
        $usulan = Usulan::findOrFail($request->id_usulan);
        $usulan->status = $request->status;

        $usulan->save();

        if($request->status == 'diterima'){
            if($request->id_instansi != null){
                $usulan = Magang::create([
                    'id_instansi' =>$request->id_instansi,
                    'id_periode' =>$request->id_periode,
                    'id_kelompok' => $request->id_kelompok,
                    'jobdesk' => $request->jobdesk,
                    'status' => 'belum magang',
                    'created_by' => $request->created_by,
                ]);
            }else{
                $usulan = User::create([
                    'username' => $request->username,
                    'password' =>  Hash::make($request->password),
                    'id_roles' => 3,
                    'created_by' => $request->created_by,
                ]);
    
                $usulan = Instansi::create([
                    'id_users' =>$usulan->id_users,
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                    'alamat' => $request->alamat,
                    'website' => $request->website,
                    'status' => 'open',
                    'created_by' => $request->created_by,
                ]);
    
                $usulan = Magang::create([
                    'id_instansi' =>$usulan->id_instansi,
                    'id_periode' =>$request->id_periode,
                    'id_kelompok' => $request->id_kelompok,
                    'jobdesk' => $request->jobdesk,
                    'status' => 'belum magang',
                    'created_by' => $request->created_by,
                ]);
            }

            return response()->json(['message' => 'Usulan berhasil diterima.']);
        }else{
            return response()->json(['message' => 'Usulan ditolak.']);
        }
        
        
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
