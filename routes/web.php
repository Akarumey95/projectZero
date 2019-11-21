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

use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@adminPage')->name('adminPage')->middleware(CheckRole::class);

Route::post('/create/user', 'HomeController@createUser')->name('createUser');
Route::post('/update/user', 'HomeController@updateUser')->name('updateUser');
Route::post('/create/role', 'RoleController@createRole')->name('createRole');
Route::post('/update/role', 'RoleController@updateRole')->name('updateRole');




