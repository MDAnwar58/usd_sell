@extends('layouts.fontend.master')
@section('fontend')

    <div class="container-fluid buy_and_sell" style="background-color: rgb(34, 33, 33);">
        <div class="container">

            <div class="row">
                <div class="d-flex my-4 justify-content-between align-items-center">
                    <div class="dropdown">
                        <a class="btn btn-secondary rounded" href="{{ route('home') }}">
                            Buy
                        </a>
                        <a class="btn btn-secondary rounded" href="{{ route('sell') }}">
                            Sell
                        </a>
                    </div>
                        <form id="form" method="GET" action="{{ route('home') }}">
                            <select class="select-usdt mb-3" name="category_id" id="category"
                                style="background-color: yellowgreen; margin: 5px 10px;">
                                @foreach ($categories as $data)
                                    <option class="p-3" value="{{ $data->id }}"
                                        {{ request()->category_id == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    <span><i class="text-white fa-solid fa-bell"></i></span>
                    <script>
                        document.getElementById('category').addEventListener('change', function() {
                            document.getElementById("form").submit();
                        });
                    </script>

                </div>

            </div>

            <div class="row">
                @foreach ($posts as $item)
                    <div class="col-lg-4 ">
                        <div class="d-flex py-2">
                            <img src="{{ asset($item->user->photo ?? 'frontend/assets/no_image.png') }}"
                                class="rounded-circle p-1" height="40px" width="40px" alt="">
                            <span class="text-white m-2 ">{{ $item->user->name }}</span>
                            <button type="button" class="bg-success p-2 mx-3">{{ $item->for }}</button>
                        </div>

                        <span>Trade(S) {{ $item->trade }} | Completion {{ $item->completion }}%</span>

                        <div class="d-flex py-2">
                            <div class="d-flex me-3 ">
                                <span class="me-2"><i class="fa-regular fa-thumbs-up"></i></span>
                                <span>{{ $item->like }}</span>
                            </div>
                            <div class="d-flex">
                                <span class="me-2"><i class="fa-regular fa-clock"></i></span>
                                <span>{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="d-flex">
                            <small class="mt-2 me-2 text-white fs-6">Tk.</small>
                            <h2>{{ $item->exchange_amount }}.00</h2>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="">
                                <span class="d-block">Quality: <span class="text-white">{{ $item->quality }}</span></span>
                                <span class="d-block">Limit: <span class="text-white">{{ $item->to_limit }} -
                                        {{ $item->from_limit }}</span></span>
                            </div>
                            <div class="text-end">
                                <span class="d-block"> {{ $item->gateway }} </span>
                                <button class="btn btn-sm btn-success" type="button" data-user_id="{{ $item->user_id }}"
                                    data-contact_number="{{ $item->contact_number }}"
                                    data-post_id="{{ $item->id }}"
                                    data-url="{{ url('/') }}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    style="padding: 1px 25px; border-radius: 6px;">
                                    Buy
                                </button>
                            </div>
                        </div>
                        <hr>
                    </div>
                @endforeach

            </div>

        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Contact With This Number</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-light">
                    <h3 class="fw-bold" id="contactNumber"></h3>
                    <div class="d-flex justify-content-end">
                        <a href="#" id="chatLink" class="mt-5 btn btn-info">Chat Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var exampleModal = document.getElementById('exampleModal');

            exampleModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var userId = button.getAttribute('data-user_id');
                var postId = button.getAttribute('data-post_id');
                var url = button.getAttribute('data-url');

                var contactNumberElement = document.getElementById('contactNumber');
                var contactNumber = button.getAttribute('data-contact_number');
                contactNumberElement.textContent = contactNumber;

                // Update the chat link
                var chatLink = document.getElementById('chatLink');

                // Construct the chat URL with the fetched values
                var chatUrl = url + "/chat?user_id=" + userId + "&post_id=" + postId;

                chatLink.setAttribute('href', chatUrl);
            });
        });
        </script>

@endsection
