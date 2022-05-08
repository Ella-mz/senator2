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


Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\Setting\Http\Controllers')->group(function() {

        Route::get('setting', 'SettingController@index')->name('setting.index.admin');
        Route::get('setting/create/{setting}', 'SettingController@create')->name('setting.create.admin');
        Route::post('setting/create/{setting}', 'SettingController@store')->name('setting.store.admin');
        Route::post('setting/delete/{setting}', 'SettingController@delete')->name('setting.delete.admin');
        Route::get('get_setting_text', 'SettingController@get_setting_text')->name('get_setting_text.admin');

    });
