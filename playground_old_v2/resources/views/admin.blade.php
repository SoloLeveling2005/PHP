@extends('main')
@section('title','Admin panel')
@section('main_content')
<style>
    .bg-grey-my {
        background-color: #eaeaea
    }
    .active {
        opacity: 1 !important;
    }
    a {
        text-decoration: none;
    }
</style>

<!-- Nav tabs -->
<div class="bg-black p-2 mb-2">
    <ul class="nav nav-tabs border-0 container" id="myTab" role="tablist">
        <li class="fs-3 w-auto text-white fw-bold" style="margin-right: 40px;">{{ $admin_me }}</li>
        <li class="nav-item d-flex align-middle" role="presentation">
            <button class="text-white bg-black fw-bold opacity-50 active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#admin-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Admins</button>
        </li>
        <li class="nav-item d-flex align-middle" role="presentation">
            <button class="text-white bg-black fw-bold opacity-50" id="contact-tab" data-bs-toggle="tab" data-bs-target="#user-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Users</button>
        </li>
        <li class="nav-item d-flex align-middle" role="presentation">
            <button class="text-white bg-black fw-bold opacity-50" id="contact-tab" data-bs-toggle="tab" data-bs-target="#game-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Games</button>
        </li>
        <button class="btn ms-auto text-white fs-6">Log out</button>
    </ul>
</div>

