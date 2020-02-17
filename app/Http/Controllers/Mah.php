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
        return view('mahasiswa.daftar_mahasiswa');
    }
    public function index1()
    {
        return view('mahasiswa.detail_mahasiswa');
    }
    public function index2()
    {
        return view('dosen.daftar_dosen');
    }
    public function showdosen()
    {
        return view('dosen.detail_dosen');
    }
    
    public function indexpartner()
    {
        return view('perusahaan.daftar_partner');
    }
    public function showpartner()
    {
        return view('perusahaan.detail_partner');
    }
    public function indexpkelompok()
    {
        return view('kelompok.persetujuan_kelompok');
    }
    public function UsulanPKL()
    {
        return view('usulan.usulan_pkl');
    }
    public function detailUsulan()
    {
        return view('usulan.detail_usulan');
    }
    public function detailKelompok()
    {
        return view('kelompok.detailKelompok');
    }

    public function indexakun()
    {
        return view('akun.daftar_akun');
    }

    public function addakun()
    {
        return view('akun.add_akun');
    }
    public function editakun()
    {
        return view('akun.edit_akun');
    }
    public function periodeListing()
    {
        return view('periode.periodeListing');
    }
    public function AddNewPeriode()
    {
        return view('periode.add_new_periode');
    }
    public function EditPeriode()
    {
        return view('periode.edit_periode');
    }
    public function magangListing()
    {
        return view('magang.magangListing');
    }
    public function detailMagang()
    {
        return view('magang.detailMagang');
    }
    public function presentasiKelompok()
    {
        return view('presentasi.presentasi_kelompok');
    }
    public function addpresentasiKelompok()
    {
        return view('presentasi.add_presentasi');
    }
    public function editpresentasiKelompok()
    {
        return view('presentasi.edit_presentasi');
    }
    public function lowonganPKL()
    {
        return view('lowongan.lowongan');
    }
    public function detaillowonganPKL()
    {
        return view('lowongan.detail_lowongan');
    }
    public function addlowonganPKL()
    {
        return view('lowongan.add_lowongan');
    }
    public function editlowonganPKL()
    {
        return view('lowongan.edit_lowongan');
    }

}

