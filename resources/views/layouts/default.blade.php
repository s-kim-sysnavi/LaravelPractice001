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
    </style>
    @yield('css')
</head>

<body>
    <div class="container">
        <header> ヘッダー </header>
        <main>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="logout-button" type="submit">ログアウト</button>
            </form>
            <h2>@yield('title','社員情報管理アプリα')</h2>
            @yield('content')
            

        </main>
        <footer> フッター</footer>
    </div>
</body>

</html>