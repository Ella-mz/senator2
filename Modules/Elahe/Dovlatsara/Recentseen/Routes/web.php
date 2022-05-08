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

//Route::prefix('admin')->middleware(['web', 'admin.auth'])
//    ->namespace('Modules\Recentseen\Http\Controllers\User')->group(function() {
//
//        Route::get('bookmarked', 'BookmarkController@bookmarked')->name('bookmarked.user');
//
//    });

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Recentseen\Http\Controllers\Panel')->group(function () {

        Route::get('seen-applications', 'ApplicationRecentseenController@index')->name('applications.seen.realestate');
        Route::post('seen-applications', 'ApplicationRecentseenController@index')->name('applications.seen.filter.realestate');

    });
