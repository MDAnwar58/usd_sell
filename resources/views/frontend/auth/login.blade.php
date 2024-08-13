@extends('layouts.fontend.master')
@section('css')
    <link href="{{ asset('frontend/assets/css/login-register.css') }}" rel="stylesheet">
    <style>
        .form-inner form .field input,
        .form-inner form .field select {
            height: 100%;
            width: 100%;
            outline: none;
            font-size: 17px;
            padding-left: 15px;
            border-radius: 5px;
            border: 1px solid lightgrey;
            border-bottom-width: 2px;
            transition: all 0.4s ease;
        }
    </style>
@endsection
@section('fontend')
    <div class="sing-in-content">
        <div class="wrapper mb-5 mt-5">
            <div class="title-text mt-5">
                <div class="title login">Sign In Form</div>
            </div>

            <!-- Start Form Container -->
            <div class="form-container" style="width: 300px">


                <div class="form-inner">
                    <!-- Start Login Form -->
                    <form action="{{ route('login') }}" method="post" class="">
                        @csrf
                        @if (Session::has('reset_success'))
                            <div class=" text-success text-center">{{ Session::get('reset_success') }}</div>
                        @endif
                        <div class="field">
                            <input type="email" placeholder="Email Address" name="email" required>
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="field">
                            <input type="password" name="password" id="myInput" placeholder="Password" required>
                        </div>
                        <div class="d-flex justify-centent-end">
                            <input type="checkbox" class="my-3 mt-1 mx-2" id="check" onclick="myFunction()"><label
                                for="check">Show Password</label>
                        </div>
                        <div class="pass-link">
                            <a href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        </div>
                        <div class="field">
                            <input type="submit" value="Sing In">
                        </div>
                        <div class="signup-link">
                            Not a member? <a href="{{ route('user_registration') }}">Signup now</a>
                        </div>
                    </form>


                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script src="{{ asset('frontend/assets/js/register.js') }}"></script>
@endsection
