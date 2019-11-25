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

Route::post('/register', 'Api\Auth\AuthController@register');
Route::post('/login', 'Api\Auth\AuthController@login');

Route::middleware('auth:api')->group( function () {

    /*UserController*/
    Route::resource('/user', 'Api\Users\UserController');

    /*RoleController*/
    Route::resource('/roles', 'Api\Roles\RoleController');
});