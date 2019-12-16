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
Route::get('/admin', 'Mah@admin')->name('/admin');
Route::get('/pengumuman', 'Mah@indexpengumuman')->name('/pengumuman');
Route::get('/add_form_pengumuman', 'Mah@addpengumuman')->name('/add_form_pengumuman');
Route::get('/edit_pengumuman', 'Mah@editpengumuman')->name('/edit_pengumuman');
Route::get('/daftar_mahasiswa', 'Mah@index')->name('/daftar_mahasiswa');
Route::get('/detail_mahasiswa', 'Mah@index1')->name('/detail_mahasiswa');
Route::get('/daftar_dosen', 'Mah@index2')->name('/daftar_dosen');
Route::get('/daftar_mentor', 'Mah@indexmentor')->name('/daftar_mentor');
Route::get('/daftar_partner', 'Mah@indexpartner')->name('/daftar_partner');
Route::get('/akun_mahasiswa', 'Mah@indexakunmahasiswa')->name('/akun_mahasiswa');
Route::get('/add_akun_mahasiswa', 'Mah@addakunmahasiswa')->name('/add_akun_mahasiswa');
Route::get('/edit_akun_mahasiswa', 'Mah@editakunmahasiswa')->name('/edit_akun_mahasiswa');
Route::get('/akun_dosen', 'Mah@indexakundosen')->name('/akun_dosen');
Route::get('/add_akun_dosen', 'Mah@addakundosen')->name('/add_akun_dosen');
Route::get('/edit_akun_dosen', 'Mah@editakundosen')->name('/edit_akun_dosen');
Route::get('/akun_mentor', 'Mah@indexakunmentor')->name('/akun_mentor');
Route::get('/add_akun_mentor', 'Mah@addakunmahasiswa')->name('/add_akun_mentor');
Route::get('/edit_akun_mentor', 'Mah@editakunmentor')->name('/edit_akun_mentor');
Route::get('/akun_partner', 'Mah@indexakunpartner')->name('/akun_partner');
Route::get('/add_akun_partner', 'Mah@addakunpartner')->name('/add_akun_partner');
Route::get('/persetujuan_kelompok', 'Mah@indexpkelompok')->name('/persetujuan_kelompok');
Route::get('/usulan_pkl', 'Mah@UsulanPKL')->name('/usulan_pkl');
Route::get('/detailKelompok', 'Mah@detailKelompok')->name('/detailKelompok');
Route::get('/periode', 'Mah@periode')->name('/periode');
Route::get('/periodeListing', 'Mah@periodeListing')->name('/periodeListing');
Route::get('/add_new_periode', 'Mah@AddNewPeriode')->name('/add_new_periode');
Route::get('/edit_periode', 'Mah@EditPeriode')->name('/edit_periode');
Route::get('/magangListing', 'Mah@magangListing')->name('/magangListing');
Route::get('/detailMagang', 'Mah@detailMagang')->name('/detailMagang');
Route::get('/presentasi_kelompok', 'Mah@presentasiKelompok')->name('/presentasi_kelompok');
Route::get('/lowongan', 'Mah@lowonganPKL')->name('/lowongan');
Route::get('/add_lowongan', 'Mah@addlowonganPKL')->name('/add_lowongan');



