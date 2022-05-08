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
    ->namespace('Modules\ContractorProject\Http\Controllers\Realestate')->group(function() {

        Route::get('contractor-projects', 'ContractorProjectController@index')->name('contractorProject.index.realestate');
        Route::get('contractor-project/create', 'ContractorProjectController@create')->name('contractorProject.create.realestate');
        Route::post('contractor-project/create', 'ContractorProjectController@store')->name('contractorProject.store.realestate');
        Route::get('contractor-project/edit/{contractorProject}', 'ContractorProjectController@edit')->name('contractorProject.edit.realestate');
        Route::post('contractor-project/update/{contractorProject}', 'ContractorProjectController@update')->name('contractorProject.update.realestate');
        Route::post('contractor-project/destroy/{contractorProject}', 'ContractorProjectController@destroy')->name('contractorProject.destroy.realestate');


    });
