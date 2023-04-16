@extends('base')
@section('title', 'Users')
@section('body')
    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('index')}}" class="btn text-white">Admins</a>
                    <a href="{{route('users')}}" class="btn text-white fw-bold">Users</a>
                    <a href="{{route('games')}}" class="btn text-white">Games</a>
                </div>
                <a href="" class="text-white">Logout</a>
            </div>
        </header>
        <main class="container">
            <h1 class="mt-4">Users</h1>
            <hr>
            <div class="table">
                <div class="row">
                    <div class="col py-2 fw-bold">Username</div>
                    <div class="col py-2 fw-bold">Last login</div>
                    <div class="col py-2 fw-bold">Created at</div>
                    <div class="col py-2 fw-bold">Action</div>
                </div>
                <div class="row bg-grey-50">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col py-2 text-dark">Username</a>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col">
                        <div class="btn-group px-1 mx-0">
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
                <div class="row">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col py-2 text-dark">Username</a>
                    <div class="col py-2">1234</div>
                    <div class="col py-2">1234</div>
                    <div class="col">
                        <div class="btn-group px-1 mx-0">
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
                <div class="row bg-grey-50">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col py-2 text-dark">Username</a>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col">
                        <div class="btn-group px-1 mx-0">
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
                <div class="row">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col py-2 text-dark">Username</a>
                    <div class="col py-2">1234</div>
                    <div class="col py-2">1234</div>
                    <div class="col">
                        <div class="btn-group px-1 mx-0">
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