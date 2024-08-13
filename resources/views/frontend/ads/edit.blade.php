@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <div class="row">
        <div class="col-12">
            <div class="d-flex  justify-content-between align-items-center">
                <div class="dropdown ads-area btn text-light ">
                    Edit Post
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mt-2">
                    <select class="form-select" name="for"  aria-label="Default select example">
                        <option value="sell" {{ $post->for == 'sell' ? 'selected' : '' }}>Sell</option>
                        <option value="buy" {{ $post->for == 'buy' ? 'selected' : '' }}>Buy</option>
                    </select>
                </div>
                <div class="mt-2" class="border-ads">
                    <label class="text-light">Quantity:</label>
                    <input type="number" name="quality" value="{{$post->quality}}" class="form-control">
                </div>

                <div class="mt-2">
                    <label class="text-light">Form Limite:</label>
                    <input type="number" class="form-control" name="from_limit" value="{{$post->from_limit}}">
                </div>

                <div class="mt-2">
                    <label class="text-light">Contact Number:</label>
                    <input type="number" class="form-control" name="contact_number" value="{{$post->contact_number}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-2">
                    <select class="form-select" name="category_id" value="{{$post->category_id}}" aria-label="Default select example">
                        <option selected disabled>Select a Category</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" {{ $post->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2">
                    <label class="text-light">To Limite:</label>
                    <input type="number" class="form-control" name="to_limit" value="{{$post->to_limit}}">
                </div>
                <div class="mt-2">
                    <label class="text-light">Exchange Amount:</label>
                    <input type="number" class="form-control" name="exchange_amount" value="{{$post->exchange_amount}}">
                </div>

                <div class="mt-2">
                    <label class="text-light">Select a Gateway</label>
                    <select class="form-select" name="gateway"  aria-label="Default select example">
                        <option selected disabled></option>
                        @foreach ($gateway as $item)
                            <option value="{{$item->name}}" {{ $post->gateway == $item->name ? 'selected' : '' }}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2 mb-2">
                    <button type="submit" class="btn btn-success">Post</button>
                </div>
            </div>
        </div>
    </div>
@endsection
