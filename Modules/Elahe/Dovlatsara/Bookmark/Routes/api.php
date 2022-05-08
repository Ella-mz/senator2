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
    ->namespace('Modules\Bookmark\Http\Controllers\Api\V1')
    ->prefix('api/v1')->group(function () {
        Route::get('bookmarks', 'BookmarkController@bookmarks');
        Route::post('bookmarked', 'BookmarkController@bookmarked');

    });
