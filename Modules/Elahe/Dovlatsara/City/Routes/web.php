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
use Illuminate\Support\Facades\Route;
/**
 * City routes.
 */

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\City\Http\Controllers\Admin')->group(function() {

        Route::resource('cities', 'CityController');

    });

Route::middleware(['web'])
    ->namespace('Modules\City\Http\Controllers\User')->group(function() {
//        Route::get('show/cities', 'CityController@show')->name('user.city.showww');

        Route::post('get/cities', 'CityController@set_cookie_of_city')->name('user.city.setCookie');
        Route::get('get/latAndLng', 'CityController@getLatAndLng')->name('user.city.getLatAndLng');

    });
