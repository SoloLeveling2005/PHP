<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            * {
                padding: 0;
                margin: 0;
            }
            body {
                width: 100vw;
                height: 100vh;
                font-family: 'Nunito', sans-serif;
                display: flex;
                align-items: center;
                justify-content: center;

            }
            input {
                outline:none;
                font-size: 20px;
            }
            form {
                padding: 10px;
                display: flex;
                flex-direction: column;
            }
            form input {
                margin: 5px;
                padding: 7px;
            }

            input
        </style>
    </head>
    <body class="antialiased">
        <form method="POST" action="{{ url('/XX-module-a/auth/auth') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input name="username" type="text" placeholder="username">
            <input name="password" type="password" placeholder="password">
            <input type="submit" value="Авторизоваться">
        </form>
    </body>
</html>
