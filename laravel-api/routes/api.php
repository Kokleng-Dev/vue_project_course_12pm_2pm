<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'App\Http\Controllers\Api\\'], function(){
    Route::post('/login', 'AuthController@login');
    Route::post('/check/otp', 'AuthController@checkOTP');

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/test', function(){
            return 'heeee';
        });

        Route::get('/logout','AuthController@logout');

        //user
        Route::get('/user','UserController@index');
        Route::post('/user/update','UserController@update');
        Route::post('/user/store','UserController@store');
        Route::post('/user/delete','UserController@delete');
    });
});
