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

/**
 * roles and permissions routes.
 */
Route::group(['namespace' => 'Modules\RoleAndPermissionNew\Http\Controllers\Admin',
    'middleware' => [
        'web',
        'admin.auth'
//        'auth',
//        'accesslevel'
//        'verified'
    ],
    'prefix'=>'admin'
], function ($router) {
//    $router->resource('role', 'RoleController');
    $router->get('roles-index', 'RoleController@index')->name('roles.index');
    $router->get('roles-create', 'RoleController@create')->name('roles.create');
    $router->get('roles-edit/{id}', 'RoleController@edit')->name('roles.edit');
    $router->post('roles-destroy/{id}', 'RoleController@destroy')->name('roles.destroy');
    $router->post('roles-store', 'RoleController@store')->name('roles.store');
    $router->post('roles-update/{id}', 'RoleController@update')->name('roles.update');

    $router->post('access-level/fetchpermission','RoleController@fetchPermission')->name('access.level.fetchpermission');
    $router->post('access-level/assignpermission','RoleController@assignPermission')->name('access.level.assignpermission');
});
