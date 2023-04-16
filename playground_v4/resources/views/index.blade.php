@extends('base')
@section('title', 'admins')
@section('body')

    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark text-white">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <a href="{{route('admins')}}" class="text-white me-3 fw-bold">Admins</a>
                    <a href="{{route('users')}}" class="text-white me-3">Users</a>
                    <a href="{{route('games')}}" class="text-white me-3">Games</a>
                </div>
                <form action="" method="POST">
                    <input type="submit" class="btn text-white" value="Logout">
                </form>
            </div>
        </header>
        <main class="container pt-4">
            <h4>Admins</h4>
            <hr>
            <div class="table">
                <div class="row py-2">
                    <div class="col fw-bold">Username</div>
                    <div class="col fw-bold">Last login</div>
                    <div class="col fw-bold">Created at</div>
                </div>
                <div class="row py-2 bg-grey-light">
                    <div class="col">Username</div>
                    <div class="col">123</div>
                    <div class="col">3645</div>
                </div>
                <div class="row py-2">
                    <div class="col">Username</div>
                    <div class="col">123</div>
                    <div class="col">3645</div>
                </div>
            </div>
        </main>

    </section>

@endsection('body')
