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

    .selector-container {
        display: flex;
        justify-content: space-around;
        margin: 20px 0;
    }

    .selector {
        position: relative;
        width: 100px;
        height: 50px;
        overflow: hidden;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        user-select: none;
    }

    .active {
        font-size: 24px;
        color: red;
    }

    .click-region {
        position: absolute;
        top: 0;
        width: 50%;
        height: 100%;
        cursor: pointer;
    }

    .click-region.left {
        left: 0;
    }

    .click-region.right {
        right: 0;
    }
</style>
@endsection

@section('content')

<h1>会員登録画面</h1>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src='{{ asset('js/gender_toggle_button.js') }}' defer></script>
<script src='{{ asset('js/register_form_validation.js') }}' defer></script>
<script src='{{ asset('js/post_code_search.js') }}' defer></script>

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

    <label for="last_name_kana">姓(カナ):</label>
    <input type="text" id="last_name_kana" name="last_name_kana" class="form-input" value="{{old('last_name_kana')}}" required>
    <div id="lastNameKanaError" class="error"></div>

    <label for="first_name_kana">名(カナ):</label>
    <input type="text" id="first_name_kana" name="first_name_kana" class="form-input" value="{{old('first_name_kana')}}" required>
    <div id="firstNameKanaError" class="error"></div>

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

    <div>
        生年月日：
        <select id="birth_year" name="birth_year" required>
            @for ($year = 1950; $year <= $today; $year++){
                <option value="{{ $year }}" {{ old('birth_year',$today-20) == $year ? 'selected' : '' }}>
                {{ $year }}年
                </option>
                }@endfor
        </select>

        <select id="birth_month" name="birth_month" required>
            @for ($month = 1; $month <= 12; $month++)
                <option value="{{ $month }}"
                {{ old('birth_month') == $month ? 'selected' : '' }}>
                {{ $month }}月
                </option>
                @endfor
        </select>

        <select id="birth_day" name="birth_day" required>
            @for ($day = 1; $day <= 31; $day++)
                <option value="{{ $day }}"
                {{ old('birth_day') == $day ? 'selected' : '' }}>
                {{ $day }}日
                </option>
                @endfor
        </select>
    </div>


    <label for="address">住所:</label>
    <div id="address" class="address"></div>
    <p> 郵便番号： <input type="text" id="post_code" name="post_code" maxlength="7" value="{{ old('post_code') }}" required>
        <button type="button" id="search">検索</button>
    </p>
    <div id="postCodeError" class="error"></div>

    <label for="address1">都道府県:</label>
    <input type="text" id="address1" name="address1" value="{{ old('address1') }}">

    <label for="address2">市区町村:</label>
    <input type="text" id="address2" name="address2" value="{{ old('address2') }}">

    <label for="address3">丁番:</label>
    <input type="text" id="address3" name="address3" value="{{ old('address3') }}">

    <div id="address1Error" class="error"></div>
    <div id="address2Error" class="error"></div>
    <div id="address3Error" class="error"></div>
    <div>
        入社日：
        <select id="join_year" name="join_year" required>
            @foreach ($join_year as $year){
            <option value="{{ $year }}" {{ old('join_year',$today) == $year ? 'selected' : '' }}>
                {{ $year }}月
            </option>
            }@endforeach
        </select>

        <select id="join_month" name="join_month" required>
            @for ($month = 1; $month <= 12; $month++)
                <option value="{{ $month }}" {{ old('join_month') == $month ? 'selected' : '' }}>
                {{ $month }}月
                </option>
                @endfor
        </select>

        <select id="join_day" name="join_day" required>
            @for ($day=1 ; $day<=31 ; $day++ ){
                <option value="{{ $day }}" {{ old('join_day') == $day ? 'selected' : '' }}>
                {{ $day }}日
                </option>
                }@endfor
        </select>
    </div>

    <button type="submit" class="button-link">登録</button>
</form>

<a href="{{route('login')}}" class="button-link">ログイン画面へ</a>


@endsection