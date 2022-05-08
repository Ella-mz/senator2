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
    ->namespace('Modules\AdFee\Http\Controllers\Admin')->group(function() {

        Route::resource('advertising-fees', 'AdFeeController');
        Route::get('add-advertising-fees/{category}', 'AdFeeController@addAdvertisingFee')->name('advertisingFee.add.admin');
        Route::get('show-advertising-fees/{category}', 'AdFeeController@showAdvertisingFees')->name('advertisingFee.index.admin');

    });

Route::middleware(['web'])
    ->namespace('Modules\AdFee\Http\Controllers\User')->group(function() {

        Route::get('check/advertising-fees', 'AdFeeController@checkAdFee')->name('checkAdFee.user');
        Route::get('show/chosen/advertising-fees', 'AdFeeController@showChosenAdFeeCard')->name('show.chosen.AdFeeCard.user');

        Route::get('pay/advertising-fees/{ad}/{adFee}', 'AdFeeController@payTheFee')->name('payAdFee.user');
        Route::get('user/ad-fee-list/{ad}', 'AdFeeController@adFeeListForPayment')->name('adFeeList.user');
        Route::post('user/factor', 'AdFeeController@factorPage')->name('factorPage.user');

//        Route::get('show-advertising-fees/{category}', 'AdvertisingFeeController@showAdvertisingFees')->name('advertisingFee.index.admin');

    });
Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\AdFee\Http\Controllers\Realestate')->group(function () {
        Route::get('check-advertising-fees', 'AdFeeController@checkAdFee')->name('checkAdFee.realestate');
//        Route::get('pay-advertising-fees/{ad}/{adFee}', 'AdFeeController@payTheFee')->name('payAdFee.realestate');
        Route::post('ad-fee/factor', 'AdFeeController@factorPage')->name('factorPage.realestate');
        Route::get('ad-fee-list/{ad}', 'AdFeeController@adFeeListForPayment')->name('adFeeList.realestate');
        Route::get('/ad-fee/gateway/start-error', 'AdFeeController@startError')->name('adFee.gateway_start_error.panel');
        Route::get('/ad-fee/gateway/callback-error', 'AdFeeController@callbackError')->name('adFee.gateway_callback_error.panel');
        Route::post('ad-fee/pay', 'AdFeeController@pay')->name('adFee.pay.realestate');
        Route::get('show/chosen/advertising-fees', 'AdFeeController@showChosenAdFeeCard')->name('show.chosen.AdFeeCard.panel');

    });
