<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Mah extends Controller
{
    public function admin()
    {
        return view('admin');
    }
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
    public function indexmentor()
    {
        return view('daftar_mentor');
    }
    public function indexpartner()
    {
        return view('daftar_partner');
    }

    public function indexpkelompok()
    {
        return view('persetujuan_kelompok');
    }
    public function UsulanPKL()
    {
        return view('usulan_pkl');
    }

    public function detailKelompok()
    {
        return view('detailKelompok');
    }

    public function indexpengumuman()
    {
        return view('pengumuman');
    }

    public function addpengumuman()
    {
        return view('add_form_pengumuman');
    }

    public function editpengumuman()
    {
        return view('edit_pengumuman');
    }

    public function indexakunmahasiswa()
    {
        return view('akun_mahasiswa');
    }

    public function addakunmahasiswa()
    {
        return view('add_akun_mahasiswa');
    }
    public function editakunmahasiswa()
    {
        return view('edit_akun_mahasiswa');
    }
    public function indexakundosen()
    {
        return view('akun_dosen');
    }
    public function addakundosen()
    {
        return view('add_akun_dosen');
    }
    public function editakundosen()
    {
        return view('edit_akun_dosen');
    }
    public function indexakunmentor()
    {
        return view('akun_mentor');
    }
    public function addakunmentor()
    {
        return view('add_akun_mentor');
    }
    public function editakunmentor()
    {
        return view('edit_akun_mentor');
    }
    public function indexakunpartner()
    {
        return view('akun_partner');
    }
    public function addakunpartner()
    {
        return view('add_akun_partner');
    }
    public function periode()
    {
        return view('periode');
    }
    public function periodeListing()
    {
        return view('periodeListing');
    }
    public function AddNewPeriode()
    {
        return view('add_new_periode');
    }
    public function EditPeriode()
    {
        return view('edit_periode');
    }
    public function magangListing()
    {
        return view('magangListing');
    }
    public function detailMagang()
    {
        return view('detailMagang');
    }
    public function presentasiKelompok()
    {
        return view('presentasi_kelompok');
    }
    public function lowonganPKL()
    {
        return view('lowongan');
    }
    public function addlowonganPKL()
    {
        return view('add_lowongan');
    }
}

