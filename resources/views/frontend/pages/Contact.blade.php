@extends('frontend.frontend-layout')
@section('content')
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center"
            data-background="{{ asset('frontend') }}/assets/img/hero/about.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $data->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="contact-section">
        <div class="container">


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-8">
                    @include('components.validatation')
                    <form class="form-contact contact_form" action="{{ route('frontend.send_mail') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea required name="message" class="form-control w-100" name="message" id="message" cols="30" rows="9" placeholder="Enter Message*"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input required name="name" class="form-control valid" name="name" id="name" type="text"placeholder="Enter your name*">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input required name="email" class="form-control valid" name="email" id="email" type="email"placeholder="Email*">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input required name="subject" class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject*">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>{{ $data->address }}</h3>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>{{ $data->phone }}</h3>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>{{ $data->email }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
