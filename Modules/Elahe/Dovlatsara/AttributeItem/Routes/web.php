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
 *attribute Items routes.
 */

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\AttributeItem\Http\Controllers\Admin')->group(function() {

        Route::get('show-attribute-items/{attribute}', 'AttributeItemController@index')->name('show.items.admin');
        Route::post('store-attribute-item', 'AttributeItemController@store')->name('store.items.admin');
        Route::post('update-attribute-item', 'AttributeItemController@update')->name('update.items.admin');
        Route::post('destroy-attribute-item/{attributeItem}', 'AttributeItemController@destroy')
            ->name('destroy.items.admin');

    });
