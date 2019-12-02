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
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    if (Auth::user() && User::checkRole('admin')) {
        return redirect('admin');
    }else{
        return redirect('home');
    }

});

Route::get('/admin/clear/all', function (){
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
});

Route::get('/home', 'Web\HomeController@index')->name('home');

Route::middleware(CheckRole::class)->group(function (){

    Route::get('/admin', 'Web\HomeController@adminPage')->name('adminPage');

    Route::post('/create/user', 'Web\Users\UserController@createUser')->name('createUser');
    Route::post('/update/user', 'Web\Users\UserController@updateUser')->name('updateUser');

    Route::post('/create/role', 'Web\Roles\RoleController@createRole')->name('createRole');
    Route::post('/update/role/{id}', 'Web\Roles\RoleController@updateRole')->name('updateRole');
});





