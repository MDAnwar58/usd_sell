@extends('layouts.fontend.master')
@section('fontend')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ Auth::user()->photo ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp' }}"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <div class="row justify-content-center mt-2">
                                @if (Auth::user()->email_verified_at == null)
                                    <strong class="text-dark bg-danger p-2">Un Verified</strong>
                                @else
                                    <strong class="bg-success text-light p-2"> Verified</strong>
                                @endif
                            </div>
                            <h5 class="my-3">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-4">{{ Auth::user()->address }}</p>
                            <p class="text-muted mb-4">Total Balance : {{ Auth::user()->wallet->wallet ?? 0 }}</p>
                            <p class="text-muted mb-4">Pending Deposit Balance : {{ Auth::user()->wallet->deposit ?? 0 }}
                            </p>
                            <p class="text-muted mb-4">Pending Withdrow Balance : {{ Auth::user()->wallet->withdrow ?? 0 }}
                            </p>

                            <a href="/chat?user_id={{ Auth::user()->id }}" class="btn btn-info text-white">Connect
                                Message</a>
                            {{-- <a href="{{ route('profile.edit') }}" class="btn btn-info">Edit Profile</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="d-flex">
                        <div class="col-md-3"><a href="{{ route('deposit_all') }}" class="btn btn-success">Deposit</a></div>
                        <div class="col-md-3"><a href="{{ route('withdrow_all') }}" class="btn btn-success">Withdrow</a>
                        </div>
                        <div class="col-md-3"><a href="{{ route('tranjection') }}" class="btn btn-success ">Tranjection</a>
                        </div>
                        <div class="col-md-3 "><a href="{{ route('notifications') }}"
                                class="btn btn-success ">Notification</a></div>
                    </div>

                    <div class="card mb-4 mt-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->phone }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
