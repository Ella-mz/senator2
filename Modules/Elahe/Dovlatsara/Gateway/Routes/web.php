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

Route::namespace('Modules\Gateway\Http\Controllers')->middleware('web')->group(function() {

    Route::get('/gateway/error', 'GatewayController@error')->name('gateway_error');
    Route::get('/gateway/callback', 'GatewayController@callback')->name('gateway_callback');
    Route::post('/gateway/callback', 'GatewayController@callback')->name('gateway_callback_post');
    Route::get('/start-gateway/saman/{merchant_id}', 'GatewayController@start_gateway_saman')->name('start_gateway.saman');
    Route::get('/start-gateway/beh-pardakht-mellat', 'GatewayController@start_gateway_beh_pardakht_mellat')->name('start_gateway.beh_pardakht_mellat');
    Route::get('/start-gateway/{merchant_code}/{resNum}/{gateway}', 'GatewayController@start_gateway_saman')->name('start_gateway');

});
