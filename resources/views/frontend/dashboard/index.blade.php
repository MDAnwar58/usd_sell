@extends('layouts.fontend.dashboard')
{{-- @section('css')
    <style>
        .profile-avater-box {
            position: relative;
        }

        .profile-avater-box img {
            max-width: 100%;
            height: 100px;
        }

        .profile-avater-box .upload-btn {
            position: absolute;
            top: 3px;
            right: 3px;
            color: #2980b9;
            background-color: transparent !important;
            padding: 0;
            border: none !important;
            font-size: 20px;
            width: 25px;
            height: 25px;
        }

        @media only screen and (max-width: 1400px) {
            .profile-avater-box {
                max-width: 100px;
            }

            .profile-avater-box img {
                max-width: 100px;
                height: 100px;
            }
        }
    </style>
@endsection --}}
@section('user_dashboard')
    <link href="{{ asset('frontend/assets/css/profile.css') }}" rel="stylesheet">
    <script src="{{ asset('frontend/assets/js/profile.js') }}"></script>

    <div class="d-flex align-content-center">
        <h2 class="fw-bold text-white">Profile Info</h2>
    </div>
    <div class="row align-content-center ">
        <div class="col-lg-4 line-right ">
            <div class="row">
                <div class="col-xxl-4 col-12 d-flex justify-content-lg-start justify-content-center">
                    <div class="profile-avater-box">
                        <img src="{{ Auth::user()->photo ?? asset('frontend/assets/img/user.png') }}" id="avater"
                            class="rounded-circle">
                        <button type="button" onclick="uploadImage()" class="upload-btn">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                </div>
                <div class="col-xxl-8 col-12 text-white text-lg-start text-center py-2">
                    <span>{{ Auth::user()->email }}</span><br>
                    <span>Unique ID:{{ Auth::user()->unique_id }}</span><br>
                    <strong class="">Balance : {{ Auth::user()->wallet->wallet }}</strong><br>
                    @if (Auth::user()->email_verified_at == null)
                        <span class="not-virified text-center">Not Verified</span>
                    @else
                        <span class="btn btn-success text-center">Verified</span>
                    @endif
                </div>
            </div>
            <div class="user-form">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>Name</label>
                        <div class="input-group">
                            <input class="form-control" name="name" type="text"
                                value="{{ old('name', Auth::user()->name) }}"
                                @if (Auth::user()->name !== null) disabled @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="position-relative">
                            <input class="form-control" name="email" type="email" disabled
                                value="{{ old('email', Auth::user()->email) }}" required>
                            <small class=" position-absolute translate-middle bg-dark text-white px-2 rounded"
                                style="top: -3px; right: -20px;">{{ Auth::user()->email_verified_at == null ? 'unverified' : 'verified' }}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <div class="input-group">
                            <input class="form-control" name="date_of_birth" type="date"
                                value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <div class="input-group">
                            <input class="form-control" name="address" type="text"
                                value="{{ old('address', Auth::user()->address) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <div class="input-group">
                            <input class="form-control" name="phone" type="text"
                                value="{{ old('phone', Auth::user()->phone) }}">
                        </div>
                    </div>

                    <div class="form-group d-none">
                        <label>Photo</label>
                        <div class="input-group">
                            <input class="form-control" name="photo" id="photo" type="file">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4 documentations">
            {{-- <h2 class="text-light">Documents Verification:</h2>
            <form action="{{ route('document.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>NID Number</label>
                    <div class="input-group">
                        <input class="form-control" name="nid_no" type="text"
                            value="{{ old('nid_no', Auth::user()->nid_no) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>NID First Page</label>
                    <div class="input-group">
                        <input class="form-control" name="nid_1" type="file">
                    </div>
                </div>
                @if (Auth::user()->nid_1)
                    <img src="{{ asset(Auth::user()->nid_1) }}" height="100px" width="100px" alt="">
                @endif
                <div class="form-group">
                    <label>NID Second Page</label>
                    <div class="input-group">
                        <input class="form-control" name="nid_2" type="file">
                    </div>
                </div>
                @if (Auth::user()->nid_2)
                    <img src="{{ asset(Auth::user()->nid_2) }}" height="100px" width="100px" alt="">
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit Now</button>
                </div>
            </form> --}}
            <div class="card border-2 w-full mb-3" style="border: solid #2980B9;">
                <div class="card-header text-white border-b border-secondary" style="background-color: #313b4e;">
                    Verifcation of
                    documents
                </div>
                <div class="card-body text-white" style="background-color: #313b4e;">
                    <p class="card-text">Please upload a color photo or scanned image of your civil reguler passport,
                        driving license, or National Identity Card.</p>
                    <div class="">
                        <button type="button" class=" btn btn-primary px-0" style="width: 100%;" data-bs-toggle="modal"
                            data-bs-target="#document-upload-modal">Upload Documents</button>
                    </div>
                </div>
            </div>

            <div class="d-lg-none d-block">
                <form method="post" action="{{ route('password.update') }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label>Old Password</label>
                        <div class="input-group">
                            <input class="form-control" name="current_password" type="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <div class="input-group">
                            <input class="form-control" type="password" name="password">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="input-group">
                            <input class="form-control" type="password" name="password_confirmation">
                            @error('password_confirmation')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4 d-lg-block d-none change-password">
            <form method="post" action="{{ route('password.update') }}">
                @method('put')
                @csrf
                <div class="form-group">
                    <label>Old Password</label>
                    <div class="input-group">
                        <input class="form-control" name="current_password" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <div class="input-group">
                        <input class="form-control" type="password" name="password">
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-group">
                        <input class="form-control" type="password" name="password_confirmation">
                        @error('password_confirmation')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let photo = document.getElementById('photo');
        photo.value = '';

        function uploadImage() {
            photo.click();
        }
    </script>
@endsection
@include('frontend.document-upload-modal')
