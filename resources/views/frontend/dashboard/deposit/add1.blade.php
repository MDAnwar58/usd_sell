@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <div class="row">
        <div class="col-md-12">
            <div class="affter-border">
                <div class="d-flex justify-content-end pt-3">
                    <a href="{{ route('deposit_all') }}" class="btn btn-success">Your Deposit List</a>
                </div>
                <div class="row">
                    @foreach ($payment_method_types as $payment_method_type)
                        <div class="col-md-6 pe-5">
                            <div class="bank-card  d-flex align-items-center deposite-banck my-2">
                                {{-- <i class="fa fa-cc-visa mx-2 mt-2 mb-0"></i> --}}
                                <i class="fas fa-money-check mx-2 my-0"></i>
                                <span>{{ $payment_method_type->name }}</span>
                            </div>
                            <div class="affter-border">
                                <div class="row">
                                    @foreach ($payment_method_type->payment_methods as $item)
                                        <div class="master-cards card m-3">
                                            <div class="card">
                                                <a href="{{ route('deposit_add1', $item->id) }}" class="card-body">
                                                    <img src="{{ $item->image }} " class="mx-2" height="50px">
                                                    {{ $item->name }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#gateway').change(function() {
                var gatewayId = $(this).val();
                $.ajax({
                    url: '/payment/' + gatewayId,
                    type: 'GET',
                    success: function(response) {
                        if (response.number) {
                            $('#card').removeClass('d-none');
                            $('#show').text(response.number);
                            $('#image').attr('src', response
                                .image); // Correctly set the image src
                            console.log(response.image)
                            $('#phone_No').val(response.number);
                            $('#attention').show();
                        } else {
                            console.log("Payment method not found");
                            $('#attention').text('Payment method not found').show();
                        }

                    },
                    error: function(xhr) {
                        console.error('An error occurred:', xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
