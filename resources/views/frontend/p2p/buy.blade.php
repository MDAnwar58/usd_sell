@extends('layouts.fontend.master')
@section('fontend')
    <main class="p2p-main ">
        <div class="container-fluid buy_and_sell">
            <div class="container">
                <div class="row">
                    <div class="d-flex my-4 justify-content-between align-items-center">
                        <div class="dropdown">
                            <a class="btn btn-secondary text-white rounded rounded-color" href="{{ route('buy') }}">
                                Buy
                            </a>

                            <a class="btn btn-secondary rounded text-white   rounded-color " href="{{ route('sell') }}">
                                Sell
                            </a>
                            <select class="select-usdt mb-3" name="category_id" id="category">
                                @foreach ($categories as $data)
                                    <option class="p-3" value="{{ $data->id }}"
                                        {{ request()->category_id == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>

                            <script>
                                document.getElementById('category').addEventListener('change', function() {
                                    const categoryId = this.value;
                                    const currentUrl = new URL(window.location.href);
                                    currentUrl.searchParams.set('category_id', categoryId);
                                    window.location.href = currentUrl.toString();
                                });
                            </script>

                        </div>
                        <span><i class="text-white fa-solid fa-bell"></i></span>

                    </div>

                </div>

                <div class="row">
                    @foreach ($posts as $item)
                        <div class="col-lg-4 ">
                            <div class="d-flex py-2">
                                <span class="text-white"><img
                                        src="{{ asset($item->user->photo ?? 'frontend/assets/no_image.png') }}"
                                        style="height: 40px; width:40px"
                                        class="img-fluid image-bordered ">{{ $item->user->name }}</span>
                            </div>
                            <span class="text-white">Trade(S) 10 | Completion 99.5%</span>
                            <div class="d-flex py-2">
                                <div class="d-flex me-3 ">
                                    <span class="text-white">99.15%</span>
                                </div>
                                <div class="d-flex">
                                    <span class="text-white">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="d-flex">
                                <small class="mt-2 me-2 text-white fs-6">Tk.</small>
                                <h2 class="text-white">{{ $item->exchange_amount }}.00</h2>

                            </div>

                            <div class="d-flex justify-content-between">
                                <div class>
                                    <span class="text-white">Quality: <span
                                            class="text-white">{{ $item->quality }}</span></span>
                                    <span class="text-white">Limit: <span class="text-white">{{ $item->to_limit }} -
                                            {{ $item->from_limit }}</span></span>
                                </div>
                                <div class="text-end">
                                    <span class="text-white"> Bkash </span>
                                    <button class="btn btn-sm btn-success" type="button"
                                        data-user_id="{{ $item->user_id }}"
                                        data-contact_number="{{ $item->contact_number }}"
                                        data-post_id="{{ $item->id }}" data-url="{{ url('/') }}"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
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
    </main>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Contact With This Number</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-light">
                    <h3 class="fw-bold text-light" id="contactNumber"></h3>
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
