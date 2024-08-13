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
                        <h4 class="page-title">Withdrow Requested <strong class="text-danger">( {{ count($withdrows) }})</strong> </h4>
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
                                        <th>Payment Number </th>
                                        <th>Payment Method </th>
                                        <th>Massage </th>
                                        <th>Amount </th>
                                        <th>Time </th>
                                        <th>Status </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrows as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->number }}</td>
                                            <td>{{ $item->gateway }}</td>
                                            <td>{{ $item->desc }}</td>
                                            <td>{{ $item->change_amount }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>{{ $item->status == 1 ? 'Accept' : 'Pending' }}</td>
                                            <td>
                                                @if ($item->status != 1)
                                                    <a href="{{ route('withdrow_request.accept', $item->id) }}"
                                                        class="btn btn-primary rounded-pill waves-effect waves-light">Approve</a>
                                                @endif

                                                <form action="{{ route('withdrow_request.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger rounded-pill waves-effect waves-light"
                                                        id="delete">Delete</button>
                                                </form>
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
