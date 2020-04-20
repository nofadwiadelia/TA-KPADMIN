<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Periode;
use App\Kelompok;
use App\Usulan;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        
        $user= Auth::user();

        return response()->json([
            'user' =>$user,
            'message' => "succes",
        ]);
    }

    public function indexadmin(){
        $periode = Periode::where('status', 'open')->first();
        $date = Carbon::now()->translatedFormat('l, d F Y');

        return view('admin.admin', compact('periode','date'));
    }

    public function kelompokCount(){
        $kelompok = Kelompok::where('persetujuan', 'diproses')->count();
        return response()->json([
            'kelompok' =>$kelompok,
            "message" => "succes",
        ]);
    }
    public function usulanCount(){
        $usulan = Usulan::where('status', 'diproses')->count();
        return response()->json([
            'usulan' =>$usulan,
            "message" => "succes",
        ]);
    }

    public function indexdosen(){
        return view('dosen.layout.dashboard');
    }

    public function indexmahasiswa(){
        return view('mahasiswa.index');
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
