<?php
use Illuminate\Support\Facades\Route;
/**
 * attributes routes.
 */

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\Category\Http\Controllers\Admin')->group(function() {

    Route::get('add-category/{parentId}', 'CategoryController@addCat')->name('category.add.admin');
    Route::get('show-cats/{parentId}', 'CategoryController@showCats')->name('category.index.admin');
    Route::post('store-cat', 'CategoryController@storeCat')->name('category.store.admin');
    Route::get('edit-cat/{category}', 'CategoryController@editCat')->name('category.edit.admin');
    Route::post('update-cat/{category}', 'CategoryController@updateCat')->name('category.update.admin');
    Route::post('destroy-caty/{category}', 'CategoryController@destroyCat')->name('category.destroy.admin');
    Route::get('category/deleteFile', 'CategoryController@deleteFile')->name('categories.deleteFile');
        Route::get('category/change-order', 'CategoryController@changeCatOrder')->name('categories.changeOrder.admin');
        Route::get('category/change-activation/{category}', 'CategoryController@changeActivation')->name('categories.changeActivation.admin');

});
//Route::group(['namespace' => 'Module\Category\Http\Controllers\admin',
//    'prefix' = '',
//    'middleware' => ['web']
//], function ($router) {
//
//    $router->get('add-category/{parentId}', 'CategoryController@addCat')->name('category.add.admin');
//    $router->get('show-cats/{parentId}', 'CategoryController@showCats')->name('category.index.admin');
//    $router->post('store-cat', 'CategoryController@storeCat')->name('category.store.admin');
//    $router->get('edit-cat/{category}', 'CategoryController@editCat')->name('category.edit.admin');
//    $router->post('update-cat/{category}', 'CategoryController@updateCat')->name('category.update.admin');
//    $router->post('destroy-cat/{category}', 'CategoryController@destroyCat')->name('category.destroy.admin');
//    $router->get('category/deleteFile','CategoryController@deleteFile')->name('categories.deleteFile');
//
//});
Route::middleware(['web'])
    ->namespace('Modules\Category\Http\Controllers\User')->group(function() {

        Route::get('/getting/category', 'CategoryController@getChildCategory')->name('categories.child.user');

    });
Route::middleware(['web'])
    ->namespace('Modules\Category\Http\Controllers')->group(function() {

        Route::get('find-cats/{type}/{panel}', 'CategoryController@selectCategory')->name('categories.find.cats');
        Route::get('prev-cats/{type}/{panel}', 'CategoryController@prevCats')->name('categories.prev.cats');

    });
