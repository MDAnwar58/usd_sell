@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="col-md-12">
            <div class="transition-history">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('deposit_add') }}" class="btn btn-success">Add A new Deposit</a>
                </div>
                <table class="table table-bordered table-background ">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Tranjection</th>
                            <th>Amount</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deposits as $item)
                            <tr>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td>{{ $item->gateway }}</td>
                                <td>{{ $item->tranjection }}</td>
                                <td>{{ $item->change_amount }} BDT</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->desc }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        <a class="btn btn-warning">Pending</a>
                                    @elseif($item->status == 2)
                                        <a class="btn btn-danger">Rejected</a>
                                    @else
                                        <a class="btn btn-success">Approved</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
