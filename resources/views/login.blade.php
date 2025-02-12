@extends('layouts.default_before_login')
@section('title', 'ログイン画面')

@section('content')

<h1>ログイン</h1>
@if (session('message'))
<script>
    alert("{{ session('message') }}");
</script>
@endif

<form action="{{route('login')}}" method="post">
    @csrf
    <label for="email">Email:</label> <input type="text"
        name="email" id="email" value="{{old('email')}}"><br> <label
        for="password">PassWord:</label> <input type="password"
        name="password" id="password"><br>
    <button class="button-link" type="submit">ログイン</button>
</form>
<form action="{{route('user_info.create')}}" method="get">
    <button class="button-link" type="submit">会員登録</button>
</form>

@endsection