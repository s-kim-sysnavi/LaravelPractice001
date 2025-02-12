@extends('layouts.default')

@section('title', '更新確認画面')
@section('content')

<form action="{{route('user_info.update',['user' => $user])}}" method="post">
    @csrf
    @method('PUT')

    <div class="form-input">
        id：
        <a class="old-value">{{old('id',$user -> id)}}</a>
    </div>


    <div class="form-input">
        Email：
        <a class="old-value">{{old('email',$user -> email)}}</a>
        <!-- <input type="hidden" value="{{old('email',$user -> email)}}"> -->
        <!-- <a class="arrow-mark">→</a>
        <a class="new-value">{{old('email',$request -> email)}}</a> -->

    </div>

    <div class="form-input">
        氏：
        <a class="old-value">{{old('last_name',$user -> last_name)}}</a>
        @if ($request -> last_name != old('last_name',$user -> last_name))
        <a class="arrow-mark">→</a>
        <input name="last_name" type="text" value="{{old('last_name',$request -> last_name)}}" class="new-value" readonly>
        @endif
    </div>
    <div class="form-input">
        名：
        <a class="old-value">{{old('first_name',$user -> first_name)}}</a>
        @if ($request -> first_name != old('first_name',$user -> first_name))
        <a class="arrow-mark">→</a>
        <input name="first_name" type="text" value="{{old('first_name',$request -> first_name)}}" readonly>
        @endif
    </div>

    <div class="form-input">
        性別
        <a class="old-value">{{old('gender',$user -> gender)}}</a>
        @if ($request -> gender != old('gender',$user -> gender))
        <a class="arrow-mark">→</a>
        <input name="gender" type="text" value="{{old('gender',$request -> gender)}}" class="new-value" readonly>
        @endif
    </div>

    <div class="form-input">
        住所
        <a class="old-value">{{old('address',$user -> address)}}</a>
        @if ($request -> address != old('address',$user -> address))
        <a class="arrow-mark">→</a>
        <input name="address" type="text" value="{{old('address',$request -> address)}}" class="new-value" readonly>
        @endif
    </div>



    <div>
        入社年度：
        <a class="old-value">{{old('join_year',$user -> join_year)}}</a>
        @if ($request -> join_year != old('join_year',$user -> join_year))
        <a class="arrow-mark">→</a>
        <input name="join_year" type="text" value="{{old('join_year',$request -> join_year)}}" class="new-value" readonly>
        @endif

    </div>

    <div class="form-input">
        ポジション：test
    </div>
    <input type="submit" value="修正" class="button-link">

</form>

<!-- <form action="{{route('top') }}" method="get">
    <input type="submit" value="プロフィール修正" class="button-link">
</form> -->

<button onclick="history.back()" class="button-link">戻る</button>

@endsection