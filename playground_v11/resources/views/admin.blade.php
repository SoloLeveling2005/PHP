@extends('base')
@section('title', 'admin')
@section('body')
<section class="w-100 h-100">
    @include('header')
    <main class="w-100">
        <div class="container">
            <h4>Admins</h4>
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <td class="col">Username</td>
                    <td class="col">Last login</td>
                    <td class="col">Created at</td>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{$admin->username}}</td>
                    <td>{{$admin->updated_at}}</td>
                    <td>{{$admin->created_at}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
</section>
@endsection
