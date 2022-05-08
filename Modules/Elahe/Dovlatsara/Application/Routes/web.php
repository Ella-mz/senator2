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
    ->namespace('Modules\Application\Http\Controllers\Admin')->group(function () {
        Route::get('applications/create/{category}', 'ApplicationController@create')->name('application.create.admin');
        Route::post('applications/create/{category}', 'ApplicationController@store')->name('application.store.admin');
        Route::get('applications/find-cats/{type}', 'ApplicationController@selectCategory')->name('application.find.cats.admin');
        Route::get('applications/prev-cats/{type}', 'ApplicationController@prevCats')->name('application.prev.cats.admin');

        Route::get('applications', 'ApplicationController@index')->name('application.index.admin');
        Route::post('applications', 'ApplicationController@index')->name('application.filer.admin');
        Route::get('applications/{application}', 'ApplicationController@show')->name('application.show.admin');
        Route::post('applications/destroy/{application}', 'ApplicationController@destroy')->name('application.destroy.admin');
        Route::get('applications/approve/{application}', 'ApplicationController@approve')->name('application.approve.admin');
        Route::post('applications/disConfirm', 'ApplicationController@disConfirm')->name('application.disConfirm.admin');
    });

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Application\Http\Controllers\Realestate')->group(function () {

        Route::get('applications', 'ApplicationController@index')->name('applications.index.realestate');
        Route::post('applications', 'ApplicationController@index')->name('applications.filter.realestate');
        Route::get('/application/recentSeen', 'ApplicationController@recentSeen')->name('applications.recentSeen.realestate');
        Route::get('/application/contact-data', 'ApplicationController@contact')->name('applications.contact.realestate');
        Route::get('application/show/posted-to-your-agency/{agencyId}', 'ApplicationController@postedSpecificAgency')->name('applications.index.postedToSpecificAgency.panel');
        Route::post('application/show/posted-to-your-agency/{agencyId}', 'ApplicationController@postedSpecificAgency')->name('applications.filter.postedToSpecificAgency.panel');

    });

Route::middleware(['web', 'user.auth'])
    ->namespace('Modules\Application\Http\Controllers\User')->group(function () {
        Route::get('applications/my-posts', 'ApplicationController@index')->name('application.index.user');
        Route::post('applications/destroy/{application}', 'ApplicationController@destroy')->name('application.destroy.user');
    });

Route::middleware(['web'])
    ->namespace('Modules\Application\Http\Controllers\User')->group(function () {
        Route::get('applications/create/{category}', 'ApplicationController@create')->name('application.create.user');
        Route::post('applications/create/{category}', 'ApplicationController@store')->name('application.store.user');
        Route::get('applications/find-cats/{type}', 'ApplicationController@selectCategory')->name('application.find.cats.user');
        Route::get('applications/prev-cats/{type}', 'ApplicationController@prevCats')->name('application.prev.cats.user');
        Route::get('applications/find-cats-level2/{type}', 'ApplicationController@selectCategoryLevel2')->name('application.find.cats.level2.user');
        Route::get('applications/prev-cats-level2/{type}', 'ApplicationController@prevCatsLevel2')->name('application.prev.cats.level2.user');
        Route::get('application/all', 'ApplicationController@listOfApplication')->name('application.list.user');
        Route::post('applications/all', 'ApplicationController@listOfApplication')->name('applications.filter.user');
        Route::get('/application/contact-data', 'ApplicationController@contact')->name('applications.contact.user');
        Route::get('/application/recentSeen', 'ApplicationController@recentSeen')->name('applications.recentSeen.user');
    });
