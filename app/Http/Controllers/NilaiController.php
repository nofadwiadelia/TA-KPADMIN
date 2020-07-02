<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;
use App\Nilai;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_mahasiswa)
    {
        //ini caranya disamain kayak di ListDaftarNilaiController
        $mahasiswa = DB::table('mahasiswa')->where('id_mahasiswa', $id_mahasiswa)->first();

        $summaryTeman = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->sum('nilai');
        $countTeman = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->count('id_kelompok_penilai');
        $bobotTeman = \DB::table('kelompok_penilai')
        ->where('id_kelompok_penilai','1')
        ->first();
        $resultTeman1 = $summaryTeman / $countTeman;
        $resultTeman2 = ($bobotTeman->bobot*$resultTeman1)/100; //Nilai Total Teman

        //Hitung Skill
        $countTemanM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '1')
        ->count();
        $skillM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '1')
        ->sum('nilai');
        $resultSkillM = $skillM / $countTemanM;

        //Hitung Kerapihan
        $countTemanMKp = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '5')
        ->count();
        $kerapihanM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '5')
        ->sum('nilai');
        $resultkerapihanM = $kerapihanM / $countTemanMKp;

        //Hitung Sikap
        $countTemanMS = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '3')
        ->count();
        $sikapM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '3')
        ->sum('nilai');
        $resultsikapM = $sikapM / $countTemanMS;

        //Hitung Keaktifan
        $countTemanMK = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '2')
        ->count();
        $keaktifanM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '2')
        ->sum('nilai');
        $resultkeaktifanM = $keaktifanM / $countTemanMK;

        //Hitung Perhatian
        $countTemanMPr = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '6')
        ->count();
        $perhatianM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '6')
        ->sum('nilai');
        $resultperhatianM = $perhatianM / $countTemanMPr;

        //Hitung Kehadiran
        $countTemanMKh = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '7')
        ->count();
        $kehadiranM = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','1')
        ->where('id_aspek_penilaian', '7')
        ->sum('nilai');
        $resultkehadiranM = $kehadiranM / $countTemanMKh;


        $summaryInstansi = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','2')
        ->sum('nilai');
        $countInstansi = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','2')
        ->count('id_kelompok_penilai');
        $bobotInstansi = \DB::table('kelompok_penilai')
        ->where('id_kelompok_penilai','2')
        ->first();
        // $resultInstansi1 = $summaryInstansi / $countInstansi ;
        // $resultInstansi2 = ($bobotInstansi ->bobot*$resultInstansi1)/100;

        $summaryPenguji = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','3')
        ->sum('nilai');
        $countPenguji = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','3')
        ->count('id_kelompok_penilai');
        $bobotPenguji = \DB::table('kelompok_penilai')
        ->where('id_kelompok_penilai','3')
        ->first();
        // $resultPenguji1 = $summaryPenguji / $countPenguji ;
        // $resultPenguji2 = ($bobotPenguji->bobot*$resultPenguji1)/100;

        $summaryDospem = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','4')
        ->sum('nilai');
        $countDospem = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','4')
        ->count('id_kelompok_penilai');
        $bobotDospem = \DB::table('kelompok_penilai')
        ->where('id_kelompok_penilai','4')
        ->first();
        $resultDospem1 = $summaryDospem / $countDospem ;
        $resultDospem2 = ($bobotDospem ->bobot*$resultDospem1)/100;

        //Nilai Skill Dosbing
        $skillDosbing = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','4')
        ->where('id_aspek_penilaian','1')
        ->sum('nilai');
        //Nilai Sikap Dosbing
        $sikapDosbing = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','4')
        ->where('id_aspek_penilaian','3')
        ->sum('nilai');
        //Nilai Kebersamaan Dosbing
        $kebersamaanDosbing = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','4')
        ->where('id_aspek_penilaian','4')
        ->sum('nilai');
        //Nilai Keaktifan Dosbing
        $keaktifanDosbing = Nilai::where('id_mahasiswa',$id_mahasiswa)
        ->where('id_kelompok_penilai','4')
        ->where('id_aspek_penilaian','2')
        ->sum('nilai');
        

        $finalResult = $resultTeman2 + $resultDospem2;
        // $finalResult = $resultTeman2 + $resultInstansi2 + $resultPenguji2 + $resultDospem2;

        return response()->json([
            'skillM' => number_format($resultSkillM, 2),
            'kerapihanM' => number_format($resultkerapihanM, 2),
            'sikapM' => number_format($resultsikapM, 2),
            'keaktifanM' => number_format($resultkeaktifanM, 2),
            'perhatianM' => number_format($resultperhatianM, 2),
            'kehadiranM' => number_format($resultkehadiranM, 2),
            'nilai_teman' => number_format($resultTeman2, 2), 
            'bobot_teman' => $bobotTeman->bobot,
            // 'nilai_instansi' => number_format($resultInstansi2, 2), 
            // 'bobot_instansi' => $bobotInstansi->bobot,
            // 'nilai_penguji' => number_format($resultPenguji2, 2), 
            // 'bobot_penguji' => $bobotPenguji->bobot,
            'nilai_dospem' => number_format($resultDospem2, 2), 
            'bobot_dospem' => $bobotDospem->bobot,
            'skillDosbing' => $skillDosbing,
            'sikapDosbing' => $sikapDosbing,
            'kebersamaanDosbing' => $kebersamaanDosbing,
            'keaktifanDosbing' => $kebersamaanDosbing,
            'nilai_akhir' => number_format($finalResult, 2)], 200);
        // $summaryTeman = Nilai::where('id_mahasiswa',$id_mahasiswa)
        // ->where('id_kelompok_penilai','1')
        // ->sum('nilai');
        // $countTeman = Nilai::where('id_mahasiswa',$id_mahasiswa)
        // ->where('id_kelompok_penilai','1')
        // ->count('id_kelompok_penilai');
        // $bobotTeman = \DB::table('kelompok_penilai')
        // ->where('id_kelompok_penilai','1')
        // ->first();
        // $resultTeman1 = $summaryTeman / $countTeman;
        // $resultTeman2 = ($bobotTeman->bobot*$resultTeman1)/100;

        // $summaryInstansi = Nilai::where('id_mahasiswa',$id_mahasiswa)
        // ->where('id_kelompok_penilai','2')
        // ->sum('nilai');
        // $countInstansi =Nilai::where('id_mahasiswa',$id_mahasiswa)
        // ->where('id_kelompok_penilai','2')
        // ->count('id_kelompok_penilai');
        // $bobotInstansi = \DB::table('kelompok_penilai')
        // ->where('id_kelompok_penilai','2')
        // ->first();
        // $resultInstansi1 = $summaryInstansi / $countInstansi ;
        // $resultInstansi2 = ($bobotInstansi ->bobot*$resultInstansi1)/100;

        // $summaryPenguji = Nilai::where('id_mahasiswa',$id_mahasiswa)
        // ->where('id_kelompok_penilai','3')
        // ->sum('nilai');
        // $countPenguji = Nilai::where('id_mahasiswa',$id_mahasiswa)
        // ->where('id_kelompok_penilai','3')
        // ->count('id_kelompok_penilai');
        // $bobotPenguji = \DB::table('kelompok_penilai')
        // ->where('id_kelompok_penilai','3')
        // ->first();
        // $resultPenguji1 = $summaryPenguji / $countPenguji ;
        // $resultPenguji2 = ($bobotPenguji ->bobot*$resultPenguji1)/100;

        // $summaryDospem = Nilai::where('id_mahasiswa',$id_mahasiswa)
        // ->where('id_kelompok_penilai','4')
        // ->sum('nilai');
        // $countDospem = Nilai::where('id_mahasiswa',$id_mahasiswa)
        // ->where('id_kelompok_penilai','4')
        // ->count('id_kelompok_penilai');
        // $bobotDospem = \DB::table('kelompok_penilai')
        // ->where('id_kelompok_penilai','4')
        // ->first();
        // $resultDospem1 = $summaryDospem / $countDospem ;
        // $resultDospem2 = ($bobotDospem ->bobot*$resultDospem1)/100;

        // $finalResult = $resultTeman2 + $resultInstansi2 + $resultPenguji2 + $resultDospem2;

        // $mah = json_decode($finalResult);

        // return response()->json([
        //     'id_mahasiswa' => $mahasiswa->id_mahasiswa,
        //     'mahasiswa' => $mahasiswa,
        //     'nilai_teman' => number_format($resultTeman2, 2), 
        //     'bobot_teman' => $bobotTeman->bobot,
        //     'nilai_instansi' => number_format($resultInstansi2, 2), 
        //     'bobot_instansi' => $bobotInstansi->bobot,
        //     'nilai_penguji' => number_format($resultPenguji2, 2), 
        //     'bobot_penguji' => $bobotPenguji->bobot,
        //     'nilai_dospem' => number_format($resultDospem2, 2), 
        //     'bobot_dospem' => $bobotDospem->bobot,
        //     'nilai_akhir' => $mah], 200);
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
