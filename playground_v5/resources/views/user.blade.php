@extends('base')
@section('title', 'user')
@section('body')

    <section class="w-100 h-100">
        @if ($me)
            <header class="w-100 py-2 bg-dark">
                <div class="container d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="{{route('admins')}}" class="text-white me-3">Admins</a>
                        <a href="{{route('users')}}" class="text-white me-3 fw-bold">Users</a>
                        <a href="{{route('games')}}" class="text-white me-3">Games</a>
                    </div>
                    <form action="{{route('logout')}}" method="POST" class="p-0 m-0">
                        @csrf
                        <input type="submit" value="Logout" class="btn text-white">
                    </form>
                </div>
            </header>
        @endif
        <main class="w-100">
            <div class="container">
                <h4 class="mt-4">User</h4>
                <hr>
                <div class="table">
                    <div class="row py-2 bg-grey-light">
                        <div class="col fw-bold">Username</div>
                        <div class="col">{{$user->username}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col fw-bold">Last login</div>
                        <div class="col">{{$user->updated_at}}</div>
                    </div>
                    <div class="row py-2 bg-grey-light">
                        <div class="col fw-bold">Created at</div>
                        <div class="col">{{$user->created_at}}</div>
                    </div>
                    @if ($me)
                        <div class="row py-2">
                            <div class="col fw-bold">Action</div>
                            <div class="col">
                                <form class="btn-group p-0 m-0" action="{{route('user_ban', ['user_id'=>$user->id])}}" method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Ban
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><input type="submit" class="dropdown-item w-100" name="spamming" value="spamming"></li>
                                        <li><input type="submit" class="dropdown-item w-100" name="cheating" value="cheating"></li>
                                        <li><input type="submit" class="dropdown-item w-100" name="other" value="other"></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </section>

@endsection
