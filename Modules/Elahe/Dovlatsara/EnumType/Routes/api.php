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

//Route::middleware('auth:api')->get('/enumtype', function (Request $request) {
//    return $request->user();
//});
Route::middleware(['api'])
    ->namespace('Modules\EnumType\Http\Controllers\Api\V1')
    ->prefix('api/v1')->group(function () {

        Route::get('about-us', 'AboutUsController@index');
        Route::get('rules-and-terms', 'RulesAndTermsController@index');

    });
