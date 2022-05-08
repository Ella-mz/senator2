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
 * CommonQuestion routes.
 */

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\CommonQuestion\Http\Controllers\Admin')->group(function() {

        Route::get('commonQuestions', 'CommonQuestionController@index')->name('commonQuestions.index.admin');
        Route::get('commonQuestion/create', 'CommonQuestionController@create')->name('commonQuestions.create.admin');
        Route::post('commonQuestion/store', 'CommonQuestionController@store')->name('commonQuestions.store.admin');
        Route::get('commonQuestion/edit/{commonQuestion}', 'CommonQuestionController@edit')->name('commonQuestions.edit.admin');
        Route::post('commonQuestion/update/{commonQuestion}', 'CommonQuestionController@update')->name('commonQuestions.update.admin');
        Route::post('commonQuestion/destroy/{commonQuestion}', 'CommonQuestionController@destroy')->name('commonQuestions.destroy.admin');

    });
Route::middleware(['web', ])
    ->namespace('Modules\CommonQuestion\Http\Controllers\User')->group(function() {

        Route::get('common/questions', 'CommonQuestionController@index')->name('commonQuestions.index.user');
        Route::post('search/in-commonQuestions', 'CommonQuestionController@search')->name('commonQuestions.search.user');

    });
