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


Route::namespace('Modules\Map\Http\Controllers')->middleware('web')->group(function() {
    Route::get('get/address_with_location', 'NeshanController@find_address')->name('get-address-with-location');

});
