@extends('base')
@section('tile', 'Auth')
@section('body')


<section class="w-100 h-100 d-flex align-items-center justify-content-center">
    <form action="{{route('login')}}" method="POST" class=" h-100 d-flex align-items-center justify-content-center flex-column">
        @csrf
        <input type="text" placeholder="username" class="form-control mb-2" name="username">
        <input type="password" placeholder="password" class="form-control mb-2" name="password">
        <input type="submit" value="Авторизоваться" class="btn btn-primary w-100">
    </form>
</section>


@endsection
