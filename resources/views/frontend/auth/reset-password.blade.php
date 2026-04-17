@extends('layouts.frontend')
@section('title', 'Reset Password | East Coast Puppies')
@section('content')
    <div class="login-content mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-5 mx-auto">
                    <div class="login-wrap">
                        <div class="login-header">
                            <h3>Reset Password</h3>
                            <p>Set a new password for your account</p>
                        </div>

                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-group group-img">
                                <div class="group-img">
                                    <i class="feather-mail"></i>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" name="email" required value="{{ old('email', $request->email) }}" autofocus autocomplete="username">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="pass-group group-img">
                                    <i class="feather-lock"></i>
                                    <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" placeholder="New Password" name="password" required autocomplete="new-password">
                                    <span class="toggle-password feather-eye"></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="pass-group group-img">
                                    <i class="feather-lock"></i>
                                    <input type="password" class="form-control pass-input @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                    <span class="toggle-password feather-eye"></span>
                                </div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-primary w-100 login-btn" type="submit">Reset Password</button>
                            <div class="register-link text-center">
                                <p>Back to <a class="forgot-link" href="{{ route('front.login') }}">Sign In</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
