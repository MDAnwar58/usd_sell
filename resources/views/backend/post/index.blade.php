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
                        <h4 class="page-title">Post All <strong class="text-danger">( {{ count($posts) }})</strong> </h4>
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
                                        <th>Category Name </th>
                                        <th>Exchange Amount </th>
                                        <th>For </th>
                                        <th>Quality </th>
                                        <th>Limite </th>
                                        <th>Status </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->exchange_amount }}</td>
                                            <td>{{ $item->for }}</td>
                                            <td>{{ $item->quality }}</td>
                                            <td>{{ $item->to_limit }} - {{ $item->from_limit }}</td>
                                            <td>{{ $item->status == 1 ? 'Active' : 'Unactive' }}</td>
                                            <td>
                                                @if (!$item->relise_user)
                                                    @if ($item->status != 1)
                                                        <a href="{{ route('post.acccept', $item->id) }}"
                                                            class="btn btn-primary rounded-pill waves-effect waves-light">Approve</a>
                                                    @endif
                                                @else
                                                    @if ($item->status == 2)
                                                        <a {{-- href="{{ route('post.relise', $item->id) }}" --}}
                                                            class="btn btn-primary rounded-pill waves-effect waves-light"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal">Pending
                                                            For Relise</a>



                                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Request Information</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <ul>
                                                                            @php
                                                                                $data = App\Models\User::find(
                                                                                    $item->relise_user,
                                                                                );
                                                                                $postAmount = App\Models\PostAmount::where(
                                                                                    'from_id',
                                                                                    $item->relise_user,
                                                                                )
                                                                                    ->where('to_id', $item->user_id)
                                                                                    ->where('post_id', $item->id)
                                                                                    ->first();
                                                                            @endphp

                                                                            <li>Recive User :
                                                                                {{ $data->userPayment->gateway ?? 'N/A' }}
                                                                            </li>
                                                                            <li>Recive Account Number :
                                                                                {{ $data->userPayment->account_number ?? 'N/A' }}
                                                                            </li>
                                                                            <li>Recive Information :
                                                                                {{ $data->userPayment->desc ?? 'N/A' }}
                                                                            </li>
                                                                            <li>Recive Amount :
                                                                                {{ $postAmount->amount ?? 'N/A' }}</li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <a href="{{ route('post.relise', $item->id) }}" class="btn btn-primary">Save
                                                                            changes</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif

                                                    <a href="{{ route('post.destroy', $item->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light"
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
