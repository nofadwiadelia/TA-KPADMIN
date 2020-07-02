<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
use App\Nilai;
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
        $periode = DB::table('periode')->select('id_periode', 'tahun_periode')->get();
    
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                                ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                                ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                                ->leftJoin('periode', 'mahasiswa.id_periode', 'periode.id_periode')
                                ->select('mahasiswa.*', 'kelompok.id_kelompok', 'kelompok.nama_kelompok', 'periode.tahun_periode', 'kelompok_detail.status_keanggotaan', 'magang.status')
                                ->where('mahasiswa.id_periode', $request->id_periode)
                                ->get();
            }else{
                $data = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                ->leftJoin('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                ->leftJoin('periode', 'mahasiswa.id_periode', 'periode.id_periode')
                ->select('mahasiswa.*', 'kelompok.id_kelompok', 'kelompok.nama_kelompok', 'periode.tahun_periode', 'kelompok_detail.status_keanggotaan', 'magang.status')
                ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($mahasiswa){
                $btn = '<a href="/admin/mahasiswa/'.$mahasiswa->id_mahasiswa.'/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<button type="button" name="delete" id="'.$mahasiswa->id_users.'" class="btn btn-danger btn-sm deleteUser" ><i class="fas fa-trash"></i></button>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a href="/admin/mahasiswa/'.$mahasiswa->id_mahasiswa.'" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
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
        return view('admin.mahasiswa.add_mahasiswa');
    }

    public function downloadexcel(){
        $file = storage_path('/public/uploads/contohIsianUser.xlsx');
        return response()->download($file);
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
    public function show(Request $request, $id_mahasiswa)
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
        $idkelompok = Mahasiswa::join('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                                ->where('kelompok_detail.id_mahasiswa',  $id_mahasiswa)
                                ->select('kelompok_detail.id_kelompok')
                                ->first();
        $anggota = Mahasiswa::join('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                            ->join('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                            ->select('kelompok.id_kelompok','mahasiswa.id_mahasiswa','mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.no_hp', 'kelompok_detail.status_keanggotaan')
                            ->whereNotIn('mahasiswa.id_mahasiswa', [$id_mahasiswa])
                            ->where('kelompok_detail.id_kelompok', $idkelompok->id_kelompok)
                            ->where(function($q) {
                                $q->where('kelompok_detail.status_join', 'create')
                                ->orWhere('kelompok_detail.status_join', 'diterima');
                            })
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

        //Belum rata" per aspek penilaian!!!
        $nilaiTeman = Nilai::where('id_mahasiswa',$id_mahasiswa)
                        ->leftJoin('aspek_penilaian', 'nilai.id_aspek_penilaian', 'aspek_penilaian.id_aspek_penilaian')
                        ->select('nilai.nilai')
                        ->where('id_kelompok_penilai','1')
                        ->get();

        //Hitung Skill M
        $countTemanM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '1')
        ->count();
        $skillM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '1')
        ->sum('nilai');
        $resultSkillM = number_format(@($skillM / $countTemanM),2);

        //Hitung Kerapihan
        $countTemanMKp = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '5')
        ->count();
        $kerapihanM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '5')
        ->sum('nilai');
        $resultkerapihanM = number_format(@($kerapihanM / $countTemanMKp), 2);

        //Hitung Sikap
        $countTemanMS = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '3')
        ->count();
        $sikapM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '3')
        ->sum('nilai');
        $resultsikapM = number_format(@($sikapM / $countTemanMS), 2);

        //Hitung Keaktifan
        $countTemanMK = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '2')
        ->count();
        $keaktifanM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '2')
        ->sum('nilai');
        $resultkeaktifanM = number_format(@($keaktifanM / $countTemanMK), 2);

        //Hitung Perhatian
        $countTemanMPr = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '6')
        ->count();
        $perhatianM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '6')
        ->sum('nilai');
        $resultperhatianM = number_format(@($perhatianM / $countTemanMPr), 2);

        //Hitung Kehadiran
        $countTemanMKh = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '7')
        ->count();
        $kehadiranM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '7')
        ->sum('nilai');
        $resultkehadiranM = number_format(@($kehadiranM / $countTemanMKh), 2);

        $summaryTeman = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->sum('nilai');
        $countTeman = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->count('id_kelompok_penilai');
        $bobotTeman = \DB::table('kelompok_penilai')
        ->where('id_kelompok_penilai','1')
        ->first();
        $resultTeman1 = number_format(@($summaryTeman / $countTeman), 2);
        $resultTeman2 = number_format(@(($bobotTeman->bobot*$resultTeman1)/100), 2); //Nilai Total Teman

        $nilaiMentor = Nilai::where('id_mahasiswa',$id_mahasiswa)
                        ->select('nilai.nilai')
                        ->where('id_kelompok_penilai','2')
                        ->get(); //get Nilai Mentor

        $summaryInstansi = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','2')
        ->sum('nilai');
        $countInstansi = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','2')
        ->count('id_kelompok_penilai');
        $bobotInstansi = \DB::table('kelompok_penilai')
        ->where('id_kelompok_penilai','2')
        ->first();
        $resultInstansi1 = number_format(@($summaryInstansi / $countInstansi), 2);
        $resultInstansi2 = number_format(@(($bobotInstansi ->bobot*$resultInstansi1)/100), 2); //nilai akhir mentor


        $nilaiDP = Nilai::where('id_mahasiswa',$id_mahasiswa)
                        ->select('nilai.nilai')
                        ->where('id_kelompok_penilai','3')
                        ->get();

        $summaryPenguji = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','3')
        ->sum('nilai');
        $countPenguji = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','3')
        ->count('id_kelompok_penilai');
        $bobotPenguji = \DB::table('kelompok_penilai')
        ->where('id_kelompok_penilai','3')
        ->first();
        $resultPenguji1 = number_format(@($summaryPenguji / $countPenguji), 2);
        $resultPenguji2 = number_format(@(($bobotPenguji->bobot*$resultPenguji1)/100), 2);


        $nilaiDosbing = Nilai::where('id_mahasiswa',$id_mahasiswa)
                        ->select('nilai.nilai')
                        ->where('id_kelompok_penilai','4')
                        ->get();

        $summaryDospem = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','4')
        ->sum('nilai');
        $countDospem = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','4')
        ->count('id_kelompok_penilai');
        $bobotDospem = \DB::table('kelompok_penilai')
        ->where('id_kelompok_penilai','4')
        ->first();
        $resultDospem1 = number_format(@($summaryDospem / $countDospem), 2) ;
        $resultDospem2 = number_format(@(($bobotDospem ->bobot*$resultDospem1)/100), 2); //nilai akhir dosbing

        $finalResult = $resultTeman2 + $resultInstansi2 + $resultPenguji2 + $resultDospem2;

        return view('admin.mahasiswa.detail_mahasiswa',compact('mahasiswa', 'role', 'kelompok', 'anggota', 'magang', 'instansi', 'bukuharian', 'hari_produktif', 'jam_produktif', 'resultSkillM', 'resultkerapihanM', 'resultsikapM', 'resultkeaktifanM', 'resultperhatianM', 'resultkehadiranM', 'nilaiDP', 'nilaiDosbing', 'nilaiMentor', 'resultTeman1', 'resultTeman2', 'resultInstansi1','resultInstansi2', 'resultPenguji1' ,'resultPenguji2', 'resultDospem1', 'resultDospem2', 'resultTeman2', 'finalResult'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function editaccount($id_mahasiswa){
        $mahasiswa = Mahasiswa::findOrFail($id_mahasiswa);
        return view('admin.mahasiswa.edit_mahasiswa', compact('mahasiswa'));
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
