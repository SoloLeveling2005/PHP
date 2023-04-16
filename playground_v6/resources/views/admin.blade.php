@extends('base')
@section('title', 'admins')
@section('body')


    <section class="w-100 h-100">
        @include('header')
        <main class="w-100">
            <div class="container pt-3">
                <h4>Admins</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col">Username</th>
                            <th class="col">Created at</th>
                            <th class="col">Updated at</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{$admin->username}}</td>
                                <td>{{$admin->created_at}}</td>
                                <td>{{$admin->updated_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </section>

@endsection
