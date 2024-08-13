@extends('layouts.fontend.master')
@section('fontend')
    <div class="chat-mian">
        <div class="container-fluid h-100">

            <div class="row justify-content-center h-100">
                @if (Session::has('fail') || Session::has('success'))
                    <div class="col-12 text-center">
                        <div class="alert {{ Session::has('fail') ? 'text-danger' : 'text-success' }} ">
                            {{ Session::has('fail') ? Session::get('fail') : Session::get('success') }}</div>
                    </div>
                @endif
                <div class="col-md-4 col-xl-3 chat">
                    <div class="card mb-sm-3 mb-md-0 contacts_card">
                        <div class="card-header">
                            <div class="input-group">
                                <input type="text" placeholder="Search..." id="searchInput" class="form-control search">
                                <div class="input-group-prepend">
                                    <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body contacts_body">
                            <ui class="contacts">
                                @foreach ($massages as $item)
                                    @php
                                        $user_id = $item->from_id == Auth::user()->id ? $item->to_id : $item->from_id;
                                        $photo =
                                            $item->from_id == Auth::user()->id
                                                ? $item->toUser->photo
                                                : $item->fromUser->photo;
                                    @endphp
                                    @php
                                        if ($item->from_id == Auth::user()->id) {
                                            $user_id = $item->toUser->name;
                                        }
                                        if ($item->to_id == Auth::user()->id) {
                                            $user_id = $item->fromUser->name;
                                        }
                                        if ($item->from_id == Auth::user()->id) {
                                            $id_u = $item->toUser->id;
                                        }
                                        if ($item->to_id == Auth::user()->id) {
                                            $id_u = $item->fromUser->id;
                                        }
                                    @endphp
                                    <a href="{{ route('chat', ['user_id' => $id_u]) }}"
                                        class="chat_list {{ $item->from_id != Auth::user()->id ? 'active' : '' }}">
                                        <div class="d-flex bd-highlight">
                                            <div class="img_cont">
                                                <img src="{{ asset($photo ?? 'https://st4.depositphotos.com/14953852/24787/v/450/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg') }}"
                                                    class="rounded-circle user_img" height="40px">
                                            </div>
                                            <div class="user_info">
                                                <span class="text-primary chat_name">{{ $user_id }}</span><br>
                                                <span>{{ $item->massage }}</span>
                                                <br>
                                                <small class="text-info">{{ $item->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </a>
                                    <br>
                                @endforeach
                            </ui>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <div class="col-md-8 col-xl-6 chat">
                    @yield('chat')
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('keyup', function() {
                var filter = searchInput.value.toLowerCase();
                var chatList = document.getElementsByClassName('chat_list');

                for (var i = 0; i < chatList.length; i++) {
                    var chatName = chatList[i].getElementsByClassName('chat_name')[0].textContent
                        .toLowerCase();

                    if (chatName.indexOf(filter) > -1) {
                        chatList[i].style.display = '';
                    } else {
                        chatList[i].style.display = 'none';
                    }
                }
            });
        });
    </script>


    </html>
@endsection
