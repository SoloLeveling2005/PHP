<header class="w-100 bg-dark">
    <section class="container py-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <a href="{{route('admin')}}" class="me-2 text-white">Admins</a>
            <a href="{{route('users')}}" class="me-2 text-white">Users</a>
            <a href="{{route('games')}}" class="me-2 text-white">Games</a>
        </div>
        <form action="{{route('logout')}}" method="POST" class="p-0 m-0">
            @csrf
            <input type="submit" value="Logout" class="btn text-white">
        </form>
    </section>
</header>

