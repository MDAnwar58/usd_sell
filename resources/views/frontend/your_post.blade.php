@extends('layouts.fontend.master')
@section('fontend')
    <div class="container-fluid buy_and_sell" style="background-color: rgb(34, 33, 33);">
        <div class="container">

            <div class="row">
                <div class="d-flex my-4 justify-content-between align-items-center">
                    <div class="dropdown">
                        <a class="btn btn-secondary rounded" href="{{ route('buy') }}">
                            Buy
                        </a>
                        <a class="btn btn-secondary rounded" href="{{ route('sell') }}">
                            Sell
                        </a>

                    </div>
                    <span><i class="text-white fa-solid fa-bell"></i></span>

                </div>

            </div>

            <div class="row">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user_post.add') }}" class="btn btn-success">Add a Post</a>
                </div>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">For</th>
                            <th scope="col">Category</th>
                            <th scope="col">Quality</th>
                            <th scope="col">Limite</th>
                            <th scope="col">Exchange Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Update Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sells as $item)
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
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->for }}</td>
                                <td>{{ $item->category->id }}</td>
                                <td>{{ $item->quality }}</td>
                                <td>{{ $item->to_limit }} - {{ $item->from_limit }}</td>
                                <td>{{ $item->exchange_amount }}</td>
                                <td>{{ $status }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td class="row">
                                    @if ($item->relise_user && $item->status == 0)
                                    <button class="btn btn-info">Wait For Admin Relise</button>
                                    @else
                                        @if ($item->status != 0)
                                            <a href="{{ route('user_post.block', $item->id) }}"
                                                class="btn btn-warning">Block</a>
                                        @endif
                                        <a href="{{ route('user_post.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                    @endif
                                    <a href="{{ route('user_post.delete', $item->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
@endsection
