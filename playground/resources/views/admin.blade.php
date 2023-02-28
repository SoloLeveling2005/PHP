@extends('main')
@if($role == "guest")
    @section('content')
        @include('login')
    @endsection
@else
    @section('content')
        <!-- Nav tabs -->
        <div class="bg-black p-2">

            <ul class="nav nav-tabs border-0 container" id="myTab" role="tablist">
                <li class="fs-3 w-auto text-white fw-bold" style="margin-right: 40px;">Admin1</li>
                <li class="nav-item d-flex align-middle" role="presentation">
                    <button class="text-white bg-black fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                </li>
                <li class="nav-item d-flex align-middle" role="presentation">
                    <button class="text-white bg-black fw-bold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Users</button>
                </li>
                <li class="nav-item d-flex align-middle" role="presentation">
                    <button class="text-white bg-black fw-bold" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Games</button>
                </li>
                <button class="btn ms-auto text-white fs-6">Log out</button>
            </ul>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">

            </div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">

            </div>
        </div>

    @endsection
@endif

