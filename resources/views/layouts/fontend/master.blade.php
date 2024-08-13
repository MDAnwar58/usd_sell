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
        @yield('css')

    </head>

    <body class="index-page">

        <header id="header" class="header d-flex align-items-center fixed-top" style="background-color: black">
            <div class="container container-xl position-relative d-flex align-items-center">

                <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <img height="150px" src="{{ $personal->logo }}">
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li class="input-search" style="">
                            <form class="input-group " action="{{ route('search') }}" method="post">
                                @csrf
                                <input type="search" class="form-control rounded-start" name="unique_id"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button class="btn btn-outline-primary" type="submit">search</button>
                            </form>
                        </li>
                        <li><a href="{{ route('posts') }}">p2p</a></li>
                        @if (
                            !Route::is('home') &&
                                !Route::is('user_login') &&
                                !Route::is('user_registration') &&
                                !Route::is('password.request') &&
                                !Route::is('verify.pin') &&
                                !Route::is('password.reset'))
                            <li><a href="{{ route('your_post') }}">ads</a></li>
                            <li><a href="{{ route('user_profile') }}">profile</a></li>
                            <li><a href="{{ route('chat') }}">chat</a></li>
                        @endif
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                @if (Route::is('home') ||
                        Route::is('user_login') ||
                        Route::is('user_registration') ||
                        Route::is('password.request') ||
                        Route::is('verify.pin') ||
                        Route::is('password.reset'))
                    <a class="btn-getstarted" href="{{ route('user_login') }}">Log In</a>
                    <a class="btn-getstarted" href="{{ route('user_registration') }}">Sign Up</a>
                @endif
            </div>
        </header>



        @yield('fontend')

        @if (!Route::is('user_login'))
            @if (!Route::is('user_registration'))
                @if (!Route::is('your_post'))
                    @if (!Route::is('chat'))
                        @if (!Route::is('password.request'))
                            <footer id="footer" class="footer">
                                <div class="container footer-top">
                                    <div class="row gy-4">
                                        <div class="col-lg-4 col-md-6 footer-about">
                                            <a href="{{ route('home') }}" class="d-flex align-items-center">
                                                <img height="150px" src="{{ $personal->logo ?? '' }}">
                                            </a>
                                            <div class="footer-contact pt-3">
                                                <p>{{ $personal->address }}</p>
                                                <p class="mt-3"><strong>Phone:</strong>
                                                    <span>{{ $personal->phone }}</span>
                                                </p>
                                                <p class="mt-3"><strong>Phone:</strong>
                                                    <span>{{ $personal->phone_2 }}</span>
                                                </p>
                                                <p><strong>Email:</strong> <span>{{ $personal->email }}</span></p>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-3 footer-links">
                                            <h4>Useful Links</h4>
                                            <ul>
                                                <li><i class="bi bi-chevron-right"></i> <a
                                                        href="{{ route('home') }}">Home</a>
                                                </li>
                                                <li><i class="bi bi-chevron-right"></i> <a
                                                        href="{{ route('about_us') }}">About
                                                        us</a>
                                                </li>
                                                <li><i class="bi bi-chevron-right"></i> <a
                                                        href="{{ route('contact_us') }}">Contact
                                                        Us</a>
                                                </li>
                                                <li><i class="bi bi-chevron-right"></i> <a
                                                        href="{{ route('privacy') }}">Privacy
                                                        Policy</a>
                                                </li>
                                                <li><i class="bi bi-chevron-right"></i> <a
                                                        href="{{ route('terms') }}">Terms of
                                                        service</a>
                                                </li>
                                            </ul>
                                        </div>


                                        <div class="col-lg-4 col-md-12">
                                            <h4>Follow Us</h4>
                                            <p>{{ $personal->desc }}</p>
                                            <div class="social-links d-flex">
                                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                                <a href=""><i class="bi bi-facebook"></i></a>
                                                <a href=""><i class="bi bi-instagram"></i></a>
                                                <a href=""><i class="bi bi-linkedin"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="container copyright text-center mt-4">
                                    <p>© <span>Copyright</span> <strong
                                            class="px-1 sitename">{{ $personal->name }}</strong>
                                        <span>All
                                            Rights
                                            Reserved</span>
                                    </p>
                                    <div class="credits">
                                        <!-- All the links in the footer should remain intact. -->
                                        <!-- You can delete the links only if you've purchased the pro version. -->
                                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                                        Designed by <a href="https://bootstrapmade.com/">{{ $personal->name }}</a>
                                    </div>
                                </div>

                            </footer>
                        @endif
                    @endif
                @endif
            @endif
        @endif
        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

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