<div class="tab-content" id="myTabContent">
{{--    <div class="tab-pane fade show active w-100 h-100 container" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">--}}
{{--        <div class="mb-5">--}}
{{--            <p class="m-0 py-2 fs-4">Admins</p>--}}
{{--            <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Username</div>--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Created at</div>--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Last login</div>--}}
{{--            </div>--}}
{{--            @foreach($admins as $index=>$admin)--}}
{{--                @if($index%2 == 0)--}}
{{--                    <div class="row border-top border-1 border-bottom">--}}
{{--                        <div class="col text-black d-flex align-items-center py-2">{{$admin['username']}}</div>--}}
{{--                        <div class="col text-black d-flex align-items-center py-2">{{$admin['created_at']}}</div>--}}
{{--                        <div class="col text-black d-flex align-items-center py-2">{{$admin['updated_at']}}</div>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">--}}
{{--                        <div class="col text-black bg-grey-my d-flex align-items-center py-2">{{$admin['username']}}</div>--}}
{{--                        <div class="col text-black bg-grey-my d-flex align-items-center py-2">{{$admin['created_at']}}</div>--}}
{{--                        <div class="col text-black bg-grey-my d-flex align-items-center py-2">{{$admin['updated_at']}}</div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div class="mb-5">--}}
{{--            <p class="m-0 py-2 fs-4">Users</p>--}}
{{--            <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Username</div>--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Created at</div>--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Action</div>--}}
{{--            </div>--}}
{{--            @foreach($users as $index=>$user)--}}
{{--                @if($index%2 == 0)--}}
{{--                    <div class="row border-top border-1 border-bottom">--}}
{{--                        <div class="col text-black d-flex align-items-center">{{$user['username']}}</div>--}}
{{--                        <div class="col text-black d-flex align-items-center">{{$user['created_at']}}</div>--}}
{{--                        <div class="col text-black d-flex align-items-center">--}}
{{--                            <div class="dropdown my-1">--}}
{{--                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                    Ban--}}
{{--                                </button>--}}
{{--                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--                                    <li><a class="dropdown-item" href="#">Spamming</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Cheating</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Other</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">--}}
{{--                        <div class="col text-black bg-grey-my d-flex align-items-center">{{$user['username']}}</div>--}}
{{--                        <div class="col text-black bg-grey-my d-flex align-items-center">{{$user['created_at']}}</div>--}}
{{--                        <div class="col text-black d-flex align-items-center bg-grey-my">--}}
{{--                            <div class="dropdown my-1">--}}
{{--                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                    Ban--}}
{{--                                </button>--}}
{{--                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--                                    <li><a class="dropdown-item" href="#">Spamming</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Cheating</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Other</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div class="mb-5">--}}
{{--            <p class="m-0 py-2 fs-4">Games</p>--}}
{{--            <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Title</div>--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Description</div>--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Author</div>--}}
{{--                <div class="col text-black bg-grey-my fw-bold">Last version</div>--}}
{{--            </div>--}}
{{--            @foreach($games as $index=>$game)--}}
{{--                @if($index%2 == 0)--}}
{{--                    <div class="row border-top border-1 border-bottom">--}}
{{--                        <div class="col text-black py-2">{{$game['title']}}</div>--}}
{{--                        <div class="col text-black py-2">{{$game['description']}}</div>--}}
{{--                        <div class="col text-black py-2">{{$game['author']}}</div>--}}
{{--                        <div class="col text-black py-2">{{$game['latest_version']}}</div>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">--}}
{{--                        <div class="col text-black bg-grey-my py-2">{{$game['title']}}</div>--}}
{{--                        <div class="col text-black bg-grey-my py-2">{{$game['description']}}</div>--}}
{{--                        <div class="col text-black bg-grey-my py-2">{{$game['author']}}</div>--}}
{{--                        <div class="col text-black bg-grey-my py-2">{{$game['latest_version']}}</div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}

{{--        </div>--}}

{{--    </div>--}}
    <div class="tab-pane fade show active w-100 h-100 container" id="admin-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
         <div class="mb-5">
                <p class="m-0 py-2 fs-4">Admins</p>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my fw-bold">Username</div>
                    <div class="col text-black bg-grey-my fw-bold">Created at</div>
                    <div class="col text-black bg-grey-my fw-bold">Last login</div>
                </div>
             @foreach($admins as $index=>$admin)
                @if($index%2 == 0)
                     <div class="row border-top border-1 border-bottom">
                         <div class="col text-black d-flex align-items-center py-2">{{$admin['username']}}</div>
                         <div class="col text-black d-flex align-items-center py-2">{{$admin['created_at']}}</div>
                         <div class="col text-black d-flex align-items-center py-2">{{$admin['updated_at']}}</div>
                     </div>
                @else
                     <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                         <div class="col text-black bg-grey-my d-flex align-items-center py-2">{{$admin['username']}}</div>
                         <div class="col text-black bg-grey-my d-flex align-items-center py-2">{{$admin['created_at']}}</div>
                         <div class="col text-black bg-grey-my d-flex align-items-center py-2">{{$admin['updated_at']}}</div>
                     </div>
                @endif
             @endforeach
         </div>
    </div>
    <div class="tab-pane fade w-100 h-100 container" id="user-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
        <div class="mb-5">
            <p class="m-0 py-2 fs-4">Users</p>
            <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                <div class="col text-black bg-grey-my fw-bold">Username</div>
                <div class="col text-black bg-grey-my fw-bold">Created at</div>
                <div class="col text-black bg-grey-my fw-bold">Action</div>
            </div>
            @foreach($users as $index=>$user)
                @if($index%2 == 0)
                    <div class="row border-top border-1 border-bottom">
                        <a class="col text-black d-flex align-items-center" href="{{ route('user', ['username' => $user['username']]) }}">{{$user['username']}}</a>
                        <div class="col text-black d-flex align-items-center">{{$user['created_at']}}</div>
                        <div class="col text-black d-flex align-items-center">
                            <div class="dropdown my-1">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Ban
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Spamming</a></li>
                                    <li><a class="dropdown-item" href="#">Cheating</a></li>
                                    <li><a class="dropdown-item" href="#">Other</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                        <a class="col text-black bg-grey-my d-flex align-items-center" href="{{ route('user', ['username' => $user['username']]) }}">{{$user['username']}}</a>
                        <div class="col text-black bg-grey-my d-flex align-items-center">{{$user['created_at']}}</div>
                        <div class="col text-black d-flex align-items-center bg-grey-my">
                            <div class="dropdown my-1">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Ban
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Spamming</a></li>
                                    <li><a class="dropdown-item" href="#">Cheating</a></li>
                                    <li><a class="dropdown-item" href="#">Other</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
    <div class="tab-pane fade w-100 h-100 container" id="game-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
        <div class="mb-5">
            <p class="m-0 py-2 fs-4">Games</p>
            <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                <div class="col text-black bg-grey-my fw-bold">Title</div>
                <div class="col text-black bg-grey-my fw-bold">Description</div>
                <div class="col text-black bg-grey-my fw-bold">Author</div>
                <div class="col text-black bg-grey-my fw-bold">Last version</div>
            </div>
            @foreach($games as $index=>$game)
                @if($index%2 == 0)
                    <div class="row border-top border-1 border-bottom">
                        <a class="col text-black py-2" href="{{ route('game', ['slug' => $game['slug']]) }}">{{$game['title']}}</a>
                        <div class="col text-black py-2">{{$game['description']}}</div>
                        <div class="col text-black py-2">{{$game['author']}}</div>
                        <div class="col text-black py-2">{{$game['latest_version']}}</div>
                    </div>
                @else
                    <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                        <a class="col text-black bg-grey-my py-2" href="{{ route('game', ['slug' => $game['slug']]) }}">{{$game['title']}}</a>
                        <div class="col text-black bg-grey-my py-2">{{$game['description']}}</div>
                        <div class="col text-black bg-grey-my py-2">{{$game['author']}}</div>
                        <div class="col text-black bg-grey-my py-2">{{$game['latest_version']}}</div>
                    </div>
                @endif
            @endforeach

        </div>

    </div>
</div>

@endsection
