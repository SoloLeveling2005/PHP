@extends('base')
@section('title', 'Users')
@section('body')
    <style>
        .col {
            display: flex;
            align-items: center;
        }
    </style>
    <section class="w-100 h-100">
        <header class="w-100 py-3 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('admin')}}" class="me-4 text-white">admin</a>
                    <a href="{{route('users')}}" class="me-4 text-white">users</a>
                    <a href="{{route('games')}}" class="me-4 text-white">games</a>
                </div>
                <form action="" method="POSt">
                    <input type="submit" value="Logout" class="btn text-white">
                </form>
            </div>
        </header>
        <main class="w-100 pt-3">
            <div class="container">
                <h4>User</h4>
                <hr>
                <div class="table">
                    <div class="row py-2">
                        <div class="col fw-bold">Username</div>
                        <div class="col">{{$user->username}}</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col fw-bold">Last login</div>
                        <div class="col">{{$user->updated_at}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col fw-bold">Created at</div>
                        <div class="col">{{$user->created_at}}</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col fw-bold">action</div>
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
            </div>
        </main>
    </section>

@endsection
