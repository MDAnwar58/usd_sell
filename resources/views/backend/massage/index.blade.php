@extends('admin.chat_master')
@section('admin_chat')
    @if ($user)
        <div class="card-header msg_head">
            <div class="d-flex bd-highlight">
                <div class="img_cont">
                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img mx-3" style="height: 60px; width:60px">
                    <span class="online_icon"></span>
                </div>
                <div class="user_info">
                    <span>Chat with <span class="text-info">{{ $user->name }}</span></span>
                    <p class="text-warning"> {{ count($massages) }} Messages</p>
                </div>
            </div>

        </div>

        <div class="card-body " style="height: 25rem">
            @foreach ($massages as $item)
                @if ($item->from_id != Auth::user()->id)
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="{{ asset($item->fromUser->photo ?? 'frontend/assets/no_image.png') }}"
                                class="rounded-circle user_img_msg" style="height: 50px; width:50px">
                        </div>
                        <div class="msg_cotainer">
                            {{ $item->massage }} <br>
                            <small class="text-info">{{ $item->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            {{ $item->massage }} <br>
                            <small class="text-info">{{ $item->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="img_cont_msg">
                            <img src="{{ asset(Auth::user()->photo ?? 'frontend/assets/no_image.png') }}"
                                class="rounded-circle user_img_msg" style="height: 50px; width:50px">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="card-footer">
            <form action="{{ route('chat.store') }}" method="post" class="input-group">
                @csrf
                <input type="hidden" name="from_id" value="{{ Auth::user()->id }}" />
                <input type="hidden" name="to_id" value="{{ $userId }}" />
                <textarea class="form-control type_msg" name="massage" placeholder="Type your message..."></textarea>
                @error('massage')
                    <strong class="text-danger">{{ $massage }}</strong>
                @enderror
                <div class="">
                    <span class="input-group-text send_btn"><button class="btn btn-success p-2" type="submit"><i
                                class="fas fa-location-arrow"></i></button></span>
                </div>
            </form>
        </div>
    @else
        <h2 class="text-info mt-5 mx-5">New Massage</h2>
    @endif
@endsection
