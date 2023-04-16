<!DOCTYPE html>
<html lang="en" class="w-100 h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        body, html {
            width: 100vw !important;
            height: 100vh !important;
        }
        .bg-grey-light {
            background-color: rgb(221, 221, 221) !important;
        }
        .col {
            display: flex;
            align-items: center;
        }
        a {
            color: black !important;
            text-decoration: none;
        }
    </style>
</head>
<body class="w-100 h-100">

    @yield('body')    

    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
</body>
</html>