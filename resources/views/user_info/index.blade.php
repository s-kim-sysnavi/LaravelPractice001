@extends('layouts.default')

@section('title', '社員情報リスト')

@section('css')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc;
    }

    .user-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
        object-fit: cover;
        transition: box-shadow 0.3s ease;

    }

    .user-icon:hover {
        box-shadow: 0 4px 8px rgba(0, 150, 255, 0.9);
    }

    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .kana-name {
        font-size: 0.7rem;
        color: blue;
    }
</style>
@endsection

@section('content')

@if (session('message'))
<script>
    alert("{{ session('message') }}");
</script>
@endif

<table border="1">
    <tr bgcolor="#cccccc">
        <th>id </th>
        <th>プロフィール画像</th>
        <th>Eメールアドレス </th>
        <th>アカウント権限 </th>
        <th>姓名</th>
        <th>性別</th>
        <th>住所</th>
        <th>入社年度</th>
        <th>変更</th>
        <th>削除</th>
    </tr>
    @if ($authuser -> role == 'admin')

    @foreach ( $users as $user )
    <tr>

        <td>{{$user -> id}}</td>
        <td> <a href="{{route('user_info.profile_image',['user'=>$user])}}">
                <img src="{{ asset('storage/'.$user->profile_image) }}"
                    alt="プロフィール画像" class="user-icon" id="profileImage"></a>
        </td>
        <td>{{$user -> email}}</td>
        <td>{{$user -> role}}</td>
        <td>
            <p>{{$user -> last_name.' '.$user -> first_name}}</p>
            <p class="kana-name">({{$user -> last_name_kana.' '.$user -> first_name_kana}})</p>
        </td>
        <td>{{$user -> gender}}</td>
        <td>〒{{ substr(strval($user-> post_code),0,3).
        '-'.substr(strval($user-> post_code),3) }}
            {{$user -> address1.$user-> address2.$user-> address3}}
        </td>
        <td>{{$user -> join_date}}</td>
        <td><a href="{{route('user_info.show',['user'=> $user])}}" class="button-link">詳細</a></td>
        @if ($user->role == 'admin' && $user->role == $authuser -> role)
        <td><a>-</a></td>
        @else
        <td><a href="{{route('user_info.delete_confirm',['user'=> $user])}}"
                class="button-link">削除</a></td>
        @endif


    </tr>
    @endforeach
    @else
    @foreach ( $users as $user )
    <tr>
        <td>{{$user -> id}}</td>
        <td>
            @if ($user -> id == $authuser ->id)
            <a href="{{route('user_info.profile_image',['user'=>$user])}}">
                <img src="{{ asset('storage/'.$user->profile_image) }}"
                    alt="プロフィール画像" class="user-icon" id="profileImage"></a>
            @else
            <img src="{{ asset('storage/'.$user->profile_image) }}"
                alt="プロフィール画像" class="user-icon" id="profileImage">
            @endif
        </td>
        <td>{{$user -> email}}</td>
        <td>{{$user -> role}}</td>
        <td>
            <p>{{$user -> last_name.' '.$user -> first_name}}</p>
            <p class="kana-name">({{$user -> last_name_kana.' '.$user -> first_name_kana}})</p>
        </td>
        <td>{{$user -> gender}}</td>
        @if ($authuser -> id == $user -> id)
        <td>〒{{ substr(strval($user-> post_code),0,3).
        '-'.substr(strval($user-> post_code),3) }}
            {{$user -> address1.$user-> address2.$user-> address3}}
        </td>

        <td>{{$user -> join_date}}</td>
        <td><a href="{{route('user_info.show',['user'=> $user])}}" class="button-link">詳細</a></td>
        <td><a>-</a></td>
        @else
        <td>-</td>
        <td>-</td>
        <td><a>-</a></td>
        <td><a>-</a></td>
        @endif
    </tr>
    @endforeach
    @endif
</table>

<form action="{{route("top")}}" method="get">
    <input type="submit" value="トップ画面へ" class="button-link">
</form>
@endsection