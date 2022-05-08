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
    ->namespace('Modules\AdFee\Http\Controllers\Api\V1')
    ->prefix('api/v1')->group(function () {
        Route::get('ad-fee-list/{ad}', 'AdFeeController@adFeeListForPayment');
        Route::post('check-ad-fees', 'AdFeeController@checkAdFee');
//
//        Route::get('myPosts', 'ShowController@myAds');
//        Route::get('similar-ads/{ad}', 'ShowController@similarAds');
//        Route::get('ad/create/{category}', 'CreateController@createSupplier');

    });
