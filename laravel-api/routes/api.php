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
        Route::get('/role','RoleController@index')->middleware('permission:role,view');
        Route::post('/role/update','RoleController@update')->middleware('permission:role,edit');
        Route::post('/role/store','RoleController@store')->middleware('permission:role,create');
        Route::post('/role/delete','RoleController@delete')->middleware('permission:role,delete');

        //role permission
        Route::get('/role/permission','RolePermissionController@index');
        Route::post('/role/permission/update', 'RolePermissionController@action');

        //user
        Route::get('/user','UserController@index')->middleware('permission:user,view');
        Route::post('/user/update','UserController@update')->middleware('permission:user,edit');
        Route::post('/user/store','UserController@store')->middleware('permission:user,create');
        Route::post('/user/delete','UserController@delete')->middleware('permission:user,delete');


        //api key
        Route::get('/api-key','ApiKeyController@index');
        Route::post('/api-key/update','ApiKeyController@update');
        Route::post('/api-key/store','ApiKeyController@store');
        Route::post('/api-key/delete','ApiKeyController@delete');



        //staff
        Route::get('/staff','StaffController@index')->middleware('permission:staff,view');
        Route::post('/staff/update','StaffController@update')->middleware('permission:staff,edit');
        Route::post('/staff/store','StaffController@store')->middleware('permission:staff,create');
        Route::post('/staff/delete','StaffController@delete')->middleware('permission:staff,delete');
    
    });
});
