@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <link href="{{ asset('frontend/assets/css/profile.css') }}" rel="stylesheet">
    <script src="{{ asset('frontend/assets/js/profile.js') }}"></script>

    <div class="d-flex align-content-center">
        <h2 class="fw-bold text-white">Payment Recive Information</h2>
    </div>
    <div class="row align-content-center ">
        <div class="col-md-6 line-right ">

            <div class="user-form">
                <form action="{{ route('payment_store') }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label>Account Name</label>
                        <div class="input-group">
                            <input class="form-control" name="gateway" type="text"
                                value="{{ $payment->gateway??'' }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Account Numner</label>
                        <div class="input-group">
                            <input class="form-control" name="account_number" type="text"
                                value="{{ $payment->account_number??'' }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Something Information</label>
                        <div class="input-group">
                            <input class="form-control" name="desc" type="text"
                                value="{{ $payment->desc??'' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Now</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
