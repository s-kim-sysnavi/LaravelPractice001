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

// ユーザー情報関連コントローラー
class UserController extends Controller
{

    // トップ画面の表示
    public function top()
    {
        //認証しているユーザー情報をビュー取得時に渡す
        $user = Auth::user();
        return view("top", ["user" => $user]);
    }

    // ユーザー情報一覧画面の表示
    public function index()
    {
        //一覧画面で権限により表示内容が分けるため、認証しているユーザー情報を渡す
        $authuser = Auth::user();
        // ユーザーのidで並び変え、10件づつ、表示させる
        $users = User::orderBy("id")->simplePaginate(10);
        return view("user_info.index", ["users" => $users, 'authuser' => $authuser]);
    }

    // ユーザー情報登録画面表示
    public function create()
    {
        //登録画面の「生年月日」項目で、今年基準で20年前の年度をデフォルトで表示させる
        $today = new \DateTime();
        $today_input = $today->format("Y");
        //登録画面の「入社日」項目の選択可能年度範囲
        $years = range(2016, $today_input);
        return view("user_info.create", ["join_year" => $years, 'today' => $today_input]);
    }

    // ユーザー情報の登録処理
    public function store(UserStoreRequest $request)
    {
        //問題がなければ下記処理実施
        try {

            // ドロップダウン(年、月、日)で受けた値をbirth_date(生年月日)の形式に合わせて変数に代入
            $birth_date_input = sprintf('%04d-%02d-%02d', $request->birth_year, $request->birth_month, $request->birth_day);
            // ドロップダウン(年、月、日)で受けた値をjoin_date(入社日)の形式に合わせて変数に代入
            $join_date_input = sprintf('%04d-%02d-%02d', $request->join_year, $request->join_month, $request->join_day);

            // バリデーションを行ったデータを変数に代入
            $validated = $request->validated();
            // パスワードはハッシュ化する
            $validated['password'] = Hash::make($validated['password']);
            // 入社日・生年月日はドロップダウンの値を合わせた値にする
            $validated['join_date'] =   $join_date_input;
            $validated['birth_date'] =   $birth_date_input;

            // 上記データをDBに保存保存
            $user = User::create($validated);

            return to_route('login')->with('message', 'ユーザー登録完了');
            // 例外発生時、以前ページにエラー内容を渡して、遷移する
        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput();
        }
    }

    // ユーザー情報詳細画面の表示
    public function show(User $user)
    {
        // 入社日入力用の表示年度範囲
        $years = range(2016, 2025);
        // 認証しているユーザー情報(権限により表示が変わる)
        $authuser = Auth::user();

        // 現在の日付を取得
        $today = new \DateTime();
        $today_input_year = $today->format("Y");
        $today_input_month = $today->format("m");
        $today_input_day = $today->format("d");

        // users.join_date(入社日)でオブジェクトを作成し、その値を年・月・日に分ける
        $join_date_show = new \DateTime($user->join_date);
        $join_year = $join_date_show->format("Y");
        $join_month = $join_date_show->format("m");
        $join_day = $join_date_show->format("d");

        // users.birth_date(生年月日)でオブジェクトを作成し、その値を年・月・日に分ける
        $birth_date_show = new \DateTime($user->birth_date);
        $birth_year = $birth_date_show->format("Y");
        $birth_month = $birth_date_show->format("m");
        $birth_day = $birth_date_show->format("d");

        // 勤続期間演算
        $interval = $join_date_show->diff($today);
        $elapsed_time = sprintf("%d年%dヶ月%d日", $interval->y, $interval->m, $interval->d);

        // 年齢演算
        $age = $birth_date_show->diff($today)->y;

        // 認証ユーザー情報と比較して、idが異なっているとトップ画面へ遷移(admin権限は例外)
        if (Gate::denies('compare-user', $user)) {
            return redirect('top');
        }

        return view('user_info.detail', ['user' => $user, 'years' => $years, 'authuser' => $authuser, 'elapsed_time' => $elapsed_time,  'age' => $age, 'today_input_year' => $today_input_year, 'birth_year' => $birth_year, 'birth_month' => $birth_month, 'birth_day' => $birth_day, 'join_year' => $join_year, 'join_month' => $join_month, 'join_day' => $join_day]);
    }

