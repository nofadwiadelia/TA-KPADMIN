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

Auth::routes();

Route::get('/', function () {
    return view('admin.login');
});

Route::prefix('admin')->group(function () {
    Route::get('/dasboard', 'dashboardController@indexadmin');
    Route::resource('/users', 'UsersController');
    Route::get('/login', 'UsersController@indexlogin')->name('login');
    Route::post('/login', 'UsersController@login')->name('login');
    Route::post('/logout', 'UsersController@logout')->name('logout');
    Route::get('/mahasiswa', ['as' => 'mahasiswa.index', 'uses' => 'MahasiswaController@index']);
    Route::get('/mahasiswa/{id}', ['as' => 'mahasiswa.show', 'uses' => 'MahasiswaController@show']);
    Route::resource('/dosen', 'DosenController');
    
    Route::resource('/instansi', 'InstansiController');
    Route::resource('/pengumuman', 'PengumumanController');
    Route::get('/pengumuman', 'PengumumanController@index');
    Route::get('/pengumuman/{id}', ['as' => 'pengumuman.show', 'uses' => 'PengumumanController@show']);
    Route::get('/pengumuman/create', ['as' => 'pengumuman.create', 'uses' => 'PengumumanController@create']);
    Route::get('/pengumuman/{id}/edit', ['as' => 'pengumuman.edit', 'uses' => 'PengumumanController@edit']);
    Route::get('/persetujuan_kelompok', 'KelompokController@acckelompok');
    Route::get('/periode/create', ['as' => 'periode.create', 'uses' => 'PeriodeController@create']);
    Route::get('/periode', ['as' => 'periode.index', 'uses' => 'PeriodeController@index']);
    Route::get('/periode/{id}/edit', ['as' => 'periode.edit', 'uses' => 'PeriodeController@edit']);
    Route::delete('/periode/{id}', ['as' => 'periode.destroy', 'uses' => 'PeriodeController@destroy']);
    // Route::resource('/lowongan', 'LowonganController');
    Route::get('/lowongan', ['as' => 'lowongan.index', 'uses' => 'LowonganController@index']);
    Route::get('/lowongan/{id}', ['as' => 'lowongan.show', 'uses' => 'LowonganController@show']);
    Route::get('/lowongan/create', ['as' => 'lowongan.create', 'uses' => 'LowonganController@create']);
    Route::get('/lowongan/{id}/edit', ['as' => 'lowongan.edit', 'uses' => 'LowonganController@edit']);
    
});

Route::prefix('mahasiswa')->group(function () {
    Route::get('/index', 'dashboardController@indexmahasiswa');
    Route::get('/profile', 'MahasiswaController@indexmahasiswa');
    Route::get('/editprofil/{id}', 'MahasiswaController@edit');
    Route::put('/editprofil/{id}', 'MahasiswaController@update');
    Route::put('/editavatar/{id}', 'MahasiswaController@updateAvatar');
    Route::get('/pengumuman', 'PengumumanController@indexmahasiswa');
    Route::get('/laporanharian', 'LaporanHarianController@index');
    Route::post('/laporanharian', 'LaporanHarianController@store');
});

Route::prefix('dosen')->group(function () {
    Route::get('/dashboard', 'dashboardController@indexdosen');
    Route::get('/profile', function () {
        return view('dosen.profile.profile');
    });
    Route::get('/edit_profil', function () {
        return view('dosen.profile.edit_profil');
    });
    Route::get('/kelompok', 'KelompokController@indexdosen');
    Route::get('/kelompok/{id}', 'KelompokController@showdosen');
    Route::get('/input_nilai', function () {
        return view('dosen.nilai.input_nilai');
    });
    Route::get('/inputNilai_penguji', function () {
        return view('dosen.nilai.inputNilai_penguji');
    });
    Route::get('/detail_inputNilai', function () {
        return view('dosen.nilai.detail_inputNilai');
    });
    Route::get('/detail_nilai', function () {
        return view('dosen.nilai.detail_nilai');
    });
    Route::get('/detail_nilai_penguji', function () {
        return view('dosen.nilai.detail_nilai_penguji');
    });
    Route::get('/daftar_nilaiAkhir', function () {
        return view('dosen.nilai.daftar_nilaiAkhir');
    });
    Route::get('/nilai_akhir', function () {
        return view('dosen.nilai.nilai_akhir');
    });
    Route::get('/laporan', function () {
        return view('dosen.laporan.laporan');
    });
    Route::get('/list_kegiatanHarian', function () {
        return view('dosen.logbook.list_kegiatanHarian');
    });
    
});


Route::get('/admin', 'Mah@admin')->name('/admin');
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

Route::get('/laporanpkl', function () {
    return view('mahasiswa.laporanpkl');
});

Route::get('/login', function () {
    return view('mahasiswa.login');
});
Route::get('/tambahanggotakelompok', function () {
    return view('mahasiswa.tambahanggotakelompok');
});



Route::get('/detail_nilai_penguji', 'Mah@nilaipenguji')->name('/detail_nilai_penguji');
Route::get('/login', 'Mah@login')->name('/login');








