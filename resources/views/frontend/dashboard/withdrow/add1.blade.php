@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <div class="row">
        <div class="col-md-12">
            <div class="affter-border">
                <h2 class="text-center text-info">Withdrow Method</h2>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('withdrow_all') }}" class="btn btn-success">Your Withdrow List</a>
                    </div>
                    <div class="col-md-4 ">
                        <div class="bank-card  d-flex deposite-banck my-2">
                            <i class="fa fa-cc-visa mx-2 my-2"></i>
                            <span>Payment Gateway</span>
                        </div>
                        <div class="affter-border">
                            <div class="row">
                                @foreach ($payment_methods as $item)
                                    <div class="master-cards card m-3">
                                        <div class="card">
                                            <a href="{{ route('withdrow_add_2', $item->id) }}" class="card-body">
                                                <img src="{{ $item->image }} " class="mx-2" height="50px">
                                                {{ $item->name }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
