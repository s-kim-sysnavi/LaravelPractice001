<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // シードデータ作成やお知らせ機能の利用
    use HasFactory, Notifiable;

    // 一括保存する項目
    protected $fillable = [
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'email',
        'password',
        'gender',
        'birth_date',
        'join_date',
        'post_code',
        'address1',
        'address2',
        'address3',
        'role',

    ];

    // デフォルト設定項目
    protected $attributes = [
        'role' => 'user', // default
        'profile_image' => 'users/default.png',

    ];

    // 外部に漏出しない値
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
