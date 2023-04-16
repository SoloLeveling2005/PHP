@extends('base')
@section('title', 'game')
@section('body')


    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container pt-3">
                <h4>Game</h4>
                <div class="table">
                    <div class="row bg-grey-light">
                        <div class="col py-2">Title</div>
                        <div class="col py-2">{{$game->title}}</div>
                    </div>
                    <div class="row">
                        <div class="col py-2">Author</div>
                        <div class="col py-2">{{$game->author}}</div>
                    </div>
                    <div class="row bg-grey-light">
                        <div class="col py-2">Created at</div>
                        <div class="col py-2">{{$game->created_at}}</div>
                    </div>
                </div>
                <hr>
                <h4>Scores</h4>
                @foreach($game_versions as $game_version)
                    <h5 class="d-flex align-items-center">
                        Version
                        <form action="{{route('drop_game_version_scores')}}" method="POST">
                            @csrf
                            <input type="hidden" name="game_version_id" value="{{$game_version->id}}">
                            <input type="submit" value="Drop all version scores" class="btn btn-danger">
                        </form>
                    </h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="col">Score</th>
                            <th class="col">Player</th>
                            <th class="col">Action</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($game_version->scores as $scores)
                            <tr>
                                <td>{{$scores->score}}</td>
                                <td>{{$scores->user->username}}</td>
                                <td class="d-flex align-items-center">
                                    <form action="{{route('drop_user_score')}}" method="POST" class="me-3">
                                        @csrf
                                        <input type="hidden" name="score_id" value="{{$scores->id}}">
                                        <input type="submit" class="btn btn-danger" value="Drop user score">
                                    </form>
                                    <form action="{{route('drop_all_user_scores')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$scores->user->id}}">
                                        <input type="hidden" name="game_version_id" value="{{$game_version->id}}">
                                        <input type="submit" class="btn btn-danger" value="Drop all user score">
                                    </form>
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
