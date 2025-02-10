@extends('layouts.default')

@section('title', 'トップ画面')
@section('content')
</form>
<p>TSET用：250210</p>
<p>
    <label for="file">プロフィール写真:</label>
    <img src="{{asset('storage/'.$user->profile_image)}}" alt="" class="circle-image">
</p>


<a href="{{route('user_info.show',['user'=>$user])}}"
    class="button-link">プロフィール詳細</a>
<a href="{{route('user_info.index')}}" class="button-link">社員情報一覧</a>

<div align="left" class="login-info">
    <p>ログインユーザー情報</p>
    <p>ID:{{$user -> id}}</p>
    <p align="right"></p>
    <p>現在ログインしているユーザー：{{$user -> last_name." ".$user -> first_name}}</p>
    <p align="right"></p>
    <p>あなたの権限：{{$user -> role}}</p>
    <p align="right"></p>
</div>

@endsection