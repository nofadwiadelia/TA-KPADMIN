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
    Route::delete('/users/{id}', 'UsersController@destroy');
    Route::get('/mahasiswa', 'MahasiswaController@index');
    Route::post('/dosen/change', 'DosenController@changeStatus');
    Route::post('/persetujuan_kelompoks', 'KelompokController@postacckelompok');
    Route::post('/tolak_kelompok', 'KelompokController@declinekelompok');
    Route::post('/periode/add', 'PeriodeController@store');
    Route::put('/periode/{id}/edit', 'PeriodeController@update');
    Route::post('/periode/change', 'PeriodeController@changeStatus');
    Route::delete('/periode/{id}', 'PeriodeController@destroy');
    Route::post('/lowongan/add', 'LowonganController@store');
    Route::put('/lowongan/{id}/edit', 'LowonganController@update');
    Route::delete('/lowongan/{id}', 'LowonganController@destroy');
    Route::post('/pengumuman/add', 'PengumumanController@store');
    Route::put('/pengumuman/{id}/edit', 'PengumumanController@update');
    Route::delete('/pengumuman/{id}', 'PengumumanController@destroy');
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