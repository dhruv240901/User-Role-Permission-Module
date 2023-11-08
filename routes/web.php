<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Route::controller(UserController::class)->group(function () {
    Route::get('list', 'index')->name('user-list');
    Route::get('create', 'create')->name('add-user');
    Route::post('store', 'store')->name('store-user');
    Route::get('edit/{id}', 'edit')->name('edit-user');
    Route::put('update/{id}', 'update')->name('update-user');
    Route::delete('delete/{id}', 'destroy')->name('delete-user');
    Route::post('restore/{id}', 'restore')->name('restore-user');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-user');
});

Route::controller(UserController::class)->group(function () {
    Route::get('list', 'index')->name('user-list');
    Route::get('create', 'create')->name('add-user');
    Route::post('store', 'store')->name('store-user');
    Route::get('edit/{id}', 'edit')->name('edit-user');
    Route::put('update/{id}', 'update')->name('update-user');
    Route::delete('delete/{id}', 'destroy')->name('delete-user');
    Route::post('restore/{id}', 'restore')->name('restore-user');
    Route::post('forceDelete/{id}', 'forceDelete')->name('force-delete-user');
});

