@extends('layouts.fontend.master')
@section('fontend')
    <div class="container-fluid buy_and_sell" style="background-color: rgb(34, 33, 33);">
        <div class="container">

            <div class="row">
                <div class="d-flex my-4 justify-content-between align-items-center">
                    <div class="dropdown">
                        <a class="btn btn-secondary rounded" href="{{ route('home') }}">
                            Buy
                        </a>

                        <a class="btn btn-secondary rounded" href="{{ route('sell') }}">
                            Sell
                        </a>

                        <select class="select-usdt mb-3" name="" id="">
                            @foreach ($categories as $data)
                                <option class="p-3" value="{{ $data->name }}"
                                    style="background-color: yellowgreen; margin: 5px 10px;">
                                    {{ $data->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <span><i class="text-white fa-solid fa-bell"></i></span>

                </div>

            </div>

            <div class="row">
                <form action="{{ route('user_post.update', $sell->id) }}" method="post" class="row">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3 col-md-6">
                        <select class="form-select" name="for" aria-label="Default select example">
                            <option value="buy" {{ $sell->for == 'buy' ? 'selected' : '' }}>buy</option>
                            <option value="sell" {{ $sell->for == 'sell' ? 'selected' : '' }}>sell</option>
                        </select>
                        @error('for')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <select class="form-select" name="category_id" aria-label="Default select example">
                            <option selected disabled>Select a Category</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ $sell->category_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="quality" class="form-label">Quality</label>
                        <input type="number" class="form-control" name="quality" value="{{ $sell->quality }}"
                            id="quality" aria-describedby="quality">
                        @error('quality')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="to_limit" class="form-label">To Limite</label>
                        <input type="number" class="form-control" name="to_limit" value="{{ $sell->to_limit }}"
                            id="to_limit">
                        @error('to_limit')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="from_limit" class="form-label">Form Limite</label>
                        <input type="number" class="form-control" name="from_limit" value="{{ $sell->from_limit }}"
                            id="from_limit">
                        @error('from_limit')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exchange_amount" class="form-label">Exchange Amount</label>
                        <input type="number" class="form-control" name="exchange_amount"
                            value="{{ $sell->exchange_amount }}" id="exchange_amount">
                        @error('exchange_amount')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="trade" class="form-label">Trade</label>
                        <input type="number" class="form-control" name="trade" value="{{ $sell->trade }}"
                            id="trade">
                        @error('trade')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="completion" class="form-label">Completion</label>
                        <input type="number" class="form-control" name="completion" value="{{ $sell->completion }}"
                            id="completion">
                        @error('completion')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="phone" class="form-control" name="contact_number"
                            value="{{ $sell->contact_number }}" id="contact_number">
                        @error('contact_number')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <select class="form-select" name="gateway" aria-label="Default select example">
                            <option selected disabled>Select a Gateway</option>
                            @foreach ($methods as $item)
                                <option value="{{$item->name}}" {{ $sell->gateway == $item->name ? 'selected' : '' }}>{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('gateway')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>

        </div>
    </div>
@endsection
