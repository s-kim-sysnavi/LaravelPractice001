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
</style>
@endsection
@section('content')

<!-- <div>
    <p>
        <img src="{{asset('storage/'.$user->profile_image)}}" alt="" class="circle-image" }}" alt="">
    </p>

    <p>
        氏名：{{$user->last_name." ".$user->first_name}}
    </p>
    <p>
        Email：{{$user -> email}}
    </p>
    <p>
        性別：{{$user -> gender}}
    </p>
    <p>
        入社日：{{$user ->join_year}}　　(現在勤続期間：)
    </p>
    <p>
        住所：{{$user -> address}}
    </p>
    <p>
        ポジション：エンジニア
    </p>

    <p>
        情報登録日：{{$user -> created_at}}　　情報更新日：{{$user -> updated_at}}
    </p>

</div> -->

<form action="{{route('user_info.update_confirm',['user' => $user])}}" method="get">
    @csrf


    <label for="email">Email：{{$user -> email}}</label>
    <input type="hidden" value="{{old('email',$user -> email)}}">
    <div class="form-input">
        氏名：
        <label for="last_name"></label>
        <input id="last_name" name="last_name" type="text" value="{{old("last_name",$user->last_name)}}">
        <label for="first_name"></label>
        <input id="first_name" name="first_name" type="text" value="{{old("first_name",$user->first_name)}}">
    </div>
    <div class="form-input">
        <label for="gender">性別:</label>
        <select id="gender" name="gender">
            <option value="男" @selected(old('gender', $user->gender ?? '') == '男')>男</option>
            <option value="女" @selected(old('gender', $user->gender ?? '') == '女')>女</option>
        </select>
    </div>

    <div class="form-input">

        <label for="address">住所：</label>
        <input type="text" id="address" name="address" value="{{old('address',$user -> address)}}">
    </div>


    <div>
        入社年度：
        <select id="join_year" name="join_year" required>
            @foreach ($join_year as $year)
            <option value="{{ $year }}" @selected(old('join_year', $user->join_year ?? '') == $year) >{{ $year }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-input">
        ポジション：test
    </div>
    <input type="submit" value="修正" class="button-link">
</form>

<!-- 「トップ画面へ」ボタン -->
<form action="{{route('user_info.delete_confirm',['user' => $user])}}" method="get">
    <input type="submit" value="削除" class="button-link">
</form>

<form action="{{route('top')}}" method="get">
    <input type="submit" value="トップ画面へ" class="button-link">
</form>
@endsection