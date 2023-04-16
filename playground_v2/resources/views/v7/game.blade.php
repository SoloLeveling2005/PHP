@extends('base')
@section('title', 'Game')
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
            <h1 class="mt-4">Game1</h1>
            <hr>
            <div class="table">
                <div class="row">
                    <div class="col">
                        <div class="table">
                            <div class="row py-1">
                                <div class="col-2 py-1 fw-bold">Title</div>
                                <div class="col py-1">title</div>
                            </div>
                            <div class="row py-1 bg-grey-50">
                                <div class="col-2 py-1 fw-bold">Author</div>
                                <div class="col py-1">author1</div>
                            </div>
                            <div class="row py-1">
                                <div class="col-2 py-1 fw-bold">Created at</div>
                                <div class="col py-1">123</div>
                            </div>
                            <div class="row py-1 bg-grey-50">
                                <div class="col-2 py-1 fw-bold">Action</div>
                                <div class="col py-1">
                                    <button class="btn btn-danger bg-danger px-3">Ban</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <img src="" alt="" class="border border-1 w-100 h-100">
                    </div>
                </div>
            </div>
            

            <h2 class="mt-4">Versions</h2>
            <hr>
            <h3>Version1</h3>
            <div class="row py-1">
                <div class="col py-2 fw-bold">Score</div>
                <div class="col py-2 fw-bold">Author</div>
                <div class="col py-2 fw-bold">Action</div>
            </div>
            <div class="row bg-grey-50 py-1">
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
            <div class="row py-1">
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
            <div class="row bg-grey-50 py-1">
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
            <div class="row py-1">
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
            <h3>Version2</h3>
            <div class="row py-1">
                <div class="col py-2 fw-bold">Score</div>
                <div class="col py-2 fw-bold">Author</div>
                <div class="col py-2 fw-bold">Action</div>
            </div>
            <div class="row bg-grey-50 py-1">
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
            <div class="row py-1">
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
            <div class="row bg-grey-50 py-1">
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
            <div class="row py-1">
                <div class="col py-2 text-dark">123</div>
                <div class="col py-2 text-dark">123321</div>
                <div class="col">
                    <button class="btn btn-danger bg-danger">Drop</button>
                </div>
            </div>
        </main>
    </section>
@endsection