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
 * neighborhoods routes.
 */

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\Neighborhood\Http\Controllers')->group(function () {
        Route::namespace('Admin')->group(function () {
            Route::resource('neighborhoods', 'NeighborhoodController');
            Route::get('add-neighborhood/{city}', 'NeighborhoodController@addNeighborhood')->name('neighborhood.add.admin');
            Route::get('show-neighborhoods/{city}', 'NeighborhoodController@showNeighborhoods')->name('neighborhoods.index.admin');
            Route::get('ad/create/neighborhood-old', 'NeighborhoodController@neighborhoodOld')->name('neighborhoodOld.admin');
        });
    });
Route::middleware(['web',])
    ->namespace('Modules\Neighborhood\Http\Controllers')->group(function () {
        Route::get('/getting/neighbor', 'NeighborhoodController@neighborhoods')->name('gettingNeighborhood');
        Route::get('application/getting/neighbor', 'NeighborhoodController@neighborhoodOld')->name('neighborhood.neighborhoodOld.user');

    });

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Neighborhood\Http\Controllers\Realestate')->group(function () {
        Route::get('ad/create/neighborhood-old', 'NeighborhoodController@neighborhoodOld')->name('neighborhoodOld.panel');

    });
