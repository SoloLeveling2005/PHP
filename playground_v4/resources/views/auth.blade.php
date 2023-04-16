@extends('base')
@section('title', 'admins')
@section('body')

    <section class="w-100 h-100">
        <form action="" method="POST">
            <label>
                <input type="text" name="username" placeholder="username">
            </label>
            <label>
                <input type="password" name="password" placeholder="password">
            </label>
            <input type="submit" value="Авторизоваться" class="w-100 btn btn-success">
        </form>
    </section>

@endsection('body')
