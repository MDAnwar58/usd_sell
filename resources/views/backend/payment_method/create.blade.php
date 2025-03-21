@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item active">Add Payment Method</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Payment Method</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('payment_method.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="name" class="form-label">Name<span
                                                class="text-danger ">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Add Payment Method Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="account_no" class="form-label">Account NO<span
                                                class="text-danger ">*</span></label>
                                        <input type="text" name="account_no" class="form-control" id="account_no"
                                            placeholder="Add Payment Method Account NO">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="commission" class="form-label">Charge %<span
                                                class="text-danger ">*</span></label>
                                        <input type="text" name="commission" class="form-control" id="commission"
                                            placeholder="Add Payment Method Charge %">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="branch" class="form-label">Branch<span
                                                class="text-danger ">*</span></label>
                                        <input type="text" name="branch" class="form-control" id="branch"
                                            placeholder="Add Payment Method Branch">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="min_amount" class="form-label">Minimum Amount<span
                                                class="text-danger ">*</span></label>
                                        <input type="number" name="min_amount" class="form-control" id="min_amount"
                                            placeholder="Add Payment Method Minimum Amount">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="max_amount" class="form-label">Maximam Amount<span
                                                class="text-danger ">*</span></label>
                                        <input type="number" name="max_amount" class="form-control" id="max_amount"
                                            placeholder="Add Payment Method Maximam Amount">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="desc" class="form-label">Something Information<span
                                                class="text-danger ">*</span></label>
                                        <input type="text" name="desc" class="form-control" id="desc"
                                            placeholder="Something Informationt">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="desc" class="form-label">Payment Method Type<span
                                                class="text-danger ">*</span></label>
                                        <select name="payment_method_type_id" class="form-control">
                                            <option value=""></option>
                                            @foreach ($payment_method_types as $payment_method_type)
                                                <option value="{{ $payment_method_type->id }}">
                                                    {{ $payment_method_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="image" class="form-label">Image<span
                                                class="text-danger ">*</span></label>
                                        <input type="file" name="image" class="form-control" id="image"
                                            placeholder="Add Payment Method">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="status" class="form-label">Status </label>
                                        <input type="checkbox" name="status" value="1" class="form-check bg-info"
                                            placeholder="Add Payment Method">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                    Changes</button>

                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    payment_method_name: {
                        required: true,
                    },
                },
                messages: {
                    payment_method_name: {
                        required: 'Please Enter Payment Method Name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
