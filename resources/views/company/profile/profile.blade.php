@extends('company.company-layout')
@section('content')
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
    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Company Details</h5>
            <hr>
            <div class="form-body mt-4">
                <form action="{{ route('company.profileUpdate') }}" method="POST" enctype="multipart/form-data">
                    @include('components.validatation')
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 offset-2">
                            <div class="border border-3 p-4 rounded">
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name*</label>
                                    <input type="text" name="company_name" class="form-control" id="company_name"
                                        placeholder="Enter company name" value="{{ $user->company->company_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="company_address" class="form-label">Company Address*</label>
                                    <textarea class="form-control" name="company_address" id="company_address" rows="3">{{ $user->company->company_address }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="company_phone" class="form-label">Company Phone Number*</label>
                                    <input type="text" name="company_phone" class="form-control" id="company_phone"
                                        placeholder="Enter phone number" value="{{ $user->company->company_phone }}">
                                </div>
                                <div class="mb-3">
                                    <label for="company_email" class="form-label">Company Email*</label>
                                    <input type="email" name="company_email" class="form-control" id="company_email"
                                        placeholder="Enter company email" value="{{ $user->company->company_email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="company_website" class="form-label">Company Website</label>
                                    <input type="text" name="company_website" class="form-control" id="company_website"
                                        placeholder="Enter company website url"
                                        value="{{ $user->company->company_website }}">
                                </div>
                                <div class="mb-3">
                                    <label for="industry" class="form-label">Industry</label>
                                    <input type="text" name="industry" class="form-control" id="industry"
                                        placeholder="Enter company industry type" value="{{ $user->company->industry }}">
                                </div>
                                <div class="mb-3">
                                    <label for="company_size" class="form-label">Company Size</label>
                                    <input type="text" name="company_size" class="form-control" id="company_size"
                                        placeholder="Enter company size (Big, Medium, Startup)"
                                        value="{{ $user->company->company_size }}">
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Company Logo</label>
                                    <input type="file" name="logo" class="form-control" id="logo">
                                    @if (!empty($user->company->logo))
                                        <img src="{{ $user->company->logo }}" alt="Logo"
                                            style="height: 120px; margin-top:10px;">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="cover_photo" class="form-label">Company Covever Photo</label>
                                    <input type="file" name="cover_photo" class="form-control" id="cover_photo">
                                    @if (!empty($user->company->cover_photo))
                                        <img src="{{ $user->company->cover_photo }}" alt="Cover"
                                            style="height: 120px; margin-top:10px;">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="facebook_links" class="form-label">Facebook Link</label>
                                    <input type="text" name="facebook_links" class="form-control" id="facebook_links"
                                        placeholder="Enter company facebook link"
                                        value="{{ $user->company->facebook_links }}">
                                </div>
                                <div class="mb-3">
                                    <label for="linkedin_link" class="form-label">Linkedin Link</label>
                                    <input type="text" name="linkedin_link" class="form-control" id="linkedin_link"
                                        placeholder="Enter company linkedin link"
                                        value="{{ $user->company->linkedin_link }}">
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex items-center">
                                        <button type="submit" class="btn btn-primary">Update Company Profile</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
@endsection