    // アップデート確認画面の表示
    public function update_confirm(Request $request, User $user)
    {

        $authuser = Auth::user();

        // users.join_date(入社日)：入力した値とDBの保存した値を比較
        $join_date_comparison = new \DateTime($user->join_date);
        $join_year_comparison = $join_date_comparison->format("Y");
        $join_month_comparison = $join_date_comparison->format("m");
        $join_day_comparison = $join_date_comparison->format("d");

        // users.birth_date(生年月日)：入力した値とDBの保存した値を比較
        $birth_date_comparison = new \DateTime($user->birth_date);
        $birth_year_comparison = $birth_date_comparison->format("Y");
        $birth_month_comparison = $birth_date_comparison->format("m");
        $birth_day_comparison = $birth_date_comparison->format("d");

        // urlを記入しようとしたら、ユーザー情報詳細ページに遷移させる遷移させる
        if ($request->isMethod('get') || Gate::denies('compare-user', $user)) {
            return redirect()->route('user_info.show', ['user' => $authuser]);
        }

        // 入力したデータを抽出
        $updatedData = $request->only(['last_name', 'first_name', 'last_name_kana', 'first_name_kana', 'gender', 'post_code', 'address1', 'address2', 'address3', 'join_year', 'join_month', 'join_day', 'role', 'birth_year', 'birth_month',  'birth_day', 'birth_date', "join_date"]);

        // 入力した年・月・日をDBの値と同様形式に変換
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

        // 比較に不要な項目は配列から除去
        unset($updatedData['birth_year'], $updatedData['birth_month'], $updatedData['birth_day']);
        unset($updatedData['join_year'], $updatedData['join_month'], $updatedData['join_day']);

        // 比較用(入力内容があるか)配列生成
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

        // 入力(内容修正)がなければ、エラーメッセージを渡し、ユーザー情報詳細ページに遷移させる
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

    // ユーザー情報のアップデート処理
    public function update(UserUpdateRequest $request, User $user)
    {
        //ユーザー情報詳細画面で入力した値をDBの形式
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

        // DBに保存できない項目は配列より削除
        unset($request['birth_year'], $request['birth_month'], $request['birth_day']);
        unset($request['join_year'], $request['join_month'], $request['join_day']);

        // バリデーションした情報を変数に代入
        $updateDate = $request->validated();

        // 入社日、生年月日項目は変更があった際、その値を保存用配列に保存
        if ($birth_date_input != $user->birth_date) {
            $updateDate['birth_date'] = $birth_date_input;
        }
        if ($join_date_input != $user->join_date) {
            $updateDate['join_date'] = $join_date_input;
        }

        // ユーザー情報を更新、更新後はユーザー情報詳細画面へ遷移
        $user->update($updateDate);
        return to_route('user_info.show', ['user' => $user])->with('message', 'ユーザー情報更新完了');
    }

    // ユーザー情報削除確認画面の表示
    public function delete_confirm(User $user)
    {

        $authuser = Auth::user();

        // 対象ユーザーがadmin権限の場合、ユーザー情報詳細画面へ遷移させる
        if (Gate::allows('admin-delete-limit', $user)) {
            return redirect()->route('user_info.show', ['user' => $authuser]);
        // admin権限を持っていない場合、ユーザー情報詳細画面へ遷移させる
        } elseif (Gate::denies('compare-user-delete', $user)) {
            return redirect()->route('user_info.show', ['user' => $authuser]);
        }
        return view('user_info.delete_confirm', ['user' => $user]);

    }

    // ユーザー情報の削除処理
    public function destroy(User $user)
    {
        //DBでユーザー情報を削除
        $user->delete();

        return to_route('user_info.index')->with('message', 'ユーザー削除完了');
    }

    // プロフィール画像アップロード画面の表示
    public function profile_image(User $user)
    {
        //他ユーザーのプロフィール画像アップロード画面にアクセスしようとしたら、ユーザー情報詳細画面へ遷移させる(adimin権限は例外)
        $authuser = Auth::user();
        if (Gate::denies('compare-user', $user)) {
            return redirect()->route('user_info.show', ['user' => $authuser]);
        }
        return view('user_info.profile_image', ['user' => $user]);
    }

    // プロフィール画像のアップデート処理
    public function profile_image_update(Request $request, User $user)
    {

        // ファイルが存在する場合
        if ($request->hasFile('profile_image')) {
            // ファイルを変数に代入
            $file = $request->file('profile_image');
            
            if ($file !== null) {
                // ファイルをstorage/app/public/usersに保存
                $savedFilePath = $file->store('users', 'public');
                //ユーザーのプロフィール画像経路情報を保存したファイルの経路にする 
                $user->profile_image =  $savedFilePath;

            // ファイルがなければ、既存のファイルを維持する
            } else {
                Log::error('ファイルが取得できませんでした');
                $savedFilePath = old($user->profile_image);
            }
        // ファイルがなければ、既存のファイルを維持する
        } else {
            Log::warning('ファイルがアップロードされていません');
            $savedFilePath = old($user->profile_image);
        }

        // ユーザー情報を更新(プロフィール画像の経路)
        $user->save();
        return to_route('user_info.show', ['user' => $user])->with('message', 'プロフィール画像、アップロード完了');
    }
}
