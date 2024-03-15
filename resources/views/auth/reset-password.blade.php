@extends('frontend.frontend-layout')
@section('content')
    <div class="row bg-light" style="padding:50px 0 80px;">
        <div class="col-md-4 offset-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mt-3 text-center">Reset Password</h4>
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('components.validatation')
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group input-group">
                            <input name="email" class="form-control" placeholder="Email" required type="email"
                                value="{{ old('email', $request->email) }}">
                        </div>
                        <div class="form-group input-group">
                            <input name="password" class="form-control" placeholder="New Password" required type="password">
                        </div>
                        <div class="form-group input-group">
                            <input name="password_confirmation" class="form-control" placeholder="Confirm Password" required
                                type="password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Update Now</button>
                        </div>
                        <div class="text-center">
                            <p class="text-center">OR</p>
                            <p class="text-center">Don't Have an account? <a href="{{ route('register') }}"
                                    class="text-primary">Register Now</a> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
