@extends('base')
@section('tile', 'Game')
@section('body')


    <section class="w-100">
        @include('header')
        <div class="container">
            <h4 class="mt-3">Game</h4>
            <hr>
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
                    <div class="col">{{$game->crated_at}}</div>
                </div>
                <div class="row py-2">
                    <div class="col fw-bold">Description</div>
                    <div class="col">{{$game->description}}</div>
                </div>
            </div>

            <h4 class="my-2 d-flex align-items-center">
                Scores

                <form action="{{route('drop_all_game_score')}}" method="POST" class="m-0 p-0">
                    @csrf
                    <input type="hidden" name="game_id" value="{{$game->id}}">
                    <input type="submit" value="Drop" class="btn btn-danger">
                </form>
            </h4>
            @foreach($versions as $version)
                @if(count($version->scores) > 0)
                <h4 class="mb-1">Version {{$version->version}}</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col">Player</th>
                        <th class="col">Score</th>
                        <th class="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($version->scores as $score)
                        @if(!$score->user->is_ban)
                        <tr>
                            <td>{{$score->user->username}}</td>
                            <td>{{$score->score}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Drop
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="{{route('drop_one_user_score')}}" method="POST" class="p-0 m-0">
                                                @csrf
                                                <input type="hidden" name="score_id" value="{{$score->id}}">
                                                <input type="submit" value="Drop score">
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{route('drop_user_version_score')}}" method="POST" class="p-0 m-0">
                                                @csrf
                                                <input type="hidden" name="game_id" value="{{$game->id}}">
                                                <input type="hidden" name="user_id" value="{{$score->user->id}}">
                                                <input type="submit" value="Delete all user score in this game">
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                @endif
            @endforeach

        </div>

    </section>


@endsection
