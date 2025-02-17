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
use Illuminate\Support\Facades\DateTime;
use Carbon\Carbon;

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
        $today = new \DateTime();
        $today_input = $today->format("Y");
        $years = range(2016, 2025);
        return view("user_info.create", ["join_year" => $years, 'today' => $today_input]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        //

        try {
            Log::info('User registration request received.', ['data' => $request->all()]); // 🔹 リクエストのデータをログに記録

            $birth_date_input = sprintf('%04d-%02d-%02d', $request->birth_year, $request->birth_month, $request->birth_day);
            $join_date_input = sprintf('%04d-%02d-%02d', $request->join_year, $request->join_month, $request->join_day);

            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);
            $validated['join_date'] =   $join_date_input;
            $validated['birth_date'] =   $birth_date_input;

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


        // 現在の日付を取得
        $today = new \DateTime();
        $today_input_year = $today->format("Y");
        $today_input_month = $today->format("m");
        $today_input_day = $today->format("d");

        $join_date_show = new \DateTime($user->join_date);
        $join_year = $join_date_show->format("Y");
        $join_month = $join_date_show->format("m");
        $join_day = $join_date_show->format("d");

        $birth_date_show = new \DateTime($user->birth_date);
        $birth_year = $birth_date_show->format("Y");
        $birth_month = $birth_date_show->format("m");
        $birth_day = $birth_date_show->format("d");

        // 差分を計算
        $interval = $join_date_show->diff($today);

        $elapsed_time = sprintf("%d年%dヶ月%d日", $interval->y, $interval->m, $interval->d);
        $birthDate = new \DateTime($user->birth_date); // 文字列を DateTime に変換
        $age = $birthDate->diff($today)->y;


        if (Gate::denies('compare-user', $user)) {
            return redirect('top');
        }
        $authuser = Auth::user();
        return view('user_info.detail', ['user' => $user, 'years' => $years, 'authuser' => $authuser, 'elapsed_time' => $elapsed_time,  'age' => $age, 'today_input_year' => $today_input_year, 'birth_year' => $birth_year, 'birth_month' => $birth_month, 'birth_day' => $birth_day, 'join_year' => $join_year, 'join_month' => $join_month, 'join_day' => $join_day, 'test' => $birth_date_show]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update_confirm(Request $request, User $user)
    {
        $authuser = Auth::user();
        $join_date_comparison = new \DateTime($user->join_date);
        $join_year_comparison = $join_date_comparison->format("Y");
        $join_month_comparison = $join_date_comparison->format("m");
        $join_day_comparison = $join_date_comparison->format("d");

        $birth_date_comparison = new \DateTime($user->birth_date);
        $birth_year_comparison = $birth_date_comparison->format("Y");
        $birth_month_comparison = $birth_date_comparison->format("m");
        $birth_day_comparison = $birth_date_comparison->format("d");

        if ($request->isMethod('get') || Gate::denies('compare-user', $user)) {
            return redirect()->route('user_info.show', ['user' => $authuser]);
        }

        $updatedData = $request->only(['last_name', 'first_name', 'last_name_kana', 'first_name_kana', 'gender', 'post_code', 'address1', 'address2', 'address3', 'join_year', 'join_month', 'join_day', 'role', 'birth_year', 'birth_month',  'birth_day', 'birth_date', "join_date"]);

        $updatedData['birth_date'] = Carbon::createFromDate(
            $updatedData['birth_year'],
            $updatedData['birth_month'],
            $updatedData['birth_day']
        )->format('Y-m-d');

        $updatedData['join_date'] = Carbon::createFromDate(
            $updatedData['join_year'],
            $updatedData['join_month'],
            $updatedData['join_day']
        )->format('Y-m-d');

        unset($updatedData['birth_year'], $updatedData['birth_month'], $updatedData['birth_day']);
        unset($updatedData['join_year'], $updatedData['join_month'], $updatedData['join_day']);

        $originalData = [
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'last_name_kana' => $user->last_name_kana,
            'first_name_kana' => $user->first_name_kana,
            'gender' => $user->gender,
            'post_code' => $user->post_code,
            'address1' => $user->address1,
            'address2' => $user->address2,
            'address3' => $user->address3,
            'birth_date' => $user->birth_date,
            'join_date' => $user->join_date,
            'role' =>  $user->role,
        ];

        Log::info('update date', ['data' => $updatedData]);
        Log::info('origin ', ['data' => $originalData]);

        if ($updatedData == $originalData) {
            return redirect()->route('user_info.show', ['user' => $user])->with('message', '内容を変更して、修正を押下してください。');
        }
        return view('user_info.update_confirm', [
            'user' => $user,
            'request' => $request,
            'join_year_comparison' => $join_year_comparison,
            'join_month_comparison' => $join_month_comparison,
            'join_day_comparison' => $join_day_comparison,
            'birth_year_comparison' => $birth_year_comparison,
            'birth_month_comparison' => $birth_month_comparison,
            'birth_day_comparison' => $birth_day_comparison
        ]);
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(UserUpdateRequest $request, User $user)
    {
        //
        $birth_date_input = Carbon::createFromDate(
            $request['birth_year'],
            $request['birth_month'],
            $request['birth_day']
        )->format('Y-m-d');

        $join_date_input = Carbon::createFromDate(
            $request['join_year'],
            $request['join_month'],
            $request['join_day']
        )->format('Y-m-d');

        Log::info('birth_date_input ', ['data' => $birth_date_input]);
        Log::info('join_date_input', ['data' => $join_date_input]);

        unset($request['birth_year'], $request['birth_month'], $request['birth_day']);
        unset($request['join_year'], $request['join_month'], $request['join_day']);



        $updateDate = $request->validated();
        if ($birth_date_input != $user->birth_date) {
            $updateDate['birth_date'] = $birth_date_input;
        }
        if ($join_date_input != $user->join_date) {
            $updateDate['join_date'] = $join_date_input;
        }
        Log::info('user date', ['data' => $user->birth_date]);
        Log::info('user join date', ['data' => $user->join_date]);
        Log::info('origin_update', ['data' => $request]);

        Log::info('update ', ['data' => $updateDate]);


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
