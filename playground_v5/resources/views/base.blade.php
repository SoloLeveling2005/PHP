<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        body, html {
            width: 100vw;
            height: 100vh;
        }
        a {
            text-decoration: none;
        }
        .bg-grey-light {
            background-color: #e7e7e7 !important;
        }
    </style>
</head>
<body>

@yield('body')

<script src="/js/bootstrap.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
</body>
</html>
