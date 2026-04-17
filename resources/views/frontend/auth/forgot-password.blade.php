@extends('layouts.frontend')
@section('title', 'Forgot Password | East Coast Puppies')
@section('content')
    <div class="login-content mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-5 mx-auto">
                    <div class="login-wrap">
                        <div class="login-header">
                            <h3>Forgot Password</h3>
                            <p>Enter your email to receive a reset link</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group group-img">
                                <div class="group-img">
                                    <i class="feather-mail"></i>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" name="email" required value="{{ old('email') }}" autofocus>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-primary w-100 login-btn" type="submit">Send Reset Link</button>
                            <div class="register-link text-center">
                                <p>Remember your password? <a class="forgot-link" href="{{ route('front.login') }}">Sign In</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
