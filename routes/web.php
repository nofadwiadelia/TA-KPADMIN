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
    return view('admin.admin');
});

Route::prefix('admin')->group(function () {
    Route::resource('/users', 'UsersController');
    Route::get('/login', 'UsersController@indexlogin')->name('login');
    Route::post('/login', 'UsersController@login')->name('login');
    Route::get('/logout', 'UsersController@logout')->name('logout');
    Route::resource('/mahasiswa', 'MahasiswaController');
    Route::resource('/dosen', 'DosenController');
    Route::resource('/instansi', 'InstansiController');
    Route::resource('/pengumuman', 'PengumumanController');
    Route::resource('/periode', 'PeriodeController');
    Route::post('/periode/change', 'PeriodeController@change');
    Route::resource('/lowongan', 'LowonganController');
    
});

Route::prefix('mahasiswa')->group(function () {
    // Route::get('/pengumuman', 'PengumumanController@indexmahasiswa')->name('pengumuman');
    Route::get('/profile', 'MahasiswaController@indexmahasiswa');
    // Route::get('/profile', 'MahasiswaController@edit');
    Route::put('/editprofil', 'MahasiswaController@update');
    Route::get('/pengumuman', 'PengumumanController@indexmahasiswa');
});

Route::get('/admin', 'Mah@admin')->name('/admin');

Route::get('/daftar_mahasiswa', 'Mah@index')->name('/daftar_mahasiswa');
Route::get('/detail_mahasiswa', 'Mah@index1')->name('/detail_mahasiswa');
Route::get('/daftar_dosen', 'Mah@index2')->name('/daftar_dosen');
Route::get('/detail_dosen', 'Mah@showdosen')->name('/detail_dosen');
Route::get('/daftar_partner', 'Mah@indexpartner')->name('/daftar_partner');
Route::get('/detail_partner', 'Mah@showpartner')->name('/detail_partner');
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
Route::get('/adlowongan', 'Mah@lowonganPKL')->name('/adlowongan');
Route::get('/detail_lowongan', 'Mah@detaillowonganPKL')->name('/detail_lowongan');
Route::get('/add_lowongan', 'Mah@addlowonganPKL')->name('/add_lowongan');
Route::get('/edit_lowongan', 'Mah@editlowonganPKL')->name('/edit_lowongan');


//MAHASISWA

Route::get('/index', function () {
    return view('mahasiswa.index');
});


Route::get('/profile', function () {
    return view('mahasiswa.profile');
});

Route::get('/editprofil', function () {
    return view('mahasiswa.editprofil');
});

Route::get('/buatkelompok', function () {
    return view('mahasiswa.buatkelompok');
});

Route::get('/tambahanggota', function () {
    return view('mahasiswa.tambahanggota');
});

Route::get('/dataperusahaan', function () {
    return view('mahasiswa.dataperusahaan');
});

Route::get('/editdataperusahaan', function () {
    return view('mahasiswa.editdataperusahaan');
});
Route::get('/tambahperusahaan', function () {
    return view('mahasiswa.tambahperusahaan');
});
Route::get('/lowongan', function () {
    return view('mahasiswa.lowongan');
});
Route::get('/applylowongan', function () {
    return view('mahasiswa.applylowongan');
});
Route::get('/editanggota', function () {
    return view('mahasiswa.editanggota');
});
Route::get('/penilaiananggota', function () {
    return view('mahasiswa.penilaiananggota');
});
Route::get('/formnilai', function () {
    return view('mahasiswa.formnilai');
});
Route::get('/editnilai', function () {
    return view('mahasiswa.editnilai');
});
Route::get('/editlaporanharian', function () {
    return view('mahasiswa.editlaporanharian');
});
Route::get('/editlaporanpkl', function () {
    return view('mahasiswa.editlaporanpkl');
});
Route::get('/tambahlaporanharian', function () {
    return view('mahasiswa.tambahlaporanharian');
});
Route::get('/tambahlaporanpkl', function () {
    return view('mahasiswa.tambahlaporanpkl');
});
Route::get('/lihatlaporanpkl', function () {
    return view('mahasiswa.lihatlaporanpkl');
});
Route::get('/calendar', function () {
    return view('mahasiswa.calendar');
});
Route::get('/laporanharian', function () {
    return view('mahasiswa.laporanharian');
});
Route::get('/laporanpkl', function () {
    return view('mahasiswa.laporanpkl');
});
Route::get('/pengumuman', 'PengumumanController@indexmahasiswa');
Route::get('/login', function () {
    return view('mahasiswa.login');
});
Route::get('/tambahanggotakelompok', function () {
    return view('mahasiswa.tambahanggotakelompok');
});





