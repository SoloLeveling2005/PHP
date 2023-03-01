@extends('main')
@section('content')
    <div class="w-100 h-100 d-flex justify-content-center align-items-center ">
        <form method="POST" action="{{ route('loginAuth') }}" class="mx-auto my-auto d-flex flex-column">
            @csrf
            <input name="username" type="text" placeholder="username" class="m-2 p-2 fs-3">
            <input name="password" type="password" placeholder="password" class="m-2 p-2 fs-3">
            <input type="submit" value="Авторизоваться" class="m-2 p-1 fs-3 btn btn-success">
        </form>
    </div>
@endsection



