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
    ->namespace('Modules\Association\Http\Controllers\Admin')->group(function() {

        Route::get('add-association/{parentId}', 'AssociationController@addAssociation')->name('associations.add.admin');
        Route::get('show-associations/{parentId}', 'AssociationController@showAssociations')->name('associations.index.admin');
        Route::post('store-association', 'AssociationController@storeAssociation')->name('associations.store.admin');
        Route::get('edit-association/{association}', 'AssociationController@ediAssociation')->name('associations.edit.admin');
        Route::post('update-association/{association}', 'AssociationController@updateAssociation')->name('associations.update.admin');
        Route::post('destroy-association/{association}', 'AssociationController@destroyAssociation')->name('associations.destroy.admin');
        Route::get('association/deleteFile', 'AssociationController@deleteFile')->name('associations.deleteFile');
//        Route::get('/gettingAssociation', 'AssociationController@gettingAssociation')->name('gettingAssociation');

    });
Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\Association\Http\Controllers\Realestate')->group(function() {

        Route::get('/getting/association', 'AssociationController@gettingAssociation')->name('gettingAssociation.panel');

    });


Route::middleware(['web'])
    ->namespace('Modules\Association\Http\Controllers\User')->group(function() {

        Route::get('/gettingAssociation', 'AssociationController@gettingAssociation')->name('gettingAssociation');
        Route::get('/gettingSkills', 'AssociationController@gettingSkills')->name('gettingSkills');

    });
