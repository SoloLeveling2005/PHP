@extends('base')
@section('title', 'game')
@section('body')

    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <a href="{{route('admins')}}" class="text-white me-3">Admins</a>
                    <a href="{{route('users')}}" class="text-white me-3">Users</a>
                    <a href="{{route('games')}}" class="text-white me-3 fw-bold">Games</a>
                </div>
                <form action="{{route('logout')}}" method="POST" class="p-0 m-0">
                    @csrf
                    <input type="submit" value="Logout" class="btn text-white">
                </form>
            </div>
        </header>
        <main class="w-100">
            <div class="container">
                <h4 class="mt-4">Game</h4>
                <hr>
                <div class="table">
                    <div class="row">
                        <div class="col">
                            <div class="table">
                                <div class="row py-2 bg-grey-light">
                                    <div class="col fw-bold">Title</div>
                                    <div class="col">{{$game->title}}</div>
                                </div>
                                <div class="row py-2">
                                    <div class="col fw-bold">Author</div>
                                    <div class="col">{{$game->author->username}}</div>
                                </div>
                                <div class="row py-2 bg-grey-light">
                                    <div class="col fw-bold">Created at</div>
                                    <div class="col">{{$game->created_at}}</div>
                                </div>
                                <div class="row py-2">
                                    <div class="col fw-bold">Action</div>
                                    <div class="col">
                                        <form action="{{route('game_delete', ['game_id'=>$game->id])}}" class="p-0 m-0" method="POST">
                                            @csrf
                                            <input type="submit" value="Delete" class="btn btn-danger bg-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <img src="" alt="" class="w-100 h-100 border border-1">
                        </div>
                    </div>
                </div>
                <h4 class="mt-3">
                    Scores

                </h4>
                @foreach($game_versions as $game_version)
                    <h5>Game Version {{$game_version->version}}
                        <form class="btn-group p-0 m-0" action="{{route('delete_all_game_version_score', ['game_version_id'=>$game_version->id])}}" method="POST">
                            @csrf
                            <input type="submit" value="Drop" class="btn btn-danger bg-danger">
                        </form>
                    </h5>
                    <table class="table">
                        <thead>
                        <tr class="">
                            <th class="col fw-bold">Score</th>
                            <th class="col fw-bold">Author</th>
                            <th class="col fw-bold">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($game_version->scores as $score)
                            @if(!$banned_user_ids->contains($score->user->id))
                                <tr>
                                    <td>{{$score->score}}</td>
                                    <td>{{$score->user->username}}</td>
                                    <td>
                                        <div class="btn-group p-0 m-0" >
                                            @csrf
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Drop
                                            </button>
                                            <ul class="dropdown-menu">
                                                <form action="{{route('delete_all_user_score', ['user_id'=>$score->user->id, 'game_version_id'=>$game_version->id])}}" method="POST" class="p-0 m-0">
                                                    @csrf
                                                    <li><input type="submit" class="dropdown-item w-100" name="" value="Все очки пользователя"></li>
                                                </form>
                                                <form action="{{route('delete_one_score', ['score_id'=>$score->id])}}" method="POST" class="p-0 m-0">
                                                    @csrf
                                                    <li><input type="submit" class="dropdown-item w-100" name="" value="Одно очко пользователя"></li>
                                                </form>

                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @endforeach

            </div>
        </main>
    </section>

@endsection
