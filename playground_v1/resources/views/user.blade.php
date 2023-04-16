@extends('base')
@section('title','User')
@auth('admin')
    @section('profile_name',ucfirst($me->username))
@endauth
@section('main')
    <div class="h-100 w-100 container py-3">
        <div class="row py-2 bg-grey-100 ">
            <div class="col fw-bold">Username</div>
            <div class="col">{{$user->username}}</div>
        </div>
        <div class="row py-2 bg-light">
            <div class="col fw-bold">Created at</div>
            <div class="col ">{{$user->created_at}}</div>
        </div>
        <div class="row py-2 bg-grey-100 ">
            <div class="col fw-bold">Last login</div>
            <div class="col">{{$user->updated_at}}</div>
        </div>
        <div class="row py-2 bg-light ">
            <div class="col fw-bold">Status</div>
            <div class="col @if(isset($user->ban)) text-danger @else text-success @endif">{{isset($user->ban) ? 'banned':'active'}}</div>
        </div>
        @auth('admin')
            <div class="row py-2 bg-grey-100 ">
                <div class="col fw-bold">Actions</div>
                <div class="col">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Lock
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($reasons as $reason)
                                    <li>
                                        <form action="{{route('user_ban', ['user_id'=>$user->id, 'reason_id'=>$reason->id])}}" method="POST" class="p-0 m-0">
                                            @csrf
                                            <input class="w-100 h-100 dropdown-item" type="submit" name="reason" value="{{$reason->reason}}">
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                </div>
            </div>
        @endauth
        <div class="d-flex align-items-center mt-3">
            <p class="fs-3 py-2 pe-2">Scores</p>
            <form action="{{route('reset_all_user_score', ['user_id'=>$user->id])}}" method="POST">
                @csrf
                <input type="submit" class="btn btn-danger fs-6" value="Reset">
            </form>
        </div>
            <div class="row py-2 bg-grey-100">
                <div class="col fw-bold">Version</div>
                <div class="col fw-bold">Score</div>
                <div class="col fw-bold">Actions</div>
            </div>
            @foreach($scores as $score)
                <div class="row py-2 @if($loop->index%2==0) bg-light @else bg-grey-100 @endif">
                    <div class="col">{{$score->game_version->path_to_game}}</div>
                    <div class="col">{{$score->score}}</div>
                    <div class="col">
                        <form action="{{route('reset_user_score', ['score_id'=>$score->id])}}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-warning fs-6" value="Delete">
                        </form>
                    </div>
                </div>
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
