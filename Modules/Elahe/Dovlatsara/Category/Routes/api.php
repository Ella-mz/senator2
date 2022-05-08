<?php

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

//Route::middleware('auth:api')->get('/category', function (Request $request) {
//    return $request->user();
//});
Route::middleware(['api'])
    ->namespace('Modules\Category\Http\Controllers\Api\V1')
    ->prefix('api/v1')->group(function () {

        Route::get('categories', 'CategoryController@index');
        Route::post('category/{category}', 'CategoryController@indexLevel2');
        Route::post('category-with-agency/{categoryId}/{agencyId}', 'CategoryController@indexLevel2WithAgency');

    });
