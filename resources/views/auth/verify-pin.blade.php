@extends('layouts.fontend.master')
@section('fontend')
    @if (Session::has('send_email'))
        <script>
            let sendEmail = @json(Session::get('send_email'));
            setCookie("email", sendEmail, 5 * 60 * 1000);

            function setCookie(cookie_name, cookie_value, time) {
                let expirationTime = time;
                let expires = new Date(new Date().getTime() + expirationTime).toUTCString();
                let path = '; path=/';

                document.cookie = cookie_name + '=' + cookie_value + '; expires=' + expires + path;
            }
        </script>
    @endif
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-lg-4 col-md-6 col-sm-8">
            <!-- Pills content -->
            <div class="mt-5">
                <form action="{{ route('verify.pin.request') }}" method="post">
                    @csrf

                    <h3 class="text-center text-dark">Verify Pin</h3>

                    <div id="alert" class="pb-1 d-none">
                        <div>Please Check Your Email Inbox! <b id="email_show"></b> enter
                            your
                            pin...
                        </div>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="hidden" id="email_input" name="email">
                        <input type="number" id="pin" name="pin" class="form-control" />
                        @error('pin')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary tet-center btn-block mb-4">Verify</button>

                    <div class="text-center">
                        {{-- <p>Not a member? <a href="{{ route('register') }}">Register</a></p> --}}
                    </div>
                </form>
            </div>

        </div>
        <!-- Pills content -->
    </div>
    </div>



    <script>
        function getCookie(name) {
            let cookieName = name + '=';
            let cookies = document.cookie.split(';');

            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i].trim();

                // Check if the cookie name matches
                if (cookie.startsWith(cookieName)) {
                    return cookie.substring(cookieName.length, cookie.length);
                }
            }

            return null; // Return null if cookie not found
        }
        let emailShow = document.getElementById('email_show');
        let emailInput = document.getElementById('email_input');
        let alert = document.getElementById('alert');
        let emailCookie = getCookie('email');
        if (emailCookie) {
            emailShow.innerText = emailCookie;
            emailInput.value = emailCookie;
            alert.classList.remove('d-none');
        } else {
            emailInput.value = null;
            window.location.href = "/forgot-password";
        }
    </script>
@endsection
