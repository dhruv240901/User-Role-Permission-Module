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
});

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('list', 'index')->name('user-list');
    Route::get('create', 'create')->name('add-user');
    Route::post('store', 'store')->name('store-user');
    Route::get('edit/{id}', 'edit')->name('edit-user');
    Route::put('update/{id}', 'update')->name('update-user');
    Route::delete('delete/{id}', 'destroy')->name('delete-user');
    Route::post('restore/{id}', 'restore')->name('restore-user');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-user');
});

Route::controller(RoleController::class)->prefix('role')->group(function () {
    Route::get('list', 'index')->name('role-list');
    Route::get('create', 'create')->name('add-role');
    Route::post('store', 'store')->name('store-role');
    Route::get('edit/{id}', 'edit')->name('edit-role');
    Route::put('update/{id}', 'update')->name('update-role');
    Route::delete('delete/{id}', 'destroy')->name('delete-role');
    Route::post('restore/{id}', 'restore')->name('restore-role');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-role');
});

Route::controller(PermissionController::class)->prefix('permission')->group(function (){
    Route::get('list', 'index')->name('permission-list');
    Route::get('create', 'create')->name('add-permission');
    Route::post('store', 'store')->name('store-permission');
    Route::get('edit/{id}', 'edit')->name('edit-permission');
    Route::put('update/{id}', 'update')->name('update-permission');
    Route::delete('delete/{id}', 'destroy')->name('delete-permission');
    Route::post('restore/{id}', 'restore')->name('restore-permission');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-permission');
});

Route::controller(ModuleController::class)->prefix('module')->group(function (){
    Route::get('list', 'index')->name('module-list');
    // Route::get('create', 'create')->name('add-permission');
    // Route::post('store', 'store')->name('store-permission');
    // Route::get('edit/{id}', 'edit')->name('edit-role');
    // Route::put('update/{id}', 'update')->name('update-role');
    Route::delete('delete/{id}', 'destroy')->name('delete-module');
    Route::post('restore/{id}', 'restore')->name('restore-module');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-module');
});

