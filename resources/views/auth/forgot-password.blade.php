@extends('layouts.fontend.master')
@section('fontend')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-lg-4 col-md-6 col-sm-8">
            <!-- Pills content -->
            <div class="mt-5">
                <form action="{{ route('send.email') }}" method="POST">
                    @csrf
                    <h3 class="text-center text-dark">Email Send</h3>

                    <div data-mdb-input-init class="form-outline mb-3">
                        {{-- <label class="form-label" for="loginName">Email</label> --}}
                        <input type="email" id="loginName" name="email" class="form-control" />
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        @if (Session::has('fail'))
                            <strong class="text-danger">{{ Session::get('fail') }}</strong>
                        @endif
                    </div>


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary tet-center btn-block mb-4">Send</button>

                    <div class="text-center">
                        <p>Not a member? <a href="{{ route('register') }}">Register</a></p>
                    </div>
                </form>
            </div>

        </div>
        <!-- Pills content -->
    </div>
    </div>
@endsection
