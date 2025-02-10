<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function top()
    {
        //
        $user = Auth::user();
        return view("top", ["user" => $user]);
    }

    public function index()
    {
        //
        $users = User::orderBy("id")->simplePaginate(10);
        return view("user_info.index",["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $years = range(2016, 2025);
        return view("user_info.create", ["join_year" => $years]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        //
        Log::info('User registration request received.', ['data' => $request->all()]); // 🔹 リクエストのデータをログに記録

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Log::info('New user registered successfully.', ['user_id' => $user->id]); // 🔹 登録成功ログ

        return to_route('login')->with('success', 'ユーザー登録完了');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //        var_dump($user->name); 
        $years = range(2016, 2025);
        return view('user_info.detail', ['user' => $user, 'join_year' => $years]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update_confirm(Request $request, User $user)
    {
        //
        return view('user_info.update_confirm', ['user' => $user, 'request' => $request]);
        // return redirect()->route('user_info.update_confirm', ['user'=> $user,'request' => $request]);
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(UserUpdateRequest $request, User $user)
    {
        //
        $updateDate = $request->validated();

        $user->update($updateDate);
        return to_route('user_info.show', ['user' => $user])->with('success', 'ユーザー登録完了');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete_confirm(User $user)
    {
        //
        return view('user_info.delete_confirm', ['user' => $user]);


        // return view('user_info.update_confirm', ['user' => $user, 'request' => $request]);
    }
    public function destroy(User $user)
    {
        //
        $user->delete();

        return to_route('user_info.show', ['user' => $user])->with('success', 'ユーザー削除完了');
    }
}
