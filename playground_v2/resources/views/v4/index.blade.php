@extends('base')
@section('title', 'Index')
@section('body')

    <section class="w-100 h-100">
        <div class="bg-secondary">
            <div class="container w-100 d-flex justify-content-between align-items-center py-2">
                  <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active text-white" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Admins</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link text-white"  id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Users</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link text-white" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Games</button>
                    </li>
                  </ul>
                <button class="btn btn-primary py-1">Logout</button>
            </div>
            
              
        </div>
        <div class="container">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <h2 class="mt-2">Admins</h2>
                    <hr class="my-0 py-0">
                    <div class="mx-3 table mt-2 border-1">
                        <div class="row py-2 border-bottom">
                            <div class="col fw-bold fs-5">Username</div>
                            <div class="col fw-bold fs-5">Created at</div>
                            <div class="col fw-bold fs-5">Last login</div>
                        </div>
                        <div class="row py-2 border-bottom bg-secondary text-white">
                            <div class="col">123</div>
                            <div class="col">123</div>
                            <div class="col">123</div>
                        </div>
                        <div class="row py-2 border-bottom">
                            <div class="col">1232</div>
                            <div class="col">123</div>
                            <div class="col">ddd</div>
                        </div>
                        <div class="row py-2 border-bottom bg-secondary text-white">
                            <div class="col">123</div>
                            <div class="col">123</div>
                            <div class="col">123</div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <h2 class="mt-2">Users</h2>
                    <hr class="my-0 py-0">
                    <div class="mx-3 table mt-2 border-1">
                        
                        <div class="row py-2 border-bottom">
                            <div class="col fw-bold fs-5">Username</div>
                            <div class="col fw-bold fs-5">Created at</div>
                            <div class="col fw-bold fs-5">Last login</div>
                            <div class="col fw-bold fs-5">Actions</div>
                        </div>
                        <div class="row py-2 border-bottom bg-secondary text-white d-flex align-items-center">
                            <a class="col text-white" href="{{ route('user', ['username'=>'user1'])}}">User1</a>
                            <div class="col">123</div>
                            <div class="col">123</div>
                            <div class="col">
                                <div class="btn-group p-0 m-0">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Lock
                                    </button>
                                    <ul class="dropdown-menu">
                                        <form action="">
                                            <li class="w-100"><input class="bg-white border-0 w-100 border-top border-bottom" type="submit" name="Spamming" value="Spamming"></li>
                                            <li class="w-100"><input class="bg-white border-0 w-100 border-top border-bottom" type="submit" name="Cheating" value="Cheating"></li>
                                            <li class="w-100"><input class="bg-white border-0 w-100 border-top border-bottom" type="submit" name="Other" value="Other"></li>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row py-2 border-bottom  d-flex align-items-center">
                            <a class="col text-dark" href="">123</a>
                            <div class="col">123</div>
                            <div class="col">123</div>
                            <div class="col">
                                <form action="">
                                    <button type="submit" class="btn btn-success">
                                        UnLock
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                    <h2 class="mt-2">Games</h2>
                    <hr class="my-0 py-0">
                    <div class="mx-3 table mt-2 border-1">
                        
                        <div class="row border-bottom py-2">
                            <div class="col-1 fw-bold"></div>
                            <div class="col fw-bold fs-5">Title</div>
                            <div class="col-3 fw-bold fs-5">Author</div>
                            <div class="col-2 fw-bold fs-5">Actions</div>
                        </div>
                        <div class="row border-bottom bg-secondary text-white d-flex align-items-center py-2">
                            <div class="col-1"></div>
                            <a class="col text-white" href="">123</a>
                            <div class="col-3">123</div>
                            <div class="col-2">
                                <form action="">
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="row border-bottom d-flex align-items-center py-2">
                            <div class="col-1"></div>
                            <a class="col text-dark" href="">123</a>
                            <div class="col-3">123</div>
                            <div class="col-2">
                                <form action="">
                                    <button type="submit" class="btn btn-success">
                                        Refresh
                                    </button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
@endsection