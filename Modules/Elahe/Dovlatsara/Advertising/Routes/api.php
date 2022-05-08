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
    ->namespace('Modules\Advertising\Http\Controllers\Api\V1')
    ->prefix('api/v1')->group(function () {
        Route::get('advertisings', 'AdvertisingController@index');
        Route::get('apply', 'AdvertisingApplicationController@apply');
        Route::post('applySubmit', 'AdvertisingApplicationController@applySubmit');
        Route::get('get-dates-with-category', 'AdvertisingApplicationController@getDateWithCategory');
        Route::get('advertising-application/list', 'AdvertisingApplicationController@index');
        Route::get('advertising-application/show', 'AdvertisingApplicationController@show');

    });
