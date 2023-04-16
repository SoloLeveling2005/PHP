@extends('base')
@section('title', 'Admins')
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
            <h1 class="mt-4">Admins</h1>
            <hr>
            <div class="table">
                <div class="row py-2 fw-bold">
                    <div class="col">Username</div>
                    <div class="col">Last login</div>
                    <div class="col">Created at</div>
                </div>
                <div class="row py-2 bg-grey-50">
                    <div class="col">Username</div>
                    <div class="col">12</div>
                    <div class="col">234</div>
                </div>
                <div class="row py-2">
                    <div class="col">Username</div>
                    <div class="col">12</div>
                    <div class="col">234</div>
                </div>
                <div class="row py-2 bg-grey-50">
                    <div class="col">Username</div>
                    <div class="col">12</div>
                    <div class="col">234</div>
                </div>
            </div>
        </main>
    </section>
@endsection