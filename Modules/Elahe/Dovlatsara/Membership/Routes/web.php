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
 * Membership routes.
 */

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\Membership\Http\Controllers\Admin')->group(function() {

        Route::resource('memberships', 'MembershipController');
        Route::get('membership/get_description', 'MembershipController@getDescription')->name('getDescription.admin');

    });
Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Membership\Http\Controllers\Realestate')->group(function() {

        Route::get('memberships', 'MembershipController@index')->name('membership.index.realestate');
        Route::get('show/{user}', 'MembershipController@show')->name('membership.show.realestate');
        Route::get('buy-membership/{membership}', 'MembershipController@buyMembership')->name('membership.buy.realestate');
        Route::get('buy-applicant-membership/{applicantMembership}', 'MembershipController@buyApplicantMembership')->name('applicantMembership.buy.realestate');
        Route::post('pay-membership', 'MembershipController@pay')->name('membership.pay.realestate');
        Route::get('/memberships/gateway/start-error', 'MembershipController@startError')->name('membership.gateway_start_error.panel');
        Route::get('/memberships/gateway/callback-error', 'MembershipController@callbackError')->name('membership.gateway_callback_error.panel');

//        Route::post('pay-membership/callback', 'MembershipController@callback')->name('membership.pay.callback.realestate');

//        Route::get('user1/edit/{user}', 'UserController@edit')->name('user.edit.realestate');
//        Route::post('user/update/{user}', 'UserController@update')->name('user.update.realestate');

    });

Route::middleware(['web'])
    ->namespace('Modules\Membership\Http\Controllers\User')->group(function () {

        Route::get('membership/all', 'MembershipController@index')->name('membership.index.user');
        Route::get('buy-membership/{membership}', 'MembershipController@buyMembership')
            ->name('membership.buy.user')->middleware('user.auth');
        Route::post('pay-membership', 'MembershipController@pay')
            ->name('membership.pay.user')->middleware('user.auth');
        Route::get('/memberships/gateway/start-error', 'MembershipController@startError')
            ->name('membership.gateway_start_error.user')->middleware('user.auth');
        Route::get('/memberships/gateway/callback-error', 'MembershipController@callbackError')
            ->name('membership.gateway_callback_error.user')->middleware('user.auth');
        Route::post('membership/pay', 'MembershipController@pay')->name('membership.pay.user');

    });
