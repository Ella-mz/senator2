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
//use Modules\Attribute\Http\Controllers\admin\AttributeController;
/**
 * attributes routes.
 */

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\Attribute\Http\Controllers\Admin')->group(function() {

        Route::resource('attributes', 'AttributeController');
        Route::get('add-attribute/{groupAttribute}', 'AttributeController@addAttribute')
            ->name('attrs.add.admin');
        Route::get('show-attributes/{groupAttribute}', 'AttributeController@showAttributes')
            ->name('attrs.index.admin');

    });
