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
    return view('admin.login');
});

Route::prefix('admin')->group(function () {
    Route::get('/dasboard', 'dashboardController@indexadmin');
    Route::resource('/users', 'UsersController');
    Route::get('/login', 'UsersController@indexlogin')->name('login');
    Route::post('/login', 'UsersController@login')->name('login');
    Route::get('/logout', 'UsersController@logout')->name('logout');
    Route::get('/mahasiswa', ['as' => 'mahasiswa.index', 'uses' => 'MahasiswaController@index']);
    Route::get('/mahasiswa/{id}', ['as' => 'mahasiswa.show', 'uses' => 'MahasiswaController@show']);
    Route::resource('/dosen', 'DosenController');
    Route::resource('/instansi', 'InstansiController');
    Route::resource('/pengumuman', 'PengumumanController');
    Route::resource('/periode', 'PeriodeController');
    Route::post('/periode/change', 'PeriodeController@change');
    Route::resource('/lowongan', 'LowonganController');
    
});

Route::prefix('mahasiswa')->group(function () {
    Route::get('/index', 'dashboardController@indexmahasiswa');
    Route::get('/profile', 'MahasiswaController@indexmahasiswa');
    Route::get('/editprofil/{id}', 'MahasiswaController@edit');
    Route::put('/editprofil/{id}', 'MahasiswaController@update');
    Route::get('/pengumuman', 'PengumumanController@indexmahasiswa');
});

Route::prefix('dosen')->group(function () {
    Route::get('/dashboard', 'dashboardController@indexdosen');
    Route::get('/kelompok', 'KelompokController@indexdosen');
    Route::get('/kelompok/{id}', 'KelompokController@showdosen');
});


Route::get('/admin', 'Mah@admin')->name('/admin');
Route::get('/persetujuan_kelompok', 'Mah@indexpkelompok')->name('/persetujuan_kelompok');
Route::get('/usulan_pkl', 'Mah@UsulanPKL')->name('/usulan_pkl');
Route::get('/detail_usulan', 'Mah@detailUsulan')->name('/detail_usulan');
Route::get('/detailKelompok', 'Mah@detailKelompok')->name('/detailKelompok');
Route::get('/magangListing', 'Mah@magangListing')->name('/magangListing');
Route::get('/detailMagang', 'Mah@detailMagang')->name('/detailMagang');
Route::get('/presentasi_kelompok', 'Mah@presentasiKelompok')->name('/presentasi_kelompok');
Route::get('/add_presentasi', 'Mah@addpresentasiKelompok')->name('/add_presentasi');
Route::get('/edit_presentasi', 'Mah@editpresentasiKelompok')->name('/edit_presentasi');


//MAHASISWA

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

Route::get('/login', function () {
    return view('mahasiswa.login');
});
Route::get('/tambahanggotakelompok', function () {
    return view('mahasiswa.tambahanggotakelompok');
});


Route::get('/profile', 'Mah@indexprofile')->name('/profile');
Route::get('/detail_nilai', 'Mah@detailnilai')->name('/detail_nilai');
Route::get('/detail_nilai_penguji', 'Mah@nilaipenguji')->name('/detail_nilai_penguji');
Route::get('/input_nilai', 'Mah@inputnilai_dosen')->name('/input_nilai');
Route::get('/inputNilai_penguji', 'Mah@inputNilai_penguji')->name('/inputNilai_penguji');
Route::get('/dashboard', 'Mah@dashboard')->name('/dashboard');
Route::get('/laporan', 'Mah@laporan')->name('/laporan');
Route::get('/nilai_akhir', 'Mah@nilai_akhir')->name('/nilai_akhir');
Route::get('/login', 'Mah@login')->name('/login');
Route::get('/detail_inputNilai', 'Mah@detail_inputNilai')->name('/detail_inputNilai');
Route::get('/edit_profil', 'Mah@edit_profil')->name('/edit_profil');
Route::get('/daftar_nilaiAkhir', 'Mah@daftar_nilaiAkhir')->name('/daftar_nilaiAkhir');
Route::get('/list_kegiatanHarian', 'Mah@list_kegiatanHarian')->name('/list_kegiatanHarian');

// Route::resource('company','CompanyController');
// Route::resource('group','GroupController');





