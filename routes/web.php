<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'top'])->name('top')->middleware('auth');

Route::get('/top', [UserController::class, 'top'])->name('top')->middleware('auth');

Route::prefix('/user-info')->name('user_info.')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');

    Route::get('/detail/{user}', [UserController::class, 'show'])->name('show');
    Route::match(['get','post'],'/update-confirm/{user}', [UserController::class, 'update_confirm'])->name('update_confirm');
    // Route::get('/update-confirm/{user}', [UserController::class, 'update_confirm'])->name('update_confirm');
    Route::put('/update-confirm/{user}', [UserController::class, 'update'])->name('update');

    Route::get('/delete-confirm/{user}', [UserController::class, 'delete_confirm'])->name('delete_confirm');
    Route::delete('/delete-confirm/{user}', [UserController::class, 'destroy'])->name('destroy');

    Route::get('/profile-image/{user}', [UserController::class, 'profile_image'])->name('profile_image');
    Route::post('/profile-image/{user}', [UserController::class, 'profile_image_update'])->name('profile_image_update');
});
Route::get('user-info/create', [UserController::class, 'create'])->name('user_info.create')->middleware('guest');
Route::post('user-info/create', [UserController::class, 'store'])->name('user_info.store');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

