<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::resource('/users', 'UsersController');
    Route::resource('/pengumuman', 'PengumumanController');
    
});

Route::get('/admin', 'Mah@admin')->name('/admin');

Route::get('/daftar_mahasiswa', 'Mah@index')->name('/daftar_mahasiswa');
Route::get('/detail_mahasiswa', 'Mah@index1')->name('/detail_mahasiswa');
Route::get('/daftar_dosen', 'Mah@index2')->name('/daftar_dosen');
Route::get('/detail_dosen', 'Mah@showdosen')->name('/detail_dosen');
Route::get('/daftar_partner', 'Mah@indexpartner')->name('/daftar_partner');
Route::get('/detail_partner', 'Mah@showpartner')->name('/detail_partner');
Route::get('/add_akun', 'Mah@addakun')->name('/add_akun');
Route::get('/edit_akun', 'Mah@editakun')->name('/edit_akun');
Route::get('/persetujuan_kelompok', 'Mah@indexpkelompok')->name('/persetujuan_kelompok');
Route::get('/usulan_pkl', 'Mah@UsulanPKL')->name('/usulan_pkl');
Route::get('/detail_usulan', 'Mah@detailUsulan')->name('/detail_usulan');
Route::get('/detailKelompok', 'Mah@detailKelompok')->name('/detailKelompok');
Route::get('/periodeListing', 'Mah@periodeListing')->name('/periodeListing');
Route::get('/add_new_periode', 'Mah@AddNewPeriode')->name('/add_new_periode');
Route::get('/edit_periode', 'Mah@EditPeriode')->name('/edit_periode');
Route::get('/magangListing', 'Mah@magangListing')->name('/magangListing');
Route::get('/detailMagang', 'Mah@detailMagang')->name('/detailMagang');
Route::get('/presentasi_kelompok', 'Mah@presentasiKelompok')->name('/presentasi_kelompok');
Route::get('/add_presentasi', 'Mah@addpresentasiKelompok')->name('/add_presentasi');
Route::get('/edit_presentasi', 'Mah@editpresentasiKelompok')->name('/edit_presentasi');
Route::get('/lowongan', 'Mah@lowonganPKL')->name('/lowongan');
Route::get('/detail_lowongan', 'Mah@detaillowonganPKL')->name('/detail_lowongan');
Route::get('/add_lowongan', 'Mah@addlowonganPKL')->name('/add_lowongan');
Route::get('/edit_lowongan', 'Mah@editlowonganPKL')->name('/edit_lowongan');
Route::get('/login', 'Mah@login')->name('/login');



