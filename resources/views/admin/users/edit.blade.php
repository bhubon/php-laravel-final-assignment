@extends('admin.admin-layout')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div>
                        </div>
                        <h5 class="mb-0 text-primary">User Details</h5>
                    </div>
                    <hr>
                    @include('components.validatation')
                    <form class="row g-3" method="POST" action="{{ route('job-category.update', $user->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name*</label>
                            <input type="text" name="first_name" class="form-control" id="first_name"
                                value="{{ old('first_name', $user->first_name) }}" placeholder="Enter Profile First Name">
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name*</label>
                            <input type="text" name="last_name" class="form-control" id="last_name"
                                value="{{ old('last_name', $user->last_name) }}" placeholder="Enter Profile last Name">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" disabled class="form-control" id="email" value="{{ $user->email }}">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone*</label>
                            <input type="text" name="phone" class="form-control" id="phone"
                                value="{{ old('phone', $user->phone) }}" placeholder="Enter Phone">
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role*</label>
                            <select name="role" id="role" class="form-control">
                                <option {{ $user->role == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                                <option {{ $user->role == 'company' ? 'selected' : '' }} value="company">Company</option>
                                <option {{ $user->role == 'candidate' ? 'selected' : '' }} value="candidate">Candidate</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status*</label>
                            <select name="status" id="status" class="form-control">
                                <option {{ $user->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                                <option {{ $user->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            @if ($user->role == 'company')
                               <a href="{{ route('companies.edit',$user->company->id) }}" class="btn btn-success">View Company Details</a>
                               @elseif ($user->role =='admin')
                               @elseif ($user->role =='candidate')
                               <a href="{{ route('admin.candidate.details',$user->id) }}" class="btn btn-success">View Candidate Details</a>
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
