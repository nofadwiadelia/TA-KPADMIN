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


Route::get('/test',function(){
    return response()->json([
        'error' =>'test bung',
        'code' => 200,
    ], 200);
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