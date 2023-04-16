@extends('base')
@section('title', 'User')
@section('body')

<section class="w-100 h-100">
    <div class="bg-secondary">
        <div class="container w-100 d-flex justify-content-between align-items-center py-2">
            <a href="{{route('index')}}" class="fs-3 text-white text-decoration-none">Home</a>
            <button class="btn btn-primary py-1">Logout</button>
        </div>
    </div>
    <div class="container mt-3">
        <h4>User1</h4>
        <hr class="mt-0 pt-0">
        <h5>Info</h5>
        <div class="mx-3 table mt-2 border-1 mb-5">
            <div class="row py-2 border-bottom">
                <div class="col">Username</div>
                <div class="col">User1</div>
            </div>
            <div class="row py-2 border-bottom bg-secondary text-white">
                <div class="col">Last login</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom">
                <div class="col">Created at</div>
                <div class="col">123</div>
            </div>
        </div>
        
        <hr>
        <h5>Authored Games</h5>
        <div class="mx-3 table mt-2 border-1 mb-5">
            <div class="row py-2 border-bottom">
                <div class="col fw-bold fs-5">Game</div>
                <div class="col fw-bold fs-5">Score</div>
            </div>
            <div class="row py-2 border-bottom bg-secondary text-white">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom bg-secondary text-white">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom bg-secondary text-white">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
        </div>

        <hr>
        <h5>Scores</h5>
        <div class="mx-3 table mt-2 border-1 mb-5">
            <div class="row py-2 border-bottom">
                <div class="col fw-bold fs-5">Game</div>
                <div class="col fw-bold fs-5">Score</div>
            </div>
            <div class="row py-2 border-bottom bg-secondary text-white">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom bg-secondary text-white">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom bg-secondary text-white">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
            <div class="row py-2 border-bottom">
                <div class="col">Game 1</div>
                <div class="col">123</div>
            </div>
        </div>
    </div>
</section>

@endsection