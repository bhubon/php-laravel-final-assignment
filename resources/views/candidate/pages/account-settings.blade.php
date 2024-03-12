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
                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <h6 class="mb-0 text-uppercase">Account Settings</h6>
            <hr>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0 text-primary">Account Settings <span
                                style="font-size: 14px;color:#000;font-weight:400;">(Not Visiable On Job Appply)</span></h5>
                    </div>
                    <hr>
                    @include('components.validatation')
                    <form class="row g-3" method="POST" action="{{ route('user.account.update') }}"
                        enctype="multipart/form-data">
                        @csrf
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
                        <div class="col-md-12">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" name="avatar" class="form-control" id="avatar">
                        </div>
                        <div class="col-md-12">
                            @php

                                if (!empty($user->avatar)) {
                                    $avatar = $user->avatar;
                                } else {
                                    $avatar = asset('admin/assets/images/pladeholder-avatar.jpg');
                                }

                            @endphp
                            <img src="{{ $avatar }}" class="user-img" alt="user avatar"
                                style="width: 160px; height:160px;object-fit:cover;">
                        </div>
                        <div class="col-md-12 mb-0">
                            <label for="password" class="form-label"><strong>Chnage Password (Fill if need to change
                                    password)</strong></label>
                        </div>
                        <div class="col-md-12 mt-0">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" id="current_password"
                                placeholder="Enter Current Password">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Enter New Password">
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" placeholder="Confirm Password">
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
