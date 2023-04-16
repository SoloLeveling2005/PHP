@extends('base')
@section('title', 'users')
@section('body')


    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container pt-3">
                <h4>Users</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col">Username</th>
                        <th class="col">Created at</th>
                        <th class="col">Updated at</th>
                        <th class="col">Action</th>
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if($user->is_ban)
                            <tr>
                                <td class="text-decoration-line-through">{{$user->username}}</td>
                                <td class="text-decoration-line-through">{{$user->created_at}}</td>
                                <td class="text-decoration-line-through">{{$user->updated_at}}</td>
                                <td>
                                    <form action="{{route('user_unban')}}" method="POST" class="p-0 m-0">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <input type="submit" value="Unban" class="btn btn-success">
                                    </form>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td><a href="{{route('user', ['username'=>$user->username])}}">{{$user->username}}</a></td>
                                <td><a href="{{route('user', ['username'=>$user->username])}}">{{$user->created_at}}</a></td>
                                <td><a href="{{route('user', ['username'=>$user->username])}}">{{$user->updated_at}}</a></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Ban
                                        </button>
                                        <form class="dropdown-menu " method="POST" action="{{route('user_ban')}}">
                                            @csrf
                                            <input type="hidden" value="{{$user->id}}" name="user_id">
                                            <input type="submit" value="cheating" class="w-100 border-0 bg-white">
                                            <input type="submit" value="spamming" class="w-100 border-0 bg-white">
                                            <input type="submit" value="other" class="w-100 border-0 bg-white">
                                        </form>
                                    </div>
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
