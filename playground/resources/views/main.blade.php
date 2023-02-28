<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-100 h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminPanel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Styles -->
    <style>
        * {
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body class="w-100 h-100">

@yield('content')

<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>

