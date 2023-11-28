<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\FileController;


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
Route::get('/comingSoon', [HomeController::class, 'comingSoon'])->name('coming-soon');

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
        Route::get('list', 'index')->name('user-list')->middleware('user_access:US,view');
        Route::get('show/{id}', 'show')->name('show-user')->middleware('user_access:US,view');
        Route::get('create', 'create')->name('add-user')->middleware('user_access:US,add');
        Route::post('store', 'store')->name('store-user')->middleware('user_access:US,add');
        Route::get('edit/{id}', 'edit')->name('edit-user')->middleware('user_access:US,edit');
        Route::put('update/{id}', 'update')->name('update-user')->middleware('user_access:US,edit');
        Route::delete('delete/{id}', 'destroy')->name('delete-user')->middleware('user_access:US,delete');
        Route::post('restore/{id}', 'restore')->name('restore-user')->middleware('user_access:US,delete');
        Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-user')->middleware('user_access:US,delete');
        Route::post('updateStatus', 'updateStatus')->name('update-user-status')->middleware('user_access:US,edit');
        Route::get('changePassword', 'viewChangePassword')->name('user-view-change-password');
        Route::post('changePassword', 'changePassword')->name('user-change-password');
        Route::post('forceLogout/{id}', 'forceLogout')->name('force-logout');
        Route::get('profile', 'profile')->name('user-profile');
    });

    Route::controller(RoleController::class)->prefix('role')->group(function () {
        Route::get('list', 'index')->name('role-list')->middleware('user_access:RO,view');
        Route::get('show/{id}', 'show')->name('show-role')->middleware('user_access:RO,view');
        Route::get('create', 'create')->name('add-role')->middleware('user_access:RO,add');
        Route::post('store', 'store')->name('store-role')->middleware('user_access:RO,add');
        Route::get('edit/{id}', 'edit')->name('edit-role')->middleware('user_access:RO,edit');
        Route::put('update/{id}', 'update')->name('update-role')->middleware('user_access:RO,edit');
        Route::delete('delete/{id}', 'destroy')->name('delete-role')->middleware('user_access:RO,delete');
        Route::post('restore/{id}', 'restore')->name('restore-role')->middleware('user_access:RO,delete');
        Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-role')->middleware('user_access:RO,delete');
        Route::post('updateStatus', 'updateStatus')->name('update-role-status')->middleware('user_access:RO,status');
    });

    Route::controller(PermissionController::class)->prefix('permission')->group(function () {
        Route::get('list', 'index')->name('permission-list')->middleware('user_access:PER,view');
        Route::get('show/{id}', 'show')->name('show-permission')->middleware('user_access:PER,view');
        Route::get('create', 'create')->name('add-permission')->middleware('user_access:PER,add');
        Route::post('store', 'store')->name('store-permission')->middleware('user_access:PER,add');
        Route::get('edit/{id}', 'edit')->name('edit-permission')->middleware('user_access:PER,edit');
        Route::put('update/{id}', 'update')->name('update-permission')->middleware('user_access:PER,edit');
        Route::delete('delete/{id}', 'destroy')->name('delete-permission')->middleware('user_access:PER,delete');
        Route::post('restore/{id}', 'restore')->name('restore-permission')->middleware('user_access:PER,delete');
        Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-permission')->middleware('user_access:PER,delete');
        Route::post('updateStatus', 'updateStatus')->name('update-permission-status')->middleware('user_access:PER,status');
    });

    Route::controller(ModuleController::class)->prefix('module')->group(function () {
        Route::get('list', 'index')->name('module-list')->middleware('user_access:Mo,view');
        Route::get('show/{id}', 'show')->name('show-module')->middleware('user_access:Mo,view');
        Route::get('create', 'create')->name('add-module')->middleware('user_access:Mo,add');
        Route::post('store', 'store')->name('store-module')->middleware('user_access:Mo,add');
        Route::get('edit/{id}', 'edit')->name('edit-module')->middleware('user_access:Mo,edit');
        Route::put('update/{id}', 'update')->name('update-module')->middleware('user_access:Mo,edit');
        Route::delete('delete/{id}', 'destroy')->name('delete-module')->middleware('user_access:Mo,delete');
        Route::post('restore/{id}', 'restore')->name('restore-module')->middleware('user_access:Mo,delete');
        Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-module')->middleware('user_access:Mo,delete');
        Route::post('updateStatus', 'updateStatus')->name('update-module-status')->middleware('user_access:Mo,status');
    });

    Route::controller(FileController::class)->prefix('file')->group(function () {
        Route::get('list', 'index')->name('file-list')->middleware('user_access:Mo,view');
        Route::get('show/{id}', 'show')->name('show-file')->middleware('user_access:Mo,view');
        Route::get('create', 'create')->name('add-file')->middleware('user_access:Mo,add');
        Route::post('store', 'store')->name('store-file')->middleware('user_access:Mo,add');
        Route::get('edit/{id}', 'edit')->name('edit-file')->middleware('user_access:Mo,edit');
        Route::put('update/{id}', 'update')->name('update-file')->middleware('user_access:Mo,edit');
        Route::delete('delete/{id}', 'destroy')->name('delete-file')->middleware('user_access:Mo,delete');
        Route::post('restore/{id}', 'restore')->name('restore-file')->middleware('user_access:Mo,delete');
        Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-file')->middleware('user_access:Mo,delete');
        Route::post('updateStatus', 'updateStatus')->name('update-file-status')->middleware('user_access:Mo,status');
    });
});
