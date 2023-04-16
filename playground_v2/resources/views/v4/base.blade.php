<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>@yield('title')</title>
    <style>
        a {
            /* text-decoration: none; */

        }
        form {
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>
</head>
<body>
    @yield('body');
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
</body>
</html>