@extends('layouts.frontend')
@section('title', 'Login | East Coast Puppies')
@section('content')
    <div class="login-content mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-5 mx-auto">
                    <div class="login-wrap">
                    
                    <div class="login-header">
                        <h3>Welcome Back</h3>
                        <p>Please Enter your Details</p>								
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- Login Form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group group-img">
                            <div class="group-img">
                                <i class="feather-mail"></i>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" name="email" required  value="{{ old('email') }}" autofocus autocomplete="username">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="pass-group group-img">
                                <i class="feather-lock"></i>
                                <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">
                                <span class="toggle-password feather-eye"></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label class="custom_check">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="rememberme">
                                    <span class="checkmark"></span>{{ __('Remember Me') }}
                                </label>
                            </div>									
                        <div class="col-md-6 col-sm-6">
                            <div class="text-md-end">
                            <a class="forgot-link" href="{{ route('password.request') }}">Forgot password?</a>
                            </div>
                        </div>									 
                        </div>
                        <button class="btn btn-primary w-100 login-btn" type="submit">Sign in</button>
                        <div class="register-link text-center">
                        <p>No account yet? <a class="forgot-link" href="{{ route('register') }}">Signup</a></p>
                        </div>								
                    </form>
                    <!-- /Login Form -->
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')
<script>
    $('.login-btn').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        //Custom logic
        let email = $('input[name="email"]').val();
        let password = $('input[name="password"]').val();

        if (email && password) {
            console.log("Submitting with:", { email, password });
            $('form').submit(); // Submit the form manually if needed
        } else {
            alert("Please fill in all required fields.");
        }
    });
</script>
@endsection