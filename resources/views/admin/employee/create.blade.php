@extends('admin.admin-layout')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add new employee</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <h6 class="mb-0 text-uppercase">Create New Employee</h6>
            <hr>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div>
                        </div>
                        <h5 class="mb-0 text-primary">Employee Details</h5>
                    </div>
                    <hr>
                    @include('components.validatation')
                    <form class="row g-3" method="POST" action="{{ route('employee.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name*</label>
                            <input type="text" name="first_name" placeholder="Enter First Name" class="form-control"
                                id="first_name" value="{{ old('first_name') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name*</label>
                            <input type="text" name="last_name" placeholder="Enter last Name" class="form-control"
                                id="last_name" value="{{ old('last_name') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="email" placeholder="Enter Email" class="form-control"
                                id="email" value="{{ old('email') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="form-label">Phone*</label>
                            <input type="text" name="phone" placeholder="Enter Phone" class="form-control"
                                id="phone" value="{{ old('phone') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" name="password" placeholder="Enter Password" class="form-control"
                                id="password" value="{{ old('password') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm Password*</label>
                            <input type="password" name="password_confirmation" placeholder="Enter lConfirm Password"
                                class="form-control" id="password_confirmation" value="{{ old('confirm_password') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="employee_type" class="form-label">Employee Type*</label>
                            <select name="employee_type" id="employee_type" class="form-control">
                                <option value="editor">Editor</option>
                                <option value="manager">Manager</option>
                            </select>
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
