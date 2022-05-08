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
    ->namespace('Modules\Hologram\Http\Controllers\Admin')->group(function () {

//        Route::resource('group-attrs', 'GroupAttributeController');
        Route::get('holograms', 'HologramController@index')->name('holograms.index.admin');
        Route::get('holograms/create', 'HologramController@create')->name('holograms.create.admin');
        Route::post('holograms/store', 'HologramController@store')->name('holograms.store.admin');

        Route::get('holograms/edit/{hologram}', 'HologramController@edit')->name('holograms.edit.admin');
        Route::post('holograms/update/{hologram}', 'HologramController@update')->name('holograms.update.admin');

        Route::post('holograms/destroy/{hologram}', 'HologramController@destroy')->name('holograms.destroy.admin');

        Route::get('holograms/deleteFile', 'HologramController@deleteFile')->name('holograms.deleteFile');
//        Route::post('store-cat', 'CategoryController@storeCat')->name('category.store.admin');
//        Route::get('edit-cat/{category}', 'CategoryController@editCat')->name('category.edit.admin');
//        Route::post('update-cat/{category}', 'CategoryController@addCat')->name('category.update.admin');
//        Route::post('destroy-caty/{category}', 'CategoryController@addCat')->name('category.destroy.admin');
//        Route::get('category/deleteFile', 'CategoryController@deleteFile')->name('categories.deleteFile');

    });
Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Hologram\Http\Controllers\Realestate')->group(function () {

        Route::get('holograms/{type}/{id}', 'HologramController@index')->name('hologram.index.realestate');
        Route::get('hologram/{hologram}/{id}', 'HologramController@choose')->name('hologram.choose.realestate');
        Route::post('holograms/apply', 'HologramController@apply')->name('hologram.apply.realestate');
        Route::get('my-holograms', 'HologramController@myHolograms')->name('hologram.myHolograms.realestate');
        Route::get('my-hologram/{hologramInterface}', 'HologramController@myHologram')->name('hologram.myHologram.realestate');
        Route::get('hologram-download-fil/{hologramInterfaceFile}', 'HologramController@download')->name('hologram.download.realestate');
        Route::post('holograms/pay', 'HologramController@pay')->name('hologram.pay.realestate');
        Route::get('/holograms/gateway/start-error', 'HologramController@startError')->name('holograms.gateway_start_error.panel');
        Route::get('/holograms/gateway/callback-error', 'HologramController@callbackError')->name('holograms.gateway_callback_error.panel');

//            Route::post('/create-supplier/{category}', 'CreateController@store')->name('ad.store.supplier.user');

    });
