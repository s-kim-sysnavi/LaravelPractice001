<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

// ユーザー情報取得用のAPI関連コントローラー
class UserApiController extends Controller
{

    // 全てのユーザー情報取得
    public function index(Request $request)
    {
        // クエリパラメータからフィールドを取得し、デフォルト値を設定
        $fields = explode(',', $request->query(
            'fields',
            'id,last_name,first_name,last_name_kana,first_name_kana,email,created_at,updated_at'
        ));

        // 許可されたフィールドのリスト
        $allowedFields = [
            'id',
            'last_name',
            'first_name',
            'last_name_kana',
            'first_name_kana',
            'email',
            'gender',
            'birth_date',
            'join_date',
            'post_code',
            'address1',
            'address2',
            'address3',
            'created_at',
            'updated_at'
        ];

        // 許可されたフィールドのみを抽出
        $fields = array_intersect($fields, $allowedFields);

        // フィールドが空の場合のエラーハンドリング
        if (empty($fields)) {
            return response()->json(['message' => '該当する情報が存在しません。'], 400);
        }

        // 全てのユーザーデータを取得
        $users = User::select($fields)->get();

        // 全てのユーザーデータをJSON形式で返す
        return response()->json($users);
    }

    // 特定ユーザー情報取得
    public function show(user $user, Request $request)
    {
        // クエリパラメータからフィールドを取得し、デフォルト値を設定
        $fields = explode(',', $request->query(
            'fields',
            'id,last_name,first_name,last_name_kana,first_name_kana,email,created_at,updated_at'
        ));

        // 許可されたフィールドのリスト
        $allowedFields = [
            'id',
            'last_name',
            'first_name',
            'last_name_kana',
            'first_name_kana',
            'email',
            'gender',
            'birth_date',
            'join_date',
            'post_code',
            'address1',
            'address2',
            'address3',
            'created_at',
            'updated_at'
        ];

        // 許可されたフィールドのみを抽出
        $fields = array_intersect($fields, $allowedFields);

        // フィールドが空の場合のエラーハンドリング
        if (empty($fields)) {
            return response()->json(['message' => '該当する情報が存在しません。'], 400);
        }

        // ユーザーデータを取得
        $userData = $user->only($fields);

        // ユーザーデータをJSON形式で返す
        return response()->json($userData);
    }
}
