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
                            <h2>About Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="support-company-area fix section-padding2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="right-caption">
                        <!-- Section Tittle -->
                        <div class="section-tittle section-tittle2">
                            <h2>Our Mission</h2>
                        </div>
                        <div class="support-caption">
                            <p class="pera-top">
                                {{ $data->company_mission }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="right-caption">
                        <!-- Section Tittle -->
                        <div class="section-tittle section-tittle2">
                            <h2>Our Vission</h2>
                        </div>
                        <div class="support-caption">
                            <p class="pera-top">
                                {{ $data->company_vission }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
