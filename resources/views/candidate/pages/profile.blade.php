@extends('candidate.candidate-layout')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <h6 class="mb-0 text-uppercase">Profile</h6>
            <hr>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div>
                        </div>
                        <h5 class="mb-0 text-primary">Profile Details</h5>
                    </div>
                    <hr>
                    @include('components.validatation')
                    <form class="row g-3" method="POST" action="{{ route('user.profile.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="full_name" class="form-label">Full Name*</label>
                            <input type="text" name="full_name" placeholder="Enter Full Name" class="form-control"
                                id="full_name" value="{{ old('full_name', $candidate->name) }}">
                        </div>
                        <div class="col-md-12">
                            <label for="fathers_name" class="form-label">Father's Name*</label>
                            <input type="text" name="fathers_name" class="form-control" id="fathers_name"
                                value="{{ old('fathers_name', $candidate->fathers_name) }}"
                                placeholder="Enter Father's Name">
                        </div>
                        <div class="col-md-12">
                            <label for="mothers_name" class="form-label">Mother's Name*</label>
                            <input type="text" name="mothers_name" class="form-control" id="mothers_name"
                                value="{{ old('mothers_name', $candidate->mothers_name) }}"
                                placeholder="Enter Mother's Name">
                        </div>
                        <div class="col-md-12">
                            <label for="date_of_birth" class="form-label">Date Of Birth*</label>
                            <input type="date" name="date_of_birth" class="form-control" id="date_of_birth"
                                value="{{ old('date_of_birth', $candidate->date_of_birth) }}">
                        </div>
                        <div class="col-md-12">
                            <label for="blood_group" class="form-label">Blood Group*</label>
                            <input type="text" name="blood_group" class="form-control" id="blood_group"
                                value="{{ old('blood_group', $candidate->blood_group) }}" placeholder="Enter Blood Group">
                        </div>
                        <div class="col-md-12">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" name="avatar" class="form-control" id="avatar">
                        </div>
                        <div class="col-md-12">
                            @php

                                if (!empty($candidate->avatar)) {
                                    $avatar = $candidate->avatar;
                                } else {
                                    $avatar = asset('candidate/assets/images/avatars/avatar-2.png');
                                }

                            @endphp
                            <img src="{{ $avatar }}" class="user-img" alt="user avatar"
                                style="width: 160px; height:auto;">
                        </div>
                        <div class="col-md-12">
                            <label for="social_id" class="form-label">Social ID</label>
                            <input type="text" name="social_id" class="form-control" id="social_id"
                                value="{{ old('social_id', $candidate->social_id) }}" placeholder="Enter Social ID">
                        </div>
                        <div class="col-md-12">
                            <label for="passport_no" class="form-label">Passport NO.</label>
                            <input type="text" name="passport_no" class="form-control" id="passport_no"
                                value="{{ old('passport_no', $candidate->passport_no) }}"
                                placeholder="Enter Passport Number">
                        </div>
                        <div class="col-md-12">
                            <label for="emergency_contact_number" class="form-label">Emergency Contact Number*</label>
                            <input type="text" name="emergency_contact_number" class="form-control"
                                id="emergency_contact_number"
                                value="{{ old('emergency_contact_number', $candidate->emergency_contact_number) }}"
                                placeholder="Enter Emergency Contact Number">
                        </div>
                        <div class="col-md-12">
                            <label for="whatsapp_number" class="form-label">Whatsapp Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" id="whatsapp_number"
                                value="{{ old('whatsapp_number', $candidate->whatsapp_number) }}"
                                placeholder="Enter Whatsapp Number">
                        </div>
                        <div class="col-md-12">
                            <label for="facebook_link" class="form-label">Facebook Profile URL</label>
                            <input type="text" name="facebook_link" class="form-control" id="facebook_link"
                                value="{{ old('facebook_link', $candidate->facebook_link) }}"
                                placeholder="Enter Facebook Profile Url">
                        </div>
                        <div class="col-md-12">
                            <label for="linkedin_link" class="form-label">Linkedin Profile URL</label>
                            <input type="text" name="linkedin_link" class="form-control" id="linkedin_link"
                                value="{{ old('linkedin_link', $candidate->linkedin_link) }}"
                                placeholder="Enter Linkedin Profile Url">
                        </div>
                        <div class="col-md-12">
                            <label for="github_link" class="form-label">Github Profile URL</label>
                            <input type="text" name="github_link" class="form-control" id="github_link"
                                value="{{ old('github_link', $candidate->github_link) }}"
                                placeholder="Enter Github Profile Url">
                        </div>
                        <div class="col-md-12">
                            <label for="behance_link" class="form-label">Behance Profile URL</label>
                            <input type="text" name="behance_link" class="form-control" id="behance_link"
                                value="{{ old('behance_link', $candidate->behance_link) }}"
                                placeholder="Enter Behance Profile Url">
                        </div>
                        <div class="col-md-12">
                            <label for="portfolio_link" class="form-label"> Portfolio Website URL</label>
                            <input type="text" name="portfolio_link" class="form-control" id="portfolio_link"
                                value="{{ old('portfolio_link', $candidate->portfolio_link) }}"
                                placeholder="Enter Portfolio Website Url">
                        </div>
                        <div class="col-md-12">
                            <label for="resume" class="form-label">CV / Resume</label>
                            <input type="file" name="resume" class="form-control" id="resume"
                                value="{{ old('resume') }}">
                        </div>
                        <div class="col-md-12">
                            @if ($candidate->resume == !'')
                                <a href="{{ asset($candidate->resume) }}" target="_blank">View CV / Resume</a>
                            @endif
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
