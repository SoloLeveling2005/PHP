@extends('base')
@section('title', 'Games')
@section('body')
    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('index')}}" class="btn text-white">Admins</a>
                    <a href="{{route('users')}}" class="btn text-white">Users</a>
                    <a href="{{route('games')}}" class="btn text-white fw-bold">Games</a>
                </div>
                <a href="" class="text-white">Logout</a>
            </div>
        </header>
        <main class="container">
            <h1 class="mt-4">Games</h1>
            <hr>
            <div class="table">
                <div class="row py-1">
                    <div class="col-1 py-2 fw-bold"></div>
                    <div class="col py-2 fw-bold">Title</div>
                    <div class="col py-2 fw-bold">Author</div>
                    <div class="col py-2 fw-bold">Created at</div>
                    <div class="col py-2 fw-bold">Action</div>
                </div>
                <div class="row bg-grey-50 py-1">
                    <div class="col-1 py-2 text-dark"></div>
                    <a href="{{route('game', ['slug'=>'slug'])}}" class="col py-2 text-dark">Title</a>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col">
                        <button class="btn btn-success bg-success">Refresh</button>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-1 py-2"></div>
                    <a href="{{route('game', ['slug'=>'slug'])}}" class="col py-2 text-dark">Title</a>
                    <div class="col py-2">1234</div>
                    <div class="col py-2">1234</div>
                    <div class="col">
                        <button class="btn btn-danger bg-danger">Ban</button>
                    </div>
                </div>
                <div class="row bg-grey-50 py-1">
                    <div class="col-1 py-2"></div>
                    <a href="{{route('game', ['slug'=>'slug'])}}" class="col py-2 text-dark">Title</a>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col">
                        <button class="btn btn-success bg-success">Refresh</button>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-1 py-2"></div>
                    <a href="{{route('game', ['slug'=>'slug'])}}" class="col py-2 text-dark">Title</a>
                    <div class="col py-2">1234</div>
                    <div class="col py-2">1234</div>
                    <div class="col">
                        <button class="btn btn-danger bg-danger">Ban</button>
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection