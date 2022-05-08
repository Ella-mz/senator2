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


use Illuminate\Support\Facades\Route;

Route::middleware(['api'])
    ->namespace('Modules\General\Http\Controllers\Api\V1')
    ->prefix('api/v1')->group(function () {
        Route::post('special-ads-in-home-page', 'HomePageController@specialAds');
        Route::post('contractors-in-home-page', 'HomePageController@contractors');
        Route::post('shops-in-home-page', 'HomePageController@shops');
        Route::post('ads-in-home-page', 'HomePageController@totalAds');
        Route::post('supplier-filter-page', 'SupplierFilterPageController@index');
        Route::get('filterItemsWithCategory/{category}', 'SupplierFilterPageController@sendFilterItems');
        Route::post('home-page', 'HomePageController@homePage');

//        Route::post('bookmarked', 'BookmarkController@bookmarked');

    });
