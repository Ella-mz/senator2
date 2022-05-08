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
 * Orders routes.
 */

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Payment\Http\Controllers')->group(function() {
        Route::get('factor', 'PaymentController@factor')->name('factor.payment.panel');

    });

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\Payment\Http\Controllers\Admin')->group(function() {

        Route::get('payments/list/{type}', 'PaymentController@index')->name('payments.index.admin');
        Route::post('payments/list/{type}', 'PaymentController@index')->name('payments.filter.admin');

    });
