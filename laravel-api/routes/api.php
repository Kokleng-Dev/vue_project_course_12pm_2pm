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

        //permission
        Route::get('/permission','PermissionController@index');
        Route::post('/permission/update','PermissionController@update');
        Route::post('/permission/store','PermissionController@store');
        Route::post('/permission/delete','PermissionController@delete');

        //permission feature
        Route::get('/permission/feature','PermissionFeatureController@index');
        Route::post('/permission/feature/update','PermissionFeatureController@update');
        Route::post('/permission/feature/store','PermissionFeatureController@store');
        Route::post('/permission/feature/delete','PermissionFeatureController@delete');

        //role
        Route::get('/role','RoleController@index');
        Route::post('/role/update','RoleController@update');
        Route::post('/role/store','RoleController@store');
        Route::post('/role/delete','RoleController@delete');

        //role permission
        Route::get('/role/permission','RolePermissionController@index');
        Route::post('/role/permission/update', 'RolePermissionController@action');

        //user
        Route::get('/user','UserController@index');
        Route::post('/user/update','UserController@update');
        Route::post('/user/store','UserController@store');
        Route::post('/user/delete','UserController@delete');

        
    });
});
