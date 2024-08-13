@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <div class="row">
        <div class="col-md-12">
            <div class="affter-border">
                <h2 class="text-center text-info">Withdrow Payment Method</h2>
                <div class="row">
                    <div class="master-cards">
                        <div class="card">
                            <form action="{{ route('withdrow_store') }}" method="post" class="card-body">
                                @csrf

                                <img src="{{ $payment->image }}" id="image" alt="image">
                                <input type="hidden" name="gateway" value="{{ $payment->name }}">

                                <div class="mt-4">
                                    <label class="text-dark mb-0">Withdraw Amount</label>
                                    <input type="text" class="form-control" name="number" placeholder="Enter Amount">
                                </div>
                                <div class="mt-2">
                                    <label class="text-dark mb-0">Your Personal {{ $payment->name }} Number</label>
                                    <input type="text" class="form-control" name="number"
                                        placeholder="Enter Personal {{ $payment->name }} Number">
                                </div>
                                <div class="mt-2">
                                    <label class="text-dark mb-0">Write Your Comments</label>
                                    <textarea type="text" class="form-control" name="desc" placeholder="Enter Request Massage"> </textarea>
                                </div>

                                <div class="mt-1">
                                    <button type="submit"class="btn btn-info">Request For
                                        Withdraw</button>
                                </div>

                                </from>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
