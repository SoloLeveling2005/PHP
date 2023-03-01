@extends('main')
@section('title','Admin panel')
@section('main_content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#admins-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Admins</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Users</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#games-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Games</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">Home</div>
    <div class="tab-pane fade" id="admins-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">Admins</div>
    <div class="tab-pane fade" id="users-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">Users</div>
    <div class="tab-pane fade" id="games-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">Games</div>
</div>

@endsection
