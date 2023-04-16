@extends('base')
@section('tile', 'Users')
@section('body')


    <section class="w-100">
        @include('header')
        <div class="container">
        <h4 class="mt-3">Users</h4>
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
                @if($user->is_ban)
                    <tr>
                        <td class="text-decoration-line-through">{{$user->username}}</td>
                        <td class="text-decoration-line-through">{{$user->updated_at}}</td>
                        <td class="text-decoration-line-through">{{$user->created_at}}</td>
                        <td>
                            <form action="{{route('user_unban')}}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <input type="submit" value="Unban" class="btn btn-success">
                            </form>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td><a href="{{route('user', ['username'=>$user->username])}}" class="text-dark">{{$user->username}}</a></td>
                        <td>{{$user->updated_at}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Ban
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{route('user_ban')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="hidden" name="reason_id" value="1">
                                            <input type="submit" value="Cheating" name="Cheating" class="btn w-100">
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{route('user_ban')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="hidden" name="reason_id" value="2">
                                            <input type="submit" value="Spamming" name="Spamming" class="btn w-100">
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{route('user_ban')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="hidden" name="reason_id" value="3">
                                            <input type="submit" value="Other" name="Other" class="btn w-100">
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        </div>

    </section>


@endsection
