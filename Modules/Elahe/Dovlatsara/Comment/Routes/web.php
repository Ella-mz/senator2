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

Route::prefix('general')->namespace('Modules\Comment\Http\Controllers\General')->middleware(['web','user.auth'])->group(function() {
    Route::post('/add-comment', 'CommentController@add')->name('general-add-comment');
    Route::post('/ajax-add-comment', 'CommentController@add_ajax')->name('general-ajax-add-comment');
    Route::get('/like-comment/{comment_id}', 'CommentController@like')->name('general-like-comment');
    Route::get('/dislike-comment/{comment_id}', 'CommentController@dislike')->name('general-dislike-comment');
});

Route::prefix('admin')->namespace('Modules\Comment\Http\Controllers\Admin')->middleware(['web','admin.auth'])->group(function() {
    Route::get('/admin-comments-index', 'CommentController@index')->name('admin-comments-index');
    Route::get('/comment-show/{comment_id}', 'CommentController@show')->name('admin-comments-show');
    Route::get('/comment-change-status/{comment}/{status}', 'CommentController@change_status')->name('admin-comment-change-status');

});
