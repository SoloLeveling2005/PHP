@if(Auth::user())
<header class="w-100 bg-dark">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{route('admins')}}" class="me-3 text-white">Admins</a>
            <a href="{{route('users')}}" class="me-3 text-white">Users</a>
            <a href="{{route('games')}}" class="me-3 text-white">Games</a>
        </div>

        <form action="{{route('logout')}}" class="p-0 m-0" method="POST">
            @csrf
            <input type="submit" value="Logout" class="btn text-white">
        </form>
    </div>
</header>
@endif
