<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/shopingo/demo/shopingo_V2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Apr 2024 09:05:19 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset($personal->logo) }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('frontend/assets/plugins/OwlCarousel/css/owl.carousel.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('frontend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('frontend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('frontend/assets/js/pace.min.js') }}"></script>

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/../../../../unpkg.com/boxicons%402.1.2/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/icons.css') }}" rel="stylesheet">
    <title>{{ $personal->name ?? '' }}</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" /> --}}
    <!-- MDB -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" /> --}}


    <style>
        .nav-link.active {
            color: #000 !important;
            background-color: rgb(116, 94, 54) !important;
        }
    </style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--start top header wrapper-->
        <div class="header-wrapper">

            <div class="header-content bg-warning">
                <div class="container">
                    <div class="row align-items-center gx-4">
                        <div class="col-auto">
                            <div class="d-flex align-items-center gap-3">
                                <div class="mobile-toggle-menu d-inline d-xl-none" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasNavbar">
                                    <i class="bx bx-menu"></i>
                                </div>
                                <div class="logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ $personal->logo }}" class="logo-icon"
                                            alt="{{ $personal->name }}" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl order-4 order-xl-0">
                            <form class="input-group flex-nowrap pb-3 pb-xl-0" action="{{ route('search') }}"
                                method="post">
                                @csrf
                                <input type="text" class="form-control w-100 border-dark border border-3"
                                    name="unique_id" placeholder="Search by Name Unique id">
                                <button class="btn btn-dark btn-ecomm border-3" type="search">Search</button>
                            </form>
                        </div>

                        <div class="col-auto ms-auto">
                            <div class="top-cart-icons">
                                <nav class="navbar navbar-expand">
                                    <ul class="navbar-nav">
                                        <li class="nav-item chat-mobile"><a href="{{ route('chat') }}"
                                                class="nav-link cart-link"><i class='fa fa-commenting text-white'
                                                    class=""></i></a>
                                        </li>
                                        @if (Auth::user())
                                            <li class="nav-item dropdown dropdown-large">
                                                <a href="#"
                                                    class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link"
                                                    data-bs-toggle="dropdown"> <span
                                                        class="alert-count">{{ count($unread_notifications) }}</span>
                                                    <i class='bx bx-bell'></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="javascript:;">
                                                        <div class="cart-header">
                                                            <p class="cart-header-title mb-0">Notification List</p>
                                                        </div>
                                                    </a>
                                                    <div class="cart-list">
                                                        @foreach ($notifications as $item)
                                                            <a class="dropdown-item"
                                                                href="{{ route('read_notification', $item->id) }}">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-grow-1">
                                                                        <h6 class="cart-product-title text-dark">
                                                                            {{ $item->massage }}</h6>
                                                                        <p class="cart-product-price">
                                                                            {{ $item->created_at->diffForHumans() }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @endforeach

                                                    </div>

                                                    <div class="d-grid p-3 border-top"> <a
                                                            href="{{ route('notifications') }}"
                                                            class="btn btn-dark btn-ecomm">View All</a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                        @if (Auth::user())
                                            <form action="{{ route('logout') }}" method='post'>
                                                @csrf
                                                <li class="nav-item "><button type="submit"
                                                        class="nav-link cart-link"><i
                                                            class='fa fa-sign-out mt-2 p-2'></i>
                                                    </button>
                                                </li>
                                            </form>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
            <div class="mobile-manu d-flex mt-2">
                <a class="nav-link p-2 m-2 {{ Route::is('home') ? 'active' : '' }}"
                    href="{{ route('home') }}">Profile</a>
                <a class="nav-link p-2 m-2 {{ Route::is('posts') ? 'active' : '' }}"
                    href="{{ route('posts') }}">P2P</a>
            </div>

            <div class="primary-menu">
                <nav class="navbar navbar-expand-xl w-100 navbar-dark container mb-0 p-0">
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
                        <div class="offcanvas-header">
                            <div class="offcanvas-logo"><img src="assets/images/logo-icon.png" width="100"
                                    alt="">
                            </div>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body primary-menu">
                            <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                                        href="{{ route('home') }}">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('posts') ? 'active' : '' }}"
                                        href="{{ route('posts') }}">P2P</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('your_post') ? 'active' : '' }}"
                                        href="{{ route('your_post') }}">Ads</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>


        @yield('fontend')
        @if (Auth::user())
            <nav class="mobile-nav">
                <a href="{{ route('chat') }}"class="text">Chat</a>
                <a href="{{ route('your_post') }}"class="text">Ads</a>
                <a href="{{ route('tranjection') }}"class="text">Tranjection</a>
            </nav>
        @endif
        <!-- End Nav Start -->
        <!-- Footer Start -->
        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-info">
                            <div class="footer-logo">
                                <a href="index.html" title="Shivaa">
                                    <img width="120px" src="{{ $personal->logo }}" alt="Logo">
                                </a>
                            </div>
                            <p>{{ $personal->desc }}</p>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-contact">
                            <h3 class="h3-title footer-title">Contact Us</h3>
                            <div class="footer-contact-box">
                                <div class="footer-contact-link">
                                    <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                    <a href="javascript:void(0);"
                                        title="{{ $personal->address }}">{{ $personal->address }}</a>
                                </div>
                            </div>
                            <div class="footer-contact-box">
                                <div class="footer-contact-link">
                                    <span class="icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <a href="javascript:void(0);"
                                        title="{{ $personal->phone }}">{{ $personal->phone }}</a>
                                    <a href="javascript:void(0);"
                                        title="{{ $personal->phone_2 }}">{{ $personal->phone_2 }}</a>
                                </div>
                            </div>
                            <div class="footer-contact-box">
                                <div class="footer-contact-link">
                                    <span class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <a href="javascript:void(0);"
                                        title="{{ $personal->email }}">{{ $personal->email }}</a>
                                    <a href="javascript:void(0);"
                                        title="{{ $personal->email }}">{{ $personal->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="our-links">
                            <h3 class="h3-title footer-title">Our Links</h3>
                            <ul>
                                <li><a href="{{ route('home') }}" title="Home">Home</a></li>
                                <li><a href="{{ route('about_us') }}" title="About Us">About Us</a></li>
                                <li><a href="{{ route('contact_us') }}" title="Contact Us">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="footer-last">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="copy-right">
                            <p>Copyright © 2021 <a href="https://dexignzone.com/"
                                    target="_blank">{{ $personal->name }}</a>. All
                                rights reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer-last-link">
                            <ul>
                                <li><a href="{{ route('privacy') }}" title="Privacy Policy">Privacy Policy</a></li>
                                <li><a href="{{ route('terms') }}" title="Terms Of Service">Terms Of Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        <!-- end buy and sell -->
        <!-- Bootstrap JS -->

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @if (session('success'))
            <script>
                swal({
                    title: "Good job!",
                    text: " {{ session('success') }}",
                    icon: "success",
                });
            </script>
        @endif

        <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
        <!--plugins-->
        <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/plugins/OwlCarousel/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
        <!--app JS-->
        <script src="{{ asset('frontend/assets/js/app.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/index.js') }}"></script>


        <!-- MDB -->
        {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script> --}}
</body>


<!-- Mirrored from codervent.com/shopingo/demo/shopingo_V2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Apr 2024 09:07:21 GMT -->

</html>
