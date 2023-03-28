<!doctype html>
<html lang="en" class="w-100 h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <title>@yield('title')</title>
</head>
<body class="w-100 h-100">
    @auth('admin')
    <div class="bg-dark w-100 py-2">
        <ul class="nav nav-tabs w-100 container border-0 d-flex align-items-center" id="myTab" role="tablist">
            <li class="d-flex align-items-center p-0 m-0 me-5">
                <a href="{{route('index')}}" class="text-decoration-none"><h3 class="text-white p-0 m-0 me-5">@yield('profile_name')</h3></a>
            </li>
            @yield('header')

            <a type="button" href="{{route('logout')}}" class="btn text-white p-2 px-3 btn-outline-secondary" style="margin-left: auto">Logout</a>
        </ul>
    </div>
    @endauth
    @yield('main')
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>

</body>
</html>
