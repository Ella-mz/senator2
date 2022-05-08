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

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\ContractorProjectImage\Http\Controllers\Realestate')->group(function() {

        Route::get('deleteContractorProjectImage', 'ContractorProjectImageController@deleteFiles')->name('deleteContractorProjectImage.realestate');

    });
