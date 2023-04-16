@extends('base')
@section('title', 'Games')
@section('body')
    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('index')}}" class="me-4 btn text-white">Admins</a>
                    <a href="{{route('users')}}" class="me-4 btn text-white">Users</a>
                    <a href="{{route('games')}}" class="me-4 btn text-white fw-bold">Games</a>
                </div>
                <a href="" class="btn text-white">Logout</a>
            </div>
        </header>
        <main class="container">
            <h1 class="mt-4">Games</h1>
            <hr>
            <div class="table">
                <div class="row py-2">
                    <div class="col-1 fw-bold"></div>
                    <div class="col fw-bold">Title</div>
                    <div class="col fw-bold">Author</div>
                    <div class="col fw-bold">Created at</div>
                    <div class="col fw-bold">Action</div>
                </div>
                <div class="row bg-grey-50 py-2">
                    <div class="col-1"></div>
                    <a href="{{route('game', ['slug'=>'slug'])}}" class="col btn">Title</a>
                    <div class="col">Author</div>
                    <div class="col">234</div>
                    <div class="col">
                        <a href="" class="btn btn-danger bg-danger px-4">Ban</a>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-1"></div>
                    <a href="{{route('game', ['slug'=>'slug'])}}" class="col btn">Title</a>
                    <div class="col">Author</div>
                    <div class="col">123</div>
                    <div class="col">
                        <a href="" class="btn btn-success bg-success px-4">Refresh</a>
                    </div>
                </div>
                <div class="row bg-grey-50 py-2">
                    <div class="col-1"></div>
                    <a href="{{route('game', ['slug'=>'slug'])}}" class="col btn">Title</a>
                    <div class="col">Author</div>
                    <div class="col">234</div>
                    <div class="col">
                        <a href="" class="btn btn-danger bg-danger px-4">Ban</a>
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection