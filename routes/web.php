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

Route::get('/',[HomeController::class,'index'])->name('index');

Route::controller(AuthController::class)->group(function () {
    Route::get('signup', 'signup')->name('signup');
    Route::post('signup', 'customSignup')->name('custom-signup');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'customLogin')->name('custom-login');
    Route::get('logout', 'logout')->name('logout');
    Route::get('changepassword', 'viewchangepassword')->name('view-change-password');
    Route::post('changepassword', 'changepassword')->name('change-password');
    Route::get('forgetpassword', 'viewforgetpassword')->name('view-forget-password');
    Route::post('forgetpassword', 'forgetpassword')->name('forget-password');
    Route::get('resetpassword/{token}', 'viewresetpassword')->name('view-reset-password');
    Route::post('resetpassword/{token}', 'resetpassword')->name('reset-password');
});

Route::middleware('auth')->group(function () {
Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('list', 'index')->name('user-list');
    Route::get('show/{id}', 'show')->name('show-user');
    Route::get('create', 'create')->name('add-user');
    Route::post('store', 'store')->name('store-user');
    Route::get('edit/{id}', 'edit')->name('edit-user');
    Route::put('update/{id}', 'update')->name('update-user');
    Route::delete('delete/{id}', 'destroy')->name('delete-user');
    Route::post('restore/{id}', 'restore')->name('restore-user');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-user');
    Route::post('updatestatus', 'updatestatus')->name('update-user-status');
    Route::get('changepassword', 'viewchangepassword')->name('user-view-change-password');
    Route::post('changepassword', 'changepassword')->name('user-change-password');
    Route::post('forceLogout/{id}', 'forceLogout')->name('force-logout');
});

Route::controller(RoleController::class)->prefix('role')->group(function () {
    Route::get('list', 'index')->name('role-list');
    Route::get('show/{id}', 'show')->name('show-role');
    Route::get('create', 'create')->name('add-role');
    Route::post('store', 'store')->name('store-role');
    Route::get('edit/{id}', 'edit')->name('edit-role');
    Route::put('update/{id}', 'update')->name('update-role');
    Route::delete('delete/{id}', 'destroy')->name('delete-role');
    Route::post('restore/{id}', 'restore')->name('restore-role');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-role');
    Route::post('updatestatus', 'updatestatus')->name('update-role-status');
});

Route::controller(PermissionController::class)->prefix('permission')->group(function (){
    Route::get('list', 'index')->name('permission-list');
    Route::get('show/{id}', 'show')->name('show-permission');
    Route::get('create', 'create')->name('add-permission');
    Route::post('store', 'store')->name('store-permission');
    Route::get('edit/{id}', 'edit')->name('edit-permission');
    Route::put('update/{id}', 'update')->name('update-permission');
    Route::delete('delete/{id}', 'destroy')->name('delete-permission');
    Route::post('restore/{id}', 'restore')->name('restore-permission');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-permission');
    Route::post('updatestatus', 'updatestatus')->name('update-permission-status');
});

Route::controller(ModuleController::class)->prefix('module')->group(function (){
    Route::get('list', 'index')->name('module-list');
    Route::get('show/{id}', 'show')->name('show-module');
    Route::get('create', 'create')->name('add-module');
    Route::post('store', 'store')->name('store-module');
    Route::get('edit/{id}', 'edit')->name('edit-module');
    Route::put('update/{id}', 'update')->name('update-module');
    Route::delete('delete/{id}', 'destroy')->name('delete-module');
    Route::post('restore/{id}', 'restore')->name('restore-module');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-module');
    Route::post('updatestatus', 'updatestatus')->name('update-module-status');
});

});
