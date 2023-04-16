@extends('base')
@section('title', 'Admins')
@section('body')
    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('index')}}" class="me-4 btn text-white fw-bold">Admins</a>
                    <a href="{{route('users')}}" class="me-4 btn text-white">Users</a>
                    <a href="{{route('games')}}" class="me-4 btn text-white">Games</a>
                </div>
                <a href="" class="btn text-white">Logout</a>
            </div>
        </header>
        <main class="container">
            <h1 class="mt-4">Admins</h1>
            <hr>
            <div class="table">
                <div class="row py-2">
                    <div class="col fw-bold">Username</div>
                    <div class="col fw-bold">Last login</div>
                    <div class="col fw-bold">Created at</div>
                </div>
                <div class="row bg-grey-50 py-2">
                    <div class="col">Username</div>
                    <div class="col">123</div>
                    <div class="col">234</div>
                </div>
                <div class="row py-2">
                    <div class="col">Username</div>
                    <div class="col">123</div>
                    <div class="col">423</div>
                </div>
                <div class="row bg-grey-50 py-2">
                    <div class="col">Username</div>
                    <div class="col">123</div>
                    <div class="col">234</div>
                </div>
            </div>
        </main>
    </section>
@endsection