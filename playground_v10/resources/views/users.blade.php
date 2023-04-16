@extends('base')
@section('title', 'Users')
@section('body')

    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container">
                <h4 class="mt-2">Users</h4>
                <hr>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col">Username</th>
                        <th class="col">Last login</th>
                        <th class="col">Created at</th>
                        <th class="col">Action</th>
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
                                                <form action="{{route('user_ban')}}" method="POST" class="p-0 m-0">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    @csrf
                                                    <input type="submit" value="Cheating" class="w-100" name="cheating">
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{route('user_ban')}}" method="POST" class="p-0 m-0">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    @csrf
                                                    <input type="submit" value="Spamming" class="w-100" name="spamming">
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{route('user_ban')}}" method="POST" class="p-0 m-0">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    @csrf
                                                    <input type="submit" value="Other" class="w-100" name="other">
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
