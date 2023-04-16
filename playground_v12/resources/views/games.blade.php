@extends('base')
@section('tile', 'Games')
@section('body')


    <section class="w-100">
        @include('header')
        <div class="container">
        <h4 class="mt-3">Games</h4>
        <hr>
        <table class="table">
            <thead>
            <tr>
                <th class="col">Title</th>
                <th class="col">Author</th>
                <th class="col">Created at</th>
                <th class="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($games as $game)
                @if($game->deleted_at)
                <tr>
                    <td class="text-decoration-line-through">{{$game->title}}</td>
                    <td class="text-decoration-line-through">{{$game->author->username}}</td>
                    <td class="text-decoration-line-through">{{$game->created_at}}</td>
                    <td>
                        <form action="{{route('game_refresh')}}" method="POST">
                            @csrf
                            <input type="hidden" name="game_id" value="{{$game->id}}">
                            <input type="submit" value="Refresh" class="btn btn-success">
                        </form>
                    </td>
                </tr>
                @else
                    <tr>
                        <td><a href="{{route('game', ['slug'=>$game->slug])}}" class="text-dark">{{$game->title}}</a></td>
                        <td>{{$game->author->username}}</td>
                        <td>{{$game->created_at}}</td>
                        <td>
                            <form action="{{route('game_delete')}}" method="POST">
                                @csrf
                                <input type="hidden" name="game_id" value="{{$game->id}}">
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        </div>

    </section>


@endsection
