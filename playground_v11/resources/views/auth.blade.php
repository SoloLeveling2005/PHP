@extends('base')
@section('title', 'auth')
@section('body')
    <section class="w-100 h-100 d-flex align-items-center justify-content-center">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="username" class="form-control">
            <input type="password" name="password" placeholder="password" class="form-control">
            <input type="submit" value="Авторизоваться" class="btn btn-primary w-100">
        </form>
    </section>
@endsection
