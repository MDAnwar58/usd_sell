@extends('layouts.fontend.chat_master')
@section('chat')
    <link href="{{ asset('frontend/assets/css/chat.css') }}" rel="stylesheet">

    <div class="card">
        @if ($user)
            <div class="card-header msg_head">
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <img src="{{ $user->photo ?? 'https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg' }}"
                            class="rounded-circle user_img">
                        <span class="online_icon"></span>
                    </div>
                    <div class="user_info">
                        <span>Chat with {{ $user->name }}</span>
                        <p> #{{ $user->unique_id }} </p>
                    </div>
                </div>
                <span id="action_menu_btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="fas fa-ellipsis-v"></i></span>
                @include('frontend.info_detials_modal')
            </div>

            <div class="card-body msg_card_body">
                @foreach ($massages as $item)
                    @if ($item->from_id != Auth::user()->id)
                        <div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                                <img src="{{ asset($item->fromUser->photo ?? 'frontend/assets/no_image.png') }}"
                                    class="rounded-circle user_img_msg">
                            </div>
                            <div class="msg_cotainer">
                                {{ $item->massage }}
                                <span class="msg_time">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-end mb-4">
                            <div class="msg_cotainer_send">
                                {{ $item->massage }}
                                <span class="msg_time_send">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="img_cont_msg">
                                <img src="{{ asset(Auth::user()->photo ?? 'frontend/assets/no_image.png') }}"
                                    class="rounded-circle user_img_msg">
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
            <div class="card-footer">
                <form action="{{ route('chat.store') }}" method="post" class="input-group">
                    @csrf
                    <div class="input-group-append">
                        <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                    </div>


                    <input type="hidden" name="from_id" value="{{ Auth::user()->id }}" />
                    <input type="hidden" name="to_id" value="{{ $userId }}" />
                    <textarea class="form-control type_msg" name="massage" placeholder="Type your message..."></textarea>
                    @error('massage')
                        <strong class="text-danger">{{ $massage }}</strong>
                    @enderror
                    <div class="input-group-append">
                        <span class="input-group-text send_btn"><button class="btn btn-success" type="submit"><i
                                    class="fas fa-location-arrow"></i></button></span>
                    </div>
                </form>
            </div>
        @else
            <h2 class="text-info mt-5 mx-5">New Massage</h2>
        @endif

    </div>
    </div>


    </div>
    </div>
@endsection
