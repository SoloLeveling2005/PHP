@extends('base')
@section('title', 'game')
@section('body')

    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark text-white">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <a href="{{route('admins')}}" class="text-white me-3">Admins</a>
                    <a href="{{route('users')}}" class="text-white me-3 fw-bold">Users</a>
                    <a href="{{route('games')}}" class="text-white me-3">Games</a>
                </div>
                <form action="" method="POST">
                    <input type="submit" class="btn text-white" value="Logout">
                </form>
            </div>
        </header>
        <main class="container pt-4">
            <h4>Game</h4>
            <hr>
            <div class="table">
                <div class="row">
                    <div class="col">
                        <div class="table">
                            <div class="row py-2 bg-grey-light">
                                <div class="col fw-bold">Title</div>
                                <div class="col">title</div>
                            </div>
                            <div class="row py-2">
                                <div class="col fw-bold">Author</div>
                                <div class="col">author</div>
                            </div>
                            <div class="row py-2 bg-grey-light">
                                <div class="col fw-bold">Created at</div>
                                <div class="col">123</div>
                            </div>
                            <div class="row py-2">
                                <div class="col fw-bold">Action</div>
                                <div class="col">
                                    <form action="" class="p-0 m-0" method="POSt">
                                        <input type="submit" value="Delete" class="btn btn-danger bg-danger">
                                    </form>
                                </div>
                            </div>
                            <div class="row py-2 bg-grey-light">
                                <div class="col fw-bold">Versions</div>
                                <div class="col">
                                    <ul class="py-0 my-0 ms-3">
                                        <li>version v1</li>
                                        <li>version v2</li>
                                        <li>version v3</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <img src="" alt="Logo" class="w-100 h-100 border border-1">
                    </div>
                </div>
            </div>
            <h4 class="d-flex">
                Scores
                <form action="" class="p-0 m-0 ms-2" method="POST">
                    <input type="submit" value="Drop" class="btn btn-danger bg-danger">
                </form>
            </h4>
            <hr>
            <h5 class="d-flex">
                Version1
                <form action="" class="p-0 m-0 ms-2" method="POST">
                    <input type="submit" value="Drop" class="btn btn-danger bg-danger">
                </form>
            </h5>
            <div class="table">
                <div class="row py-2">
                    <div class="col fw-bold">Score</div>
                    <div class="col fw-bold">Author</div>
                    <div class="col fw-bold">Created at</div>
                    <div class="col fw-bold">Action</div>
                </div>
                <div class="row py-2 bg-grey-light">
                    <div class="col">1213</div>
                    <div class="col">author</div>
                    <div class="col">3645</div>
                    <div class="col">
                        <form action="" class="p-0 m-0" method="POST">
                            <input type="submit" value="Drop" class="btn btn-danger bg-danger">
                        </form>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col">123</div>
                    <div class="col">author</div>
                    <div class="col">3645</div>
                    <div class="col">
                        <form action="" class="p-0 m-0" method="POST">
                            <input type="submit" value="Drop" class="btn btn-danger bg-danger">
                        </form>
                    </div>
                </div>
            </div>
            <h5 class="d-flex">
                Version2
                <form action="" class="p-0 m-0 ms-2" method="POST">
                    <input type="submit" value="Drop" class="btn btn-danger bg-danger">
                </form>
            </h5>
            <div class="table">
                <div class="row py-2">
                    <div class="col fw-bold">Score</div>
                    <div class="col fw-bold">Author</div>
                    <div class="col fw-bold">Created at</div>
                    <div class="col fw-bold">Action</div>
                </div>
                <div class="row py-2 bg-grey-light">
                    <div class="col">1213</div>
                    <div class="col">author</div>
                    <div class="col">3645</div>
                    <div class="col">
                        <form action="" class="p-0 m-0" method="POST">
                            <input type="submit" value="Drop" class="btn btn-danger bg-danger">
                        </form>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col">123</div>
                    <div class="col">author</div>
                    <div class="col">3645</div>
                    <div class="col">
                        <form action="" class="p-0 m-0" method="POST">
                            <input type="submit" value="Drop" class="btn btn-danger bg-danger">
                        </form>
                    </div>
                </div>
            </div>
        </main>

    </section>

@endsection('body')
