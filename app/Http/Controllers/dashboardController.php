<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Periode;
use App\Kelompok;
use App\Usulan;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $user= User::where(['api_token'=>$request->api_token])->first();

        return response()->json([
            'user' =>$user,
            'code' => 200,
        ], 200);
    }

    public function indexadmin(){
        $periode = Periode::where('status', 'open')->first();
        \Carbon\Carbon::setLocale('id');
        $date = Carbon::now()->format('l, d F Y');

        $kelompok = Kelompok::where('persetujuan', 'diproses')->count();
        $usulan = Usulan::where('status', 'diproses')->count();

        return view('admin.admin', compact('periode','date', 'kelompok', 'usulan'));
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
