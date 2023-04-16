@extends('base')
@section('title', 'Games')
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
                    <a href="{{route('games')}}" class="me-4 text-white fw-bold">games</a>
                </div>
                <form action="" method="POSt">
                    <input type="submit" value="Logout" class="btn text-white">
                </form>
            </div>
        </header>
        <main class="w-100 pt-3">
            <div class="container">
                <h4>Games</h4>
                <hr>
                <div class="w-100 pb-2 d-flex">
                    <label class="w-100">
                        <input type="text" class="form-control w-100" id="input_check_game">
                    </label>
                    <select class="form-select mx-2" aria-label="Default select example" style="width: 190px;" id="selected_">
                        <option selected>Поиск по?</option>
                        <option value="title">Заголовок</option>
                        <option value="description">Описание</option>
                        <option value="author">Автор</option>
                    </select>
                    <input type="button" value="Поиск" class="btn btn-primary ms-2" id="check_game">
                </div>
                <div class="table" id="games">
                    <div class="row py-2">
                        <div class="col-1 fw-bold"></div>
                        <div class="col fw-bold">Title</div>
                        <div class="col fw-bold">Author</div>
                        <div class="col fw-bold">Created at</div>
                        <div class="col fw-bold">Action</div>
                    </div>
                    @foreach($games as $game)

                        @if($loop->index %2 == 1)

                            @if(!$game->deleted_at)
                                <div class="row py-2" id="id{{$loop->index}}">
                                    <div class="col-1 fw-bold"></div>
                                    <a href="{{route('game', ['slug'=>$game->slug])}}" class="col" id="title">{{$game->title}}</a>
                                    <div class="col" id="username">{{$game->author->username}}</div>
                                    <div class="col">{{$game->created_at}}</div>
                                    <div style="display: none;" id="description">{{$game->description}}</div>
                                    <div class="col">
                                        <button class="btn btn-danger bg-danger">Delete</button>
                                    </div>
                                </div>
                            @else
                                <div class="row py-2" id="id{{$loop->index}}">
                                    <div class="col-1 fw-bold"></div>
                                    <div class="col text-decoration-line-through" id="title">{{$game->title}}</div>
                                    <div class="col text-decoration-line-through" id="username">{{$game->author->username}}</div>
                                    <div class="col text-decoration-line-through">{{$game->created_at}}</div>
                                    <div style="display: none;" id="description">{{$game->description}}</div>
                                    <div class="col">
                                        <button class="btn btn-success bg-success">Refresh</button>
                                    </div>
                                </div>
                            @endif
                        @else
                            @if(!$game->deleted_at)
                                <div class="row py-2 bg-grey-light" id="id{{$loop->index}}">
                                    <div class="col-1 fw-bold"></div>
                                    <a href="{{route('game', ['slug'=>$game->slug])}}" class="col" id="title">{{$game->title}}</a>
                                    <div class="col" id="username">{{$game->author->username}}</div>
                                    <div class="col">{{$game->created_at}}</div>
                                    <div style="display: none;" id="description">{{$game->description}}</div>
                                    <div class="col">
                                        <button class="btn btn-danger bg-danger">Delete</button>
                                    </div>
                                </div>
                            @else
                                <div class="row py-2 bg-grey-light" id="id{{$loop->index}}">
                                    <div class="col-1 fw-bold"></div>
                                    <div class="col text-decoration-line-through" id="title">{{$game->title}}</div>
                                    <div class="col text-decoration-line-through" id="username">{{$game->author->username}}</div>
                                    <div class="col text-decoration-line-through">{{$game->created_at}}</div>
                                    <div style="display: none;" id="description">{{$game->description}}</div>
                                    <div class="col">
                                        <button class="btn btn-success bg-success">Refresh</button>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach


                </div>
            </div>
        </main>
    </section>
    <script>
        document.querySelector('#check_game').addEventListener("click", (event)=> {
            check()
        });
        function check () {
            let selected_ = document.querySelector('#selected_').value
            if (selected_ === "title") {
                let games = document.querySelectorAll('#title')
                let input_ = document.querySelector('#input_check_game').value
                let game_titles = []
                let all_game_titles = []
                for (let i in games) {
                    if (typeof (games[i]) == "object") {
                        let title = games[i].textContent
                        if (!title.toLowerCase().includes(input_.toLowerCase())) {
                            game_titles.push({'id': i, title: title})
                        }
                        all_game_titles.push({'id': i, title: title})
                    }
                }
                console.log(game_titles)
                for (let all_game_title of all_game_titles) {
                    document.querySelector(`#id${all_game_title.id}`).style = "display:flex;"
                }
                for (let game_title of game_titles) {
                    document.querySelector(`#id${game_title.id}`).style = "display:none;"
                }
            } else if (selected_ === "description") {
                let games = document.querySelectorAll('#description')
                let input_ = document.querySelector('#input_check_game').value
                let game_titles = []
                let all_game_titles = []
                for (let i in games) {
                    if (typeof (games[i]) == "object") {
                        let title = games[i].textContent
                        if (!title.toLowerCase().includes(input_.toLowerCase())) {
                            game_titles.push({'id': i, title: title})
                        }
                        all_game_titles.push({'id': i, title: title})
                    }
                }
                console.log(game_titles)
                for (let all_game_title of all_game_titles) {
                    document.querySelector(`#id${all_game_title.id}`).style = "display:flex;"
                }
                for (let game_title of game_titles) {
                    document.querySelector(`#id${game_title.id}`).style = "display:none;"
                }
            } else if (selected_ === "author") {
                let games = document.querySelectorAll('#username')
                let input_ = document.querySelector('#input_check_game').value
                let game_titles = []
                let all_game_titles = []
                for (let i in games) {
                    if (typeof (games[i]) == "object") {
                        let title = games[i].textContent
                        if (!title.toLowerCase().includes(input_.toLowerCase())) {
                            game_titles.push({'id': i, title: title})
                        }
                        all_game_titles.push({'id': i, title: title})
                    }
                }
                console.log(game_titles)
                for (let all_game_title of all_game_titles) {
                    document.querySelector(`#id${all_game_title.id}`).style = "display:flex;"
                }
                for (let game_title of game_titles) {
                    document.querySelector(`#id${game_title.id}`).style = "display:none;"
                }
            }
        }

    </script>
@endsection
