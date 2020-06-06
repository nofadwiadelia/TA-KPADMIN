<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Exports\MahasiswaExport;
use Excel;
use File;
use Image;

use App\Mahasiswa;
use App\User;
use App\Role;
use App\Periode;
use App\LaporanHarian;
use App\Kelompok;
use App\Magang;
use DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $mahasiswa = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
        //                     ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
        //                     ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
        //                     ->select('mahasiswa.*', 'kelompok.nama_kelompok', 'periode.tahun_periode', 'kelompok_detail.status_keanggotaan')
        //                     ->get();
        $periode = DB::table('periode')->select('id_periode', 'tahun_periode')->get();
    
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                                ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                                ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                                ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                                ->select('mahasiswa.*', 'kelompok.id_kelompok', 'kelompok.nama_kelompok', 'periode.tahun_periode', 'kelompok_detail.status_keanggotaan', 'magang.status')
                                ->where('mahasiswa.id_periode', $request->id_periode)
                                ->get();
            }else{
                $data = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
                ->select('mahasiswa.*','kelompok.id_kelompok', 'kelompok.nama_kelompok', 'periode.tahun_periode', 'kelompok_detail.status_keanggotaan', 'magang.status')
                ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($mahasiswa){

                   $btn = '<a href="/admin/mahasiswa/'.$mahasiswa->id_mahasiswa.'/'.$mahasiswa->id_kelompok.'" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
                   return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.mahasiswa.daftar_mahasiswa',compact('periode'));
    }

    public function indexmahasiswa()
    {
        $mahasiswa = Mahasiswa::leftJoin('users', 'mahasiswa.users_id', 'users.id_users')
                            ->leftJoin('roles', 'users.roles_id', 'roles.id_roles')
                            ->select('mahasiswa.id', 'mahasiswa.users_id', 'users.id_users', 'users.nama_lengkap', 'roles.id_roles', 'roles.nama', 'mahasiswa.no_hp', 'mahasiswa.email', 'mahasiswa.pengalaman', 'mahasiswa.keahlian', 'mahasiswa.nim')
                            ->first();
        return view('mahasiswa.profile', compact('mahasiswa'));
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

    public function export() 
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
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
    public function show($id_mahasiswa, $id_kelompok)
    {
        $mahasiswa = Mahasiswa::findOrFail($id_mahasiswa);
        $role = Mahasiswa::leftJoin('users', 'mahasiswa.id_users', 'users.id_users')
                        ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                        ->select( 'roles.roles')
                        ->first();
        $kelompok = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                            ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                            ->select('kelompok.nama_kelompok', 'kelompok_detail.status_keanggotaan')
                            ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
                            ->first();
        $anggota = Mahasiswa::join('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                            ->join('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                            ->select('mahasiswa.id_mahasiswa','mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.no_hp', 'kelompok_detail.status_keanggotaan')
                            ->whereNotIn('mahasiswa.id_mahasiswa', [$id_mahasiswa])
                            ->where('kelompok_detail.id_kelompok', $id_kelompok) 
                            // kurang ambil id kelompok
                            ->get();
        $magang = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                            ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                            ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                            ->select('dosen.nama', 'dosen.email', 'dosen.nip', 'dosen.no_hp')
                            ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
                            ->first();
        $instansi = Mahasiswa::join('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                            ->join('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                            ->join('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                            ->join('instansi', 'magang.id_instansi', 'instansi.id_instansi')
                            ->select('instansi.nama', 'instansi.deskripsi', 'instansi.alamat')
                            ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
                            ->first();

        $bukuharian =  LaporanHarian::leftJoin('mahasiswa', 'buku_harian.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                                ->select('mahasiswa.nama', 'buku_harian.id_buku_harian', 'buku_harian.tanggal', 'buku_harian.waktu_mulai', 'buku_harian.waktu_selesai', 'buku_harian.kegiatan', 'buku_harian.status')
                                ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
                                ->get();
        $hari_produktif = LaporanHarian::leftJoin('mahasiswa', 'buku_harian.id_mahasiswa', 'mahasiswa.id_mahasiswa')           
                                ->select('buku_harian.tanggal')
                                ->where('buku_harian.id_mahasiswa', $id_mahasiswa)
                                ->count();
        
        $jam_produktif = LaporanHarian::leftJoin('mahasiswa', 'buku_harian.id_mahasiswa', 'mahasiswa.id_mahasiswa')          
                                ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
                                ->selectRaw("SEC_TO_TIME(SUM(TIME_TO_SEC(buku_harian.waktu_selesai) - TIME_TO_SEC(buku_harian.waktu_mulai))) as timediff")
                                ->first();

        return view('admin.mahasiswa.detail_mahasiswa',compact('mahasiswa', 'role', 'kelompok', 'anggota', 'magang', 'instansi', 'bukuharian', 'hari_produktif', 'jam_produktif'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::leftJoin('users', 'mahasiswa.users_id', 'users.id_users')
                                ->select('mahasiswa.id', 'mahasiswa.users_id', 'users.id_users', 'users.nama_lengkap', 'mahasiswa.nim', 'mahasiswa.no_hp', 'mahasiswa.pengalaman', 'mahasiswa.keahlian')
                                ->where('id',$id)->first();
        return view('mahasiswa.editprofil', compact('mahasiswa'));
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
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->email = $request->email;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->keahlian = $request->keahlian;
        $mahasiswa->pengalaman = $request->pengalaman;
        $mahasiswa->save();

        return redirect('mahasiswa/profile');
    }

    public function updateAvatar(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $file = $request->file('photo');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = $data->nim . '.' . $extension;
        Storage::put('images/uploads/avatar/' . $filename, File::get($file));
        $file_server = Storage::get('images/uploads/avatar/' . $filename);
        $img = Image::make($file_server)->resize(141, 141);
        $img->save(base_path('public/images/uploads/avatar/' . $filename));

        $mahasiswa->photo=$filename;
        $mahasiswa->save();
        Alert::success('Success', 'Avatar has been changed!');
        return redirect('mahasiswa/profile');

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
