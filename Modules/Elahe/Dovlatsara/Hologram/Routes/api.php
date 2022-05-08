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
    ->namespace('Modules\Hologram\Http\Controllers\Api\V1')
    ->prefix('api/v1')->group(function () {
        Route::get('holograms', 'HologramController@index');
        Route::get('select-hologram', 'HologramController@choose');
        Route::post('holograms/apply', 'HologramController@apply');
//        Route::get('user-holograms', 'HologramController@userHolograms');

//        Route::post('check-ad-fees', 'HologramController@checkAdFee');
    });
