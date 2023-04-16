@extends('base')
@section('title', 'User')
@section('body')
    <section class="w-100 h-100 mb-3">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('index')}}" class="btn text-white">Home</a>
                </div>
                <a href="" class="text-white">Logout</a>
            </div>
        </header>
        <main class="container">
            <h1 class="mt-4">User1</h1>
            <hr>
            <div class="table">
                <div class="row py-1">
                    <div class="col-1 py-1 fw-bold">Username</div>
                    <div class="col py-1">User1</div>
                </div>
                <div class="row py-1 bg-grey-50">
                    <div class="col-1 py-1 fw-bold">Last login</div>
                    <div class="col py-1">123</div>
                </div>
                <div class="row py-1">
                    <div class="col-1 py-1 fw-bold">Created at</div>
                    <div class="col py-1">123</div>
                </div>
                <div class="row py-1 bg-grey-50">
                    <div class="col-1 py-1 fw-bold">Action</div>
                    <div class="col py-1">
                        <div class="btn-group px-1 mx-0 py-0 my-0">
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

            <h2 class="mt-4">Authored games</h2>
            <hr>
            <h3>Game1<button class="btn btn-danger bg-danger ms-2">Delete</button></h3>
            <ul>
                <li><h5>Version1</h5></li>
                <li><h5>Version2</h5></li>
            </ul>
            <h3>Game2<button class="btn btn-danger bg-danger ms-2">Delete</button></h3>
            <ul>
                <li><h5>Version1</h5></li>
                <li><h5>Version2</h5></li>
            </ul>
            <h3>Game3<button class="btn btn-danger bg-danger ms-2">Delete</button></h3>
            <ul>
                <li><h5>Version1</h5></li>
                <li><h5>Version2</h5></li>
            </ul>

            
            <h2 class="mt-4">User scores<button class="btn btn-danger bg-danger ms-2">Drop</button></h2>
            <hr>
            <div class="row py-1">
                <div class="col py-2 fw-bold">Game version</div>
                <div class="col py-2 fw-bold">Score</div>
                <div class="col py-2 fw-bold">Created at</div>
                <div class="col py-2 fw-bold">Action</div>
            </div>
            <div class="row bg-grey-50 py-1">
                <div class="col py-2 text-dark">version1</div>
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
            <div class="row py-1">
                <div class="col py-2 text-dark">version1</div>
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
        </main>
    </section>
@endsection