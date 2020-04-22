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
        Route::get('/', 'dashboardController@indexadmin');
        // Route::get('/dashboard', 'Auth\LoginController@dashboard');
        Route::get('/dasboard', 'dashboardController@indexadmin');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        Route::get('/users/create', ['as' => 'users.create', 'uses' => 'UsersController@create']);
        Route::put('/users/{id}', ['as' => 'users.update', 'uses' => 'UsersController@update']);
        Route::get('/users', 'UsersController@index');
        Route::get('/users/{id}/edit', 'UsersController@edit');
        Route::post('import', 'UsersController@import')->name('import');
        Route::get('exportmahasiswa', 'MahasiswaController@export')->name('exportmahasiswa');
        Route::get('/mahasiswa', ['as' => 'mahasiswa.index', 'uses' => 'MahasiswaController@index']);
        Route::get('/mahasiswa/{id}', ['as' => 'mahasiswa.show', 'uses' => 'MahasiswaController@show']);
        Route::resource('/dosen', 'DosenController');
        Route::resource('/instansi', 'InstansiController');
        Route::resource('/pengumuman', 'PengumumanController');
        Route::get('/kelompok', 'KelompokController@index');
        Route::get('/kelompok/magang/{id}/detail', 'KelompokController@detailmagang');
        Route::get('/persetujuan_kelompok', 'KelompokController@acckelompok');
        Route::get('/kelompok/{id}', 'KelompokController@detailacckelompok');
        Route::get('/periode/create', ['as' => 'periode.create', 'uses' => 'PeriodeController@create']);
        Route::get('/periode', ['as' => 'periode.index', 'uses' => 'PeriodeController@index']);
        Route::get('/periode/{id}/edit', ['as' => 'periode.edit', 'uses' => 'PeriodeController@edit']);
        Route::resource('/lowongan', 'LowonganController');
        Route::get('/lowongan', ['as' => 'lowongan.index', 'uses' => 'LowonganController@index']);
        Route::get('/lowongan/{id}', ['as' => 'lowongan.show', 'uses' => 'LowonganController@show']);
        Route::get('/showlowongan/{id}', 'LowonganController@showlowongan');
        Route::get('/lowongan/create', ['as' => 'lowongan.create', 'uses' => 'LowonganController@create']);
        Route::get('/lowongan/{id}/edit', ['as' => 'lowongan.edit', 'uses' => 'LowonganController@edit']);
        Route::get('/presentasi', 'PresentasiController@index');
        Route::get('/presentasi/create', ['as' => 'presentasi.create', 'uses' => 'PresentasiController@create']);
        Route::get('/presentasi/{id}/edit', ['as' => 'presentasi.edit', 'uses' => 'PresentasiController@edit']);
        Route::get('/usulan', 'UsulanController@usulan');
        Route::get('/usulan/kelompok/{id}/detail', 'UsulanController@detailusulan');
        Route::get('/roles', 'RolesController@index');
        Route::get('/roles/{id}', 'RolesController@edit');
        Route::get('/sesi', 'SesiwaktuController@index');
        Route::get('/ruang', 'RuangController@index');
        Route::get('/aspekpenilaian', 'AspekpenilaianController@index');
        Route::get('/kelompokpenilai', 'PenilaiController@index');
        Route::get('/login', 'UsersController@indexlogin')->name('login');
        Route::post('/login', 'UsersController@loginadmin')->name('login');
    
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








