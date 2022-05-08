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
    ->namespace('Modules\Order\Http\Controllers')->group(function() {
        Route::get('factor/{orderId}', 'OrderController@factor')->name('factor.order.panel');
    });
