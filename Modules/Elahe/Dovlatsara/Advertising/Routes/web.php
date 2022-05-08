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
    ->namespace('Modules\Advertising\Http\Controllers\Admin')->group(function() {

        Route::get('advertisings', 'AdvertisingController@index')->name('advertisings.index.admin');
        Route::get('advertising/create', 'AdvertisingController@create')->name('advertisings.create.admin');
        Route::post('advertising/store', 'AdvertisingController@store')->name('advertisings.store.admin')->middleware('AdvertisingDuplicateCheck');
        Route::get('advertising/edit/{advertising}', 'AdvertisingController@edit')->name('advertisings.edit.admin');
        Route::post('advertising/update/{advertising}', 'AdvertisingController@update')->name('advertisings.update.admin');
        Route::get('advertising-applicants', 'AdvertisingApplicationController@index')->name('advertisingApplicants.index.admin');
        Route::get('advertising-applicants/{applicant}', 'AdvertisingApplicationController@show')->name('advertisingApplicants.show.admin');
        Route::get('advertising-applicants-download-file/{applicant}/{type}', 'AdvertisingApplicationController@download')->name('advertisingApplicants.download.admin');
        Route::post('advertising/active/{advertising}', 'AdvertisingController@active')->name('advertisings.active.admin');
        Route::post('advertising/inactive/{advertising}', 'AdvertisingController@inactive')->name('advertisings.inactive.admin');
        Route::get('advertisement-apply/{advertising}', 'AdvertisingController@apply')->name('advertisings.apply.admin');
        Route::get('getDates', 'AdvertisingController@getDates')->name('getDates.index.admin');
        Route::post('advertisement-apply', 'AdvertisingController@applySubmit')->name('advertisings.apply.submit.admin');
        Route::post('advertising-applicant/destroy/{applicant}', 'AdvertisingApplicationController@destroy')->name('advertisingApplicants.destroy.admin');
        Route::get('advertising-applicant/activation', 'AdvertisingApplicationController@activeApplicant')->name('advertisingApplicants.activation.admin');
        Route::get('getDates-user', 'AdvertisingController@getDatesForUser')->name('getDates.user.index.admin');

    });

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Advertising\Http\Controllers\Realestate')->group(function() {

        Route::get('advertisement', 'AdvertisingController@index')->name('advertisings.index.realestate');
        Route::get('getImage', 'AdvertisingController@getImage')->name('getImage.index.realestate');

        Route::get('advertisement-apply/{advertising}', 'AdvertisingController@apply')->name('advertisings.apply.realestate');
        Route::post('advertisement-apply', 'AdvertisingController@applySubmit')->name('advertisings.apply.submit.realestate');
        Route::get('getDates', 'AdvertisingController@getDates')->name('getDates.index.realestate');
        Route::get('advertising-applicants', 'AdvertisingApplicationController@index')->name('advertisingApplicants.index.realestate');
        Route::get('advertising-applicants/{applicant}', 'AdvertisingApplicationController@show')->name('advertisingApplicants.show.realestate');
        Route::get('advertising-applicants-download-file/{applicant}/{type}', 'AdvertisingApplicationController@download')->name('advertisingApplicants.download.realestate');
        Route::post('pay-advertisement', 'AdvertisingController@pay')->name('advertisement.pay.realestate');
        Route::get('/advertisement/gateway/start-error', 'AdvertisingController@startError')->name('advertisings.gateway_start_error.panel');
        Route::get('/advertisement/gateway/callback-error', 'AdvertisingController@callbackError')->name('advertisings.gateway_callback_error.panel');
        Route::get('getDates/user', 'AdvertisingController@getDatesForUser')->name('getDates.user.index.realestate');
    });

Route::middleware(['web'])
    ->namespace('Modules\Advertising\Http\Controllers\User')->group(function () {

        Route::get('advertisement/all', 'AdvertisingController@index')->name('advertisings.index.user');
        Route::get('get/image', 'AdvertisingController@getImage')->name('getImage.index.user');
        Route::get('advertisement/apply/{advertising}', 'AdvertisingController@apply')->name('advertisings.apply.user')->middleware('user.auth');
        Route::post('advertisement/apply', 'AdvertisingController@applySubmit')->name('advertisings.apply.submit.user')->middleware('user.auth');
        Route::get('get/dates', 'AdvertisingController@getDates')->name('getDates.index.user');
        Route::get('set/formatDate', 'AdvertisingController@setFormatDate')->name('setFormatDate.index.user');
        Route::post('advertisement/pay', 'AdvertisingController@pay')->name('advertisement.pay.user')->middleware('user.auth');
        Route::get('get/dates/users', 'AdvertisingController@getDatesForUser')->name('getDates.user.index.user');

    });
