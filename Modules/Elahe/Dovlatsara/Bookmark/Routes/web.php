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

Route::middleware(['web'])
    ->namespace('Modules\Bookmark\Http\Controllers\User')->group(function() {

        Route::get('/bookmarked/ad/{adId}', 'BookmarkController@bookmarked')->name('bookmarked.user')->middleware('user.auth');

    });
