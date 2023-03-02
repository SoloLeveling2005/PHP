@extends('main')

@section('title','Log in')
@section('main_content')

    <form action="{{ route('login_POST') }}" method="POST" class="d-flex w-100 h-100 align-items-center justify-content-center flex-md-column">
        @csrf
        <div class="form-group">
            <label for="username" class="">Введите имя пользователя</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="username">
        </div>
        <div class="form-group mt-2">
            <label for="password" class="">Введите пароль</label>
            <input type="password" class="form-control " id="password" name="password" placeholder="password">
        </div>
        <button type="submit" class="btn btn-success m-2 px-5 mt-2">Авторизоваться</button>
    </form>


@endsection
