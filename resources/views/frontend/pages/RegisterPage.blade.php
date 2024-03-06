@extends('frontend.frontend-layout')
@section('content')
    <div class="row bg-light" style="padding:50px 0 80px;">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mt-3 text-center">Create Account</h4>
                    <p class="text-center">Get started with your free account</p>
                    @include('components.validatation')
                    <form action="{{ route('frontend.registrationSubmit') }}" method="POST" >
                        @csrf
                        @method('POST')
                        <div class="form-group input-group">
                            <input name="first_name" class="form-control" placeholder="First Name" type="text" value="{{ old('first_name') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="last_name" class="form-control" placeholder="Last Name" type="text" value="{{ old('last_name') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="email" class="form-control" placeholder="Email address" type="email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="phone" class="form-control" placeholder="Phone number" type="text" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="password" class="form-control" placeholder="Create password" type="password">
                        </div>
                        <div class="form-group input-group">
                            <input name="password_confirmation" class="form-control" placeholder="Repeat password"
                                type="password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                        </div>
                        <p class="text-center">Have an account? <a href="" class="text-primary">Log In</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
