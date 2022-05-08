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

Route::prefix('real-estate-master')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\RealestateMaster\Http\Controllers')->group(function() {
//    Route::get('/realestateMaster', function (){
//     dd('sd');
//    });
    Route::get('/realestate/master', 'RealestateMasterController@index')
        ->name('realestateMaster');


    });
