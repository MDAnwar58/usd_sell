@extends('layouts.fontend.dashboard')
@section('fontend')
    <div class="row">
        <div class="col-md-12">
            <div class="transition-history">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <table class="table table-bordered table-background ">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Method</th>
                            <th>Number</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Charge</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-05-25 17:24 pm</td>
                            <td>Namul Hossain</td>
                            <td>Nagad</td>
                            <td>23987746113</td>
                            <td>50000 BDT</td>
                            <td>10</td>
                            <td>56</td>
                            <td>
                                <a class="btn btn-success">Approved</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
