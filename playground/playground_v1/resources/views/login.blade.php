@extends('base')
@section('title', 'Login')
@section('main')
    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
        <form action="{{ route('PostLogin') }}" class="d-flex flex-column w-25" method="POST">
            @csrf
            <label for="username" class="fs-3">Username:</label>
            <input class="p-2 m-2" type="text" id="username" name="username">

            <label for="password" class="fs-3">Password:</label>
            <input class="p-2 m-2" type="password" id="password" name="password">

            <input class="p-2 m-2 btn btn-success" type="submit" value="Авторизоваться">
        </form>
    </div>

@endsection
