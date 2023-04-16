@extends('base')
@section('title', 'user')
@section('body')


    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container pt-3">
                <h4>User</h4>
                <div class="table">
                    <div class="row bg-grey-light">
                        <div class="col py-2 fw-bold">Username</div>
                        <div class="col py-2">{{$user->username}}</div>
                    </div>
                    <div class="row">
                        <div class="col py-2 fw-bold">Created at</div>
                        <div class="col py-2">{{$user->created_at}}</div>
                    </div>
                    <div class="row bg-grey-light">
                        <div class="col py-2 fw-bold">Last login</div>
                        <div class="col py-2">{{$user->updated_at}}</div>
                    </div>

                </div>

            </div>
        </main>
    </section>

@endsection
