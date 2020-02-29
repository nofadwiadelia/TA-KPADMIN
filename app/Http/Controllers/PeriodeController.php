<?php

namespace App\Http\Controllers;

use App\Periode;

use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Periode::get();
        return view('admin.periode.periodeListing',compact('data'));
    }

    public function change(Request $request){
        $periode = Periode::findOrFail($request->id);
        // return $periode;
        
        if($periode->status == 'active'){
            $periode->status = 'inactive';
        } else {
            $periode->status = 'active';
        }

        $periode->save();
    
        return response()->json([
          'data' => [
            'success' => 'lur',
          ]
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Periode::all();
        return view('admin.periode.add_new_periode',compact('data'));
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
            'tahun' => 'required|max:4',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);
        $data = Periode::create([
            'tahun' => $request->tahun,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai
        ]);
        $data->save();
        return redirect(route('periode.index'))
        ->with('alert-success','Berhasil Menambahkan Data!');
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
        $data = Periode::findOrFail($id);
        return view('admin.periode.edit_periode', compact('data'));
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
        $this->validate($request, [
            'tahun' => 'required|max:4',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);
        $data = Periode::where ('id',$id)->first();
        $data->tahun = $request->tahun;
        $data->tgl_mulai = $request->tgl_mulai;
        $data->tgl_selesai = $request->tgl_selesai;

        $data->save();
        return redirect()->route('periode.index')->with(
            'alert-success','Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periode = Periode::find($id);
        $periode->delete();
        return redirect()->back()->with(['success' => '<strong>' . $periode->tahun . '</strong> Telah Dihapus!']);
    }
}
