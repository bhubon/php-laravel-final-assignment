@extends('company.company-layout')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <h6 class="mb-0 text-uppercase">Edit Employee</h6>
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
                    <form class="row g-3" method="POST" action="{{ route('employee-manager.update', $employee->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name*</label>
                            <input type="text" name="first_name" placeholder="Enter First Name" class="form-control"
                                id="first_name" value="{{ old('first_name', $employee->first_name) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name*</label>
                            <input type="text" name="last_name" placeholder="Enter last Name" class="form-control"
                                id="last_name" value="{{ old('last_name', $employee->last_name) }}">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="email" placeholder="Enter Email" class="form-control"
                                id="email" value="{{ old('email', $employee->email) }}">
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="form-label">Phone*</label>
                            <input type="text" name="phone" placeholder="Enter Phone" class="form-control"
                                id="phone" value="{{ old('phone', $employee->phone) }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><strong>Change Password</strong></label>
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" name="password" placeholder="Enter Password" class="form-control"
                                id="password" value="{{ old('password') }}">
                        </div>
                        <div class="col-md-6 mt-0">
                            <label for="password_confirmation" class="form-label">Confirm Password*</label>
                            <input type="password" name="password_confirmation" placeholder="Enter lConfirm Password"
                                class="form-control" id="password_confirmation" value="{{ old('confirm_password') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="employee_type" class="form-label">Employee Type (Role)*</label>
                            <select name="employee_type" id="employee_type" class="form-control">
                                <option {{ $employee->employee_type == 'editor' ? 'selected' : '' }} value="editor">Editor
                                </option>
                                <option {{ $employee->employee_type == 'manager' ? 'selected' : '' }} value="manager">
                                    Manager</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="permissions" class="form-label">Permissions</label>
                            <style>
                                .permissions ul {
                                    margin: 0;
                                    padding: 0;
                                    list-style: none;
                                    display: flex;
                                    flex-wrap: wrap;
                                }

                                .permissions ul li {
                                    margin: 0 8px 17px;
                                    width: 22%;
                                }
                            </style>
                            <div class="permissions">
                                <ul>
                                    @if (count($permissions) > 0)
                                        @php
                                            $user_permissions = $employee->getAllPermissions();
                                        @endphp
                                        @foreach ($permissions as $key => $permission)
                                            <li><input name="permissions[]" id="permission-{{ $key }}"
                                                    {{ in_array($permission, $user_permissions->pluck('name')->toArray()) ? 'checked' : '' }}
                                                    type="checkbox" value="{{ $permission }}">
                                                <label for="permission-{{ $key }}">{{ $permission }}</label>
                                            </li>
                                        @endforeach
                                    @else
                                        <h5>Run "php artisan db:seed --class=PermissionSeeder" to seed permissions
                                        </h5>
                                    @endif
                                </ul>
                            </div>
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
