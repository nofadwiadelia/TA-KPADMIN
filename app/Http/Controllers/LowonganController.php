<?php

namespace App\Http\Controllers;
use App\Lowongan;
use App\Instansi;
use App\Periode;
use App\Magang;
use App\DaftarLowongan;
use DB;

use Illuminate\Http\Request;

class LowonganController extends Controller
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
                $data = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                                ->select('lowongan.*', 'instansi.nama')
                                ->where('lowongan.id_periode',  $request->id_periode)
                                ->get();
            }else{
                $data = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                                ->select('lowongan.*', 'instansi.nama')
                                ->get();
            }
            return datatables()->of($data)->addIndexColumn()
            ->addColumn('action', function($lowongan){
                $btn = '<a href="/admin/lowongan/'.$lowongan->id_lowongan.'/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<button type="button" name="delete" id="'.$lowongan->id_lowongan.'" class="btn btn-danger btn-sm deleteUser" ><i class="fas fa-trash"></i></button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.lowongan.lowongan',compact('periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Instansi::get();
        $periode = Periode::where('status', 'open')->first();
        return view('admin.lowongan.add_lowongan',compact('data', 'periode'));
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
            'pekerjaan' => 'required|string|max:100',
            'persyaratan' => 'required|string|max:1000',
            'kapasitas' => 'required',
        ]);
        $data = Lowongan::create([
            'pekerjaan' => $request->pekerjaan,
            'persyaratan' => $request->persyaratan,
            'kapasitas' => $request->kapasitas,
            'id_instansi' => $request->id_instansi,
            'id_periode' => $request->id_periode
        ]);
        $data->save();
        return response()->json(['message' => 'Lowongan status added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_lowongan)
    {
        $lowongan = Lowongan::findOrFail($id_lowongan);
        $applylowongan = DB::table('daftar_lowongan')
                            ->leftJoin('lowongan', 'daftar_lowongan.id_lowongan', 'lowongan.id_lowongan')
                            ->leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                            ->leftJoin('kelompok', 'daftar_lowongan.id_kelompok', '=', 'kelompok.id_kelompok')
                            ->leftJoin('kelompok_detail', 'kelompok.id_kelompok', '=', 'kelompok_detail.id_kelompok')
                            ->leftJoin('mahasiswa', 'kelompok_detail.id_mahasiswa', 'mahasiswa.id_mahasiswa')
                            ->where('kelompok_detail.status_keanggotaan', 'Ketua')
                            ->select('kelompok.nama_kelompok', 'kelompok.id_kelompok', 'mahasiswa.nama', 'daftar_lowongan.id_daftar_lowongan', 'daftar_lowongan.status', 'daftar_lowongan.tanggal_daftar', 'instansi.id_instansi')
                            ->where('lowongan.id_lowongan', $id_lowongan)
                            ->get();
        return view('admin.lowongan.detail_lowongan',compact('lowongan', 'applylowongan'));
    }

    public function acclowongan(Request $request){
        $daftar_lowongan = DaftarLowongan::findOrFail($request->id_daftar_lowongan);
        $daftar_lowongan->status = $request->status;

        $daftar_lowongan->save();

        if($request->status == 'diterima'){
            $daftar_lowongan = Magang::create([
                'id_kelompok' => $request->id_kelompok,
                'id_instansi' => $request->id_instansi,
                'status' => 'belum magang',
            ]);
        }
        return response()->json(['message' => 'Daftar Lowongan updated successfully.']);

    }

    // public function showlowongan(Request $request, $id_lowongan)
    // {
    //     $lowongan = Lowongan::findOrFail($id_lowongan);
    //     if(request()->ajax()){
    //         $data = DB::table('daftar_lowongan')
    //                         ->join('lowongan', 'daftar_lowongan.id_lowongan', '=', 'lowongan.id_lowongan')
    //                         ->join('kelompok', 'daftar_lowongan.id_kelompok', '=', 'kelompok.id_kelompok')
    //                         ->select('kelompok.nama_kelompok', 'kelompok.id_kelompok')
    //                         ->where('lowongan.id_lowongan', $id_lowongan)
    //                         ->get();
    //         return datatables()->of($data)->addIndexColumn()
    //             ->addColumn('action', function($lowongan){
    //                 $btn = '<a href="#" id="'.$lowongan->id_lowongan.'" class="btn btn-sm btn-info editbtn"><i class="fas fa-check"></i></a>';
    //                 $btn .= '&nbsp;&nbsp;';
    //                 $btn .= '<button type="button" id="'.$id_lowongan->id_lowongan.'" class="btn btn-danger btn-sm declinebtn"><i class="fas fa-times"></i></button>';
    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
            
    //     return view('admin.lowongan.detail_lowongan');
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_lowongan)
    {
        $lowongan = Lowongan::findOrFail($id_lowongan);
        $instansi = Instansi::get();
        $periode = Periode::get();
        return view('admin.lowongan.edit_lowongan',compact('instansi', 'periode', 'lowongan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_lowongan)
    {
        $this->validate($request, [
            'pekerjaan' => 'required|string|max:100',
            'persyaratan' => 'required',
            'kapasitas' => 'required',
        ]);
        $data = Lowongan::findOrFail($id_lowongan);
        $data->update([
            'pekerjaan' => $request->pekerjaan,
            'persyaratan' => $request->persyaratan,
            'kapasitas' => $request->kapasitas,
            'id_instansi' => $request->id_instansi,
            'id_periode' => $request->id_periode
        ]);
        $data->save();
        return response()->json(['message' => 'Periode update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_lowongan)
    {
        $lowongan = Lowongan::find($id_lowongan);
        $lowongan->delete();
        return response()->json(['message' => 'Lowongan deleted successfully.']);
    }
}
