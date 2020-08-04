<?php

namespace App\Http\Controllers;

use App\Periode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodes = Periode::where('isDeleted', 0)->get();
        $aktif = Periode::where('status', 'open')->first();
        $date = Carbon::now()->translatedFormat('l, d F Y');
        return view('admin.periode.periodeListing',compact('periodes', 'aktif', 'date' ));
    }

    public function changeStatus(Request $request){
        $periode = Periode::findOrFail($request->periode_id);
        $check = Periode::where('status', 'open')
                        ->first();
        if($check){
            $periode->status = $request->status = 'close';
            $periode->save();
            return response()->json(['message' => 'Matikan periode yang aktif terlebih dahulu']);
        }else{
            $periode->status = $request->status;
            $periode->save();
    
            return response()->json(['message' => 'Status periode berhasil diubah']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        return view('admin.periode.add_new_periode', compact('userId'));
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
            'tahun_periode' => 'required|unique:periode,tahun_periode|max:4',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ],
        [
            'tahun_periode.required' => 'tahun periode tidak boleh kosong !',
            'tahun_periode.unique' => 'tahun periode sudah tersedia !',
            'tahun_periode.max' => 'tahun periode terlalu panjang !',
            'tgl_mulai.required' => 'tanggal mulai tidak boleh kosong !',
            'tgl_selesai.required' => 'tanggal selesai tidak boleh kosong !',
        ]);

        $data = Periode::create([
            'tahun_periode' => $request->tahun_periode,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'created_by' => $request->created_by,
        ]);
        $data->save();
        return response()->json(['message' => 'Berhasil menambahkan periode']);
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
    public function edit($id_periode)
    {
        $data = Periode::findOrFail($id_periode);
        return view('admin.periode.edit_periode', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_periode)
    {
        $this->validate($request, [
            'tahun_periode' => 'required|max:4',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ],[
            'tahun_periode.required' => 'tahun periode tidak boleh kosong !',
            'tahun_periode.max' => 'tahun periode terlalu panjang !',
            'tgl_mulai.required' => 'tanggal mulai tidak boleh kosong !',
            'tgl_selesai.required' => 'tanggal selesai tidak boleh kosong !',
        ]);
        
        $data = Periode::findOrFail($id_periode);
        $data->update([
            'tahun_periode' => $request->tahun_periode,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai
        ]);

        $data->save();
        return response()->json(['message' => 'Periode berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_periode)
    {
        $periode = Periode::find($id_periode);
        $periode->isDeleted = 1;
        $periode->save();
        return response()->json(['message' => 'Periode berhasil dihapus.']);    
    }
}
