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
    ->namespace('Modules\Application\Http\Controllers\Api\V1')
    ->prefix('api/v1/applications')->group(function () {
        Route::get('/', 'ApplicationController@index');
        Route::get('/show', 'ApplicationController@show');
        Route::get('/create', 'ApplicationController@create');
        Route::post('/store', 'ApplicationController@store');
        Route::post('/destroy/{applicationId}', 'ApplicationController@destroy');
    });
