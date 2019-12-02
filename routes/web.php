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

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/admin/clear/all', function (){
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
});

Auth::routes();

Route::get('/home', 'Web\HomeController@index')->name('home');

Route::middleware(CheckRole::class)->group(function (){

    Route::get('/admin', 'Web\HomeController@adminPage')->name('adminPage');

    /*UserController*/
    Route::resource('/admin/user', 'Web\Users\UserController');

    /*RoleController*/
    Route::resource('/admin/role', 'Web\Roles\RoleController');

    /*CarController*/
    Route::resource('/admin/car', 'Web\Cars\CarController');

    /*TariffController*/
    Route::resource('/admin/tariff', 'Web\Tariffs\TariffController');

});





