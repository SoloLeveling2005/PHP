@extends('base')
@section('title', 'users')
@section('body')

    <section class="w-100 h-100">
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
        <main class="w-100">
            <div class="container">
                <h4 class="mt-4">Users</h4>
                <hr>
                <table class="table">
                    <thead>
                    <tr class="">
                        <th class="col fw-bold">Username</th>
                        <th class="col fw-bold">Last login</th>
                        <th class="col fw-bold">Created at</th>
                        <th class="col fw-bold">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if($user->is_ban)

                            <tr>
                                <td class="text-decoration-line-through">{{$user->username}}</td>
                                <td class="text-decoration-line-through">{{$user->updated_at}}</td>
                                <td class="text-decoration-line-through">{{$user->created_at}}</td>
                                <td>
                                    <form action="{{route('user_unban', ['user_id'=>$user->id])}}" class="p-0 m-0" method="POST">
                                        @csrf
                                        <input type="submit" value="Refresh" class="btn btn-success bg-success">
                                    </form>
                                </td>
                            </tr>

                        @else

                            <tr>
                                <td><a href="{{route('user', ['username'=>$user->username])}}" class="text-dark">{{$user->username}}</a></td>
                                <td>{{$user->updated_at}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
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

                                </td>
                            </tr>

                        @endif

                    @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </section>

@endsection
