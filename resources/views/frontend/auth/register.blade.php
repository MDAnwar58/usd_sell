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

        .form-inner form .field-password-confirmation {
            height: 50px;
            width: 100%;
        }

        .form-inner form .field-password-confirmation input {
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
    <div class="wrapper mb-5 mt-5">
        <div class="title-text mt-5">
            <div class="title signup">Signup Form</div>
        </div>

        <!-- Start Form Container -->
        <div class="form-container">


            <div class="form-inner">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="field">
                        <input type="name" name="name" placeholder="Your Name">
                    </div>
                    <div class="field">
                        <input type="text" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="field">
                        <select class="form-select border border-info" name="country" aria-label="Default select example">
                            @foreach ($countries as $item)
                                <option value="{{ $item->nicename }}">{{ $item->nicename }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <select class="form-select border-info" name="currency" aria-label="Default select example">
                            <option value="BDT">BDT</option>
                            {{-- <option value="USD">USD</option>
                            <option value="Rs">Rs</option> --}}
                        </select>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" id="myInput" required>
                    </div>
                    <div class="d-flex justify-centent-end align-items-center">
                        <input type="checkbox" class="my-3 mt-1 mx-2" id="check" onclick="myFunction()">
                        <label for="check">Show Password</label>
                    </div>
                    <div class="field-password-confirmation">
                        <input type="password" name="password_confirmation" id="myInput1" placeholder="Confirm password"
                            required>
                    </div>
                    <div class="d-flex justify-centent-end align-items-center">
                        <input type="checkbox" class="my-3 mt-1 mx-2" id="check1" onclick="myFunction1()"><label
                            for="check1">Show Password</label>
                    </div>

                    <div class="field">
                        <input type="submit" value="Signup">
                    </div>
                    <a href="{{ route('user_login') }}" class="text-cente">Already Register</a>
                </form>

            </div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
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

        function myFunction1() {
            var x = document.getElementById("myInput1");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script src="{{ asset('frontend/assets/js/register.js') }}"></script>
@endsection
