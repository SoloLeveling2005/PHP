@extends('base')
@section('title', 'games')
@section('body')


    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container pt-3">
                <h4>Games</h4>
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
                        @if($game->deleted_at == null)
                        <tr>
                            <td>
                                <a href="{{route('game', ['slug'=>$game->slug])}}">{{$game->title}}</a>
                            </td>
                            <td>
                                <a href="{{route('game', ['slug'=>$game->slug])}}">{{$game->author->username}}</a>
                            </td>
                            <td>
                                <a href="{{route('game', ['slug'=>$game->slug])}}">{{$game->created_at}}</a>
                            </td>
                            <td>
                                <form action="{{route('game_delete')}}" method="POST" class="p-0 m-0">
                                    @csrf
                                    <input type="hidden" value="{{$game->id}}" name="game_id">
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                        @else
                            <tr>
                                <td class="text-decoration-line-through">{{$game->title}}</td>
                                <td class="text-decoration-line-through">{{$game->author->username}}</td>
                                <td class="text-decoration-line-through">{{$game->created_at}}</td>
                                <td>
                                    <form action="{{route('game_refresh')}}" method="POST" class="p-0 m-0">
                                        @csrf
                                        <input type="hidden" value="{{$game->id}}" name="game_id">
                                        <input type="submit" value="Refresh" class="btn btn-success">
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
