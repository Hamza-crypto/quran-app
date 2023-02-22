<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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



Route::middleware(['auth'])->group(function () {

    Route::controller(DashboardController::class)->group(function () {

        Route::get('/', 'index')->name('dashboard.index');
    });

    Route::controller(ProfileController::class)->middleware(['auth'])->group(function () {

        Route::get('/profile', 'index')->name('profile.index');
    });

    Route::controller(UsersController::class)->middleware(['auth'])->group(function () {

        Route::post('/password/{user}', 'password_update')->name('user.password_update');
        Route::post('/assign/{user}', 'assign_teacher')->name('user.assign_teacher');
    });

    Route::resource('users', UsersController::class)->middleware(['admin']);

});




Route::impersonate();
