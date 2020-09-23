<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KelompokPenilai;
use DataTables;
class PenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KelompokPenilai::get();
            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function($penilai){
                    $btn = '<a href="javascript:void(0)"  data-toggle="tooltip" data-id="'.$penilai->id_kelompok_penilai.'" data-original-title="Edit" class="edit btn btn-sm btn-info editPenilai"><i class="fas fa-pencil-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

            return view('admin.master.kelompok_penilai');
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
        $this->validate($request, [
            'nama' => 'required|string',
            'bobot' => 'required',
        ],
        [
            'nama.required' => 'nama tidak boleh kosong !',
            'bobot.required' => 'bobot tidak boleh kosong !'
        ]);

        $data = KelompokPenilai::findOrFail($request->id_kelompok_penilai);

        $total = (KelompokPenilai::sum('bobot')) - $data->bobot;
                                
        if($total + $request->bobot <= 100){
            $data->nama = $request->nama;
            $data->bobot = $request->bobot;
            $data->save();
        return response()->json(['message'=>'Kelompok penilai berhasil diubah']);
        }else{
            return response()->json(['message'=>'Total bobot tidak boleh lebih dari 100']);
        }
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
    public function edit($id_kelompok_penilai)
    {
        $penilai = KelompokPenilai::find($id_kelompok_penilai);
        return response()->json($penilai);
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
    public function destroy($id_kelompok_penilai)
    {
        
    }
}
