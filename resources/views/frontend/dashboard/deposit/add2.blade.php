@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <div class="row">
        <div class="col-md-12">
            <div class="affter-border">
                <div class="row">
                    <h2 class="text-center text-info">Deposit Payment Method</h2>
                    <div class="master-cards">
                        <div class="card">
                            <form action="{{ route('deposit_store') }}" method="post" class="card-body">
                                @csrf
                                <div class="text-center">
                                    <img src="{{ $payment->image }}" class="rounded-5" id="image" alt="image">
                                    <input type="hidden" name="gateway" value="{{ $payment->name }}">
                                    <input type="hidden" name="number" value="{{ $payment->account_no }}">
                                </div>

                                <div class=" mt-3 col-md-12 text-center" id="card">
                                    <strong class="text-warning">
                                        {{ _('Personal ' . $payment->name . ':- ') }}
                                    </strong>
                                    <strong class="text-warning">{{ $payment->desc }}
                                        <strong id="show" class="text-danger">{{ $payment->account_no }}</strong>
                                    </strong>
                                </div>
                                <div class="mt-4 input-group">
                                    <input type="text" id="amount" class="form-control rounded-start-2"
                                        style="height: 2em; padding: 0.75em 1.15em; font-size: 1.15em; border: 0.05em solid rgba(195, 40, 40, 1) !important; border-right: 0px !important; background-color: rgba(255, 255, 255, 0.9) !important; color: black;"
                                        onkeyup="enterPerchent(event.target.value)" name="amount"
                                        placeholder="Enter Amount" required>
                                    <button type="button" id="commission"
                                        class=" rounded-end-2 bg-white px-3 border-start-0"
                                        style="border: 0.05em solid rgba(195, 40, 40, 1);"></button>
                                </div>
                                <div class="mt-2">
                                    <label class="text-dark mb-0">Full Amount</label>
                                    <input type="text" class="form-control" id="full_amount" name="full_amount"
                                        placeholder="Enter Full Amount" required>
                                </div>
                                <div class="mt-1">
                                    <label class="text-dark mb-0">From Number</label>
                                    <input type="text" class="form-control" name="from_number"
                                        placeholder="Send Money From" required>
                                </div>
                                <div class="mt-1">
                                    <label class="text-dark mb-0">Transaction Id</label>
                                    <input type="text" class="form-control" name="tranjection"
                                        placeholder="Enter Tranjection Id" required>
                                </div>
                                <div class="mt-1">
                                    <label class="text-dark mb-0">Write Your Comments</label>
                                    <textarea class="form-control" name="desc" required> </textarea>
                                </div>
                                <div class="mt-1">
                                    <button type="submit"class="btn btn-info">Request For
                                        Deposite</button>
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

    <script>
        // let amount = document.getElementById('amount');
        let fullAmount = document.getElementById('full_amount');
        let commissionShow = document.getElementById('commission');
        let commission = @json($payment->commission);
        amount.value = "";
        fullAmount.value = "";

        function enterPerchent(value) {
            if (value !== "") {
                commissionShow.innerText = `+ ${commission}%`;
                fullAmount.value = Math.ceil(value) + commission * 10;
            }
        }
    </script>
@endsection
