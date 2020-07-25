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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

    // Route::post('/login', 'UsersController@loginadmin');
    
    

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('/userlogin', 'dashboardController@users');
        Route::get('/datadashboard', 'dashboardController@datadashboard');
    });

    Route::post('/users/{id}', 'UsersController@update');
    Route::post('/admin/add', 'AdminController@store');
    Route::post('/admin/{id}', 'AdminController@update');
    Route::post('/admin/{id}/edit', 'AdminController@updateAvatar');
    Route::put('/admin/delete/{id}', 'AdminController@destroy');
    Route::put('/users/{id}', 'UsersController@destroy');
    Route::put('/password/{id}/', 'UsersController@updatePassword');
    Route::get('/mahasiswa', 'MahasiswaController@index');
    Route::get('/mahasiswa/nilai/{id}', 'NilaiController@index');
    Route::post('/mahasiswa/add', 'MahasiswaController@store');
    Route::post('/mahasiswa/{id}', 'MahasiswaController@updateadmin');
    Route::put('/mahasiswa/delete/{id}', 'MahasiswaController@destroy');
    Route::post('/dosen/change', 'DosenController@changeStatus');
    Route::post('/dosen/add', 'DosenController@store');
    Route::post('/dosen/{id}', 'DosenController@update');
    Route::post('/instansi/changestatus', 'InstansiController@changeStatus');
    Route::post('/instansi/changeblacklist', 'InstansiController@changeBlacklist');
    Route::post('/instansi/add', 'InstansiController@store');
    Route::post('/instansi/{id}', 'InstansiController@update');
    Route::put('/instansi/delete/{id}', 'InstansiController@destroy');
    Route::post('/persetujuan_kelompoks', 'KelompokController@postacckelompok');
    Route::post('/tolak_kelompok', 'KelompokController@declinekelompok');
    Route::post('/create_kelompok', 'KelompokController@storekelompok');
    Route::get('/detailkelompok/{id}', 'KelompokController@detail');
    Route::delete('/kelompok/{id}', 'KelompokController@destroy');
    Route::delete('/kick/{id}', 'KelompokController@kick');
    Route::post('/anggota/add', 'KelompokController@addAnggotaMerge');
    Route::post('/periode/add', 'PeriodeController@store');
    Route::put('/periode/{id}/edit', 'PeriodeController@update');
    Route::post('/periode/change', 'PeriodeController@changeStatus');
    Route::put('/periode/{id}', 'PeriodeController@destroy');
    Route::post('/lowongan/add', 'LowonganController@store');
    Route::put('/lowongan/{id}/edit', 'LowonganController@update');
    Route::put('/lowongan/{id}', 'LowonganController@destroy');
    Route::post('/persetujuanlowongan', 'LowonganController@acclowongan');
    Route::post('/declinelowongan', 'LowonganController@declinelowongan');
    Route::post('/persetujuanusulan', 'UsulanController@accusulan');
    Route::get('/usulan/{id}', 'UsulanController@editusulan');
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
    Route::get('/kelompokpenilai/{id}', 'PenilaiController@edit');
});


// Route::post('login', function(Request $request){
//     if(auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')]))
//     {
//         $user = auth()->user();
//         $user->api_token = str_random(60);
//         $user->save();
//         return $user;
//     }
//     return response()->json([
//         'error' =>'error bung',
//         'code' => 401,
//     ], 401);
// });

