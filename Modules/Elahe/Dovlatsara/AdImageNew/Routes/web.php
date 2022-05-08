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

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\AdImageNew\Http\Controllers\Admin')->group(function() {


        Route::get('deleteAdImage', 'AdImageController@deleteImage')->name('deleteAdImageNew.admin');

    });
Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\AdImageNew\Http\Controllers\Realestate')->group(function() {

        Route::get('deleteAdImage', 'AdImageController@deleteImage')->name('deleteAdImage.realestate');

    });
