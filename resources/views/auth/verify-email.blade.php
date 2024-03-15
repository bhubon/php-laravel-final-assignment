@extends('frontend.frontend-layout')
@section('content')
    <div class="row bg-light" style="padding:50px 0 80px;">
        <div class="col-md-4 offset-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="mt-4 flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div> 
                                <button type="submit" class="btn btn-sam btn-success">{{ __('Resend Verification Email') }}</button>
                            </div>
                        </form>

                        <form class="mt-4" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="btn btn-sm">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
