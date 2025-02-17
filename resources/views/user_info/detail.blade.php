@extends('layouts.default')


@section('title', '社員情報-詳細')

@section('css')
<style>
    .form-input {
        font-size: 16px;
        color: #313;
    }

    form {
        padding: 30;
        margin: 30;
    }

    button:disabled {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
    }
    .info{
        font-size: 0.6rem;
        color: grey;
    }
</style>
@endsection

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src='{{ asset('js/post_code_search.js') }}' defer></script>

@if (session('message'))
<script>
    alert("{{ session('message') }}");
</script>
@endif

<form action="{{route('user_info.update_confirm',['user' => $user])}}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
        <p>プロフィール画像</p>
        <a href="{{route('user_info.profile_image',['user'=>$user])}}">
            <img src=" {{asset('storage/'.$user->profile_image)}}" alt="" class="circle-image">
        </a>
    </div>
    <div><label for="id">Id：{{$user -> id}}</label> </div>
    <div><label for="email">Email：{{$user -> email}}</label> </div>
    <!-- <input type="hidden" value="{{old('email',$user -> email)}}"> -->
    <div class="form-input">
        氏名：
        <label for="last_name"></label>
        <input id="last_name" name="last_name" type="text" value="{{old("last_name",$user->last_name)}}">
        <label for="first_name"></label>
        <input id="first_name" name="first_name" type="text" value="{{old("first_name",$user->first_name)}}">
    </div>
    <div class="form-input">
        氏名(カナ)：
        <label for="last_name_kana"></label>
        <input id="last_name_kana" name="last_name_kana" type="text" value="{{old("last_name_kana",$user->last_name_kana)}}">
        <label for="first_name_kana"></label>
        <input id="first_name_kana" name="first_name_kana" type="text" value="{{old("first_name_kana",$user->first_name_kana)}}">
    </div>
    <div class="form-input">
        <label for="gender">性別:</label>
        <select id="gender" name="gender">
            <option value="男" @selected(old('gender', $user->gender ?? '') == '男')>男</option>
            <option value="女" @selected(old('gender', $user->gender ?? '') == '女')>女</option>
        </select>
    </div>

    <div>
        生年月日：

        <select id="birth_year" name="birth_year" required>
            @for ($year = 1950; $year <= $today_input_year; $year++)
                <option value="{{ $year }}"
                {{ old('birth_year', $birth_year) == $year ? 'selected' : '' }}>
                {{ $year }}年
                </option>
                @endfor
        </select>

        <select id="birth_month" name="birth_month" required>
            @for ($month=1 ; $month<=12 ; $month++ ){
                <option value="{{ $month }}" @selected(old('birth_month', $birth_month ?? '' )==$month)>{{ $month }}月</option>

                }@endfor
        </select>

        <select id="birth_day" name="birth_day" required>
            @for ($day=1 ; $day<=31 ; $day++ ){
                <option value="{{ $day }}" @selected(old('birth_day', $birth_day ?? '' )==$day)>{{ $day }}日</option>
                }@endfor
        </select>

        (満 {{ $age }}歳)

    </div>


    <br>

    <div class="form-input">
        <p>
            〒<input type="text" id="post_code" name="post_code" maxlength="7" value="{{ old('post_code',$user -> post_code) }}" required>
            <button type="button" id="search">検索</button>
        </p>
        <p>住所：
            <input type="text" id="address1" name="address1" value="{{ old('address1',$user -> address1) }}">
            <input type="text" id="address2" name="address2" value="{{ old('address2',$user -> address2) }}">
            <input type="text" id="address3" name="address3" value="{{ old('address3',$user -> address3) }}">
        </p>
    </div>



    <div>
        入社日：
        <select id="join_year" name="join_year" required>
            @foreach ($years as $year)
            <option value="{{ $year }}" @selected(old('join_year', $join_year ?? '' )==$year)>{{ $year }}年</option>
            @endforeach
        </select>
        <select id="join_month" name="join_month" required>
            @for ($month=1 ; $month<=12 ; $month++ ){
                <option value="{{ $month }}" @selected(old('join_month', $join_month ?? '' )==$month)>{{ $month }}月</option>

                }@endfor
        </select>
        <select id="join_day" name="join_day" required>
            @for ($day=1 ; $day<=31 ; $day++ ){
                <option value="{{ $day }}" @selected(old('join_day', $join_day ?? '' )==$day)>{{ $day }}日</option>

                }@endfor
        </select>
        <a>(現在 {{ $elapsed_time }} 勤続)</a>


    </div>


    @if ($authuser -> role== 'admin' && $user -> role != 'admin')
    <div>
        権限：
        <select id="role" name="role">
            <option value="admin" @selected(old('role', $user->role ?? '') == 'admin')>管理者</option>
            <option value="user" @selected(old('role', $user->role ?? '') == 'user')>ユーザー</option>
        </select>
    </div>
    <div class="form-input">
        ポジション：
        <select id="position" name="position">
            <option value=0>代表</option>
            <option value=1>部長</option>
            <option value=2>キャプテン</option>
            <option value=3>エンジニア</option>
            <option value=4>管理(総務・人事・会計)</option>
            <option value=5>管理()</option>
        </select>
    </div>
    @else
    <div>
        権限：{{ old('role', $user->role ) }}
        <input type="hidden" id="role" name="role" value="{{old('role', $user->role )}}">
    </div>
    <div class="form-input">
        ポジション：エンジニア
    </div>
    <div class="info">
        <p>
                情報登録日：{{$user -> created_at}}
        </p>
        <p>
                情報更新日：{{$user -> updated_at}}
        </p>
    </div>
    @endif

    <input type="submit" value="修正" class="button-link">
</form>

@if ($authuser -> role == 'admin' && $authuser -> role == $user->role)
<script>
    function toggleSubmitButton() {
        const submitButton = document.getElementById('button-link-admin');

        submitButton.disabled
    }
</script>
<input type="submit" value="削除" id="button-link-admin" class="button-link">

@elseif ($authuser -> role == 'admin')
<form action="{{route('user_info.delete_confirm',['user' => $user])}}" method="get">
    <input type="submit" value="削除" class="button-link">
</form>
@endif

<form action="{{route('user_info.index')}}" method="get">
    <input type="submit" value="社員情報一覧へ" class="button-link">
</form>

<form action="{{route('top')}}" method="get">
    <input type="submit" value="トップ画面へ" class="button-link">
</form>
@endsection