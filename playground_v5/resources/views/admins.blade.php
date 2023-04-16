@extends('base')
@section('title', 'admins')
@section('body')

    <section class="w-100 h-100">
        <header class="w-100 py-2 bg-dark">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <a href="{{route('admins')}}" class="text-white me-3 fw-bold">Admins</a>
                    <a href="{{route('users')}}" class="text-white me-3">Users</a>
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
                <h4 class="mt-4">Admins</h4>
                <hr>
                <table class="table">
                    <thead>
                        <tr class="">
                            <th class="col fw-bold">Username</th>
                            <th class="col fw-bold">Last login</th>
                            <th class="col fw-bold">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr class="">
                                <td>{{$admin->username}}</td>
                                <td>{{$admin->updated_at}}</td>
                                <td>{{$admin->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </section>

@endsection
