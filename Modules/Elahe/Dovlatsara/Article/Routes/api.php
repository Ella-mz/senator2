<?php

use Illuminate\Http\Request;

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

use Illuminate\Support\Facades\Route;

Route::middleware(['api'])
    ->namespace('Modules\Article\Http\Controllers\Api\V1')
    ->prefix('api/v1')->group(function () {
        Route::get('articles/list', 'ArticleController@index');
        Route::get('article-groups/list', 'ArticleController@articleGroups');
        Route::get('articles/{id}', 'ArticleController@show');
        Route::get('similar-articles', 'ArticleController@similarArticles');
    });
