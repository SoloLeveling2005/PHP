@extends('base')
@section('title', 'Auth')
@section('body')
    <section class="w-100 h-100 d-flex align-items-center justify-content-center">
        <form action="{{route('auth')}}" method="POST" class="d-flex flex-column w-25">
            @csrf
            <label for="username">
                Username
            </label>
            <input name="username" type="text" id="username" class="form-control my-2">
            <label for="password">
                Password
            </label>
            <input name="password" type="password" id="password" class="form-control my-2">
            <input type="submit" value="Авторизоваться" class="btn btn-success w-100">
        </form>

    </section>
@endsection
