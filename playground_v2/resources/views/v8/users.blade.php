@extends('base')
@section('title', 'users')
@section('body')    
    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark text-white">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <a href="{{route('index')}}" class="text-white text-decoration-none me-4">Admins</a>
                    <a href="{{route('users')}}" class="text-white text-decoration-none me-4 fw-bold">Users</a>
                    <a href="{{route('games')}}" class="text-white text-decoration-none me-4">Games</a>
                </div>
                <form action="" method="POST">
                    <input type="submit" class="btn text-white" value="Logout">
                </form>
            </div>
        </header>
        <main>
            <div class="container pt-4">
                <h5>Users</h5>
                <hr>
                <div class="table">
                    <div class="row py-2 fw-bold">
                        <div class="col">Username</div>
                        <div class="col">Last login</div>
                        <div class="col">Created at</div>
                        <div class="col">Action</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <a href="{{route('user', ['username'=>'username'])}}" class="col">Username</a>
                        <div class="col">123</div>
                        <div class="col">234</div>
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
                    <div class="row py-2">
                        <a href="{{route('user', ['username'=>'username'])}}" class="col">Username</a>
                        <div class="col">345</div>
                        <div class="col">56657</div>
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