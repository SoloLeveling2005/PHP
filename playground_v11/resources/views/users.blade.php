@extends('base')
@section('title', 'users')
@section('body')
    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container">
                <h4>Users</h4>
                <hr>
                <table class="table">
                    <thead>
                    <tr>
                        <td class="col">Username</td>
                        <td class="col">Last login</td>
                        <td class="col">Created at</td>
                        <td class="col">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            @if($user->is_ban)
                                <td>{{$user->username}}</td>
                                <td>{{$user->updated_at}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <form action="{{route('user_unban')}}" method="POST" class="p-0 m-0">
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        @csrf
                                        <input type="submit" value="Unban" class="btn btn-success bg-success">
                                    </form>
                                </td>
                            @else
                                <td><a href="{{route('user', ['username'=>$user->username])}}">{{$user->username}}</a></td>
                                <td>{{$user->updated_at}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Ban
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form class="dropdown-item" action="{{route('user_ban')}}" method="POST">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    @csrf
                                                    <input type="submit" value="Spamming" name="Spamming" class="w-100 bg-white border-0">
                                                </form>
                                            </li>
                                            <li>
                                                <form class="dropdown-item" action="{{route('user_ban')}}" method="POST">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    @csrf
                                                    <input type="submit" value="Cheating" name="Cheating" class="w-100 bg-white border-0">
                                                </form>
                                            </li>
                                            <li>
                                                <form class="dropdown-item" action="{{route('user_ban')}}" method="POST">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    @csrf
                                                    <input type="submit" value="Other" name="Other" class="w-100 bg-white border-0">
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
            </div>
        </main>
    </section>
@endsection
