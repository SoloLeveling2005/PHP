@extends('base')
@section('title', 'Admins')
@section('body')

    <section class="w-100 h-100">
        <header class="w-100 py-3 bg-dark">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('admin')}}" class="me-4 text-white fw-bold">admin</a>
                    <a href="{{route('users')}}" class="me-4 text-white">users</a>
                    <a href="{{route('games')}}" class="me-4 text-white">games</a>
                </div>
                <form action="" method="POSt">
                    <input type="submit" value="Logout" class="btn text-white">
                </form>
            </div>
        </header>
        <main class="w-100 pt-3">
            <div class="container">
                <h4>Admins</h4>
                <hr>
                <div class="table">
                    <div class="row py-2">
                        <div class="col fw-bold">Username</div>
                        <div class="col fw-bold">Last login</div>
                        <div class="col fw-bold">Created at</div>
                    </div>
                    @foreach($admins as $admin)
                        @if($loop->index %2 == 1)
                            <div class="row py-2">
                                <div class="col">{{$admin->username}}</div>
                                <div class="col">{{$admin->updated_at}}</div>
                                <div class="col">{{$admin->created_at}}</div>
                            </div>
                        @else
                            <div class="row py-2 bg-grey-light">
                                <div class="col">{{$admin->username}}</div>
                                <div class="col">{{$admin->updated_at}}</div>
                                <div class="col">{{$admin->created_at}}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </main>
    </section>

@endsection
