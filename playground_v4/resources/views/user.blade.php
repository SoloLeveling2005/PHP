@extends('base')
@section('title', 'user')
@section('body')

    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark text-white">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <a href="{{route('admins')}}" class="text-white me-3">Admins</a>
                    <a href="{{route('users')}}" class="text-white me-3 fw-bold">Users</a>
                    <a href="{{route('games')}}" class="text-white me-3">Games</a>
                </div>
                <form action="" method="POST">
                    <input type="submit" class="btn text-white" value="Logout">
                </form>
            </div>
        </header>
        <main class="container pt-4">
            <h4>User</h4>
            <hr>
            <div class="table">
                <div class="row py-2 bg-grey-light">
                    <div class="col fw-bold">Username</div>
                    <div class="col">username</div>
                </div>
                <div class="row py-2">
                    <div class="col fw-bold">Last login</div>
                    <div class="col">1234</div>
                </div>
                <div class="row py-2 bg-grey-light">
                    <div class="col fw-bold">Created at</div>
                    <div class="col">123</div>
                </div>
                <div class="row py-2">
                    <div class="col fw-bold">Action</div>
                    <div class="col">
                        <div class="btn-group p-0 m-0">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Ban
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Cheating</a></li>
                                <li><a class="dropdown-item" href="#">Spamming</a></li>
                                <li><a class="dropdown-item" href="#">Other</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </section>

@endsection('body')
