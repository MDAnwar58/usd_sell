@extends('layouts.fontend.dashboard')
@section('fontend')
    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="col-12">
            <div class="d-flex  justify-content-between align-items-center">
                <div class="dropdown ads-area ">
                    <a class="btn btn-secondary rounded-color" href="#">Sell</a>
                    <a class="btn btn-secondary rounded-color" href="#">Buy</a>
                    <select class="select-usdt mb-3">
                        <option class="p-2" value="">BDT</option>
                        <option class="p-2" value="">Bitcoin</option>
                        <option class="p-2" value="">Paypal</option>
                        <option class="p-2" value="">USDT</option>
                        <option class="p-2" value="">BTC</option>
                    </select>
                    <a class="btn btn-secondary rounded-color" href="#">Add Post</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mt-2">
                    <select class="form-select" aria-label="Default select example">
                        <option value="1">Sell</option>
                        <option value="2">Buy</option>
                    </select>
                </div>
                <div class="mt-2" class="border-ads">
                    <label>Quantity:</label>
                    <input type="number" class="form-control" name="">
                </div>
                <div class="mt-2">
                    <label>Form Limite:</label>
                    <input type="number" class="form-control" name="">
                </div>
                <div class="mt-2">
                    <label>Trade:</label>
                    <input type="number" class="form-control" name="">
                </div>
                <div class="mt-2">
                    <label>Contact Number:</label>
                    <input type="number" class="form-control" name="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-2">
                    <select class="form-select" aria-label="Default select example">
                        <option value="1">Select a Category</option>
                        <option value="1">Sell</option>
                        <option value="2">Buy</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label>To Limite:</label>
                    <input type="number" class="form-control" name="">
                </div>
                <div class="mt-2">
                    <label>Exchange Amount:</label>
                    <input type="number" class="form-control" name="">
                </div>
                <div class="mt-2">
                    <label>Completion:</label>
                    <input type="number" class="form-control" name="">
                </div>
                <div class="mt-2">
                    <select class="form-select" aria-label="Default select example">
                        <option value="1">Select a Gateway</option>
                        <option value="1">Sell</option>
                        <option value="2">Buy</option>
                    </select>
                </div>
                <div class="mt-2 mb-2">
                    <button type="submit" class="btn btn-success">Post</button>
                </div>
            </div>
        </div>
    </div>
@endsection
