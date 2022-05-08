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
    ->namespace('Modules\GroupAttribute\Http\Controllers\Admin')->group(function() {

        Route::resource('group-attrs', 'GroupAttributeController');
        Route::get('add-group-attrs/{category}', 'GroupAttributeController@addGroupAttribute')->name('groupAttrs.add.admin');
        Route::get('show-group-attrs/{category}', 'GroupAttributeController@showGroupAttributes')->name('groupAttrs.index.admin');
        Route::get('change-group-attrs-order', 'GroupAttributeController@changeGroupAttrOrder')->name('changeGroupAttrOrder');

    });
