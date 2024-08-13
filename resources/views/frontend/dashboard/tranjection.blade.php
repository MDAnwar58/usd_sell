@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <div class="row">
        <div class="col-md-12">
            <div class="transition-history">
                <table class="table table-bordered table-background ">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Account Number</th>
                            <th>Amount</th>
                            <th>Tranjection</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tranjections as $item)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                <td>{{ $item->gateway }}</td>
                                <td>{{ $item->number }}</td>
                                <td>{{ $item->change_amount }} BDT</td>
                                <td>{{ $item->tranjection }}</td>
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
