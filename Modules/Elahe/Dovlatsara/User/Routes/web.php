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

/**
 * users routes.
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['web', 'admin.auth'])
    ->namespace('Modules\User\Http\Controllers\Admin')->group(function () {

        Route::get('users-show/{type}', 'UserController@index')->name('users.index.admin');
        Route::get('user-detail/{user}', 'UserController@detail')->name('users.detail.admin');
        Route::get('user-edit/{user}', 'UserController@edit')->name('users.edit.admin');
        Route::post('user-update/{user}', 'UserController@update')->name('users.update.admin');
        Route::post('user-destroy/{user}', 'UserController@destroy')->name('users.destroy.admin');
        Route::get('user/deleteFiles', 'UserController@deleteFiles')->name('users.deleteFiles.admin');
        Route::post('user/shop-disConfirm', 'UserController@shopDisConfirm')->name('users.shops.disconfirm.admin');
        Route::get('user/shop-confirm/{user}', 'UserController@shopConfirm')->name('users.shops.confirm.admin');
        Route::get('user/shops-show/{active}', 'ShopController@index')->name('users.shops.index.admin');
        Route::post('user/shops-show', 'ShopController@index')->name('users.shops.filter.admin');
        Route::get('user/shops-detail/{user}', 'ShopController@detail')->name('users.shops.detail.admin');
        Route::get('user/activation', 'UserController@activeUser')->name('user.activation.admin');
        Route::get('user-create/{type}', 'UserController@create')->name('users.create.admin');
        Route::post('user-store', 'UserController@store')->name('users.store.admin');

    });
Route::prefix('admin')->middleware(['web'])
    ->namespace('Modules\User\Http\Controllers\Admin')->group(function () {

        Route::get('login', 'LoginController@loginForm')->name('admin_login_form');
        Route::post('login', 'LoginController@login')->name('admin_login');
        Route::post('logout', 'LoginController@logout')->name('admin_logout');
    });
Route::prefix('panel')->middleware(['web', 'realestate.auth'])
    ->namespace('Modules\User\Http\Controllers\Realestate')->group(function () {

        Route::get('profile/{user}', 'UserController@profile')->name('user.profile.realestate');
        Route::get('user/edit/{user}', 'UserController@edit')->name('user.edit.realestate');
        Route::post('user/update/{user}', 'UserController@update')->name('user.update.realestate');
        Route::get('user/detail/{user}', 'UserController@detail')->name('users.detail.realestate');

//        Route::post('user-update/{user}', 'UserController@update')->name('users.update.admin');
//        Route::post('user-destroy/{user}', 'UserController@destroy')->name('users.destroy.admin');
        Route::get('user/deleteFiles', 'UserController@deleteFiles')->name('user.deleteFiles.realestate');
        Route::get('user/activation', 'UserController@activeUser')->name('user.activation.realestate');
        Route::get('user/show-agency/{user}', 'ShopController@index')->name('user.shop.index.realestate');
        Route::get('user/agency/{user}', 'ShopController@edit')->name('user.shop.edit.realestate');
        Route::post('user/update-agency/{user}', 'ShopController@update')->name('user.shop.update.realestate');
        Route::get('user/change-password/{user}', 'UserController@changePasswordForm')->name('users.changePasswordForm.realestate');
        Route::post('user/change-password/{user}', 'UserController@changePassword')->name('users.changePassword.realestate');
        Route::get('agents/{user}', 'ShopController@myShopAgents')->name('user.shop.agents.realestate');
        Route::post('user/contractor-skills', 'UserController@contractorSkillStore')->name('users.contractorSkills.store.realestate');
        Route::post('user/contractor-skills/update', 'UserController@contractorSkillUpdate')->name('users.contractorSkills.update.realestate');
        Route::post('user/contractor-skills/destroy/{associationSkill}', 'UserController@contractorSkillDestroy')->name('users.contractorSkills.destroy.realestate');
        Route::get('user/agent/create/{user}', 'ShopController@createAgentForm')->name('user.shop.agentCreate.realestate');
        Route::post('user/agent/store', 'ShopController@storeAgent')->name('user.shop.agentStore.realestate');
        Route::get('user/delete/files', 'ShopController@deleteFiles')->name('user.shop.deleteFiles.realestate');
        Route::get('user/release/{userId}', 'ShopController@releaseAgentFromAgency')->name('user.release.panel');
        Route::get('user/agent/add', 'ShopController@addExistingAgent')->name('user.shop.addExistAgent.panel');
        Route::post('user/find/agent', 'ShopController@findAgent')->name('user.findAgent.panel');
        Route::get('user/agent/choose/{userId}', 'ShopController@chooseExistingAgent')->name('user.shop.chooseExistAgent.panel');
        Route::get('user/agent/quit/{userId}', 'ShopController@quitFromAgency')->name('user.shop.quitFromAgency.panel');
        Route::get('user/agent/complete-info/{userId}', 'ShopController@completeAgentInfos')->name('user.shop.completeInfo.panel');
        Route::post('user/agent/complete-info}', 'ShopController@completeAgentInfoPost')->name('user.shop.complete-info-post.panel');
    });
Route::prefix('panel')->middleware(['web'])
    ->namespace('Modules\User\Http\Controllers\Realestate')->group(function () {
        Route::get('login', 'LoginController@loginForm')->name('realestate_login_form');
        Route::post('login', 'LoginController@login')->name('realestate_login');
        Route::post('logout', 'LoginController@logout')->name('realestate_logout');
        Route::post('login/OTP', 'LoginController@loginOTP')->name('panel_login_OTP');
        Route::post('ll/dd/user/verify', 'LoginController@verify')->name('user.verify.panel');
//        Route::get('user/verify/{user}', 'LoginController@verifyForm')->name('user.verifyForm.panel');

        Route::get('forgot-password-mobile', 'ForgotPasswordController@form')->name('realestate_forgot_password_mobile_form');
        Route::post('forgot-password-mobile', 'ForgotPasswordController@mobile')->name('realestate_forgot_password_mobile');
        Route::post('forgot-password-verify', 'ForgotPasswordController@verify')->name('realestate_forgot_password_verify');
        Route::post('forgot-password-changePassword', 'ForgotPasswordController@changePassword')->name('realestate_forgot_password_changePassword');

    });

Route::middleware(['web'])
    ->namespace('Modules\User\Http\Controllers\User')->group(function () {

        Route::get('agencies/all', 'ShopController@index')->name('realEstate.index.user');
        Route::get('/{slug}', 'ShopController@show')->name('realEstate.show.user');
        Route::post('agencies/ads/filter/{slug}', 'ShopController@show')->name('filter.agency.ads.user');

        Route::post('agencies/all', 'ShopController@index')->name('realEstate.index.filter.user');
        Route::post('agencies-search', 'ShopController@search')->name('realEstate.index.search.user');
        Route::get('contractors/all', 'ContractorController@index')->name('contractors.index.user');
//        Route::get('contractors/{slug}', 'ContractorController@show')->name('contractors.show.user');
        Route::post('contractors/all', 'ContractorController@index')->name('contractors.index.filter.user');
        Route::post('contractors/search', 'ContractorController@search')->name('contractors.index.search.user');
//        Route::post('login', 'LoginController@login')->name('realestate_login');
        Route::get('cats/charts/child', 'ShopController@chartOfCats')->name('realEstate.cats.charts');

    });

Route::middleware(['web'])
    ->namespace('Modules\User\Http\Controllers\Authentication')->group(function () {

        Route::namespace('User')->group(function () {

            Route::get('login&register/user', 'LoginController@loginForm')->name('auth.loginForm.user');
            Route::get('Verify/User/{user}', 'LoginController@verifyForm')->name('auth.verifyForm.user');

            Route::post('Login/User', 'LoginController@login')->name('auth.user.login.user');
            Route::post('Verify/User', 'LoginController@verify')->name('auth.user.verify.user');
            Route::post('Logout/User', 'LoginController@logout')->name('auth.user.logout.user');
            Route::post('Register/User', 'RegisterController@register')->name('auth.user.register.user');
            Route::post('LoginOTP/User', 'LoginController@loginOTP')->name('auth.user.loginOTP.user');

        });
        Route::namespace('realEstateAdmin')->group(function () {

            Route::get('register/business-managers', 'RegisterController@registerForm')->name('auth.realestate.registerForm.user');
//            Route::post('Verify-User', 'LoginController@verify')->name('auth.user.verify.user');
            Route::post('register/business-manager', 'RegisterController@registerAdmin')->name('auth.realestate.registerAdmin.user');
            Route::post('Register/contractor', 'RegisterController@RegisterContractor')->name('auth.realestate.RegisterContractor.user');
            Route::post('Register/agent', 'RegisterController@RegisterAgent')->name('auth.realestate.RegisterAgent.user');

            Route::get('set/verify/code', 'RegisterController@setVerifyCode')->name('auth.realestate.setVerifyCode.user');
            Route::get('validate/slug/business-manager', 'RegisterController@validateSlug')->name('validate.slug.user');
            Route::get('register/business-manager/neighborhood-old', 'RegisterController@neighborhoodOld')->name('registerBusiness.neighborhoodOld.user');
//            Route::get('register/business-manager/subcategory-old', 'RegisterController@subCategoryOld')->name('registerBusiness.subCategoryOld.user');

        });


    });
