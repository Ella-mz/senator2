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
    ->namespace('Modules\Article\Http\Controllers\Admin')->group(function () {

        Route::get('article-groups', 'ArticleGroupController@index')->name('article-groups.index.admin');
        Route::get('article-groups/create', 'ArticleGroupController@create')->name('article-groups.create.admin');
        Route::post('article-groups/store', 'ArticleGroupController@store')->name('article-groups.store.admin');
        Route::get('article-groups/edit/{articleGroupId}', 'ArticleGroupController@edit')->name('article-groups.edit.admin');
        Route::post('article-groups/update/{articleGroupId}', 'ArticleGroupController@update')->name('article-groups.update.admin');
        Route::post('article-groups/destroy/{articleGroupId}', 'ArticleGroupController@destroy')->name('article-groups.destroy.admin');

        Route::get('articles/{slug}', 'ArticleController@index')->name('articles.index.admin');
        Route::get('articles/create/{slug}', 'ArticleController@create')->name('articles.create.admin');
        Route::post('articles/store', 'ArticleController@store')->name('articles.store.admin');
        Route::get('articles/edit/{articleId}', 'ArticleController@edit')->name('articles.edit.admin');
        Route::post('articles/update/{articleId}', 'ArticleController@update')->name('articles.update.admin');
        Route::post('articles/destroy/{articleId}', 'ArticleController@destroy')->name('articles.destroy.admin');
        Route::get('articles', 'ArticleController@all')->name('articles.all.admin');
        Route::post('articles', 'ArticleController@all')->name('articles.filter.admin');
        Route::get('article/activation', 'ArticleController@activeArticle')->name('article.activation.admin');

    });

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Article\Http\Controllers\Panel')->group(function () {

//        Route::get('article-groups', 'ArticleGroupController@index')->name('article-groups.index.admin');
//        Route::get('article-groups/create', 'ArticleGroupController@create')->name('article-groups.create.admin');
//        Route::post('article-groups/store', 'ArticleGroupController@store')->name('article-groups.store.admin');
//        Route::get('article-groups/edit/{articleGroupId}', 'ArticleGroupController@edit')->name('article-groups.edit.admin');
//        Route::post('article-groups/update/{articleGroupId}', 'ArticleGroupController@update')->name('article-groups.update.admin');
//        Route::post('article-groups/destroy/{articleGroupId}', 'ArticleGroupController@destroy')->name('article-groups.destroy.admin');

        Route::get('articles', 'ArticleController@index')->name('articles.index.panel');
        Route::get('article/create', 'ArticleController@create')->name('articles.create.panel');
        Route::post('article/store', 'ArticleController@store')->name('articles.store.panel');
        Route::get('article/edit/{articleId}', 'ArticleController@edit')->name('articles.edit.panel');
        Route::post('article/update/{articleId}', 'ArticleController@update')->name('articles.update.panel');
        Route::post('article/destroy/{articleId}', 'ArticleController@destroy')->name('articles.destroy.panel');

    });

Route::middleware(['web'])->namespace('Modules\Article\Http\Controllers\User')->group(function () {

    Route::get('Mag/list', 'ArticleController@index')->name('articles.index.user');
    Route::post('Mag/list', 'ArticleController@index')->name('articles.filter.user');
    Route::get('Mag/{slug}', 'ArticleController@show')->name('articles.show.user');

});
