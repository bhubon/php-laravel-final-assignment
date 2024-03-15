@extends('frontend.frontend-layout')
@section('content')
    <div class="row bg-light" style="padding:50px 0 80px;">
        <div class="col-md-4 offset-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mt-3 text-center">Login Now</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        @include('components.validatation')
                        @method('POST')
                        <div class="form-group input-group">
                            <input name="email" class="form-control" placeholder="Email" required type="email"
                                value="{{ old('email') }}">
                        </div>
                        <div class="form-group input-group mb-0">
                            <input name="password" class="form-control" placeholder="Password" type="password" required
                                value="{{ old('password') }}">
                        </div>
                        <a href="{{ route('password.request') }}" class="text-dark mt-0 mb-4 d-block text-right">Forgon
                            Password</a>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
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
