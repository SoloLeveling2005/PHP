<header class="w-100 bg-dark">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <div>
            <a href="{{route('admins')}}" class="text-white me-3">Admins</a>
            <a href="{{route('users')}}" class="text-white me-3">Users</a>
            <a href="{{route('games')}}" class="text-white me-3">Games</a>
        </div>
        <form action="{{route('logout')}}" method="POST" class="p-0 m-0">
            @csrf
            <input type="submit" value="Logout" class="btn text-white">
        </form>
    </div>
</header>
