@extends('base')
@section('title', 'Users')
@section('body')
    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('index')}}" class="me-4 btn text-white">Admins</a>
                    <a href="{{route('users')}}" class="me-4 btn text-white fw-bold">Users</a>
                    <a href="{{route('games')}}" class="me-4 btn text-white">Games</a>
                </div>
                <a href="" class="btn text-white">Logout</a>
            </div>
        </header>
        <main class="container">
            <h1 class="mt-4">Users</h1>
            <hr>
            <div class="table">
                <div class="row py-2">
                    <div class="col fw-bold">Username</div>
                    <div class="col fw-bold">Last login</div>
                    <div class="col fw-bold">Created at</div>
                    <div class="col fw-bold">Action</div>
                </div>
                <div class="row bg-grey-50 py-2">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col btn">Username</a>
                    <div class="col">123</div>
                    <div class="col">234</div>
                    <div class="col">
                        <div class="btn-group my-0 py-0">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              Action
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Cheatind</a></li>
                              <li><a class="dropdown-item" href="#">Spamming</a></li>
                              <li><a class="dropdown-item" href="#">Other</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col btn">Username</a>
                    <div class="col">123</div>
                    <div class="col">123</div>
                    <div class="col">
                        <div class="btn-group my-0 py-0">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Cheatind</a></li>
                            <li><a class="dropdown-item" href="#">Spamming</a></li>
                            <li><a class="dropdown-item" href="#">Other</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row bg-grey-50 py-2">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col btn">Username</a>
                    <div class="col">123</div>
                    <div class="col">123</div>
                    <div class="col">
                        <div class="btn-group my-0 py-0">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Cheatind</a></li>
                            <li><a class="dropdown-item" href="#">Spamming</a></li>
                            <li><a class="dropdown-item" href="#">Other</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection