@extends('base')
@section('title', 'games')
@section('body')

    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <a href="{{route('admins')}}" class="text-white me-3">Admins</a>
                    <a href="{{route('users')}}" class="text-white me-3">Users</a>
                    <a href="{{route('games')}}" class="text-white me-3 fw-bold">Games</a>
                </div>
                <form action="{{route('logout')}}" method="POST" class="p-0 m-0">
                    @csrf
                    <input type="submit" value="Logout" class="btn text-white">
                </form>
            </div>
        </header>
        <main class="w-100">
            <div class="container">
                <h4 class="mt-4">Games</h4>
                <hr>
                <div class="w-100 d-flex">
                    <input type="text" class="form-control me-3" id="find-data">
                    <button class="btn btn-primary" onclick="check()">Поиск</button>
                </div>
                <table class="table">
                    <thead>
                    <tr class="">
                        <th class="col fw-bold">Title</th>
                        <th class="col fw-bold">Author</th>
                        <th class="col fw-bold">Created at</th>
                        <th class="col fw-bold">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($games as $game)
                        @if($game->deleted_at)
                            <tr id="{{$loop->index}}">
                                <td id="title" class="text-decoration-line-through">{{$game->title}}</td>
                                <td id="author" class="text-decoration-line-through">{{$game->author->username}}</td>
                                <td class="text-decoration-line-through">{{$game->created_at}}</td>
                                <td id="description" class="d-none">{{$game->description}}</td>
                                <td>
                                    <form action="{{route('game_refresh', ['game_id'=>$game->id])}}" class="p-0 m-0" method="POST">
                                        @csrf
                                        <input type="submit" value="Refresh" class="btn btn-success bg-success">
                                    </form>
                                </td>
                            </tr>

                        @else

                            <tr id="{{$loop->index}}">
                                <td id="title"><a href="{{route('game', ['slug'=>$game->slug])}}" class="text-dark">{{$game->title}}</a></td>
                                <td id="author">{{$game->author->username}}</td>
                                <td>{{$game->created_at}}</td>
                                <td id="description" class="d-none">{{$game->description}}</td>
                                <td>
                                    <form action="{{route('game_delete', ['game_id'=>$game->id])}}" class="p-0 m-0" method="POST">
                                        @csrf
                                        <input type="submit" value="Delete" class="btn btn-danger bg-danger">
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
    <script>
        function check() {
            let findData = document.querySelector('#find-data').value
            let authors = document.querySelectorAll('#author')
            let titles = document.querySelectorAll('#title')
            let descriptions = document.querySelectorAll('#description')
            let look = [];
            console.log(authors)
            console.log(titles)
            console.log(descriptions)

            for (let author_i in authors) {
                try {
                    if (authors[author_i].textContent.toLowerCase().indexOf(findData.toLowerCase()) !== -1) {
                        look.push(author_i)
                        console.log(`${authors[author_i].textContent}`)
                        console.log(findData)
                    }
                } catch (e) {

                }

            }

            for (let title_i in titles) {
                try {
                    if (titles[title_i].textContent.toLowerCase().indexOf(findData.toLowerCase()) !== -1) {
                        look.push(title_i)
                        console.log(`${titles[title_i].textContent}`)
                        console.log(findData)
                    }
                } catch (e) {

                }

            }

            for (let description_i in descriptions) {
                try {
                    if (descriptions[description_i].textContent.toLowerCase().indexOf(findData.toLowerCase()) !== -1) {
                        look.push(description_i)
                        console.log(`${descriptions[description_i].textContent}`)
                        console.log(findData)
                    }
                } catch (e) {

                }

            }
            console.log([...new Set(look)])
        }

    </script>
@endsection
