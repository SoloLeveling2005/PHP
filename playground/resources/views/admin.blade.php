<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AdminPanel</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            * {
                padding: 0;
                margin: 0;
            }
            body {
                display:flex;
                width: 100vw;
                height: 100vh;
                align-items: center;
                justify-content: center;
            }
            form {
                display: flex;
                flex-direction: column;
            }
            input {
                padding: 7px;
                margin: 5px;
                font-size: 16px;
            }
            input[type=submit] {
                background-color: #fff;
                border:1px solid black;
                border-radius: 7px;
                padding: 10px;
            }
            input[type=submit]:hover {
                background-color: #eaeaea;
                cursor: pointer;
            }
            .main {
                width: 100vw;
                height: 100vh;
            }
        </style>
    </head>
    <body class="container">
    @if($role == "guest")
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input name="username" type="text" placeholder="username">
            <input name="password" type="password" placeholder="password">
            <input type="submit" value="Авторизоваться">
        </form>
    @else
        <section class="main">
            Hello
        </section>
    @endif

{{--    <script src="/js/app.js"></script>--}}
    </body>
</html>
