<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['web'])
    ->namespace('Modules\General\Http\Controllers')->group(function() {

        Route::get('/', 'HomePageController@homePage2')->name('homePage.user');
        Route::post('/', 'HomePageController@homePage2')->name('post.homePage.user');
//        Route::get('supplier/filter', 'SupplierFilterPageController@index')->name('supplierFilterPage.user');
        Route::get('search/in/ads', 'HomePageController@searchAdsSupplier')->name('searchSupplierAds.user');
//        Route::post('supplier/ads/filter', 'SupplierFilterPageController@index')->name('filter.supplierFilterPage.user');
//        Route::get('supplier/filter2', 'SupplierFilterPageController@adTypeFilter')
//            ->name('filter.adTypeFilter.user');


        Route::get('users/ads-filter-page', 'FilterPageController@index')->name('supplierFilterPage.user');
        Route::post('users/ads-filter-page', 'FilterPageController@index')->name('filter.supplierFilterPage.user');
        Route::get('s/ads-filter2-page', 'FilterPageController@adTypeFilter')
            ->name('filter.adTypeFilter.user');

    });
