@extends('layouts.default')

@section('title', '削除確認画面')
@section('content')


<form action="{{route('user_info.destroy',['user' => $user])}}" method="post">
    @csrf
    @method('DELETE')

    <div class="form-input">
        Email：
        <a class="old-value">{{old('email',$user -> email)}}</a>

    </div>

    <div class="form-input">
        氏名：
        <a class="old-value">{{old('last_name',$user -> last_name)}}</a>
        <a class="old-value">{{old('first_name',$user -> first_name)}}</a>
    </div>

    <div class="form-input">
        性別
        <a class="old-value">{{old('gender',$user -> gender)}}</a>
    </div>

    <div class="form-input">
        住所
        <a class="old-value">{{old('address',$user -> address)}}</a>
    </div>

    <div>
        入社年度：
        <a class="old-value">{{old('join_year',$user -> join_year)}}</a>
    </div>

    <div class="form-input">
        ポジション：test
    </div>
    <input type="submit" value="削除" class="button-link">

</form>

<!-- <form action="{{route('top') }}" method="get">
    <input type="submit" value="プロフィール修正" class="button-link">
</form> -->

<button onclick="history.back()" class="button-link">戻る</button>

@endsection