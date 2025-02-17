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
        氏(カナ)：
        <a class="old-value">{{old('last_name_kana',$user -> last_name_kana)}}</a>
        @if ($request -> last_name_kana != old('last_name_kana',$user -> last_name_kana))
        <a class="arrow-mark">→</a>
        <input name="last_name_kana" type="text" value="{{old('last_name_kana',$request -> last_name_kana)}}" class="new-value" readonly>
        @endif
    </div>
    <div class="form-input">
        名(カナ)：
        <a class="old-value">{{old('first_name_kana',$user -> first_name_kana)}}</a>
        @if ($request -> first_name_kana != old('first_name',$user -> first_name_kana))
        <a class="arrow-mark">→</a>
        <input name="first_name_kana" type="text" value="{{old('first_name_kana',$request -> first_name_kana)}}" readonly>
        @endif
    </div>

    <div class="form-input">
        性別：
        <a class="old-value">{{old('gender',$user -> gender)}}</a>
        @if ($request -> gender != old('gender',$user -> gender))
        <a class="arrow-mark">→</a>
        <input name="gender" type="text" value="{{old('gender',$request -> gender)}}" class="new-value" readonly>
        @endif
    </div>$
    <div class="form-input">
        生年月日：


        <div>
            ┗年度：
            <a class="old-value">{{old('birth_year_comparison',$birth_year_comparison)}}年</a>
            @if ($request -> birth_year != $birth_year_comparison)
            <a class="arrow-mark">→</a>
            <input name="birth_year" type="text" value="{{old('birth_year',$request -> birth_year)}}" class="new-value" readonly>年
            @else
            <input name="birth_year" type="hidden" value="{{old('birth_year',$birth_year_comparison)}}" class="new-value" readonly>

            @endif
        </div>
        <div>
            ┗月：
            <a class="old-value">{{old('birth_month_comparison',$birth_month_comparison)}}月</a>
            @if ($request -> birth_month != $birth_month_comparison)
            <a class="arrow-mark">→</a>
            <input name="birth_month" type="text" value="{{old('birth_month',$request -> birth_month)}}" class="new-value" readonly>月
            @else
            <input name="birth_month" type="hidden" value="{{old('birth_month',$birth_month_comparison)}}" class="new-value" readonly>
            @endif
        </div>
        <div>
            ┗日：
            <a class="old-value">{{old('birth_day_comparison',$birth_day_comparison)}}日</a>
            @if ($request -> birth_day != $birth_day_comparison)
            <a class="arrow-mark">→</a>
            <input name="birth_day" type="text" value="{{old('birth_day',$request -> birth_day)}}" class="new-value" readonly>日
            @else
            <input name="birth_day" type="hidden" value="{{old('birth_day',$birth_day_comparison)}}" class="new-value" readonly>

            @endif
        </div>
    </div>
    <br>
    <div class="form-input">
        住所
        <div>
            ┗〒：
            <a class="old-value">{{old('post_code',$user -> post_code)}}</a>
            @if ($request -> post_code != old('post_code',$user -> post_code))
            <a class="arrow-mark">→</a>
            <input name="post_code" type="text" value="{{old('post_code',$request -> post_code)}}" class="new-value" readonly>
            @endif
        </div>
        <div>
            ┗住所1：
            <a class="old-value">{{old('address1',$user -> address1)}}</a>
            @if ($request -> address1 != old('address1',$user -> address1))
            <a class="arrow-mark">→</a>
            <input name="address1" type="text" value="{{old('address1',$request -> address1)}}" class="new-value" readonly>
            @endif
        </div>
        <div>
            ┗住所2：
            <a class="old-value">{{old('address2',$user -> address2)}}</a>
            @if ($request -> address2 != old('address2',$user -> address2))
            <a class="arrow-mark">→</a>
            <input name="address2" type="text" value="{{old('address2',$request -> address2)}}" class="new-value" readonly>
            @endif
        </div>
        <div>
            ┗住所3：
            <a class="old-value">{{old('address3',$user -> address3)}}</a>
            @if ($request -> address3 != old('address3',$user -> address3))
            <a class="arrow-mark">→</a>
            <input name="address3" type="text" value="{{old('address3',$request -> address3)}}" class="new-value" readonly>
            @endif
        </div>
    </div>


    <br>
    <div>
        <!-- 3つを満たすケースから全部書く？それとも何か方法がある？？考えてみる -->
        入社日
        <div>
            ┗年度：
            <a class="old-value">{{old('join_year_comparison',$join_year_comparison)}}年</a>
            @if ($request -> join_year != old('join_year_comparison',$join_year_comparison))
            <a class="arrow-mark">→</a>
            <input name="join_year" type="text" value="{{old('join_year',$request -> join_year)}}" class="new-value" readonly>年
            @else
            <input name="join_year" type="hidden" value="{{old('join_year',$join_year_comparison)}}" class="new-value" readonly>

            @endif
        </div>
        <div>
            ┗月：
            <a class="old-value">{{old('join_month_comparison',$join_month_comparison)}}月</a>
            @if ($request -> join_month != old('join_month_comparison',$join_month_comparison))
            <a class="arrow-mark">→</a>
            <input name="join_month" type="text" value="{{old('join_month',$request -> join_month)}}" class="new-value" readonly>月
            @else
            <input name="join_month" type="hidden" value="{{old('join_month',$join_month_comparison)}}" class="new-value" readonly>

            @endif
        </div>
        <div>
            ┗日：
            <a class="old-value">{{old('join_day_comparison',$join_day_comparison)}}日</a>
            @if ($request -> join_day != old('join_day_comparison',$join_day_comparison))
            <a class="arrow-mark">→</a>
            <input name="join_day" type="text" value="{{old('join_day',$request -> join_day)}}" class="new-value" readonly>日
            @else
            <input name="join_day" type="hidden" value="{{old('join_day',$join_day_comparison)}}" class="new-value" readonly>

            @endif
        </div>

    </div>
    <br>
    <div>
        権限：
        <a class="old-value">{{old('role',$user -> role)}}</a>
        @if ($request -> role != old('role',$user -> role))
        <a class="arrow-mark">→</a>
        <input name="role" type="text" value="{{$request -> role}}" class="new-value" readonly>
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