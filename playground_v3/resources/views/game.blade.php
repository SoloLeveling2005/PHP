@extends('base')
@section('title', 'Users')
@section('body')
    <style>
        .col {
            display: flex;
            align-items: center;
        }
    </style>
    <section class="w-100 h-100">
        <header class="w-100 py-3 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('admin')}}" class="me-4 text-white">admin</a>
                    <a href="{{route('users')}}" class="me-4 text-white">users</a>
                    <a href="{{route('games')}}" class="me-4 text-white">games</a>
                </div>
                <form action="" method="POSt">
                    <input type="submit" value="Logout" class="btn text-white">
                </form>
            </div>
        </header>
        <main class="w-100 pt-3">
            <div class="container">
                <h4>Game</h4>
                <hr>
                <div class="table">
                    <div class="row py-2">
                        <div class="col fw-bold">Title</div>
                        <div class="col">{{$game->title}}</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col fw-bold">Author</div>
                        <div class="col">{{$game->author->username}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col fw-bold">Created at</div>
                        <div class="col">{{$game->created_at}}</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col fw-bold">Action</div>
                        <div class="col">
                            <button class="btn btn-danger bg-danger">Delete</button>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col fw-bold">Versions</div>
                        <div class="col">
                            <ul class="p-0 m-0">
                                @foreach($game->versions as $version)
                                    <li>Version </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <h4>Scores <button class="btn btn-danger bg-danger">Drop</button></h4>
                <hr>

                <h4>Version 1 <button class="btn btn-danger bg-danger">Drop</button></h4>
                <div class="table">
                    <div class="row py-2">
                        <div class="col fw-bold">Score</div>
                        <div class="col fw-bold">Player</div>
                        <div class="col fw-bold">Action</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col">1223</div>
                        <div class="col">player</div>
                        <div class="col"><button class="btn btn-danger bg-danger">Drop</button></div>
                    </div>
                    <div class="row py-2">
                        <div class="col">1223</div>
                        <div class="col">player</div>
                        <div class="col"><button class="btn btn-danger bg-danger">Drop</button></div>
                    </div>
                </div>
                <h4>Version 2 <button class="btn btn-danger bg-danger">Drop</button></h4>
                <div class="table">
                    <div class="row py-2">
                        <div class="col fw-bold">Score</div>
                        <div class="col fw-bold">Player</div>
                        <div class="col fw-bold">Action</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col">1223</div>
                        <div class="col">player</div>
                        <div class="col"><button class="btn btn-danger bg-danger">Drop</button></div>
                    </div>
                    <div class="row py-2">
                        <div class="col">1223</div>
                        <div class="col">player</div>
                        <div class="col"><button class="btn btn-danger bg-danger">Drop</button></div>
                    </div>
                </div>
                <h4>Version 3 <button class="btn btn-danger bg-danger">Drop</button></h4>
                <div class="table">
                    <div class="row py-2">
                        <div class="col fw-bold">Score</div>
                        <div class="col fw-bold">Player</div>
                        <div class="col fw-bold">Action</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col">1223</div>
                        <div class="col">player</div>
                        <div class="col"><button class="btn btn-danger bg-danger">Drop</button></div>
                    </div>
                    <div class="row py-2">
                        <div class="col">1223</div>
                        <div class="col">player</div>
                        <div class="col"><button class="btn btn-danger bg-danger">Drop</button></div>
                    </div>
                </div>
            </div>
        </main>
    </section>

@endsection
