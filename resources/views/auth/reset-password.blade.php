@extends('layouts.fontend.master')
@section('fontend')
    @if (Session::has('email'))
        <script>
            let email = @json(Session::get('email'));
            localStorage.setItem('email', email);
        </script>
    @endif
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-lg-4 col-md-6 col-sm-8">
            <!-- Pills content -->
            <div class="mt-5">
                <form action="{{ route('reset.password') }}" method="POST">
                    @csrf

                    <h3 class="text-center text-dark">Create New Password</h3>
                    <input type="hidden" id="email_input" name="email">

                    <div data-mdb-input-init class="form-outline mt-4 @error('password') mb-2 @else mb-4 @enderror ">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="New Password" />
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div data-mdb-input-init class="form-outline mb-2">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            placeholder="Password Confirmation" />
                        @error('password_confirmation')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <div class="text-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" onchange="passwordShowAndHide(event)"
                                    id="password-check">
                                <label class="form-check-label text-secondary" for="password-check">
                                    show Password
                                </label>
                            </div>
                        </div>
                    </div>


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary tet-center btn-block mb-4">Reset</button>
                </form>
            </div>

        </div>
        <!-- Pills content -->
    </div>
    </div>



    <script>
        let emailValue = localStorage.getItem('email');
        let emailInput = document.getElementById('email_input');

        let password = document.getElementById('password');
        let password_confirmation = document.getElementById('password_confirmation');
        let passwordCheck = document.getElementById('password-check');
        password.value = "";
        password_confirmation.value = "";
        passwordCheck.checked = false;

        if (emailValue) {
            emailInput.value = emailValue;
        } else {
            emailInput.value = null;
            window.location.href = "/forgot-password";
        }

        function passwordShowAndHide(event) {
            if (event.target.checked === true) {
                password.type = 'text';
                password_confirmation.type = 'text';
            } else {
                password.type = 'password';
                password_confirmation.type = 'password';
            }
        }
    </script>
@endsection
