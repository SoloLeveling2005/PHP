@extends('main')
@section('title', 'Info')
@section('main_content')
    <div class="bg-black p-2 mb-2">
        <ul class="nav nav-tabs border-0 container" id="myTab" role="tablist">
            <li class="fs-3 w-auto text-white fw-bold" style="margin-right: 40px;">{{ $admin_me }}</li>
            <button class="btn ms-auto text-white fs-6">Log out</button>
        </ul>
    </div>
    <div class="container p-0">

        @if($type_info == 'user')
            <p class="fs-3 pt-2">{{ ucfirst($info['username']) }}</p>
            <hr>
        @else {{-- game --}}
            <div class="d-flex justify-content-between align-items-center">
                <p class="fs-3">{{ $info['title'] }}</p>
                @if($info['deleted_at'])
                    <button class="btn btn-success float-end">Recover</button>
                @else
                    <button class="btn btn-danger float-end">Delete</button>
                @endif


            </div>

            <hr>
            <div class="row border-1 border-bottom">
                <div class="col text-black d-flex align-items-center py-2">Title</div>
                <div class="col text-black d-flex align-items-center py-2">{{$info['title']}}</div>
            </div>
            <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                <div class="col text-black bg-grey-my d-flex align-items-center py-2">Status</div>
                <div class="col text-black bg-grey-my d-flex align-items-center py-2">
                @if($info['deleted_at'])
                    <span class="text-danger">Inactive</span>
                    @else
                    <span class="text-success">Active</span>
                @endif
                </div>
            </div>
            <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                <div class="col text-black bg-grey-my d-flex align-items-center py-2">Description</div>
                <div class="col text-black bg-grey-my d-flex align-items-center py-2">{{$info['description']}}</div>
            </div>
            <div class="row border-top border-1 border-bottom">
                <div class="col text-black d-flex align-items-center py-2">Author</div>
                <div class="col text-black d-flex align-items-center py-2">{{$info['author']['username']}}</div>
            </div>
            <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                <div class="col text-black bg-grey-my d-flex align-items-center py-2">Versions</div>
                <div class="col text-black bg-grey-my d-flex align-items-center py-2">
                    @foreach($info['versions'] as $version)
                        {{$version['file_name']}}
                        <br>
                    @endforeach
                </div>


            </div>
        @endif


    </div>




@endsection
