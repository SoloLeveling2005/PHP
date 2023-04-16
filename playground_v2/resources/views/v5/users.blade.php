@extends('base')
@section('title', 'Users')
@section('body')
    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <section class="container d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{route('index')}}" class="text-white text-decoration-none me-4 fw-bold">Admins</a>
                    <a href="{{route('users')}}" class="text-white text-decoration-none me-4">Users</a>
                    <a href="{{route('games')}}" class="text-white text-decoration-none me-4">Games</a>
                </div>
                <a href="" class="btn text-white text-decoration-none">Logout</a>
            </section>
        </header>
        <main class="container">
            <h1 class="mt-4">Users</h1>
            <hr>
            <div class="table">
                <div class="row py-2 fw-bold">
                    <div class="col py-0">Username</div>
                    <div class="col py-0">Last login</div>
                    <div class="col py-0">Created at</div>
                    <div class="col py-0">Action</div>
                </div>
                <div class="row py-2 bg-grey-50">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col d-flex align-items-center btn">Username</a>
                    <div class="col d-flex align-items-center">12</div>
                    <div class="col d-flex align-items-center">234</div>
                    <div class="col d-flex align-items-center">
                        <div class="btn-group m-0 p-0">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Spamming</a></li>
                                <li><a class="dropdown-item" href="#">Cheating</a></li>
                                <li><a class="dropdown-item" href="#">Other</a></li>
                            </ul>
                        </div>    
                    </div>
                </div>
                <div class="row py-2">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col d-flex align-items-center btn text-black">Username</a>
                    <div class="col d-flex align-items-center">12</div>
                    <div class="col d-flex align-items-center">234</div>
                    <div class="col d-flex align-items-center">
                        <div class="btn-group m-0 p-0">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Spamming</a></li>
                                <li><a class="dropdown-item" href="#">Cheating</a></li>
                                <li><a class="dropdown-item" href="#">Other</a></li>
                            </ul>
                        </div>    
                    </div>
                </div>
                <div class="row py-2 bg-grey-50">
                    <a href="{{route('user', ['username'=>'username'])}}" class="col d-flex align-items-center btn">Username</a>
                    <div class="col d-flex align-items-center">12</div>
                    <div class="col d-flex align-items-center">234</div>
                    <div class="col d-flex align-items-center">
                        <div class="btn-group m-0 p-0">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Spamming</a></li>
                                <li><a class="dropdown-item" href="#">Cheating</a></li>
                                <li><a class="dropdown-item" href="#">Other</a></li>
                            </ul>
                        </div>    
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection