<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>{{ $personal->name }}</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <link rel="icon" href="{{ asset($personal->logo) }}" type="image/png" />

        <!-- Favicons -->
        <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
            integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <!-- Vendor CSS Files -->
        <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/assets/css/profile.css') }}" rel="stylesheet">
        <script src="{{ asset('frontend/assets/js/profile.js') }}"></script>

    </head>

    <body class="index-page bg-dark">

        <header id="header" class="header d-flex align-items-center fixed-top">
            <div class="container container-xl position-relative d-flex align-items-center">

                <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <img height="150px" src="{{ $personal->logo }}">
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li class="me-xl-5 px-xl-0 px-3 pe-lg-3 pe-5">
                            <form class="input-group " action="{{ route('search') }}" method="post">
                                @csrf
                                <input type="search" class="form-control rounded-start" name="unique_id"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button class="btn btn-outline-primary" type="submit">search</button>
                            </form>
                        </li>
                        <li><a href="{{ route('posts') }}">p2p</a></li>
                        <li><a href="{{ route('your_post') }}">ads</a></li>
                        @if (Auth::user())
                            <li><a href="{{ route('user_profile') }}">profile</a></li>
                            <li><a href="{{ route('chat') }}">chat</a></li>
                            <li class="ps-xl-0 ps-3"><button type="button" class="btn btn-warning"
                                    data-bs-toggle="modal" data-bs-target="#notificationModal">Notification</button>
                            </li>
                        @endif
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                @if (Auth::user() == null)
                    <a class="btn-getstarted" href="{{ route('user_login') }}">Login</a>
                @endif
            </div>
        </header>


        <div class="app">
            <div class="wrapper">
                <div class="left-side">

                    <form action="{{ route('logout') }}" method='post' class="mt-5">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout
                        </button>
                    </form>
                    {{-- <div class="side-wrapper">
                    <div class="side-title">Apps</div>
                    <div class="side-menu">
                        <a href="#">
                            <svg viewBox="0 0 488.932 488.932" fill="currentColor">
                                <path
                                    d="M243.158 61.361v-57.6c0-3.2 4-4.9 6.7-2.9l118.4 87c2 1.5 2 4.4 0 5.9l-118.4 87c-2.7 2-6.7.2-6.7-2.9v-57.5c-87.8 1.4-158.1 76-152.1 165.4 5.1 76.8 67.7 139.1 144.5 144 81.4 5.2 150.6-53 163-129.9 2.3-14.3 14.7-24.7 29.2-24.7 17.9 0 31.8 15.9 29 33.5-17.4 109.7-118.5 192-235.7 178.9-98-11-176.7-89.4-187.8-187.4-14.7-128.2 84.9-237.4 209.9-238.8z" />
                            </svg>
                            Updates
                            <span class="notification-number updates">3</span>
                        </a>
                    </div>
                </div> --}}
                    {{-- <div class="side-wrapper">
                    <div class="side-title">Categories</div>
                </div>
                <div class="side-wrapper">
                    <div class="side-title">Fonts</div>
                </div>
                <div class="side-wrapper">
                    <div class="side-title">Resource Links</div>
                    <div class="side-menu">
                        <a href="#">
                            <svg viewBox="0 0 512 512" fill="currentColor">
                                <path
                                    d="M467 0H45C20.186 0 0 20.186 0 45v422c0 24.814 20.186 45 45 45h422c24.814 0 45-20.186 45-45V45c0-24.814-20.186-45-45-45zM181 241c41.353 0 75 33.647 75 75s-33.647 75-75 75-75-33.647-75-75c0-8.291 6.709-15 15-15s15 6.709 15 15c0 24.814 20.186 45 45 45s45-20.186 45-45-20.186-45-45-45c-41.353 0-75-33.647-75-75s33.647-75 75-75 75 33.647 75 75c0 8.291-6.709 15-15 15s-15-6.709-15-15c0-24.814-20.186-45-45-45s-45 20.186-45 45 20.186 45 45 45zm180 120h30c8.291 0 15 6.709 15 15s-6.709 15-15 15h-30c-24.814 0-45-20.186-45-45V211h-15c-8.291 0-15-6.709-15-15s6.709-15 15-15h15v-45c0-8.291 6.709-15 15-15s15 6.709 15 15v45h45c8.291 0 15 6.709 15 15s-6.709 15-15 15h-45v135c0 8.276 6.724 15 15 15z" />
                            </svg>
                            Stock
                        </a>
                    </div>
                </div> --}}
                </div>
                <div class="main-container">
                    <div class="main-header">
                        <a class="menu-link-main" href="#">All Apps</a>

                        <div class="header-menu ">
                            <nav>
                                <input type="checkbox" id="check">
                                <label for="check" class="checkbtn"><i class="fa fa-bars"></i></label>
                                <ul>
                                    <li><a class="main-header-link is-active {{ Route::is('user_profile') ? 'bg-success text-white' : '' }}"
                                            href="{{ route('user_profile') }}">Account</a></li>
                                    <li><a class="main-header-link is-active  {{ Route::is('deposit_add') ? 'bg-success text-white' : '' }}"
                                            href="{{ route('deposit_add') }}">Deposite</a></li>
                                    <li><a class="main-header-link is-active  {{ Route::is('withdrow_add') ? 'bg-success text-white' : '' }}"
                                            href="{{ route('withdrow_add') }}">withdrawal</a>
                                    </li>
                                    <li><a class="main-header-link is-active  {{ Route::is('tranjection') ? 'bg-success text-white' : '' }}"
                                            href="{{ route('tranjection') }}">Tranjection</a>
                                    </li>
                                    <li><a class="main-header-link is-active  {{ Route::is('payment_all') ? 'bg-success text-white' : '' }}"
                                            href="{{ route('payment_all') }}">Payment Setup</a>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="container">
                            @yield('user_dashboard')
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay-app"></div>
        </div>




        {{-- modal --}}

        <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-light" id="exampleModalLabel">All Notifications</h5>
                        <button type="button" class="btn-close text-light " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-dark">
                        <ul class="list-group">
                            @foreach ($notifications as $item)
                                <li class="list-group-item">{{ $item->massage }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer bg-dark">
                        <a href="{{ route('unread_all') }}" class="btn btn-primary">Unread All</a>
                    </div>
                </div>
            </div>

            {{-- endmodal --}}
            <!-- Vendor JS Files -->
            <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
            <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
            <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
            <script src="{{ asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" type="text/css"
                href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
            <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
            </script>

            <!-- Main JS File -->
            <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
            <script src="{{ asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/chat.js') }}"></script>

    </body>

</html>
