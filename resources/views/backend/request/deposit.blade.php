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

                            </ol>
                        </div>
                        <h4 class="page-title">Deposit Requested <strong class="text-danger">(
                                {{ count($deposits) }})</strong> </h4>
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
                                        <th>User Name </th>
                                        <th>To Number </th>
                                        <th>From Payment Number </th>
                                        <th>Payment Method </th>
                                        <th>Tranjection </th>
                                        <th>Massage </th>
                                        <th>Amount </th>
                                        <th>Time </th>
                                        <th>Status </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deposits as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->to_number }}</td>
                                            <td>{{ $item->from_number }}</td>
                                            <td>{{ $item->gateway }}</td>
                                            <td>{{ $item->tranjection }}</td>
                                            <td>{{ $item->desc }}</td>
                                            <td>{{ $item->change_amount }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>{{ $item->status == 1 ? 'Accept' : 'Pending' }}</td>
                                            <td>
                                                <a href="{{ route('deposit_request.accept', $item->id) }}"
                                                    class="btn btn-primary rounded-pill waves-effect waves-light">Approve</a>


                                                <a href="{{ route('deposit_request.destroy', $item->id) }}"
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
