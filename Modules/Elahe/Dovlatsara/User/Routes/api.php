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
    ->namespace('Modules\User\Http\Controllers\Api\V1\User')
    ->prefix('api/v1')->group(function () {

//        Route::get('agencies', 'ShopController@index');
        Route::get('agency/{slug}', 'ShopController@show');
        Route::post('agencies', 'ShopController@index');
        Route::post('real-estates-search', 'ShopController@search');
        Route::get('contractors', 'ContractorController@index');
        Route::get('contractors/{slug}', 'ContractorController@show');
        Route::post('contractors', 'ContractorController@index');
        Route::post('contractors-search', 'ContractorController@search');
//        Route::post('login', 'LoginController@login')->name('realestate_login');
        Route::post('login', 'LoginController@login');
        Route::post('verify', 'LoginController@verify');
        Route::post('register', 'RegisterController@register');
        Route::post('agency-ads/{slug}', 'ShopController@adsOfShop');
        Route::get('profile', 'UserController@profile');
        Route::post('logout', 'LoginController@logout');

    });
