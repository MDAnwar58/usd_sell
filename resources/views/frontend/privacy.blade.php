@extends('layouts.fontend.master')
@section('fontend')
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/contacts/contact-1/assets/css/contact-1.css">

    <section class="bg-light py-3 py-md-5">
        <div class="container">
            <p>{!!$privacy->desc!!}</p>
        </div>


    </section>
@endsection
