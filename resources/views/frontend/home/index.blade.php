@extends('layouts.fontend.master')
@section('css')
    <style>
        .hero {
            background-color: #212531;
            color: #ffffff;
        }
    </style>
@endsection
@section('fontend')
    <main class="main">
        <section id="hero" class="hero section ">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center  " data-aos="zoom-out">
                        <h3>{{ $personal->header }}</h3>
                        <p class="">{!! $personal->header_desc !!}</p>
                        <a class="btn btn-success register-hero" href="{{ route('user_registration') }}"
                            style="width:120px;padding:15px;background-color:#05C55E; ">Register</a>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ $personal->background_image }}" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->
    </main>
@endsection
