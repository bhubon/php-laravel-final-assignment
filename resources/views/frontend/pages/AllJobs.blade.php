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
                            <h2>Get your job</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- Job List Area Start -->
    <div class="job-listing-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <!-- Left content -->
                <div class="col-xl-3 col-lg-3 col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="small-section-tittle2 mb-45">
                                <div class="ion"> <svg xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="12px">
                                        <path fill-rule="evenodd" fill="rgb(27, 207, 107)"
                                            d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z" />
                                    </svg>
                                </div>
                                <h4>Filter Jobs</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Job Category Listing start -->
                    <div class="job-category-listing mb-50">
                        <!-- single one -->
                        <div class="single-listing">
                            <div class="small-section-tittle2">
                                <h4>Job Category</h4>
                            </div>
                            <!-- Select job items start -->
                            <div class="select-job-items2">
                                <select name="select" onchange="redirectToUrl(this)">
                                    <option value="">All Category</option>
                                    @foreach ($jobs_categories as $job_category)
                                        <option {{ request()->category == $job_category->id ? 'selected' : '' }}
                                            value="{{ $job_category->id }}">{{ $job_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--  Select job items End-->
                            <!-- select-Categories start -->
                            <div class="select-Categories pt-80 pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Job Type</h4>
                                </div>
                                <label class="container">Office
                                    <input type="checkbox"
                                        {{ request()->job_type == 'office' ? 'checked="checked active"' : '' }}
                                        value="office" name="job_type" onclick="jobType(this)">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Remote
                                    <input type="checkbox"
                                        {{ request()->job_type == 'remote' ? 'checked="checked active"' : '' }}
                                        value="remote" name="job_type" onclick="jobType(this)">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Hybride
                                    <input type="checkbox"
                                        {{ request()->job_type == 'hybrid' ? 'checked="checked active"' : '' }}
                                        value="hybrid" name="job_type" onclick="jobType(this)">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <!-- select-Categories End -->
                        </div>
                        <!-- single two -->
                        <div class="single-listing">
                            <!-- select-Categories start -->
                            <div class="select-Categories pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Job Nature</h4>
                                </div>
                                <label class="container">Full Time
                                    <input type="checkbox"  {{ request()->job_nature == 'Full Time' ? 'checked="checked"' : '' }} value="Full Time" onchange="job_nature(this)">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Part Time
                                    <input type="checkbox"  {{ request()->job_nature == 'Part Time' ? 'checked="checked"' : '' }} value="Part Time"
                                        onchange="job_nature(this)">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <!-- select-Categories End -->
                        </div>
                    </div>
                    <!-- Job Category Listing End -->
                </div>
                <!-- Right content -->
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <!-- Featured_job_start -->
                    <section class="featured-job-area">
                        <div class="container">
                            <!-- Count of Job list Start -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="count-job mb-35">
                                        <span>{{ count($jobs) }} Jobs found</span>
                                        <!-- Select job items start -->
                                    </div>
                                </div>
                            </div>
                            <!-- Count of Job list End -->
                            <!-- single-job-content -->
                            @if (count($jobs) > 0)
                                @foreach ($jobs as $job)
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
                                        <div class="items-link items-link2 f-right">
                                            <a
                                                href="{{ route('frontend.jobs.details', $job->id) }}">{{ ucwords($job->job_type) }}</a>
                                            <span>{{ $job->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h4>No Job Found</h4>
                            @endif

                        </div>
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Job List Area End -->
    <!--Pagination Start  -->
    <div class="pagination-area pb-115 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
    <!--Pagination End  -->

    <script>
        function redirectToUrl(selectElement) {
            const selectedValue = selectElement.value;
            const urlParams = new URLSearchParams(window.location.search);

            // Set or delete the 'category' parameter based on the selected value
            if (selectedValue) {
                urlParams.set('category', selectedValue);
            } else {
                urlParams.delete('category');
            }

            // Construct the new URL with updated parameters
            const newUrl = window.location.pathname + '?' + urlParams.toString();

            // Redirect to the new URL
            window.location.href = newUrl;
        }


        function jobType(checkbox) {
            const checkedValue = checkbox.checked ? checkbox.value : '';
            const urlParams = new URLSearchParams(window.location.search);

            // Set or delete the 'job_type' parameter based on the checked value
            if (checkedValue) {
                urlParams.set('job_type', checkedValue);
            } else {
                urlParams.delete('job_type');
            }

            // Construct the new URL with updated parameters
            const newUrl = window.location.pathname + '?' + urlParams.toString();

            // Redirect to the new URL
            window.location.href = newUrl;
        }


        function job_nature(checkbox) {
            const checkedValue = checkbox.checked ? checkbox.value : '';
            const urlParams = new URLSearchParams(window.location.search);

            // Set or delete the 'job_type' parameter based on the checked value
            if (checkedValue) {
                urlParams.set('job_nature', checkedValue);
            } else {
                urlParams.delete('job_nature');
            }

            // Construct the new URL with updated parameters
            const newUrl = window.location.pathname + '?' + urlParams.toString();

            // Redirect to the new URL
            window.location.href = newUrl;
        }
    </script>
@endsection
