@extends('layouts.fontend.master')
@section('fontend')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notification</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ Auth::user()->photo ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp' }}"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-4">{{ Auth::user()->address }}</p>
                            <p class="text-muted mb-4">Total Balance : {{ Auth::user()->wallet->wallet ?? 0 }}</p>
                            <p class="text-muted mb-4">Pending Deposit Balance : {{ Auth::user()->wallet->deposit ?? 0 }}</p>
                            <p class="text-muted mb-4">Pending Withdrow Balance : {{ Auth::user()->wallet->withdrow ?? 0 }}
                            </p>

                            <a href="{{ route('profile.edit') }}" class="btn btn-info">Edit Profile</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="d-flex">
                        <div class="col-md-3"><a href="{{route('deposit_all')}}" class="btn btn-success">Deposit</a></div>
                        <div class="col-md-3"><a href="{{route('withdrow_all')}}" class="btn btn-success">Withdrow</a></div>
                        <div class="col-md-3"><a href="{{route('tranjection')}}" class="btn btn-success ">Tranjection</a></div>
                        <div class="col-md-3 "><a href="{{route('notifications')}}" class="btn btn-success ">Notification</a></div>
                    </div>


                    <div class="row notification-container mt-2">

                        <h2 class="text-center">My Notifications</h2>
                        <p class="dismiss text-right"><a id="dismiss-all" href="{{route('unread_all')}}">Dimiss All</a></p>

                        @foreach ($notifications as $item)
                            <div class="card notification-card notification-invitation">
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td style="width:70%">
                                                <div class="card-title ">{{$item->massage}}
                                                </div>
                                                <span>{{$item->created_at->diffForHumans()}}</span>
                                            </td>
                                            <td style="width:30%" class="mx-5">
                                                <a href="{{route('read_notification',$item->id)}}" class="btn btn-danger dismiss-notification">{{$item->status == 1? 'Readed': 'Non Readed'}}</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
