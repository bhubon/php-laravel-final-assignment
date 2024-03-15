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

    <div class="support-company-area fix" style="padding: 80px 0 60px;">
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

    <div class="online-cv cv-bg section-overly pt-90 pb-120"
        data-background="{{ asset('frontend/') }}/assets/img/gallery/cv_bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 mb-4">
                    <h2 class="text-center text-light">Top Companies</h2>
                </div>
                @foreach ($top_companies as $company)
                    <div class="col-md-2 text-center border border-1 border-light bg-light pt-4 rounded mx-3">
                        @if (!empty($company->logo))
                            <img src="{{ !empty($company->logo) ? $company->logo : '' }}" alt="Company Logo" width="120px">
                        @endif
                        <h6 class="text-center text-dark">{{ $company->company_name }}</h6>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
