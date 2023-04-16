@extends('base')
@section('tile', 'User')
@section('body')
    <section class="w-100">
        @if(isset($me))
        @include('header')
        @endif
        <div class="container">
            <h4 class="mt-3">User</h4>
            <hr>
            <div class="table">
                <div class="row py-2 bg-grey-light">
                    <div class="col fw-bold">Username</div>
                    <div class="col">{{$user->username}}</div>
                </div>
                <div class="row py-2">
                    <div class="col fw-bold">Last login</div>
                    <div class="col">{{$user->updated_at}}</div>
                </div>
                <div class="row py-2 bg-grey-light">
                    <div class="col fw-bold">Created at</div>
                    <div class="col">{{$user->crated_at}}</div>
                </div>
            </div>
        </div>

    </section>


@endsection
