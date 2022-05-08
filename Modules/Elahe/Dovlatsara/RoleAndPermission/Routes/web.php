<?php

///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//use Illuminate\Support\Facades\Route;
//
///**
// * roles and permissions routes.
// */
//Route::group(['namespace' => 'Modules\RoleAndPermission\Http\Controllers\Admin',
//    'middleware' => [
//        'web',
//        'admin.auth'
////        'auth',
////        'accesslevel'
////        'verified'
//    ]
//], function ($router) {
//    $router->resource('role', 'RoleController');
//    $router->post('access-level/fetchpermission','RoleController@fetchPermission')->name('access.level.fetchpermission');
//    $router->post('access-level/assignpermission','RoleController@assignPermission')->name('access.level.assignpermission');
//});
