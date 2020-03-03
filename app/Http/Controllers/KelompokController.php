<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelompok;
use App\Periode;
use App\Dosen;
use App\Mahasiswa;

class KelompokController extends Controller
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

    public function indexdosen()
    {
        $kelompok = Kelompok::get();
        return view('dosen.kelompok.kelompok',compact('kelompok'));
    }
    
    public function acckelompok()
    {
        $dosen = Dosen::leftJoin('users', 'dosen.users_id', 'users.id_users')
                        ->select('dosen.id', 'users.nama_lengkap')
                        ->get();
        $kelompok = Kelompok::leftJoin('mahasiswa', 'kelompok.mahasiswa_id', 'mahasiswa.id')
                            ->leftJoin('dosen', 'kelompok.dosen_id', 'dosen.id')
                            ->leftJoin('users', 'mahasiswa.users_id', 'users.id_users')
                            ->select('kelompok.id','kelompok.nama_kelompok','kelompok.status', 'users.nama_lengkap')
                            ->get();
        return view('admin.kelompok.persetujuan_kelompok',compact('kelompok', 'dosen'));
    }

    public function postacckelompok(Request $request, $id)
    {
        $kelompok = Kelompok::find($id);
        $kelompok->dosen_id = $request->input('dosen_id');
        $kelompok->status = $request->input('status');

        $kelompok->save();
        return $kelompok;
    }

    public function declinekelompok(Request $request, $id)
    {
        $kelompok = Kelompok::find($id);
        $kelompok->status = $request->input('status');

        $kelompok->save();
        return redirect()->back();
        return view('admin.kelompok.persetujuan_kelompok');
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

    public function showdosen($id)
    {
        $kelompok = Kelompok::findOrFail($id);
        return view('dosen.kelompok.detail_kelompok', compact('kelompok'));
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
