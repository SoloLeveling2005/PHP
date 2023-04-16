@extends('base')
@section('title', 'auth')
@section('body')

    <section class="w-100 h-100 d-flex align-items-center justify-content-center">
        <form action="{{route('auth')}}" method="POST" class="w-25">
            @csrf
                <input type="text" name="username" placeholder="username" class="form-control my-2">
                <input type="password" name="password" placeholder="password" class="form-control my-2">
            <input type="submit" value="Авторизоваться" class="bt btn-success w-100">
        </form>
    </section>

@endsection
