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
    ->namespace('Modules\EnumType\Http\Controllers\Admin')->group(function() {

        Route::get('about-us', 'AboutUsController@create')->name('aboutUs.create.admin');
        Route::post('about-us', 'AboutUsController@store')->name('aboutUs.store.admin');

        Route::get('rules-and-terms', 'RulesAndTermsController@create')->name('rulesAndTerms.create.admin');
        Route::post('rules-and-terms', 'RulesAndTermsController@store')->name('rulesAndTerms.store.admin');

        Route::get('contact-us', 'ContactUsController@create')->name('contactUs.index.admin');
        Route::get('contact-us/create', 'ContactUsController@create')->name('newName');
        Route::post('contact-us', 'ContactUsController@store')->name('contactUs.store.admin');

        Route::get('app', 'AppController@create')->name('app.create.admin');
        Route::post('app', 'AppController@store')->name('app.store.admin');
        Route::get('app-of-website/download/{enumType}', 'AppController@download')->name('app.download.admin');

        Route::get('widgets', 'WidgetController@index')->name('widget.index.admin');
        Route::get('widget-create', 'WidgetController@create')->name('widget.create.admin');
        Route::post('widget-store', 'WidgetController@store')->name('widget.store.admin');
        Route::post('widget-destroy/{widget}', 'WidgetController@destroy')->name('widget.destroy.admin');

        Route::get('header-icons', 'HeaderIconController@index')->name('header_icon.index.admin');
        Route::get('header-icon-create', 'HeaderIconController@create')->name('header_icon.create.admin');
        Route::post('header-icon-store', 'HeaderIconController@store')->name('header_icon.store.admin');
        Route::post('header-icon-destroy/{header_icon}', 'HeaderIconController@destroy')->name('header_icon.destroy.admin');


        Route::get('membership-reduction-score', 'MembershipReductionScoreController@index')->name('membership_reduction_score.index.admin');
        Route::get('membership-reduction-score-edit/{enumType}', 'MembershipReductionScoreController@edit')->name('membership_reduction_score.edit.admin');
        Route::post('membership-reduction-score-update/{enumType}', 'MembershipReductionScoreController@update')->name('membership_reduction_score.update.admin');

    });

Route::middleware(['web'])
    ->namespace('Modules\EnumType\Http\Controllers\User')->group(function() {

        Route::get('docs/about-us', 'AboutUsController@index')->name('aboutUs.index.user');
        Route::get('docs/rules-and-terms', 'RulesAndTermsController@index')->name('rulesAndTerms.index.user');
        Route::get('app-of-website/download/{enumType}', 'AppController@download')->name('app.download.user');
    });
