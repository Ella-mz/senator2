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
    ->namespace('Modules\AssociationSkill\Http\Controllers\Admin')->group(function() {

        Route::get('association-skills/create/{association}', 'AssociationSkillController@create')->name('associationSkills.create.admin');
        Route::get('association-skills/index/{association}', 'AssociationSkillController@index')->name('associationSkills.index.admin');
        Route::post('association-skills/store', 'AssociationSkillController@store')->name('associationSkills.store.admin');
        Route::get('association-skills/edit/{associationSkill}', 'AssociationSkillController@edit')->name('associationSkills.edit.admin');
        Route::post('association-skills/update/{associationSkill}', 'AssociationSkillController@update')->name('associationSkills.update.admin');
        Route::post('association-skills/destroy/{associationSkill}', 'AssociationSkillController@destroy')->name('associationSkills.destroy.admin');
        Route::get('association-skills/deleteFile', 'AssociationSkillController@deleteFile')->name('associationSkills.deleteFile');

    });
