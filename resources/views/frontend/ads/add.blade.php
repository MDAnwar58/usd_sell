@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <div class="row">
        <div class="col-12">
            <div class="d-flex  justify-content-between align-items-center">
                <div class="dropdown ads-area btn text-light ">
                    Add Post
                </div>
            </div>
        </div>
        <form action="{{ route('sell_store') }}" method="post" class="row">
            @csrf
            <div class="col-md-6">
                <div class="mt-2">
                    <select class="form-select" name="for" id="buyAndSale"
                        onchange="onChangeBuyAndSale(event.target.value)" aria-label="Default select example">
                        <option value="sell">Sell</option>
                        <option value="buy">Buy</option>
                    </select>
                </div>
                <div class="mt-2" class="border-ads">
                    <label class="text-light">Quantity:</label>
                    <input type="number" name="quality" class="form-control">
                </div>

                <div class="mt-2" id="form-limit-group">
                    <label class="text-light">Limit:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="to_limit">
                        <button type="button" class=" btn py-0 input-group-btn">-</button>
                        <input type="text" class="form-control" name="from_limit">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-2">
                    <select class="form-select" name="category_id" aria-label="Default select example">
                        <option selected disabled>Select Wallet</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2" id="form-rate-group">
                    <label class="text-light">Rate:</label>
                    <input type="number" class="form-control" name="rate">
                </div>

                <div class="mt-2">
                    <label class="text-light">Contact Number:</label>
                    <input type="number" class="form-control" name="contact_number">
                </div>
                {{-- <div class="mt-2">
                    <label class="text-light">Exchange Amount:</label>
                    <input type="number" class="form-control" name="exchange_amount">
                </div>

                <div class="mt-2">
                    <label class="text-light">Select a Gateway</label>
                    <select class="form-select" name="gSelect a Gatewayateway" aria-label="Default select example">
                        <option selected disabled></option>
                        @foreach ($gateway as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="mt-2 mb-2">
                    <button type="submit" class="btn btn-success">Post</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let formLimitGroup = document.getElementById('form-limit-group');
        let formRateGroup = document.getElementById('form-rate-group');
        let buyAndSale = document.getElementById('buyAndSale');

        onChangeBuyAndSale("sell");

        function onChangeBuyAndSale(value) {
            if (value === "sell") {
                buyAndSale.value = "sell";
                formLimitGroup.classList.remove('d-none');
                formRateGroup.classList.remove('d-none');
            } else {
                formLimitGroup.classList.add('d-none');
                formRateGroup.classList.add('d-none');
            }
        }
    </script>
@endsection
