<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Acces-Control-Request-Method, Authorization");
header("Acces-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function () {
    Route::get('/kelompokcount', 'dashboardController@kelompokCount');
    Route::get('/usulancount', 'dashboardController@usulanCount');
    Route::delete('/users/{id}', 'UsersController@destroy');
    Route::put('/password/{id}/', 'UsersController@updatePassword');
    Route::get('/mahasiswa', 'MahasiswaController@index');
    Route::post('/dosen/change', 'DosenController@changeStatus');
    Route::post('/instansi/change', 'InstansiController@changeStatus');
    Route::post('/persetujuan_kelompoks', 'KelompokController@postacckelompok');
    Route::post('/tolak_kelompok', 'KelompokController@declinekelompok');
    Route::get('/detailkelompok/{id}', 'KelompokController@detail');
    Route::post('/periode/add', 'PeriodeController@store');
    Route::put('/periode/{id}/edit', 'PeriodeController@update');
    Route::post('/periode/change', 'PeriodeController@changeStatus');
    Route::delete('/periode/{id}', 'PeriodeController@destroy');
    Route::post('/lowongan/add', 'LowonganController@store');
    Route::put('/lowongan/{id}/edit', 'LowonganController@update');
    Route::delete('/lowongan/{id}', 'LowonganController@destroy');
    Route::post('/pengumuman/add', 'PengumumanController@store');
    Route::post('/pengumuman/{id}/edit', 'PengumumanController@update');
    Route::delete('/pengumuman/{id}', 'PengumumanController@destroy');
    Route::post('/presentasi/add', 'PresentasiController@store');
    Route::put('/presentasi/{id}/edit', 'PresentasiController@update');
    Route::delete('/presentasi/{id}', 'PresentasiController@destroy');
    Route::post('/roles', 'RolesController@store');
    Route::get('/roles/{id}', 'RolesController@edit');
    Route::delete('/roles/{id}', 'RolesController@destroy');
    Route::post('/sesi', 'SesiwaktuController@store');
    Route::get('/sesi/{id}', 'SesiwaktuController@edit');
    Route::delete('/sesi/{id}', 'SesiwaktuController@destroy');
    Route::post('/ruang', 'RuangController@store');
    Route::get('/ruang/{id}', 'RuangController@edit');
    Route::delete('/ruang/{id}', 'RuangController@destroy');
    Route::post('/aspekpenilaian', 'AspekpenilaianController@store');
    Route::get('/aspekpenilaian/{id}', 'AspekpenilaianController@edit');
    Route::delete('/aspekpenilaian/{id}', 'AspekpenilaianController@destroy');
    Route::post('/kelompokpenilai', 'PenilaiController@store');
    Route::get('/kelompokpenilai/{id}', 'PenilaiController@edit');
    Route::delete('/kelompokpenilai/{id}', 'PenilaiController@destroy');
});


Route::post('login', function(Request $request){
    if(auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')]))
    {
        $user = auth()->user();
        $user->api_token = str_random(60);
        $user->save();
        return $user;
    }
    return response()->json([
        'error' =>'error bung',
        'code' => 401,
    ], 401);
});

Route::get('/dashboard', 'dashboardController@index');