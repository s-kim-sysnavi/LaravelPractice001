<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','社員情報管理アプリα')</title>
    @yield('css')
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        header {
            height: 10%;
            background-color: rgb(0, 200, 255);
            color: white;
            text-align: center;
            line-height: 50px;
        }

        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 20px;
            background-color: #f5f5f5;
            box-sizing: border-box;
        }

        footer {
            height: 10%;
            background-color: rgb(0, 200, 255);
            color: white;
            text-align: center;
            line-height: 50px;
        }

        .circle-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            transition: box-shadow 0.3s ease;
        }

        .circle-image:hover {
            box-shadow: 0 4px 8px rgba(0, 150, 255, 0.9);
        }

        .circle-image-for-modal {
            width: 60%;
            border-radius: 50%;
            object-fit: cover;
            transition: box-shadow 0.3s ease;
        }

        .button-link {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 11px;
            border: none;
        }

        .button-link:hover {
            background-color: #0056b3;
        }

        .logout-button {
            position: absolute;
            top: 10%;
            right: 5px;
            display: flex;
            padding: 20px 20px;
            margin: 5px;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 11px;
            border: none;
        }

        .logout-button:hover {
            background-color: #0056b3;
        }

        .login-info {
            background-color: #808080;
            color: white;
            font-weight: bold;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 10px;
            max-width: 350px;
            margin: 20px auto;

        }

        .login-user-icon {


            width: 50px;
            height: 50px;
            border-radius: 50%;
            position: absolute;
            top: 10%;
            right: 5px;
            display: flex;
            margin: 5px;
            border: none;
            object-fit: cover;
            transition: box-shadow 0.3s ease;
        }

        .login-user-icon-name {


            width: 70px;
            height: 50px;
            border-radius: 50%;
            position: absolute;
            top: 10%;
            right: 65px;
            display: flex;
            margin: 5px;
            border: none;
            object-fit: cover;
            transition: box-shadow 0.3s ease;
        }

        .login-user-icon:hover {
            box-shadow: 0 4px 8px rgba(0, 150, 255, 0.9);
        }

        /* モーダルの背景 */
        .modal {
            display: none;
            /* 初期状態で非表示 */
            position: fixed;
            z-index: 10;
            left: 37%;
            top: -25%;
            width: 100%;
            height: 100%;
            /* background-color: rgba(0, 0, 0, 0.5); */
            /* 背景を半透明に */
        }

        /* モーダルのコンテンツ */
        .modal-content {
            background-color: white;
            padding: 20px;
            width: 300px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            text-align: center;
        }

        /* 閉じるボタン */
        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        /* モーダル内のボタン */
        .modal-btn {
            display: block;
            width: 70%;
            padding: 10px;
            margin: 10px 0;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-align: center;
        }

        .logout-btn {

            display: block;
            width: 70%;
            padding: 10px;
            margin: 10px 0;
            text-decoration: none;
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
            text-align: center;
        }
    </style>
    @yield('css')
</head>

<body>
    <script src='{{ asset('js/login_user_modal.js') }}' defer></script>
    <div class="container">
        <header> ヘッダー </header>
        <main>

            <!-- <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="logout-button" type="submit">ログアウト</button>
            </form> -->
            <!-- プロフィール画像 -->
            <div>
                <a class="login-user-icon-name">
                    <p>{{ auth()->user()->last_name." ".auth()->user()->first_name }}</p>
                </a>

                <img src="{{ asset('storage/'.auth()->user()->profile_image) }}" alt="プロフィール画像" class="login-user-icon" id="profileImage">

            </div>

            <!-- モーダル -->
            <div id="profileModal" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <h5>{{ auth()->user()->last_name }} {{ auth()->user()->first_name }}様、よろしくお願いいたします。</h5>
                    <a href="{{ route('user_info.profile_image', ['user' => auth()->user()]) }}" class="modal-btn">プロフィール画像</a>
                    <a href="{{ route('user_info.show', ['user' => auth()->user()]) }}" class="modal-btn">マイページ</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">ログアウト</button>
                    </form>
                </div>
            </div>



            <h2>@yield('title','社員情報管理アプリα')</h2>
            @yield('content')


        </main>
        <footer> フッター</footer>
    </div>
</body>

</html>