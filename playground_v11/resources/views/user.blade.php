@extends('base')
@section('title', 'user')
@section('body')
    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container">
                <h4>User</h4>
                <hr>
                <div class="table">
                    <div class="row">
                        <div class="col">Username</div>
                        <div class="col">{{$user->username}}</div>
                    </div>
                    <div class="row">
                        <div class="col">Last login</div>
                        <div class="col">{{$user->updated_at}}</div>
                    </div>
                    <div class="row">
                        <div class="col">Created at</div>
                        <div class="col">{{$user->created_at}}</div>
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection
