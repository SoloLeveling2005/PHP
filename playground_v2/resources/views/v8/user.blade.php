@extends('base')
@section('title', 'user')
<style>
    .col {
        align-items: flex-start !important;
    }
</style>
@section('body')    
    <section class="w-100 h-100">
        <header class="w-100 py-3 bg-dark text-white">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <a href="{{route('index')}}" class="text-white text-decoration-none me-4 fw-bold">Home</a>
                </div>
            </div>
        </header>
        <main class="pb-4">
            <div class="container pt-4">
                <h4>User</h4>
                <hr>
                <div class="table">
                    <div class="row py-2 bg-grey-light">
                        <div class="col-2 fw-bold">Username</div>
                        <div class="col-2">username</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-2 fw-bold">Last login</div>
                        <div class="col-2">123</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col-2 fw-bold">Created at</div>
                        <div class="col-2">124</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-2 fw-bold">Action</div>
                        <div class="col-2">
                            <div class="btn-group p-0 m-0">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  Ban
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">Cheating</a></li>
                                  <li><a class="dropdown-item" href="#">Spamming</a></li>
                                  <li><a class="dropdown-item" href="#">Other</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <h4>Games author</h4>
                <hr>
                <div class="table">
                    <div class="row py-2 fw-bold">
                        <div class="col">Title</div>
                        <div class="col">Author</div>
                        <div class="col">Created at</div>
                        <div class="col">Veriosn</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <a href="{{route('game', ['slug'=>'slug'])}}" class="col">Title</a>
                        <div class="col">123</div>
                        <div class="col">234</div>
                        <div class="col">
                            <ul class="m-0 p-0">
                                <li>Version1</li>
                                <li>Version2</li>
                                <li>Version3</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row py-2">
                        <a href="{{route('game', ['slug'=>'slug'])}}" class="col">Title</a>
                        <div class="col">345</div>
                        <div class="col">56657</div>
                        <div class="col">
                            <ul class="m-0 p-0">
                                <li>Version1</li>
                                <li>Version2</li>
                                <li>Version3</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <a href="{{route('game', ['slug'=>'slug'])}}" class="col">Title</a>
                        <div class="col">123</div>
                        <div class="col">234</div>
                        <div class="col">
                            <ul class="m-0 p-0">
                                <li>Version1</li>
                                <li>Version2</li>
                                <li>Version3</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <h4>Scores</h4>
                <hr>
                <div class="table">
                    <div class="row py-2 fw-bold">
                        <div class="col">GameVersion</div>
                        <div class="col">Score</div>
                        <div class="col">Action</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col">verision1</div>
                        <div class="col">234</div>
                        <div class="col">
                            <button class="btn btn-danger bg-danger">Drop</button>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col">verision3</div>
                        <div class="col">56657</div>
                        <div class="col">
                            <button class="btn btn-danger bg-danger">Drop</button>
                        </div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col">verision4</div>
                        <div class="col">234</div>
                        <div class="col">
                            <button class="btn btn-danger bg-danger">Drop</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection 