@extends('base')
@section('title', 'auth')
@section('body')


    <section class="w-100 h-100 d-flex align-items-center justify-content-center">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <input type="text" class="form-control my-2" placeholder="username" name="username">
            <input type="password" class="form-control my-2" placeholder="password" name="password">
            <input type="submit" value="Авторизоваться" class="btn btn-success w-100">
        </form>
    </section>

@endsection
