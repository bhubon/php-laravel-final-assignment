@extends('frontend.frontend-layout')
@section('content')
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active">
            <div class="single-slider slider-height d-flex align-items-center"
                data-background="{{ asset('frontend/') }}/assets/img/hero/h1_hero.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-9 col-md-10">
                            <div class="hero__caption">
                                <h1>Find the most exciting jobs</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Search Box -->
                    <div class="row">
                        <div class="col-xl-8">
                            <!-- form -->
                            <form action="{{ route('frontend.jobs') }}" class="search-box">
                                <div class="input-form">
                                    <input name="title" type="text" placeholder="Job Tittle or keyword" required>
                                </div>
                                <div class="select-form">
                                    <div class="select-itms">
                                        <select name="job_type" id="select1">
                                            <option value="remote" selected>Remote</option>
                                            <option value="office">Office</option>
                                            <option value="hybrid">Hybrid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="search-form">
                                    <button type="submit" class="btn head-btn1" style="height: 70px;: 100%;">Find
                                        job</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!-- Our Services Start -->
    <div class="our-services section-pad-t30">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <span>FEATURED TOURS Packages</span>
                        <h2>Browse Top Categories </h2>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-contnet-center">
                @if (count($jobs_categories) > 0)
                    @foreach ($jobs_categories as $job_category)
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-services text-center mb-30">
                                <div class="services-ion">
                                    @if (!empty($job_category->icon))
                                        <img src="{{ asset($job_category->icon) }}" alt="{{ $job_category->name }}">
                                    @else
                                        <span class="flaticon-tour"></span>
                                    @endif

                                </div>
                                <div class="services-cap">
                                    <h5><a href="{{ "/jobs?category=$job_category->id" }}">{{ $job_category->name }}</a>
                                    </h5>
                                    <span>({{ count($job_category->jobs) }})</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <!-- Our Services End -->
    <!-- Online CV Area Start -->
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
    <!-- Online CV Area End-->
    <!-- Featured_job_start -->
    <section class="featured-job-area feature-padding">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <h2>Recent Job</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <!-- single-job-content -->
                    @if (count($jobs) > 0)
                        @foreach ($jobs as $job)
                            <div class="single-job-items mb-30">
                                <div class="job-items">
                                    <div class="company-img">
                                        <a href="{{ route('frontend.jobs.details', $job->id) }}"><img
                                                src="{{ $job->company->logo }}" alt="Company Logo" width="90px"></a>
                                    </div>
                                    <div class="job-tittle">
                                        <a href="{{ route('frontend.jobs.details', $job->id) }}">
                                            <h4>{{ $job->title }}</h4>
                                        </a>
                                        <ul>
                                            <li>{{ $job->company->company_name }}</li>
                                            <li><i
                                                    class="fas fa-map-marker-alt"></i>{{ !empty($job->location) ? $job->location : $job->company->location }}
                                            </li>
                                            <li>${{ $job->salary }}</li>
                                        </ul>
                                        <style>
                                            .skills {
                                                margin: 0;
                                                padding: 0;
                                                width: 490px;
                                            }

                                            .skills li {
                                                margin: 0 !important;
                                            }

                                            .skills li span {
                                                background: #8B92DD;
                                                color: #fff;
                                                padding: 2px 8px;
                                                border-radius: 10px;
                                            }
                                        </style>
                                        <ul class="skills">
                                            @php
                                                $skills = explode(',', $job->skills);
                                            @endphp
                                            @if (count($skills) > 0)
                                                @foreach ($skills as $skill)
                                                    @if (!empty($skill))
                                                        <li><span class="">{{ $skill }}</span></li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="items-link f-right">
                                    <a href="{{ route('frontend.jobs.details', $job->id) }}">{{ $job->job_nature }}</a>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-12 text-center">
                    <a href="{{ route('frontend.jobs') }}" class="btn head-btn1">All Jobs</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured_job_end -->
    <!-- How  Apply Process Start-->
    <div class="apply-process-area apply-bg pt-150 pb-150"
        data-background="{{ asset('frontend/') }}/assets/img/gallery/how-applybg.png">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle white-text text-center">
                        <span>Apply process</span>
                        <h2> How it works</h2>
                    </div>
                </div>
            </div>
            <!-- Apply Process Caption -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-process text-center mb-30">
                        <div class="process-ion">
                            <span class="flaticon-search"></span>
                        </div>
                        <div class="process-cap">
                            <h5>1. Search a job</h5>
                            <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-process text-center mb-30">
                        <div class="process-ion">
                            <span class="flaticon-curriculum-vitae"></span>
                        </div>
                        <div class="process-cap">
                            <h5>2. Apply for job</h5>
                            <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-process text-center mb-30">
                        <div class="process-ion">
                            <span class="flaticon-tour"></span>
                        </div>
                        <div class="process-cap">
                            <h5>3. Get your job</h5>
                            <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- How  Apply Process End-->
    <!-- Testimonial Start -->
    <div class="testimonial-area">
        <div class="container">
            <!-- Testimonial contents -->
            <div class="row d-flex justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10">
                    <div class="h1-testimonial-active dot-style">
                        <!-- Single Testimonial -->
                        <div class="single-testimonial text-center">
                            <!-- Testimonial Content -->
                            <div class="testimonial-caption ">
                                <!-- founder -->
                                <div class="testimonial-founder  ">
                                    <div class="founder-img mb-30">
                                        <img src="{{ asset('frontend/') }}/assets/img/testmonial/testimonial-founder.png"
                                            alt="">
                                        <span>Margaret Lawson</span>
                                        <p>Creative Director</p>
                                    </div>
                                </div>
                                <div class="testimonial-top-cap">
                                    <p>“I am at an age where I just want to be fit and healthy our bodies are our
                                        responsibility! So start caring for your body and it will care for you. Eat clean it
                                        will care for you and workout hard.”</p>
                                </div>
                            </div>
                        </div>
                        <!-- Single Testimonial -->
                        <div class="single-testimonial text-center">
                            <!-- Testimonial Content -->
                            <div class="testimonial-caption ">
                                <!-- founder -->
                                <div class="testimonial-founder  ">
                                    <div class="founder-img mb-30">
                                        <img src="{{ asset('frontend/') }}/assets/img/testmonial/testimonial-founder.png"
                                            alt="">
                                        <span>Margaret Lawson</span>
                                        <p>Creative Director</p>
                                    </div>
                                </div>
                                <div class="testimonial-top-cap">
                                    <p>“I am at an age where I just want to be fit and healthy our bodies are our
                                        responsibility! So start caring for your body and it will care for you. Eat clean it
                                        will care for you and workout hard.”</p>
                                </div>
                            </div>
                        </div>
                        <!-- Single Testimonial -->
                        <div class="single-testimonial text-center">
                            <!-- Testimonial Content -->
                            <div class="testimonial-caption ">
                                <!-- founder -->
                                <div class="testimonial-founder  ">
                                    <div class="founder-img mb-30">
                                        <img src="{{ asset('frontend/') }}/assets/img/testmonial/testimonial-founder.png"
                                            alt="">
                                        <span>Margaret Lawson</span>
                                        <p>Creative Director</p>
                                    </div>
                                </div>
                                <div class="testimonial-top-cap">
                                    <p>“I am at an age where I just want to be fit and healthy our bodies are our
                                        responsibility! So start caring for your body and it will care for you. Eat clean it
                                        will care for you and workout hard.”</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    <!-- Blog Area Start -->
    <div class="home-blog-area blog-h-padding">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <span>Our latest blog</span>
                        <h2>Our recent news</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (count($blogs) > 0)
                    @foreach ($blogs as $blog)
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="home-blog-single mb-30">
                                <div class="blog-img-cap">
                                    <div class="blog-img">
                                        @if (!empty($blog->thumbnail))
                                            <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}"
                                                style="height:400px; width:570px; object-fit:cover;">
                                        @else
                                            <img src="{{ asset('admin/assets/images/placeholder.jpg') }}"
                                                alt="{{ $blog->title }}"
                                                style="height:400px; width:570px; object-fit:cover;">
                                        @endif
                                        <!-- Blog date -->
                                        <div class="blog-date text-center">
                                            <span>{{ date('d', strtotime($blog->created_at)) }}</span>
                                            <p>{{ date('M', strtotime($blog->created_at)) }}</p>
                                        </div>
                                    </div>
                                    <div class="blog-cap">
                                        <p>| {{ $blog->category->name }}</p>
                                        <h3><a
                                                href="{{ route('frontend.blogs.details', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h3>
                                        <a href="{{ route('frontend.blogs.details', $blog->slug) }}"
                                            class="more-btn">Read more »</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4 class="text-center">No Blogs Found</h4>
                @endif
            </div>
        </div>
    </div>
    <!-- Blog Area End -->
@endsection
