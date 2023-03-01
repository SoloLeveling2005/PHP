@extends('main')

@section('title','Log in')
@section('main_content')

    <form action="{{ route('login_POST') }}" method="POST">
        @csrf
        <label>Введите имя пользователя
            <input type="text" placeholder="username" name="username">
        </label>
        <label>Введите пароль
            <input type="password" placeholder="password" name="password">
        </label>
        <input type="submit" value="Авторизоваться" class="btn btn-success">
    </form>

@endsection
