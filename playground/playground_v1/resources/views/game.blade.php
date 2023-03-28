@extends('base')
@section('title','Game')
@auth('admin')
    @section('profile_name',ucfirst($me->username))
@endauth
@section('main')
    <div class="h-100 w-100 container py-3">
        <div class="row">
            <div class="col-2">
                <img src="" alt="" class="w-100 h-100" style="min-height: 200px;">
            </div>
            <div class="col">
                <div class="row py-2 bg-grey-100 ">
                    <div class="col fw-bold">Title</div>
                    <div class="col">{{$game->title}}</div>
                </div>
                <div class="row py-2 bg-light">
                    <div class="col fw-bold">Description</div>
                    <div class="col ">{{$game->description}}</div>
                </div>
                <div class="row py-2 bg-grey-100">
                    <div class="col fw-bold">Versions</div>
                    <div class="col">
                        @foreach($game->versions as $version)
                            <li>{{$version->path_to_file}}</li>
                        @endforeach
                    </div>
                </div>
                @auth('admin')
                    <div class="row py-2 bg-light">
                        <div class="col fw-bold">Actions</div>
                        <div class="col">
                            <form action="{{route('game_delete', ['game_id'=>$game->id])}}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-danger px-4" value="Ban">
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        <hr>

        <div class="d-flex align-items-center mt-3 mb-0">
            <p class="fs-3 py-2 pe-2 mb-0 fw-bold">Scores</p>
            <form action="{{route('reset_all_game_score', ['game_id'=>$game->id])}}" method="POST" class="m-0">
                @csrf
                <input type="submit" class="btn btn-danger fs-6" value="Reset">
            </form>
        </div>
        @foreach($game->versions->sortBy('created_at') as $version)
            <p class="fs-4 fw-bold pb-0 mb-0">Version v{{$loop->iteration}}</p>
            <div class="row py-2 ">
                <div class="col fw-bold">Score</div>
                <div class="col fw-bold">Player</div>
                <div class="col fw-bold">Actions</div>
            </div>
            @foreach($version->version_scores as $scores)
                @empty($scores->user->ban)
                    <div class="row py-2  @if($loop->index%2==1) bg-grey-100 @else bg-light @endif">
                        <div class="col">{{$scores->score}}</div>
                        <div class="col">{{$scores->user->username}}</div>
                        <div class="col">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Delete
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{route('reset_user_score', ['score_id'=>$scores->id])}}" method="POST" class="p-0 m-0">
                                            @csrf
                                            <input class="w-100 h-100 dropdown-item" type="submit" name="reason" value="Delete score">
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{route('reset_all_user_score', ['user_id'=>$scores->user->id])}}" method="POST" class="p-0 m-0">
                                            @csrf
                                            <input class="w-100 h-100 dropdown-item" type="submit" name="reason" value="Delete all user score">
                                        </form>
                                    </li>
    {{--                                <li>--}}
    {{--                                    <form action="{{route('user_ban', ['user_id'=>$user->id, 'reason_id'=>$reason->id])}}" method="POST" class="p-0 m-0">--}}
    {{--                                        @csrf--}}
    {{--                                        <input class="w-100 h-100 dropdown-item" type="submit" name="reason" value="{{$reason->reason}}">--}}
    {{--                                    </form>--}}
    {{--                                </li>--}}
    {{--                                <li>--}}
    {{--                                    <form action="{{route('user_ban', ['user_id'=>$user->id, 'reason_id'=>$reason->id])}}" method="POST" class="p-0 m-0">--}}
    {{--                                        @csrf--}}
    {{--                                        <input class="w-100 h-100 dropdown-item" type="submit" name="reason" value="{{$reason->reason}}">--}}
    {{--                                    </form>--}}
    {{--                                </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                @endisset
            @endforeach
            <div class="mb-3"></div>
        @endforeach

    </div>
@endsection
<style>
    li .active {
        font-weight: bold;
    }
    li:hover button {
        opacity: .7;

    }
    .bg-grey-100 {
        background-color: #eaeaea;
    }
</style>
