@extends('base')
@section('title','Admin Panel')
@section('profile_name',ucfirst($me->username))
@php
    $filter = Request::get('filter');
@endphp
@section('header')

    <li class="nav-item border-0 bg-dark" role="presentation">
        <button class="nav-link @if($filter == 'default') active @endif border-0 bg-dark text-white" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">Admins</button>
    </li>
    <li class="nav-item border-0 @if($filter == 'users') active @endif bg-dark" role="presentation">
        <button class="nav-link border-0 bg-dark text-white" id="profile-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="profile" aria-selected="false">Users</button>
    </li>
    <li class="nav-item border-0 bg-dark @if($filter == 'games') active @endif" role="presentation">
        <button class="nav-link border-0 bg-dark text-white" id="profile-tab" data-bs-toggle="tab" data-bs-target="#games" type="button" role="tab" aria-controls="profile" aria-selected="false">Games</button>
    </li>

@endsection
@section('main')
    <div class="tab-content w-100 container p-0 pt-3" id="myTabContent">
        <div class="tab-pane fade @if($filter == 'default' or !$filter) show active @endif  px-2" id="admin" role="tabpanel" aria-labelledby="admin-tab">
            <h3 class="px-0 mx-0 ">Admins</h3>
            <hr>
            <div class="row py-2 bg-grey-100 ">
                <div class="col fw-bold">Username</div>
                <div class="col fw-bold">Created at</div>
                <div class="col fw-bold">Last login</div>
            </div>
            @foreach($admins as $admin)
                <div class="row py-2 @if($loop->index%2==0) bg-light @else bg-grey-100 @endif">
                    <div class="col">{{$admin['username']}}</div>
                    <div class="col">{{$admin['created_at']}}</div>
                    <div class="col">{{$admin['updated_at']}}</div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade @if($filter == 'users') show active @endif" id="users" role="tabpanel" aria-labelledby="profile-tab">
            <h3 class="px-0 mx-0 ">Users</h3>
            <hr>
            <div class="row py-2 bg-grey-100 ">
                <div class="col fw-bold">Username</div>
                <div class="col fw-bold">Created at</div>
                <div class="col fw-bold">Last login</div>
                <div class="col fw-bold">Actions</div>
            </div>
            @foreach($users as $user)
                <?php $banned = $user->ban ?>
                <div class="row py-1 @if($loop->index%2==0) bg-light @else bg-grey-100 @endif">
                    <a href="{{route('user', ['username'=>$user->username])}}" class="d-block col text-decoration-none text-dark"><div class=" d-flex align-items-center @if($banned)text-decoration-line-through @endif">{{$user['username']}}</div></a>
                    <div class="col d-flex align-items-center @if($banned)text-decoration-line-through @endif">{{$user['created_at']}}</div>
                    <div class="col d-flex align-items-center @if($banned)text-decoration-line-through @endif">{{$user['updated_at']}}</div>
                    <div class="col d-flex align-items-center">
                        @if($banned)
                            <form action="{{route('user_unban', ['user_id'=>$user->id])}}" method="POST" class="d-flex align-items-center p-0 m-0">
                                @csrf
                                <input type="submit" class="btn btn-success" value="Unlock"/>
                            </form>
                        @else
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
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade @if($filter == 'games') show active @endif" id="games" role="tabpanel" aria-labelledby="contact-tab">
            <h3 class="px-0 mx-0 ">Games</h3>
            <div class="row">
                <form action="{{route('game_filter')}}" class="p-0 m-0 d-flex" method="POST">
                    @csrf
                    <div class="col px-2"><input type="text" class="w-100 me-2 p-1" placeholder="введите текст" name="filter_data"></div>
                    <div class="col-2"><input type="submit" class="btn btn-primary w-100 mx-2" value="Поиск"></div>
                </form>

            </div>
            <hr>
            <div class="row py-2 bg-grey-100 ">
                <div class="col-2 fw-bold"></div>
                <div class="col fw-bold">Title</div>
                <div class="col fw-bold">Author</div>
                <div class="col fw-bold">Actions</div>
            </div>

            @foreach($games as $game)
                <?php $banned = $game->deleted_at ?>
                <div class="row py-1 @if($loop->index%2==0) bg-light @else bg-grey-100 @endif">
                    <div class="col-2 d-flex align-items-center"></div>
                    <a href="{{route('game', ['slug'=>$game->slug])}}" class="col @if($banned)text-decoration-line-through @else text-decoration-none @endif text-dark"><div class="d-flex align-items-center">{{$game->title}}</div></a>
                    <div class="col d-flex align-items-center @if($banned)text-decoration-line-through @else text-decoration-none @endif">
                        {{$game->author->username}}
                    </div>
                    <div class="col d-flex align-items-center">
                        @isset($banned)
                            <form action="{{route('game_recovery', ['game_id'=>$game->id])}}" method="POST" class="p-0 m-0">
                                @csrf
                                <input type="submit" value="Restore" class="btn btn-success" name="Restore">
                            </form>
                        @else
                            <form action="{{route('game_delete', ['game_id'=>$game->id])}}" method="POST" class="p-0 m-0">
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-danger" name="Delete">
                            </form>
                        @endisset

                    </div>
                </div>
            @endforeach
        </div>
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
