@extends('main')

@section('content')
    <style>
        .bg-grey-my {
            background-color: #eaeaea
        }
    </style>
    <!-- Nav tabs -->
    <div class="bg-black p-2 mb-2">
        <ul class="nav nav-tabs border-0 container" id="myTab" role="tablist">
            <li class="fs-3 w-auto text-white fw-bold" style="margin-right: 40px;">Admin1</li>
            <li class="nav-item d-flex align-middle" role="presentation">
                <button class="text-white bg-black fw-bold active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
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
        <div class="tab-pane fade show active w-100 h-100 container" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="mb-5">
                <p class="m-0 py-2 fs-4">Admins</p>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my fw-bold">Title</div>
                    <div class="col text-black bg-grey-my fw-bold">Description</div>
                    <div class="col text-black bg-grey-my fw-bold">Author</div>
                    <div class="col text-black bg-grey-my fw-bold">Last version</div>
                </div>
                <div class="row border-top border-1 border-bottom">
                    <div class="col text-black">1</div>
                    <div class="col text-black">2</div>
                    <div class="col text-black">3</div>
                    <div class="col text-black">3</div>
                </div>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my">1</div>
                    <div class="col text-black bg-grey-my">2</div>
                    <div class="col text-black bg-grey-my">3</div>
                    <div class="col text-black bg-grey-my">3</div>
                </div>
                <div class="row border-top border-1 border-bottom">
                    <div class="col text-black">1</div>
                    <div class="col text-black">2</div>
                    <div class="col text-black">3</div>
                    <div class="col text-black">3</div>
                </div>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my">1</div>
                    <div class="col text-black bg-grey-my">2</div>
                    <div class="col text-black bg-grey-my">3</div>
                    <div class="col text-black bg-grey-my">3</div>
                </div>
            </div>
            <div class="mb-5">
                <p class="m-0 py-2 fs-4">Users</p>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my fw-bold">Title</div>
                    <div class="col text-black bg-grey-my fw-bold">Description</div>
                    <div class="col text-black bg-grey-my fw-bold">Author</div>
                    <div class="col text-black bg-grey-my fw-bold">Last version</div>
                </div>
                <div class="row border-top border-1 border-bottom">
                    <div class="col text-black">1</div>
                    <div class="col text-black">2</div>
                    <div class="col text-black">3</div>
                    <div class="col text-black">3</div>
                </div>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my">1</div>
                    <div class="col text-black bg-grey-my">2</div>
                    <div class="col text-black bg-grey-my">3</div>
                    <div class="col text-black bg-grey-my">3</div>
                </div>
                <div class="row border-top border-1 border-bottom">
                    <div class="col text-black">1</div>
                    <div class="col text-black">2</div>
                    <div class="col text-black">3</div>
                    <div class="col text-black">3</div>
                </div>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my">1</div>
                    <div class="col text-black bg-grey-my">2</div>
                    <div class="col text-black bg-grey-my">3</div>
                    <div class="col text-black bg-grey-my">3</div>
                </div>
            </div>
            <div class="mb-5">
                <p class="m-0 py-2 fs-4">Games</p>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my fw-bold">Title</div>
                    <div class="col text-black bg-grey-my fw-bold">Description</div>
                    <div class="col text-black bg-grey-my fw-bold">Author</div>
                    <div class="col text-black bg-grey-my fw-bold">Last version</div>
                </div>
                <div class="row border-top border-1 border-bottom">
                    <div class="col text-black">1</div>
                    <div class="col text-black">2</div>
                    <div class="col text-black">3</div>
                    <div class="col text-black">3</div>
                </div>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my">1</div>
                    <div class="col text-black bg-grey-my">2</div>
                    <div class="col text-black bg-grey-my">3</div>
                    <div class="col text-black bg-grey-my">3</div>
                </div>
                <div class="row border-top border-1 border-bottom">
                    <div class="col text-black">1</div>
                    <div class="col text-black">2</div>
                    <div class="col text-black">3</div>
                    <div class="col text-black">3</div>
                </div>
                <div class="row border-top border-1 border-opacity-25 border-bottom border-dark">
                    <div class="col text-black bg-grey-my">1</div>
                    <div class="col text-black bg-grey-my">2</div>
                    <div class="col text-black bg-grey-my">3</div>
                    <div class="col text-black bg-grey-my">3</div>
                </div>
            </div>

        </div>
        <div class="tab-pane fade w-100 h-100 container" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            Users
        </div>
        <div class="tab-pane fade w-100 h-100 container" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            Games
        </div>
        <div class="tab-pane fade w-100 h-100 container" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">

        </div>
    </div>

@endsection
