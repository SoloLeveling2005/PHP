@extends('base')
@section('title', 'auth')
@section('body')
    <section class="w-100 h-100 fs-4 d-flex align-items-center justify-content-center">
        <form class="d-flex flex-column align-items-center" action="" method="POST">
            <div class="d-flex flex-column">
                <label for="username" class="w-100 text-left fw-bold">Username</label>
                <input type="text" id="username" placeholder="username" class="my-2">    
            </div>
            
            <div class="d-flex flex-column">
                <label for="password" class="w-100 text-left fw-bold">Password</label>
                <input type="text" id="password" placeholder="password" class="my-2">    
            </div>
            
            <input type="submit" value="Авторизоваться" class="btn btn-success w-100">
        </form>
    </section>
@endsection