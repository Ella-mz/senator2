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
 * AdvertisingFee routes.
 */

//Route::prefix('admin')->middleware(['web', 'admin.auth'])
//    ->namespace('Modules\AdvertisingFee\Http\Controllers\Admin')->group(function() {

//        Route::resource('advertising-fees', 'AdvertisingFeeController');
//        Route::get('add-advertising-fees/{category}', 'AdvertisingFeeController@addAdvertisingFee')->name('advertisingFee.add.admin');
//        Route::get('show-advertising-fees/{category}', 'AdvertisingFeeController@showAdvertisingFees')->name('advertisingFee.index.admin');

//        Route::get('add-group-attrs/{category}', 'GroupAttributeController@addGroupAttribute')->name('groupAttrs.add.admin');
//        Route::get('show-group-attrs/{category}', 'GroupAttributeController@showGroupAttributes')->name('groupAttrs.index.admin');
//        Route::get('change-group-attrs-order', 'GroupAttributeController@changeGroupAttrOrder')->name('changeGroupAttrOrder');

//    });
//Route::middleware(['web'])
//    ->namespace('Modules\AdvertisingFee\Http\Controllers\User')->group(function() {
//
//        Route::get('check-advertising-fees', 'AdvertisingFeeController@checkAdFee')->name('checkAdFee.user');
//        Route::get('pay-advertising-fees/{ad}', 'AdvertisingFeeController@payTheFee')->name('payAdFee.user');
//
////        Route::get('show-advertising-fees/{category}', 'AdvertisingFeeController@showAdvertisingFees')->name('advertisingFee.index.admin');
//
//    });
