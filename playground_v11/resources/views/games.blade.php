@extends('base')
@section('title', 'games')
@section('body')
    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container">
                <h4>Games</h4>
                <hr>
                <table class="table">
                    <thead>
                    <tr>
                        <td class="col">Title</td>
                        <td class="col">Author</td>
                        <td class="col">Created at</td>
                        <td class="col">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($games as $game)
                        <tr>
                            @if($game->deleted_at)
                                <td>{{$game->title}}</td>
                                <td>{{$game->author->username}}</td>
                                <td>{{$game->created_at}}</td>
                                <td>
                                    <form action="{{route('game_refresh')}}" method="POST" class="p-0 m-0">
                                        <input type="hidden" name="game_id" value="{{$game->id}}">
                                        @csrf
                                        <input type="submit" value="Refresh" class="btn btn-success bg-success">
                                    </form>
                                </td>
                            @else
                                <td><a href="{{route('game', ['slug'=>$game->slug])}}">{{$game->title}}</a></td>
                                <td>{{$game->author->username}}</td>
                                <td>{{$game->created_at}}</td>
                                <td>
                                    <form action="{{route('game_delete')}}" method="POST" class="p-0 m-0">
                                        <input type="hidden" name="game_id" value="{{$game->id}}">
                                        @csrf
                                        <input type="submit" value="Delete" class="btn btn-danger bg-danger">
                                    </form>
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
