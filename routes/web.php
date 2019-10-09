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

Route::get('/daftar_mahasiswa', 'Mah@index')->name('/daftar_mahasiswa');
Route::get('/detail_mahasiswa', 'Mah@index1')->name('/detail_mahasiswa');
Route::get('/daftar_dosen', 'Mah@index1')->name('/daftar_dosen');
