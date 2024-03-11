@extends('frontend.frontend-layout')
@section('content')
    <div class="row bg-light" style="padding:50px 0 80px;">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mt-3 text-center">Create Company Account</h4>
                    <p class="text-center">Get started with your free account</p>
                    @include('components.validatation')
                    <form action="{{ route('frontend.company.registrationSubmit') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group input-group">
                            <input name="first_name" class="form-control" placeholder="First Name*" type="text"
                                value="{{ old('first_name') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="last_name" class="form-control" placeholder="Last Name*" type="text"
                                value="{{ old('last_name') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="email" class="form-control" placeholder="Email address*" type="email"
                                value="{{ old('email') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="phone" class="form-control" placeholder="Phone number*" type="text"
                                value="{{ old('phone') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="company_name" class="form-control" placeholder="Company Name*" type="text"
                                value="{{ old('company_name') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="company_address" class="form-control" placeholder="Company Address*" type="text"
                                value="{{ old('company_address') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="company_type" class="form-control" placeholder="Company Type / Industry (Tech, Farming etc)*" type="text"
                                value="{{ old('company_type') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="password" class="form-control" placeholder="Create password*" type="password">
                        </div>
                        <div class="form-group input-group">
                            <input name="password_confirmation" class="form-control" placeholder="Repeat password*"
                                type="password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                        </div>
                        <div class="text-center">
                            <p class="text-center">Register as a candidate <a href="{{ route('register') }}"
                                    class="text-primary">Register</a>
                            </p>
                            <p class="text-center">OR</p>
                            <p class="text-center">Have an account? <a href="{{ route('login') }}" class="text-primary">Log
                                    In</a> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
