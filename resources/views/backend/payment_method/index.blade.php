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
                                <a href="{{ route('payment_method.create') }}"
                                    class="btn btn-blue waves-effect waves-light">Add
                                    Payment Method</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Payment Method All </h4>
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
                                        <th>Payment Name </th>
                                        <th>Payment Method Type </th>
                                        <th>Payment Min Amount </th>
                                        <th>Payment Max Amount </th>
                                        <th>Account No</th>
                                        <th>Payment Method Image </th>
                                        <th>Status </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment_methods as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->payment_method_type->name }}</td>
                                            <td>{{ $item->min_amount }}</td>
                                            <td>{{ $item->max_amount }}</td>
                                            <td>{{ $item->account_no }}</td>
                                            <td class="text-center"><img src="{{ $item->image }}" height="40px"
                                                    width="40px" alt="">
                                            </td>
                                            <td>{{ $item->status == 1 ? 'Active' : 'Unactive' }}</td>
                                            <td>
                                                <a href="{{ route('payment_method.edit', $item->id) }}"
                                                    class="btn btn-primary rounded-pill waves-effect waves-light">Edit</a>


                                                <a href="{{ route('payment_method.show', $item->id) }}"
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
