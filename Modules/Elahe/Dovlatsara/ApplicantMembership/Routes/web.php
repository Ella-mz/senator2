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
 * Applicant Membership routes.
 */

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\ApplicantMembership\Http\Controllers\Admin')->group(function() {

        Route::resource('applicant-memberships', 'ApplicantMembershipController');

    });

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\ApplicantMembership\Http\Controllers\Realestate')->group(function() {

        Route::get('buy-applicant-membership/{applicantMembership}', 'ApplicantMembershipController@buyApplicantMembership')->name('applicantMembership.buy.realestate');
        Route::post('pay/applicant-membership', 'ApplicantMembershipController@pay')->name('applicantMembership.pay.realestate');
        Route::get('/applicant-memberships/gateway/start-error', 'ApplicantMembershipController@startError')->name('applicantMembership.gateway_start_error.panel');
        Route::get('/applicant-memberships/gateway/callback-error', 'ApplicantMembershipController@callbackError')->name('applicantMembership.gateway_callback_error.panel');

    });
