<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Exception;
use Illuminate\Validation\ValidationException;

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
        $authuser = Auth::user();
        $users = User::orderBy("id")->simplePaginate(10);
        return view("user_info.index", ["users" => $users, 'authuser' => $authuser]);
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
        try {
            Log::info('User registration request received.', ['data' => $request->all()]); // 🔹 リクエストのデータをログに記録

            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);

            $user = User::create($validated);

            Log::info('New user registered successfully.', ['user_id' => $user->id]); // 🔹 登録成功ログ

            return to_route('login')->with('message', 'ユーザー登録完了');
        } catch (ValidationException $e) {
            Log::warning('User registration validation failed.', ['message' => $e->errors()]);

            return back()->withErrors($e->errors())->withInput();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //        var_dump($user->name); 
        $years = range(2016, 2025);
        $authuser = Auth::user();

        if (Gate::denies('compare-user', $user)) {
            return redirect('top');
        }
        $authuser = Auth::user();
        return view('user_info.detail', ['user' => $user, 'join_year' => $years, 'authuser' => $authuser]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update_confirm(Request $request, User $user)
    {
        $authuser = Auth::user();

        if ($request->isMethod('get') || Gate::denies('compare-user', $user)) {
            return redirect()->route('user_info.show', ['user' => $authuser]);
        }

        $updatedData = $request->only(['last_name', 'first_name', 'gender', 'address', 'join_year']);

        $originalData = [
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'gender' => $user->gender,
            'address' => $user->address,
            'join_year' => $user->join_year,
        ];


        if ($updatedData == $originalData) {
            return redirect()->route('user_info.show', ['user' => $user])->with('message', '内容を変更して、修正を押下してください。');
        }
        return view('user_info.update_confirm', ['user' => $user, 'request' => $request]);
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(UserUpdateRequest $request, User $user)
    {
        //
        $updateDate = $request->validated();
        $user->update($updateDate);
        return to_route('user_info.show', ['user' => $user])->with('message', 'ユーザー情報更新完了');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete_confirm(User $user)
    {
        //
        $authuser = Auth::user();
        if (Gate::allows('admin-delete-limit', $user)) {
            return redirect()->route('user_info.show', ['user' => $authuser]);
        } elseif (Gate::denies('compare-user-delete', $user)) {
            return redirect()->route('user_info.show', ['user' => $authuser]);
        }
        return view('user_info.delete_confirm', ['user' => $user]);


        // return view('user_info.update_confirm', ['user' => $user, 'request' => $request]);
    }
    public function destroy(User $user)
    {
        //
        $user->delete();

        return to_route('user_info.index')->with('message', 'ユーザー削除完了');
    }

    public function profile_image(User $user)
    {
        //
        $authuser = Auth::user();
        if (Gate::denies('compare-user', $user)) {
            return redirect()->route('user_info.show', ['user' => $authuser]);
        }
        return view('user_info.profile_image', ['user' => $user]);
    }

    public function profile_image_update(Request $request, User $user)
    {

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');

            if ($file !== null) {
                $savedFilePath = $file->store('users', 'public');

                $user->profile_image =  $savedFilePath;
            } else {
                Log::error('ファイルが取得できませんでした');
                $savedFilePath = old($user->profile_image);
            }
        } else {
            Log::warning('ファイルがアップロードされていません');
            $savedFilePath = old($user->profile_image);
        }

        $user->save();
        return to_route('user_info.show', ['user' => $user])->with('message', 'プロフィール画像、アップロード完了');
    }
}
