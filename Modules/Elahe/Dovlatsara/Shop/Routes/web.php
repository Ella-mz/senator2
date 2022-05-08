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
/**
 * shops routes.
 */

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\Shop\Http\Controllers\Admin')->group(function() {
//
//        Route::get('shops-show', 'ShopController@index')->name('shops.index.admin');
//        Route::post('shops-show', 'ShopController@index')->name('shops.filter.admin');
//        Route::get('shop-confirm/{shop}', 'ShopController@confirm')->name('shops.confirm.admin');
//        Route::post('shop-destroy/{shop}', 'ShopController@destroy')->name('shops.destroy.admin');
//        Route::post('shop-disConfirm', 'ShopController@disConfirm')->name('shops.disconfirm.admin');
//        Route::get('shop-detail/{shop}', 'ShopController@detail')->name('shops.detail.admin');

    });
