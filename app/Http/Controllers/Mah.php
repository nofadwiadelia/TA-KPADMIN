<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Mah extends Controller
{
    public function index()
    {
        return view('daftar_mahasiswa');
    }
    public function index1()
    {
        return view('detail_mahasiswa');
    }
    public function index2()
    {
        return view('daftar_dosen');
    }
}
