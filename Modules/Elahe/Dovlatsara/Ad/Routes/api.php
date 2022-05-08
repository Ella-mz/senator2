<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['api'])
    ->namespace('Modules\Ad\Http\Controllers\Api\V1')
    ->prefix('api/v1')->group(function () {
//        Route::get('/create-supplier/{category}', 'CreateController@index')->name('ad.crate.supplier.user')->middleware('user.auth');
//        Route::post('/create-supplier/{category}', 'CreateController@store')->name('ad.store.supplier.user')->middleware('user.auth');
        Route::get('ad/{ad}', 'ShowController@show');
        Route::get('myPosts', 'ShowController@myAds');
        Route::get('similar-ads/{ad}', 'ShowController@similarAds');
//        Route::get('delete-ad/{ad}', 'DeleteController@delete')->name('ad.delete.supplier.user')->middleware('user.auth');
//        Route::get('find-cats/{type}', 'CreateController@selectCategory')->name('ad.find.cats.user')->middleware('user.auth');
//        Route::get('prev-cats/{type}', 'CreateController@prevCats')->name('ad.prev.cats.user')->middleware('user.auth');
//        Route::get('bookmarks', 'ShowController@bookmark')->name('ad.bookmarks.supplier.user')->middleware('user.auth');
//        Route::post('login', 'LoginController@login')->name('realestate_login');
        Route::get('ad/create/{category}', 'CreateController@createSupplier');
        Route::post('ad/store', 'CreateController@storeSupplier');
        Route::get('user/active/{adId}', 'DeleteController@active');
        Route::get('user/inactive/{adId}', 'DeleteController@inactive');
        Route::get('delete-ad/{adId}', 'DeleteController@delete');


    });
