@extends('base')
@section('title', 'Admins')
@section('body')
    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('index')}}" class="btn text-white fw-bold">Admins</a>
                    <a href="{{route('users')}}" class="btn text-white">Users</a>
                    <a href="{{route('games')}}" class="btn text-white">Games</a>
                </div>
                <a href="" class="text-white">Logout</a>
            </div>
        </header>
        <main class="container">
            <h1 class="mt-4">Admins</h1>
            <hr>
            <div class="table">
                <div class="row">
                    <div class="col py-2 fw-bold">Username</div>
                    <div class="col py-2 fw-bold">Last login</div>
                    <div class="col py-2 fw-bold">Created at</div>
                </div>
                <div class="row bg-grey-50">
                    <div class="col py-2 text-dark">Username</div>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col py-2 text-dark">123</div>
                </div>
                <div class="row">
                    <div class="col py-2 text-dark">Username</div>
                    <div class="col py-2">1234</div>
                    <div class="col py-2">1234</div>
                </div>
                <div class="row bg-grey-50">
                    <div class="col py-2 text-dark">Username</div>
                    <div class="col py-2 text-dark">123</div>
                    <div class="col py-2 text-dark">123</div>
                </div>
                <div class="row">
                    <div class="col py-2 text-dark">Username</div>
                    <div class="col py-2">1234</div>
                    <div class="col py-2">1234</div>
                </div>
            </div>
        </main>
    </section>
@endsection