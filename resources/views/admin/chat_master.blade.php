@extends('admin.admin_dashboard')
@section('admin')
    @php
        $id = Auth::user()->id;
        $userid = App\Models\User::find($id);
        $status = $userid->status;
    @endphp
    <div class="chat-mian">
        <div class="container-fluid h-100">
            <div class="row য-100 h-100">
                <div class="col-md-4 col-xl-4 chat">
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

                                    @endphp
                                    <a href="{{ route('massage.index', ['user_id' => $item->from_id]) }}"
                                        class="chat_list {{ $item->from_id != Auth::user()->id ? 'active' : '' }}">
                                        <div class="d-flex bd-highlight">
                                            <div class="img_cont">
                                                <img src="{{ asset($photo ?? 'frontend/assets/no_image.png') }}"
                                                    class="rounded-circle user_img" height="40px">
                                            </div>
                                            <div class="user_info">
                                                <span class="text-warning p-2">{{ $user_id }}</span><br>
                                                <span class="text-white">{{ $item->massage }}</span>
                                                <br>
                                                <small class="text-info">{{ $item->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </a>
                                    <br>
                                @endforeach
                                @foreach ($users as $user)
                                    <a href="{{ route('massage.index', ['user_id' => $user->id]) }}"
                                        class="chat_list {{ $item->from_id != Auth::user()->id ? 'active' : '' }}">
                                        <div class="d-flex bd-highlight">
                                            <div class="img_cont">
                                                <img src="{{ asset($user->photo ?? 'frontend/assets/no_image.png') }}"
                                                    class="rounded-circle user_img" height="40px">
                                            </div>
                                            <div class="user_info">
                                                <span class="text-warning">{{ $user->name }}</span><br>
                                                <span class="text-white">New Conversion</span>
                                                <br>
                                                <small class="text-info">...</small>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </ui>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <div class="col-md-8 col-xl-8 chat">
                    @yield('admin_chat')
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
