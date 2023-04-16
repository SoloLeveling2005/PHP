@extends('base')
@section('title', 'game')
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
                    <div class="row">
                        <div class="col">
                            <div class="table">
                                <div class="row py-2 bg-grey-light">
                                    <div class="col-2 fw-bold">Title</div>
                                    <div class="col-2">title</div>
                                </div>
                                <div class="row py-2">
                                    <div class="col-2 fw-bold">Author</div>
                                    <div class="col-2">author</div>
                                </div>
                                <div class="row py-2 bg-grey-light">
                                    <div class="col-2 fw-bold">Versions</div>
                                    <div class="col-2">
                                        <ul class="m-0 p-0">
                                            <li>Version1</li>
                                            <li>Version2</li>
                                            <li>Version3</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col-2 fw-bold">Action</div>
                                    <div class="col-2">
                                        <button class="btn btn-danger bg-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <img src="" alt="" class="w-100 h-100 border-1 border">
                        </div>
                    </div>
                </div>
                
                <h4>Scores <button class="btn btn-danger bg-danger">Drop</button></h4>
                <hr>
                <h5>Version v1 <button class="btn btn-danger bg-danger">Drop</button></h5>
                <div class="table">
                    <div class="row py-2 fw-bold">
                        <div class="col">Score</div>
                        <div class="col">Player</div>
                        <div class="col">Action</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col">123</div>
                        <div class="col">user</div>
                        <div class="col">
                            <div class="btn-group p-0 m-0">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  Drop
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">All user score</a></li>
                                  <li><a class="dropdown-item" href="#">One score</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col">123</div>
                        <div class="col">user</div>
                        <div class="col">
                            <div class="btn-group p-0 m-0">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  Drop
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">All user score</a></li>
                                  <li><a class="dropdown-item" href="#">One score</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <h5>Version v2 <button class="btn btn-danger bg-danger">Drop</button></h5>
                <div class="table">
                    <div class="row py-2 fw-bold">
                        <div class="col">Score</div>
                        <div class="col">Player</div>
                        <div class="col">Action</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col">123</div>
                        <div class="col">user</div>
                        <div class="col">
                            <div class="btn-group p-0 m-0">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  Drop
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">All user score</a></li>
                                  <li><a class="dropdown-item" href="#">One score</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col">123</div>
                        <div class="col">user</div>
                        <div class="col">
                            <div class="btn-group p-0 m-0">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  Drop
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">All user score</a></li>
                                  <li><a class="dropdown-item" href="#">One score</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection 