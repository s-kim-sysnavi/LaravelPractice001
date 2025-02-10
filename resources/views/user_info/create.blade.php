@extends('layouts.default_before_login')

@section('title', '社員登録画面')
@section('content')

<h1>会員登録画面</h1>

@if($errors->any())
<div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
    <ul>
        @foreach($errors->all() as $error)
        <li class="text-red-400">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('user_info.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    <label for="email">Eメール:</label>
    <input type="text" id="email" name="email" value="{{old('email')}}" required />

    <label for="password">パスワード:</label>
    <input type="password" id="password" name="password" required />

    <label for="password_confirmation">パスワード確認:</label>
    <input type="password" name="password_confirmation" required>
    <br>

    <label for="last_name">姓:</label>
    <input type="text" id="last_name" name="last_name" class="form-input" value="{{old('last_name')}}" required>

    <label for="first_name">名:</label>
    <input type="text" id="first_name" name="first_name" class="form-input" value="{{old('first_name')}}" required>

    <label for="gender">性別:</label>
    <select id="gender" name="gender" class="form-input" required>
        <option value="">選択してください</option>
        <option value="男">男</option>
        <option value="女">女</option>
    </select>

    <label for="address">住所:</label>
    <input type="text" id="address" name="address" class="form-input" value="{{old('address')}}" required>

    <label for="join_year">入社年度:</label>
    <select id="join_year" name="join_year" required>
        @foreach ($join_year as $year)
        <option value="{{ $year }}">{{ $year }}</option>
        @endforeach
    </select>



    <button type="submit" class="button-link">登録</button>
</form>

<a href="{{route('login')}}" class="button-link">ログイン画面へ</a>

@endsection