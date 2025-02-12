@extends('layouts.default_before_login')

@section('title', '社員登録画面')

@section('css')
<style>
    button:disabled {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
    }

    .error {
        color: red;
        font-size: 12px;
        margin-bottom: 10px;
        display: block;
    }

    .toggle-form {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px;
        height: 30px;
        background-color: #ddd;
        border-radius: 15px;
        position: relative;
        cursor: pointer;
    }

    .slider {
        position: absolute;
        width: 50px;
        height: 30px;
        background-color: #007BFF;
        border-radius: 15px;
        transition: left 0.3s;
        left: 0;
        border-radius: 15px;
    }

    .option {
        position: absolute;
        width: 50px;
        text-align: center;
        font-size: 12px;
        color: white;
        pointer-events: none;
    }

    .option.left {
        left: 5px;
    }

    .option.right {
        right: 5px;
    }

    .year-selector {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-family: Arial, sans-serif;
        width: 300px;
        height: 50px;
        position: relative;
        overflow: hidden;
        background-color: #ddd;
        border-radius: 15px;
    }

    .year {
        font-size: 15px;
        opacity: 0.5;
        transition: all 0.3s;
    }

    .year.active {
        font-size: 40px;
        color: blue;
        font-weight: bold;
        opacity: 1;
        animation: bounce 0.5s;
    }

    .year-selector>div {
        display: flex;
        top: 0;
        left: 0;
        right: 0;
        transition: transform 0.5s ease;
    }

    .years-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
    }

    /* @ keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40 % {
            transform:
                translateY(-10px);
        }

        60 % {
            transform:
                translateY(-5px);
        }
    } */

    .click-region {
        width: 30px;
        height: 30px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #555;
        border-radius: 50%;
        position: relative;
    }

    .click-region:hover {
        background-color: #333;
    }

    .click-region::before {
        content: "";
        width: 0;
        height: 0;
        border-style: solid;
        position: absolute;
    }

    .click-region.left::before {
        border-width: 6px 10px 6px 0;
        border-color: transparent white transparent transparent;
        left: 8px;
    }

    .click-region.right::before {
        border-width: 6px 0 6px 10px;
        border-color: transparent transparent transparent white;
        right: 8px;
    }

    .click-region.left {
        position: relative;
        order: -10;
    }

    .click-region.right {
        position: relative;
        order: 10;
    }
</style>
@endsection

@section('content')

<h1>会員登録画面</h1>
<script src='{{ asset('js/gender_toggle_button.js') }}' defer></script>
<script src='{{ asset('js/join_year_selector.js') }}' defer></script>
<script src='{{ asset('js/register_form_validation.js') }}' defer></script>
<!-- <script>
    alert("<%=message%>");
</script> -->

<!-- @if($errors->any())
<div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
    <ul>
        @foreach($errors->all() as $error)
        <li class="text-red-400">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif -->
@if ($errors->any())
    <script>
        alert("{{ $errors->first() }}");
    </script>
@endif
<form action="{{route('user_info.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    <label for="email">Eメール:</label>
    <input type="text" id="email" name="email" value="{{old('email')}}" required />
    <div id="emailError" class="error"></div>

    <label for="password">パスワード:</label>
    <input type="password" id="password" name="password" required />
    <div id="passwordError" class="error"></div>

    <label for="password_confirmation">パスワード確認:</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>
    <div id="passwordConfirmError" class="error"></div>
    <br>

    <label for="last_name">姓:</label>
    <input type="text" id="last_name" name="last_name" class="form-input" value="{{old('last_name')}}" required>
    <div id="lastNameError" class="error"></div>

    <label for="first_name">名:</label>
    <input type="text" id="first_name" name="first_name" class="form-input" value="{{old('first_name')}}" required>
    <div id="firstNameError" class="error"></div>

    <label for="gender">性別:</label>
    <select id="gender" name="gender" class="form-input" style="display:none" required>
        <option value="男" selected>男</option>
        <option value="女">女</option>
    </select>
    <div id="toggleForm" class="toggle-form">
        <div class="slider"></div>
        <div class="option left">男</div>
        <div class="option right">女</div>
    </div>
    <div id="genderError" class="error"></div>

    <label for="address">住所:</label>
    <input type="text" id="address" name="address" class="form-input" value="{{old('address')}}" required>
    <div id="addressError" class="error"></div>

    <label for="join_year">入社年度:</label>
    <div class="year-selector" id="yearSelector">
        <div class="click-region left"></div>
        <div class="years-container"></div>
        <div class="click-region right"></div>
    </div>
    <input type="hidden" id="join_year" name="join_year" required>
    <div id="joinYearError" class="error"></div>



    <button type="submit" class="button-link">登録</button>
</form>

<a href="{{route('login')}}" class="button-link">ログイン画面へ</a>


@endsection