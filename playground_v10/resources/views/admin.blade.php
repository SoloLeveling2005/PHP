@extends('base')
@section('title', 'Admins')
@section('body')

    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container">
                <h4 class="mt-2">Admins</h4>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col">Username</th>
                            <th class="col">Last login</th>
                            <th class="col">Created at</th>
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
