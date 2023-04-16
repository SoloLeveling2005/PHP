@extends('base')
@section('title', 'games')
@section('body')
    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container">
                <h4>Games</h4>
                <hr>
                <div class="table">
                    <div class="row bg-grey-light">
                        <div class="col">Title</div>
                        <div class="col">{{$game->title}}</div>
                    </div>
                    <div class="row">
                        <div class="col">Author</div>
                        <div class="col">{{$game->author->username}}</div>
                    </div>
                    <div class="row bg-grey-light">
                        <div class="col">Created at</div>
                        <div class="col">{{$game->created_at}}</div>
                    </div>
                </div>

                <h4>Scores</h4>
                @foreach($game->versions as $game_version)
                    <h5>
                        Version {{$game_version->version}}
                        <form action="{{route('drop_version_score')}}" method="POST" class="p-0 m-0">
                            <input type="hidden" name="game_version_id" value="{{$game_version->id}}">
                            @csrf
                            <input type="submit" value="Drop">
                        </form>
                    </h5>
                <table class="table">
                    <thead>
                    <tr>
                        <td class="col">Score</td>
                        <td class="col">Player</td>
                        <td class="col">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($game_version->scores as $score)
                        <tr>
                            @if(!$score->user->is_ban)
                                <td>{{$score->score}}</td>
                                <td>{{$score->user->username}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Drop
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{route('drop_all_user_score')}}" method="POSt" class="p-0 m-0">
                                                    <input type="hidden" name="user_id" value="{{$score->user->id}}">
                                                    <input type="hidden" name="game_id" value="{{$game->id}}">
                                                    @csrf
                                                    <input type="submit" value="Удалить все очки игрока" name="">
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{route('drop_score')}}" method="POSt" class="p-0 m-0">
                                                    <input type="hidden" name="score_id" value="{{$score->id}}">
                                                    @csrf
                                                    <input type="submit" value="Удалить очко" name="">
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endforeach
            </div>
        </main>
    </section>
@endsection
