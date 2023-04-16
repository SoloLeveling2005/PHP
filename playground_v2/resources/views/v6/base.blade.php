<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        .bg-grey-50 {
            background-color: rgb(212, 212, 212);
        }
        .col {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    @yield('body')
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
</body>
</html>