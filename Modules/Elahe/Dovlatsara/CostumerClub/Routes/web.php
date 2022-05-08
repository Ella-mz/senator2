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
    ->namespace('Modules\CostumerClub\Http\Controllers\Score\Admin')->group(function() {

        Route::get('scores', 'ScoreController@index')->name('scores.index.admin');
        Route::get('/edit/{score_id}', 'ScoreController@edit')->name('score.edit.admin');
        Route::patch('/update', 'ScoreController@update')->name('score.update.admin');
        Route::get('/change_score_status', 'ScoreController@change_score_status')->name('change_score_status');
        Route::resource('/user', 'UserController');

        Route::get('/ajax/object/user', 'UserController@get_user_object')->name('get-user-object');
    });

Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\CostumerClub\Http\Controllers\Score\Panel')->group(function() {

        Route::get('scores-2-wallet', 'ScoreController@score2wallet')->name('scores.score2wallet.panel');
        Route::get('/convert-score/store', 'ScoreController@conversion_score_to_wallet_store')->name('scores.conversion-score-to-wallet.panel');

    });

Route::middleware(['web'])
    ->namespace('Modules\CostumerClub\Http\Controllers\Invite')->group(function() {

        Route::get('invite/check-code', 'InviteController@validateInvitedCode')->name('invite.checkInvitedCode');

    });

Route::middleware(['web'])
    ->namespace('Modules\CostumerClub\Http\Controllers\Wallet')->group(function() {

        Route::get('wallet/gateway-computation', 'WalletController@walletComputation')->name('wallet.computation');

    });
