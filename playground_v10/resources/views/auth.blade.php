@extends('body')
@section('title', 'Auth')
@section('body')

    <section class="w-100 h-100">
        <form action="{{route('login')}}" class="d-flex align-items-start">
            @csrf
            <input type="text" placeholder="username" name="username" class="form-control">
            <input type="password" placeholder="password" name="password" class="form-control">
            <input type="submit" value="Авторизоваться" class="btn btn-primary w-100">
        </form>
    </section>
@endsection
