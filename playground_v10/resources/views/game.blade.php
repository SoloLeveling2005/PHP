@extends('base')
@section('title', "Game $game->title")
@section('body')

    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container">
                <h4 class="mt-2">Game {{$game->title}}</h4>
                <hr>
                <div class="table">
                    <div class="row">
                        <div class="col py-2 fw-bold">Title</div>
                        <div class="col">{{$game->title}}</div>
                    </div>
                    <div class="row">
                        <div class="col py-2 fw-bold">Author</div>
                        <div class="col">{{$game->author->username}}</div>
                    </div>
                    <div class="row">
                        <div class="col py-2 fw-bold">Created at</div>
                        <div class="col">{{$game->created_at}}</div>
                    </div>
                </div>
                <h4 class="mt-3">Scores</h4>
                <hr>
                @foreach($versions as $version)
                    <h5>Version {{$version->version}}
                        <form action="{{route('drop_all_version_score')}}" method="POST" class="m-0 p-0">
                            <input type="hidden" name="game_version_id" value="{{$version->id}}">
                            @csrf
                            <input type="submit" value="Drop" class="btn btn-danger bg-danger">
                        </form>
                    </h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col">Score</th>
                        <th class="col">Player</th>
                        <th class="col">Created at</th>
                        <th class="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($version->scores as $score)
                        <tr>
                            <td>{{$score->score}}</td>
                            <td>{{$score->user->username}}</td>
                            <td>{{$score->created_at}}</td>
                            <td>
                                <div class="btn-group p-0 m-0">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Drop
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="{{route('drop_all_user_score')}}" method="POST" class="p-0 m-0">
                                                <input type="hidden" name="user_id" value="{{$score->user->id}}">
                                                <input type="hidden" name="game_version_id" value="{{$version->id}}">
                                                @csrf
                                                <input type="submit" value="All user score" class="w-100" name="cheating">
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{route('drop_user_score')}}" method="POST" class="p-0 m-0">
                                                <input type="hidden" name="score_id" value="{{$score->id}}">
                                                @csrf
                                                <input type="submit" value="One score" class="w-100" name="spamming">
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endforeach
            </div>
        </main>
    </section>

@endsection
