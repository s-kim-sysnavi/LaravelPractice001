@extends('layouts.default')

@section('title', '更新確認画面')

@section('css')

@endsection
<style>
    .drag-and-drop {
        width: 60%;
        height: 100px;
        border: 2px dashed #007BFF;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f9f9f9;
        color: #999;
    }

    .drag-and-drop.dragover {
        background-color: #e0e0e0;
        border-color: #0056b3;
    }

    .circle-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        transition: box-shadow 0.3s ease;
    }

    .preview {
        display: flex;
        flex-wrap: wrap;
        margin-top: 10px;
        gap: 10px;
        justify-content: center;
        align-items: center;
    }

    .preview img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        border-color: #007BFF;
    }

    .dragged {
        background-color: #555;
        color: white;
    }
</style>
@section('content')
<script src="{{ asset('/js/profile_upload.js') }}"></script>

<p>
    <label for="file">▼現在のプロフィール画像:</label>
</p>
<p>
    <img src="{{asset('storage/'.$user->profile_image)}}" alt="プロフィール画像"
        class="circle-image">
</p>

<p>▼今回、アップロードする画像</p>
<p id="file-info"></p>
<div id="preview" class="preview"></div>
<p>
<div id="drag-and-drop" class="drag-and-drop">
    <p>ここにファイルをドラッグアンドドロップしてください。</p>
</div>
</p>

<form id="upload-form" action="{{route('user_info.profile_image_update',['user' => $user])}}" method="post"
    enctype="multipart/form-data">
    @csrf
    <input type="file" name="profile_image" id="file"
        style="display: none;">
    <p>
        <button type="submit" class="button-link">アップロード</button>
    </p>
</form>



<form action="{{route('user_info.show',['user' => $user])}}" method="get">
    <input type="submit" value="社員情報詳細へ" class="button-link">
</form>

<form action="{{route('top')}}" method="get">
    <input type="submit" value="トップ画面へ" class="button-link">
</form>
@endsection