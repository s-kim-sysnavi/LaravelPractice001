@extends('layouts.default')

@section('title', 'トップ画面')

@section('css')
<style>
    .custom-modal {
        display: block;
        position: fixed;
        top: 55px;
        left: 10px;
        background-color: transparent;
        width: auto;
        height: auto;
        z-index: 1000;
    }

    .custom-modal-content {
        background-color: white;
        padding: 15px;
        width: 350px;
        /*モーダルの大きさ調整はこの属性*/
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .custom-close {
        float: right;
        font-size: 20px;
        color: #007BFF;
        font-weight: bold;
        cursor: pointer;
        font-weight: bold;
    }

    .easter-egg {
        position: fixed;
        top: 75%;
        left: -200px;
        /* 初期位置: 画面外 (左) */
        transform: translateY(-50%);
        transition: left 1s ease-in-out;
        width: 150px;
        height: auto;
        display: none;
        z-index: 1000;
    }

    /* イースターエッグを表示するクラス */
    .easter-egg.show {
        left: -15px;
        /* 画面左端から少し出る */
    }

    .wellcome {
        position: fixed;
        top: 120%;
        left: 75%;
        transform: translateY(-50%);
        width: 150px;
        height: auto;
        visibility: hidden;
        z-index: 1000;
        transform: translateY(-50%);
        width: 150px;
        height: auto;
        visibility: hidden;
    }
</style>
@endsection


@section('content')

<script src='{{ asset('js/call_login_modal.js') }}' defer></script>




@if (session('message'))

<script>
    alert("{{ session('message') }}");
</script>
@endif

<div id="customModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="custom-close">&times;</span>
        <h2>モーダル</h2>
        <p>
            <img src="storage/users/guide_rakko.jpg" alt="モーダル画像"
                class="circle-image-for-modal">
        </p>
        <p>画像を5回クリックしてみてください。</p>
        <label> <input type="checkbox" id="modalSetting">
            次回より非表示にする
        </label>
    </div>
</div>
<div id="easterEgg" class="easter-egg">
    <img src="storage/users/easteregg.png" alt="イースターエッグ">
</div>

<div id="wellcome" class="wellcome">
    <img src="storage/users/yoroshiku.png" alt="ウェルカム">
</div>


</form>
<p>TSET用：250212</p>

<a href="{{route('user_info.index')}}" class="button-link">社員情報一覧</a>


@endsection