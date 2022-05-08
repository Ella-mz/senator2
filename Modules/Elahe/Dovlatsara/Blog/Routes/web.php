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

Route::prefix('admin')->namespace('Modules\Blog\Http\Controllers\Admin')->middleware(['web','admin.auth'])->group(function() {
//    Route::resource('/position', 'PositionController');
    Route::get('/position', 'PositionController@index')->name('position.index.admin');
    Route::get('/position/edit/{position}', 'PositionController@edit')->name('position.edit.admin');
    Route::post('/position/update/{position}', 'PositionController@update')->name('position.update.admin');
    Route::get('/position-article/{position}', 'PositionController@articles')->name('admin-position-article');
    Route::post('/position-attach-article/{position}', 'PositionController@attach_article')->name('admin-position-attach-article');
    Route::get('/position-attach-article/{position}', 'PositionController@article_list')->name('admin-position-article-list');
    Route::post('/admin-attach-article-position/{position}', 'PositionController@attach_article')->name('admin-attach-article-position');
    Route::get('admin-detach-position-article/{position}/{article}', 'PositionController@detach_article')->name('admin-detach-position-article');
    Route::get('change-order-position-article', 'PositionController@change_order')->name('change-order-position-article');
});

Route::namespace('Modules\Blog\Http\Controllers\General')->middleware('web')->group(function() {
    Route::get('magazine/blog', 'BlogController@index')->name('general-blog');
    Route::get('blog/article/{article_id}', 'BlogController@single')->name('general-blog-single_article');

});
