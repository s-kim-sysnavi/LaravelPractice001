<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZipcodeController;

// トップページのルート(/、/topでも遷移)
Route::get('/', [UserController::class, 'top'])->name('top')->middleware('auth');
Route::get('/top', [UserController::class, 'top'])->name('top')->middleware('auth');

// ユーザー情報関連のルートまとめ(認証情報がないとこのグループにアクセス不可)
Route::prefix('/user-info')->name('user_info.')->middleware('auth')->group(function () {
    // 一覧画面のルート(全ユーザー表示)
    Route::get('/', [UserController::class, 'index'])->name('index');

    // ユーザー詳細画面のルート
    Route::get('/detail/{user}', [UserController::class, 'show'])->name('show');

    // ユーザー情報修正画面のルート(表示・更新)
    Route::match(['get', 'post'], '/update-confirm/{user}', [UserController::class, 'update_confirm'])->name('update_confirm');
    Route::put('/update-confirm/{user}', [UserController::class, 'update'])->name('update');

    // ユーザー情報削除画面のルート(表示・削除)
    Route::get('/delete-confirm/{user}', [UserController::class, 'delete_confirm'])->name('delete_confirm');
    Route::delete('/delete-confirm/{user}', [UserController::class, 'destroy'])->name('destroy');

    // ユーザープロフィール画像修正画面のルート(表示・更新)
    Route::get('/profile-image/{user}', [UserController::class, 'profile_image'])->name('profile_image');
    Route::post('/profile-image/{user}', [UserController::class, 'profile_image_update'])->name('profile_image_update');
});

// ユーザー登録のルート(認証後にはアクセス不可)
Route::get('user-info/create', [UserController::class, 'create'])->name('user_info.create')->middleware('guest');
Route::post('user-info/create', [UserController::class, 'store'])->name('user_info.store');

// ログイン画面のルート(認証語にはアクセス不可)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
// ログアウト処理のルート(認証状態で実施可能)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 郵便番号検索APIのルート
Route::get('/api/address', [ZipcodeController::class, 'search']);
