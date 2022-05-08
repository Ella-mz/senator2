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
 * group attributes routes.
 */

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\HologramInterface\Http\Controllers\Admin')->group(function () {
        Route::get('hologram-applications', 'HologramInterfaceController@index')->name('hologramInterface.index.admin');
        Route::post('hologram-applications', 'HologramInterfaceController@index')->name('hologramInterface.filter.admin');
        Route::get('hologram-applications/{hologramInterface}', 'HologramInterfaceController@show')->name('hologramInterface.show.admin');
        Route::get('hologram-applications-download-file/{hologramInterfaceFile}', 'HologramInterfaceController@download')->name('hologramInterface.download.admin');
        Route::get('update-expert-in-holo-interface', 'HologramInterfaceController@changeExpertInHologramInterface')
            ->name('changeExpertInHologramInterface')->middleware('request.pending');
        Route::post('approved-hologram', 'HologramInterfaceController@approved')
            ->name('hologramInterface.approved.admin')->middleware('request.pending');
        Route::post('not-approved-hologram', 'HologramInterfaceController@notApproved')
            ->name('hologramInterface.notApproved.admin')->middleware('request.pending');

//        Route::get('hologram/{hologramInterface}', 'HologramInterfaceController@show')->name('hologramInterface.show.admin');

    });
Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\HologramInterface\Http\Controllers\Realestate')->group(function () {

        Route::get('holograms/{type}', 'HologramInterfaceController@index')->name('hologramInterface.index.realestate');
        Route::get('hologram/{hologramInterface}', 'HologramInterfaceController@show')->name('hologramInterface.show.realestate');
        Route::get('hologram-download-file/{hologramInterfaceFile}', 'HologramInterfaceController@download')->name('hologramInterface.download.realestate');

        Route::post('approved-hologram-in-panel', 'HologramInterfaceController@approved')
            ->name('hologramInterface.approved.realestate')->middleware('request.pending');
        Route::post('not-approved-hologram-in-panel', 'HologramInterfaceController@notApproved')
            ->name('hologramInterface.notApproved.realestate')->middleware('request.pending');
//        Route::get('holograms/{type}/{id}', 'HologramController@index')->name('hologram.index.realestate');
//        Route::get('hologram/{hologram}/{id}', 'HologramController@choose')->name('hologram.choose.realestate');
//        Route::post('holograms/apply', 'HologramController@apply')->name('hologram.apply.realestate');
//        Route::get('my-holograms', 'HologramController@myHolograms')->name('hologram.myHolograms.realestate');
//        Route::get('my-hologram/{hologramInterface}', 'HologramController@myHologram')->name('hologram.myHologram.realestate');

//            Route::post('/create-supplier/{category}', 'CreateController@store')->name('ad.store.supplier.user');

    });
