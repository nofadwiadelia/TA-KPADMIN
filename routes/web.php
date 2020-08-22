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

Route::get('/login', 'UsersController@indexlogin')->name('login');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', 'dashboardController@indexadmin');
        Route::get('/dasboard', 'dashboardController@indexadmin');
        Route::post('logout', 'UsersController@logout')->name('logout');

        Route::get('/mahasiswa/contoh', 'MahasiswaController@downloadexcel');
        Route::post('import', 'UsersController@import')->name('import');
        Route::get('exportmahasiswa', 'MahasiswaController@export')->name('exportmahasiswa');
        Route::get('/mahasiswa/create',  'MahasiswaController@create');
        Route::get('/mahasiswa/{id}/edit',  'MahasiswaController@editaccount');
        Route::get('/mahasiswa', ['as' => 'mahasiswa.index', 'uses' => 'MahasiswaController@index']);
        Route::get('/mahasiswa/{id}', ['as' => 'mahasiswa.show', 'uses' => 'MahasiswaController@show']);
        Route::get('/dosen',  'DosenController@index');
        Route::get('/dosen/create',  'DosenController@create');
        Route::get('/dosen/{id}/edit',  'DosenController@editaccount');
        Route::get('/dosen/{id}',  'DosenController@show');
        Route::get('/instansi',  'InstansiController@index');
        Route::get('/instansi/create',  'InstansiController@create');
        Route::get('/instansi/{id}/edit',  'InstansiController@editaccount');
        Route::get('/instansi/{id}',  'InstansiController@show');
        Route::get('/instansi/getlowongan/{id}',  'InstansiController@getLowongan');
        Route::get('/instansi/{id}/edit',  'InstansiController@editaccount');
        Route::get('/daftaradmin', 'AdminController@index');
        Route::get('/admin/create',  'AdminController@create');
        Route::get('/admin/{id}/edit',  'AdminController@edit');
        Route::resource('/pengumuman', 'PengumumanController');
        Route::get('/kelompok', 'KelompokController@index');
        Route::get('/kelompok/create', 'KelompokController@createkelompok');
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
        Route::get('/contoh/download', 'UsersController@getExcel')->name('contoh.download');
    });
        Route::get('/login', 'UsersController@indexlogin')->name('login');
        Route::post('/login', 'UsersController@loginadmin')->name('login');
    
});









