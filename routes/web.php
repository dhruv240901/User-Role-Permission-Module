<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ModuleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::controller(AuthController::class)->group(function () {
    Route::get('signup', 'signup')->name('signup');
    Route::post('signup', 'customSignup')->name('custom-signup');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'customLogin')->name('custom-login');
    Route::middleware('auth')->group(function () {
        Route::get('logout', 'logout')->name('logout');
        Route::get('changePassword', 'viewChangePassword')->name('view-change-password');
        Route::post('changePassword', 'changePassword')->name('change-password');
    });
    Route::get('forgetPassword', 'viewForgetPassword')->name('view-forget-password');
    Route::post('forgetPassword', 'forgetPassword')->name('forget-password');
    Route::get('resetPassword/{token}', 'viewResetPassword')->name('view-reset-password');
    Route::post('resetPassword/{token}', 'resetPassword')->name('reset-password');
});

Route::middleware(['auth', 'firstlogin'])->group(function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('list', 'index')->name('user-list')->middleware('user_access:User,any');
        Route::get('show/{id}', 'show')->name('show-user')->middleware('user_access:User,view');
        Route::get('create', 'create')->name('add-user')->middleware('user_access:User,add');
        Route::post('store', 'store')->name('store-user')->middleware('user_access:User,add');
        Route::get('edit/{id}', 'edit')->name('edit-user')->middleware('user_access:User,edit');
        Route::put('update/{id}', 'update')->name('update-user')->middleware('user_access:User,edit');
        Route::delete('delete/{id}', 'destroy')->name('delete-user')->middleware('user_access:User,delete');
        Route::post('restore/{id}', 'restore')->name('restore-user')->middleware('user_access:User,delete');
        Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-user')->middleware('user_access:User,delete');
        Route::post('updateStatus', 'updateStatus')->name('update-user-status')->middleware('user_access:User,status');
        Route::get('changePassword', 'viewChangePassword')->name('user-view-change-password');
        Route::post('changePassword', 'changePassword')->name('user-change-password');
        Route::post('forceLogout/{id}', 'forceLogout')->name('force-logout');
        Route::get('profile', 'profile')->name('user-profile');
    });

    Route::controller(RoleController::class)->prefix('role')->group(function () {
        Route::get('list', 'index')->name('role-list')->middleware('user_access:Role,any');
        Route::get('show/{id}', 'show')->name('show-role')->middleware('user_access:Role,view');
        Route::get('create', 'create')->name('add-role')->middleware('user_access:Role,add');
        Route::post('store', 'store')->name('store-role')->middleware('user_access:Role,add');
        Route::get('edit/{id}', 'edit')->name('edit-role')->middleware('user_access:Role,edit');
        Route::put('update/{id}', 'update')->name('update-role')->middleware('user_access:Role,edit');
        Route::delete('delete/{id}', 'destroy')->name('delete-role')->middleware('user_access:Role,delete');
        Route::post('restore/{id}', 'restore')->name('restore-role')->middleware('user_access:Role,delete');
        Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-role')->middleware('user_access:Role,delete');
        Route::post('updateStatus', 'updateStatus')->name('update-role-status')->middleware('user_access:Role,status');
    });

    Route::controller(PermissionController::class)->prefix('permission')->group(function () {
        Route::get('list', 'index')->name('permission-list')->middleware('user_access:Permission,any');
        Route::get('show/{id}', 'show')->name('show-permission')->middleware('user_access:Permission,view');
        Route::get('create', 'create')->name('add-permission')->middleware('user_access:Permission,add');
        Route::post('store', 'store')->name('store-permission')->middleware('user_access:Permission,add');
        Route::get('edit/{id}', 'edit')->name('edit-permission')->middleware('user_access:Permission,edit');
        Route::put('update/{id}', 'update')->name('update-permission')->middleware('user_access:Permission,edit');
        Route::delete('delete/{id}', 'destroy')->name('delete-permission')->middleware('user_access:Permission,delete');
        Route::post('restore/{id}', 'restore')->name('restore-permission')->middleware('user_access:Permission,delete');
        Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-permission')->middleware('user_access:Permission,delete');
        Route::post('updateStatus', 'updateStatus')->name('update-permission-status')->middleware('user_access:Permission,status');
    });

    Route::controller(ModuleController::class)->prefix('module')->group(function () {
        Route::get('list', 'index')->name('module-list')->middleware('user_access:Module,any');
        Route::get('show/{id}', 'show')->name('show-module')->middleware('user_access:Module,view');
        Route::get('create', 'create')->name('add-module')->middleware('user_access:Module,add');
        Route::post('store', 'store')->name('store-module')->middleware('user_access:Module,add');
        Route::get('edit/{id}', 'edit')->name('edit-module')->middleware('user_access:Module,edit');
        Route::put('update/{id}', 'update')->name('update-module')->middleware('user_access:Module,edit');
        Route::delete('delete/{id}', 'destroy')->name('delete-module')->middleware('user_access:Module,delete');
        Route::post('restore/{id}', 'restore')->name('restore-module')->middleware('user_access:Module,delete');
        Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-module')->middleware('user_access:Module,delete');
        Route::post('updateStatus', 'updateStatus')->name('update-module-status')->middleware('user_access:Module,status');
    });
});
