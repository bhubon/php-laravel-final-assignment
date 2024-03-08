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
                        <li class="breadcrumb-item active" aria-current="page">Add Education</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <h6 class="mb-0 text-uppercase">Add Education</h6>
            <hr>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div>
                        </div>
                        <h5 class="mb-0 text-primary">Education Details</h5>
                    </div>
                    <hr>
                    @include('components.validatation')
                    <form class="row g-3" method="POST" action="{{ route('education.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="degree" class="form-label">Degree*</label>
                            <input type="text" name="degree_type" placeholder="Enter Degree Type" class="form-control"
                                id="degree" value="{{ old('degree') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="institute_name" class="form-label">Institute Name*</label>
                            <input type="text" name="institute_name" placeholder="Enter Institute Name"
                                class="form-control" id="institute_name" value="{{ old('institute_name') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="department" class="form-label">Department*</label>
                            <input type="text" name="department" class="form-control" id="passing_year"
                                value="{{ old('department') }}" placeholder="Enter Department">
                        </div>
                        <div class="col-md-12">
                            <label for="passing_year" class="form-label">Passing Year*</label>
                            <input type="text" name="passing_year" class="form-control" id="passing_year"
                                value="{{ old('passing_year') }}" placeholder="Enter Passing/Trainig Year">
                        </div>
                        <div class="col-md-12">
                            <label for="cgpa" class="form-label">CGPA / GPA*</label>
                            <input type="text" name="cgpa" class="form-control" id="cgpa"
                                value="{{ old('cgpa') }}" placeholder="Enter CGPA/GPA">
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
