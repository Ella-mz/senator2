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

Route::middleware(['web'])
    ->namespace('Modules\Ad\Http\Controllers\User')->group(function () {
        Route::namespace('Ad')->group(function () {
            Route::get('/create-supplier/{category}', 'CreateController@index')->name('ad.crate.supplier.user');
            Route::post('/create-supplier/{category}', 'CreateController@store')->name('ad.store.supplier.user');
            Route::get('ad/{ad}', 'ShowController@show')->name('ad.show.supplier.user');
            Route::get('user/my-posts', 'ShowController@myAds')->name('ad.myPosts.supplier.user')->middleware('user.auth');
            Route::get('delete/ad/{ad}', 'DeleteController@delete')->name('ad.delete.supplier.user')->middleware('user.auth');
            Route::get('find/cats/{type}', 'CreateController@selectCategory')->name('ad.find.cats.user');
            Route::get('find/cats-level2/{type}', 'CreateController@selectCategoryLevel2')->name('ad.find.cats.level2.user');
            Route::get('prev/cats-level2/{type}', 'CreateController@prevCatsLevel2')->name('ad.prev.cats.level2.user');

            Route::get('prev/cats/{type}', 'CreateController@prevCats')->name('ad.prev.cats.user');
            Route::get('user/bookmarks', 'ShowController@bookmark')->name('ad.bookmarks.supplier.user')->middleware('user.auth');
            Route::get('user/active/{ad}', 'DeleteController@active')->name('ad.active.user')->middleware('user.auth');
            Route::get('user/inactive/{ad}', 'DeleteController@inactive')->name('ad.inactive.user')->middleware('user.auth');
            Route::get('user/recent-seen', 'ShowController@recentseens')->name('ad.recentseens.supplier.user')->middleware('user.auth');
            Route::get('user/sendLatlngToApi', 'CreateController@sendLatlngToApi')->name('sendLatlngToApi');
            Route::get('user/ad/create/neighborhood-old', 'CreateController@neighborhoodOld')->name('neighborhoodOld.user');
            Route::get('ad/edit/{adId}', 'EditController@index')->name('ad.edit.supplier.user')->middleware('user.auth');
            Route::post('ad/update/{adId}', 'EditController@update')->name('ad.update.supplier.user')->middleware('user.auth');
            Route::get('ad/delete/image', 'DeleteController@deleteAdImage')->name('ad.deleteImage.user')->middleware('user.auth');
            Route::get('ad/delete/video', 'DeleteController@deleteAdVideo')->name('ad.deleteVideo.user')->middleware('user.auth');
            Route::get('ads/{userId}', 'ShowController@userAds')->name('ad.userAds.user');
            Route::get('download/catalog/{catalog}', 'ShowController@downloadCatalog')->name('catalog.download.user');

        });
    });
Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\Ad\Http\Controllers\Admin')->group(function () {
        Route::namespace('Ad')->group(function () {
            Route::get('/create-supplier/{category}', 'CreateController@index')->name('ad.create.supplier.admin');
            Route::post('/create-supplier/{category}', 'CreateController@store')->name('ad.store.supplier.admin');
            Route::get('find-cats/{type}', 'CreateController@selectCategory')->name('ad.find.cats.admin');
            Route::get('prev-cats/{type}', 'CreateController@prevCats')->name('ad.prev.cats.admin');

            Route::get('ads/{active}', 'ShowController@index')->name('ad.index.supplier.admin');
            Route::post('ads/{active}', 'ShowController@index')->name('ad.filter.supplier.admin');

//            Route::get('ads-approved', 'ShowController@indexActive')->name('ad.indexActive.supplier.admin');
//            Route::get('ads-not-approved', 'ShowController@indexNotApproved')->name('ad.indexNotApproved.supplier.admin');
//            Route::get('ads-deleted-by-user', 'ShowController@indexDeleted')->name('ad.indexDeleted.supplier.admin');
            Route::get('ad/{ad}', 'ShowController@show')->name('ad.show.supplier.admin');
            Route::post('ad/destroy/{ad}', 'DeleteController@destroy')->name('ad.destroy.supplier.admin');
            Route::get('ads/approve/{ad}', 'ShowController@approve')->name('ad.approve.admin');
            Route::post('ad/disapprove', 'ShowController@disconfirm')->name('ad.disapprove.admin');
//            Route::get('change-ad-user-status123', 'DeleteController@changeAdUserStatus')->name('changeAdUserStatus.realestate1234');
            Route::get('ad/edit/{adId}', 'EditController@index')->name('ad.edit.supplier.admin');
            Route::post('ad/update/{adId}', 'EditController@update')->name('ad.update.supplier.admin');
            Route::get('ad/delete/image', 'DeleteController@deleteAdImage')->name('ad.deleteImage.admin');
            Route::get('ad/delete/video', 'DeleteController@deleteAdVideo')->name('ad.deleteVideo.admin');
            Route::get('download/catalog/{catalog}', 'ShowController@downloadCatalog')->name('catalog.download.admin');

//            Route::post('/create-supplier/{category}', 'CreateController@store')->name('ad.store.supplier.user');

        });
    });

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Ad\Http\Controllers\Realestate')->group(function () {
        Route::namespace('Ad')->group(function () {
            Route::get('ads/{user}/{type}', 'ShowController@index')->name('ad.index.supplier.realestate');
            Route::get('ad/{ad}', 'ShowController@show')->name('ad.show.supplier.realestate');
            Route::post('ad/destroy/{ad}', 'DeleteController@destroy')->name('ad.destroy.supplier.realestate');
            Route::get('/create-supplier/{category}', 'CreateController@index')->name('ad.create.supplier.realestate');
            Route::post('/create-supplier/{category}', 'CreateController@store')->name('ad.store.supplier.realestate');
            Route::get('find-cats/{type}', 'CreateController@selectCategory')->name('ad.find.cats.realestate');
            Route::get('prev-cats/{type}', 'CreateController@prevCats')->name('ad.prev.cats.realestate');
            Route::get('bookmarks', 'ShowController@bookmarks')->name('ad.bookmarks.supplier.realestate');
            Route::get('recentseens', 'ShowController@recentseens')->name('ad.recentseens.supplier.realestate');
            Route::get('ad/edit/{adId}', 'EditController@index')->name('ad.edit.supplier.panel');
            Route::post('ad/update/{adId}', 'EditController@update')->name('ad.update.supplier.panel');
            Route::get('ads/delete/image', 'DeleteController@deleteAdImage')->name('ad.deleteImage.panel');
            Route::get('ads/delete/video', 'DeleteController@deleteAdVideo')->name('ad.deleteVideo.panel');
            Route::get('ad/change/user-status', 'DeleteController@changeAdUserStatus')->name('changeAdUserStatus.realestate');
            Route::get('ads/show/posted-to-your-agency/{agencyId}', 'ShowController@postedSpecificAgency')->name('ad.index.postedToSpecificAgency.panel');
            Route::get('ads/show/posted-to-agencies', 'ShowController@postedAgencies')->name('ad.index.postedAgencies.panel');
            Route::get('ads/designate/ad-request-to-agency/{adId}/{status}', 'EditController@designateOfRequestToAgencies')->name('ad.designateOfRequestToAgencies.panel');
            Route::get('ads/choose/ad-request-to-agencies/{adId}', 'EditController@chooseReceivedAd')->name('ad.chooseReceivedAd.panel');
            Route::get('download/catalog/{catalog}', 'ShowController@downloadCatalog')->name('catalog.download.panel');
            Route::get('ad/transfer-ad/{adId}/{destination}', 'EditController@transferAd')->name('ad.transfer.panel');
        });

    });
