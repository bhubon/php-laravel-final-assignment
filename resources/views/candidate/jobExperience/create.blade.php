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
                        <li class="breadcrumb-item active" aria-current="page">Add Job Experience</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <h6 class="mb-0 text-uppercase">Add Job Experience</h6>
            <hr>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div>
                        </div>
                        <h5 class="mb-0 text-primary">Job Details</h5>
                    </div>
                    <hr>
                    @include('components.validatation')
                    <form class="row g-3" method="POST" action="{{ route('user.job.experiences.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="designation" class="form-label">Designation*</label>
                            <input type="text" name="designation" placeholder="Enter Designation" class="form-control"
                                id="designation" value="{{ old('designation') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="company_name" class="form-label">Company Name*</label>
                            <input type="text" name="company_name" placeholder="Enter Company Name" class="form-control"
                                id="company_name" value="{{ old('company_name') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="joining_date" class="form-label">Joining Date*</label>
                            <input type="date" name="joining_date" class="form-control" id="joining_date"
                                value="{{ old('joining_date') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="departure_date" class="form-label">Departure Date</label>
                            <input type="date" name="departure_date" class="form-control" id="departure_date"
                                value="{{ old('departure_date') }}">
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
