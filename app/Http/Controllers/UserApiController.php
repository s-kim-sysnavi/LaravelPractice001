<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserApiController extends Controller
{
    //
    // public function index_all()
    // {
    //     $users = User::all();
    //     return response()->json($users);
    // }

    // public function index_limit()
    // {
    //     $users = User::all()->map(function ($user) {
    //         return $user->only(["id", "last_name", "first_name", "last_name_kana", "first_name_kana", "email"]);
    //     });

    //     return response()->json($users);
    // }
    public function index(Request $request)
    {
        $fields = explode(',', $request->query('fields', 'id,last_name,first_name,last_name_kana,first_name_kana,email,created_at,updated_at'));
        $allowedFields = ['id', 'last_name', 'first_name', 'email', 'gender', 'birth_date', 'join_date', 'post_code', 'address1', 'address2', 'address3', 'created_at', 'updated_at'];

        $fields = array_intersect($fields, $allowedFields);

        if (empty($fields)) {
            return response()->json(['message' => '該当する情報が存在しません。'], 400);
        }

        $users = User::select($fields)->get();
        return response()->json($users);
    }

    // public function show(user $user)
    // {
    //     $user = User::find($user->id)->only(["id", "last_name", "first_name", "last_name_kana", "first_name_kana", "email"]);

    //     if (!$user) {
    //         return response()->json(['message' => '存在していない社員です'], 404);
    //     }
    //     return response()->json($user);
    // }

    // public function show_all(user $user)
    // {
    //     $user = User::find($user->id);
    //     if (!$user) {
    //         return response()->json(['message' => '存在していない社員です'], 404);
    //     }
    //     return response()->json($user);
    // }

    public function show(user $user, Request $request)
    {
        $fields = explode(',', $request->query('fields', 'id,last_name,first_name,last_name_kana,first_name_kana,email,created_at,updated_at'));
        $allowedFields = ['id', 'last_name', 'first_name', 'email', 'gender', 'birth_date', 'join_date', 'post_code', 'address1', 'address2', 'address3', 'created_at', 'updated_at'];

        $fields = array_intersect($fields, $allowedFields);

        if (empty($fields)) {
            return response()->json(['message' => '該当する情報が存在しません。'], 400);
        }
        $userData = $user->only($fields);

        return response()->json($userData);
    }
}
