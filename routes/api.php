<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserApiController;
use Illuminate\Support\Facades\Route;

// 全てのユーザー情報を取得するAPIエンドポイントのルート
Route::get('/user-info/all', [UserApiController::class, 'index'])->name('user_info.all');

// 特定ユーザー情報を取得するAPIエンドポイントのルート
Route::get('/user-info/{user}', [UserApiController::class, 'show'])->name('user_info.detail');
