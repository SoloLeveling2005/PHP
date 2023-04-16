@extends('base')
@section('title', "User $user->username")
@section('body')

    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container">
                <h4 class="mt-2">User {{$user->username}}</h4>
                <hr>
                <div class="table">
                    <div class="row">
                        <div class="col py-2 fw-bold">Username</div>
                        <div class="col">{{$user->username}}</div>
                    </div>
                    <div class="row">
                        <div class="col py-2 fw-bold">Last login</div>
                        <div class="col">{{$user->update_at}}</div>
                    </div>
                    <div class="row">
                        <div class="col py-2 fw-bold">Created at</div>
                        <div class="col">{{$user->created_at}}</div>
                    </div>
                </div>
            </div>
        </main>
    </section>

@endsection
