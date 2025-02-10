@extends('layouts.default')

@section('title', '社員情報リスト')
@section('content')





<table border="1">
    <tr bgcolor="#cccccc">th>
        <th>id </th>
        <th>Eメールアドレス </th>
        <th>アカウント権限 </th>
        <th>姓名</th>
        <th>性別</th>
        <th>住所</th>
        <th>入社年度</th>
        <th>変更</th>
        <th>削除</th>
    </tr>
    @foreach ( $users as $user )
    <tr>
    <td>{{$user -> id}}</td>
        <td>{{$user -> email}}</td>
        <td>{{$user -> role}}</td>
        <td>{{$user -> last_name.' '.$user -> first_name}}</td>
        <td>{{$user -> gender}}</td>
        <td>{{$user -> address}}</td>
        <td>{{$user -> join_year}}</td>
        <td><a href="{{route('user_info.show',['user'=> $user])}}">詳細</a></td>
        <td><a href="{{route('user_info.delete_confirm',['user'=> $user])}}">削除</a></td>

    </tr>
    @endforeach
</table>


<!-- 「トップ画面へ」ボタン -->
<form action="{{route("top")}}" method="get">
    <input type="submit" value="トップ画面へ" class="button-link">
</form>
@endsection