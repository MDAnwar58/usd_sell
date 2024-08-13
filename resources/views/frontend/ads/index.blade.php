@extends('layouts.fontend.dashboard')
@section('user_dashboard')
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex  justify-content-between align-items-center">
                            <div class="dropdown ads-area ">
                                <a class="btn btn-secondary rounded-color mx-1" href="{{ route('user_post.add') }}">Add
                                    Post</a>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="col-12">
                            <table class="table table-bordered  table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>For</th>
                                        <th>Quality</th>
                                        <th>Rate</th>
                                        <th>Limit</th>
                                        <th>Status</th>
                                        <th>Update Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $item)
                                        <tr>
                                            @php
                                                if ($item->status == 1) {
                                                    $status = 'Active';
                                                } elseif ($item->status == 2) {
                                                    $status = 'Compleate';
                                                } elseif ($item->status == 0) {
                                                    $status = 'Pending';
                                                } else {
                                                    $status = 'Possed';
                                                }
                                            @endphp
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->for }}</td>
                                            <td>{{ $item->quality }}</td>
                                            <td>{{ $item->rate }}</td>
                                            <td>{{ $item->limit }}</td>
                                            <td>{{ $status }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td>
                                                @if ($item->relise_user && $item->status == 0)
                                                    <button class="btn btn-info">Wait For Admin Relise</button>
                                                @else
                                                    @if ($item->status != 0)
                                                        <a href="{{ route('user_post.block', $item->id) }}"
                                                            class="btn btn-warning">Block</a>
                                                    @endif
                                                    <a href="{{ route('user_post.edit', $item->id) }}"
                                                        class="btn btn-info">Edit</a>
                                                @endif
                                                <a href="{{ route('user_post.delete', $item->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
