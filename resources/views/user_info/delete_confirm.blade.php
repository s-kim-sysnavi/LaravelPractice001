@extends('layouts.default')

@section('title', '削除確認画面')

@section('css')
<style>
    .delete-info {
        display: flex;
        border: 2px solid #ccc;
        border-radius: 10px;
        background-color: #808080;
        color: white;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 600px;
        /* 必要に応じて調整 */
        margin: 0 auto;
        border-radius: 10px;
    }

    .delete-info p {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        max-width: 500px;
        /* 必要に応じて調整 */
        margin: 10px 0;
    }

    .key {
        flex: 1;
        text-align: right;
        padding-right: 10px;
        font-weight: bold;
    }

    .value {
        flex: 2;
        text-align: left;
        padding-left: 10px;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .delete-modal {
        background-color: white;
        padding: 30px;
        width: 435px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        position: relative;
    }

    .delete-modal button {
        margin: 10px;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .delete-modal .confirm-button {
        background-color: red;
        color: white;
    }

    .delete-modal .cancel-button {
        background-color: gray;
        color: white;
    }
</style>
@endsection

@section('content')

<script src="{{ asset('js/call_delete_modal.js') }}" defer></script>


<form action="{{route('user_info.destroy',['user' => $user])}}" method="post" id="deleteForm"
    class="delete-info">
    @csrf
    @method('DELETE')



    <p>
        <a class="key"><label for="id">ID:</label></a><a
            class="value">{{old('id',$user -> id)}}</a>
    </p>
    <p>
        <a class="key"><label for="email">Email:</label></a><a
            class="value">{{old('email',$user -> email)}}</a>
    </p>
    <p>
        <a class="key"><label for="name">名前:</label></a><a
            class="value">{{old('last_name',$user -> last_name)}} {{old('first_name',$user -> first_name)}}</a>
    </p>
    <p>
        <a class="key"><label for="gender">性別:</label></a><a
            class="value">{{old('gender',$user -> gender)}}</a>
    </p>
    <p>
        <a class="key"><label for="address">住所:</label></a><a
            class="value">{{old('address',$user -> address)}}</a>
    </p>
    <p>
        <a class="key"><label for="join_year">入社年度:</label></a><a
            class="value">{{old('join_year',$user -> join_year)}}</a>
    </p>
    <button type="button" class="button-link" id="openModalBtn">削除</button>
</form>

<div class="modal-overlay" id="modalOverlay">
    <div class="delete-modal">
        <p>該当社員の情報を本当に削除しますか？</p>
        <p>削除した情報は復旧できませんので、ご理解のほどよろしくお願いいたします。</p>
        <button class="confirm-button" id="deleteConfirmButton">完全に削除</button>
        <button class="cancel-button" id="closeModalButton">キャンセル</button>
    </div>
</div>

<button onclick="history.back()" class="button-link">戻る</button>

@endsection