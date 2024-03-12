@extends('frontend.frontend-layout')
@section('content')
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center"
            data-background="{{ !empty($job->company->cover_photo) ? $job->company->cover_photo : asset('frontend/assets/img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $job->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- job single -->
                    <div class="single-job-items mb-30">
                        <div class="job-items">
                            <div class="company-img">
                                <a href="{{ route('frontend.jobs.details', $job->id) }}"><img
                                        src="{{ !empty($job->company->logo) ? asset($job->company->logo) : asset('uploads/placeholder.jpg') }}"
                                        alt=""
                                        style="height: 90px; width:90px; object-fit:cover;border:1px solid #ddd;"></a>
                            </div>
                            <div class="job-tittle job-tittle2">
                                <a href="{{ route('frontend.jobs.details', $job->id) }}">
                                    <h4>{{ $job->title }}</h4>
                                </a>
                                <ul>
                                    <li>{{ $job->company->company_name }}</li>
                                    <li><i
                                            class="fas fa-map-marker-alt"></i>{{ !empty($job->location) ? $job->location : $job->company->company_address }}
                                    </li>
                                    <li>${{ $job->salary }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="items-link items-link2 f-right">
                            <a href="{{ route('frontend.jobs.details', $job->id) }}">{{ ucwords($job->job_type) }}</a>
                            <span>{{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <!-- job single End -->

                    <div class="job-post-details">
                        <div class="post-details1 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Description</h4>
                            </div>
                            <p>{{ $job->description }}</p>
                        </div>
                        <div class="post-details2  mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Required Knowledge, Skills, and Abilities</h4>
                            </div>
                            <p>
                                {{ $job->requirements }}
                            </p>
                        </div>
                    </div>

                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3  mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Job Overview</h4>
                        </div>
                        <ul>
                            <li>Posted date : <span>{{ date('d M, Y', strtotime($job->created_at)) }}</span></li>
                            <li>Location :
                                <span>{{ !empty($job->location) ? $job->location : $job->company->company_address }}</span>
                            </li>
                            <li>Vacancy : <span>{{ $job->vacancy }}</span></li>
                            <li>Job nature : <span>{{ $job->job_nature }}</span></li>
                            <li>Job Type : <span>{{ ucwords($job->job_type) }}</span></li>
                            <li>Salary : <span>${{ $job->salary }}</span></li>
                            <li>Application date : <span>{{ date('d M, Y', strtotime($job->deadline)) }}</span></li>
                        </ul>
                        <div class="apply-btn2">
                            @if (auth()->check() && auth()->user()->role != 'candidate')
                                <button type="button" disabled class="btn">Loggedin As Candidate To Apply</a>
                                @elseif (!auth()->check())
                                    <a href="#" class="btn">Login To Appy</a>
                                @else
                                    @php
                                        $application = \App\Models\Application::where([
                                            'user_id' => auth()->user()->id,
                                            'job_id' => $job->id,
                                        ])->first();
                                    @endphp

                                    @if ($application)
                                        <button type="button" class="btn">Allready Applied</button>
                                    @else
                                    @include('components.validatation')
                                        <form action="{{ route('frontend.jobs.apply', $job->id) }}" method="POST">
                                            @csrf
                                            <div class="d-flex mb-3">
                                                <div class="form-grpup mr-1">
                                                    <label for="current_salaries">Current Salary</label>
                                                    <input type="text" id="current_salaries" name="current_salary" class="form-control" required placeholder="Current Salary">
                                                </div>
                                                <div class="form-grpup ml-1">
                                                    <label for="expected_salaried">Expected Salary</label>
                                                    <input type="text" id="expected_salaried" name="expected_salary" class="form-control" required placeholder="Current Salary">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn">Apply Now</button>
                                        </form>
                                    @endif
                            @endif
                        </div>
                    </div>
                    <div class="post-details4  mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Company Information</h4>
                        </div>
                        <span>{{ $job->company->company_name }}</span>
                        <ul>
                            <li>Name: <span>{{ $job->company->company_name }} </span></li>
                            <li>Address: <span>{{ $job->company->company_address }} </span></li>
                            <li>Web : <span>{{ $job->company->company_phone }}</span></li>
                            <li>Email: <span>{{ $job->company->company_email }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job post company End -->
@endsection
