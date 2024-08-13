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
                        <h4 class="page-title">All User <strong class="text-danger">( {{ count($users) }})</strong> </h4>
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
                                        <th>Email </th>
                                        <th>Total</th>
                                        <th>Withdrow </th>
                                        <th>Deposit </th>
                                        <th>Unique Id </th>
                                        <th>Phone </th>
                                        <th>Address </th>
                                        <th>Status </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->wallet->wallet??0 }}</td>
                                            <td>{{ $item->wallet->withdrow??0 }}</td>
                                            <td>{{ $item->wallet->deposit??0 }}</td>
                                            <td>{{ $item->unique_id }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>{{ $item->status == 1 ? 'Active' : 'Unactive' }}</td>
                                            <td><a href="{{route('delete.user',$item->id)}}" class="btn btn-danger">Delete</a></td>
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
