@extends('admin.admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('payment_method_type.create') }}"
                                    class="btn btn-blue waves-effect waves-light">Add
                                    Payment Method</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Payment Method Types </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Payment Method Type </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment_method_types as $key => $payment_method_type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $payment_method_type->name }}</td>
                                            <td>
                                                <a href="{{ route('payment_method_type.edit', $payment_method_type->id) }}"
                                                    class="btn btn-primary rounded-pill waves-effect waves-light">Edit</a>


                                                <a href="{{ route('payment_method_type.show', $payment_method_type->id) }}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light"
                                                    id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->



        </div> <!-- container -->

    </div> <!-- content -->
@endsection
