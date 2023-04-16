<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tile')</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        html, body {
            width: 100vw !important;
            height: 100vh !important;
        }
        a {
            text-decoration: none;
        }

        .bg-grey-light {
            background-color: #f1f1f1 !important;
        }
    </style>
</head>
<body class="w-100">

@yield('body')

<script src="/js/bootstrap.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
</body>
</html>
