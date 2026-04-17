@extends('layouts.frontend')
@section('title', 'Register | East Coast Puppies')
@section('content')
    <div class="login-content mt-5">
        <div class="container">
            <div class="row">
            <div class="col-md-6 col-lg-5 mx-auto">
                <div class="login-wrap register-form">
                
                <div class="login-header">
                    <h3>Create an Account</h3>
                    <p>Start With Us</p>								
                </div>
                
                <!-- Login Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- @if(count($errors->all()) >= 1)
                        {{ dd($errors->all()) }}
                    @endif --}}

                    <select class="form-select @error('user_type') is-invalid @enderror" aria-label="Default select example" name="user_type" required>
                    <option value="buyer">
                        I’m looking for a puppy
                    </option>
                    <option value="seller">
                        I’m a breeder; I want to sell puppies
                    </option>
                    </select>
                    @error('user_type')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <div class="form-group group-img">
                        <div class="group-img">
                            <i class="feather-user"></i>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Full Name') }}" name="name" required value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group group-img">
                        <div class="group-img">
                            <i class="feather-mail"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}" name="email" required value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group group-img">
                        <div class="group-img">
                            <i class="feather-phone"></i>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ __('Contact No') }}" name="phone" required value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="pass-group group-img">
                            <i class="feather-lock"></i>
                            <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" required autocomplete="new-password">
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
                            <input type="password" class="form-control pass-input" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required autocomplete="new-password">
                            <span class="toggle-password feather-eye"></span>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100 login-btn" type="submit">{{ __('Create Account') }}</button>
                    <div class="register-link text-center">
                    <p>Already have an account? <a class="forgot-link" href="{{ route('login') }}">Sign In</a></p>
                    </div>					
                </form>
                <!-- /Login Form -->
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection