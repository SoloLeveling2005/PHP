@extends('base')
@section('title', 'games')
@section('body')

    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark text-white">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <a href="{{route('admins')}}" class="text-white me-3">Admins</a>
                    <a href="{{route('users')}}" class="text-white me-3">Users</a>
                    <a href="{{route('games')}}" class="text-white me-3 fw-bold">Games</a>
                </div>
                <form action="" method="POST">
                    <input type="submit" class="btn text-white" value="Logout">
                </form>
            </div>
        </header>
        <main class="container pt-4">
            <h4>Games</h4>
            <hr>
            <div class="w-100 d-flex justify-content-between align-items-center">
                <input type="text" placeholder="поиск игр" class="form-control w-100">
                <div class="d-flex ms-2 align-items-center">
                    <div class="btn-group p-0 m-0 mx-3" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="btnradio1">Заголовку</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnradio2">Описанию</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnradio3">Автору</label>
                    </div>
                    <button class="btn btn-primary px-4">Поиск</button>
                </div>
            </div>
            <div class="table">
                <div class="row py-2">
                    <div class="col-1"></div>
                    <div class="col fw-bold">Title</div>
                    <div class="col fw-bold">Author</div>
                    <div class="col fw-bold">Created at</div>
                    <div class="col fw-bold">Action</div>
                </div>
                <div class="row py-2 bg-grey-light">
                    <div class="col-1"></div>
                    <a href="{{route('game', ['slug'=>"slug"])}}" class="col">title</a>
                    <div class="col">author</div>
                    <div class="col">3645</div>
                    <div class="col">
                        <form action="" class="p-0 m-0" method="POST">
                            <input type="submit" value="Delete" class="btn btn-danger bg-danger">
                        </form>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-1"></div>
                    <div class="col text-decoration-line-through">title</div>
                    <div class="col text-decoration-line-through">author</div>
                    <div class="col text-decoration-line-through">3645</div>
                    <div class="col">
                        <form action="" class="p-0 m-0" method="POST">
                            <input type="submit" value="Refresh" class="btn btn-success bg-success">
                        </form>
                    </div>
                </div>
            </div>
        </main>

    </section>

@endsection('body')
