<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserApiController;
use Illuminate\Support\Facades\Route;

// Route::get('/user-info/all-full', [UserApiController::class, 'index_all'])->name('user_info.all_full');

// Route::get('/user-info/all', [UserApiController::class, 'index_limit'])->name('user_info.all');

Route::get('/user-info/all', [UserApiController::class, 'index'])->name('user_info.all');

Route::get('/user-info/{user}', [UserApiController::class, 'show'])->name('user_info.detail');

// Route::get('/user-info/{user}/full', [UserApiController::class, 'show_all'])->name('user_info.detail_full');