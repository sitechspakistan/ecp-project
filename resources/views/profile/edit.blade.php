{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.frontend')
@section('title', 'Profile | East Coast Puppies')
@section('customStyles')
    <style>
        .email-listing{
            color: #fff;
            box-shadow: inset 0 0 0 #fff;
            border-radius: 4px;
            padding: 11px 19px;
            font-weight: 600;
            text-align: center;
            -webkit-transition: all 0.7s;
            -moz-transition: all 0.7s;
            -o-transition: all 0.7s;
            transition: all 0.7s;
            line-height: normal;
            background-color: #374b5c;
            border: 1px solid #374b5c;
            display: flex;
            align-items: center;
        }
        .email-listing:hover {
            background-color: #fff;
            border: 1px solid #374b5c;
            color: #374b5c;
        }
    </style>
@endsection
@section('content')

    @if(Session::has('status'))
        <div class="alert alert-success alert-icon" style="position: absolute;top: 2%;right: 1%;z-index: 9999;">
            <em class="icon ni ni-check-circle"></em> <strong>{{Session::get('status')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width: 6px;height: 10px;margin-left: 20px;"></button>
        </div>
    @endif

    <!-- Breadscrumb Section -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">Profile</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>							
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadscrumb Section -->

    <!-- Profile Content -->
    <div class="dashboard-content">		
        <div class="container">
            @include('frontend.includes.dashboard_menu')
            <div class="profile-content">
                <div class="row dashboard-info">
                    <div class="col-lg-9">
                        <div class="card dash-cards">
                            <div class="card-header">
                                <h4>Profile Details</h4>																
                            </div>
                            <div class="card-body">
                                <div class="profile-photo">
                                    <div class="profile-img">
                                        <div class="settings-upload-img">
                                            @if(!isset($user->image))
                                                <img src="{{asset('assets_frontend')}}/img/profile-img.jpg" alt="profile">
                                            @else
                                                <img src="{{asset('uploads/user_image/'.$user->image)}}" alt="profile">
                                            @endif
                                        </div>										    
                                        <div class="settings-upload-btn">
                                            <label for="file" class="file-upload">Upload New photo</label>												
                                        </div>	
                                        <span>Max file size: 10 MB</span>
                                    </div>                                        									
                                    {{-- <a href="javascript:void(0)" class="profile-img-del"><i class="feather-trash-2"></i></a>										 --}}
                                </div>
                                <div class="profile-form">
                                    <form method="POST" action="{{ route('profile.update') }}" enctype= multipart/form-data>
                                        @csrf
                                        @method('patch')
                                        <input type="file" accept="image/*" name="image" class="hide-input image-upload" id="file" style="visibility: hidden;">
                                        <div class="form-group">
                                            <label class="col-form-label">Your Full Name</label>
                                            <div class="pass-group group-img">
                                                <span class="lock-icon"><i class="feather-user"></i></span>
                                                <input type="text" class="form-control" value="{{ $user->name }}" name="name" required>													
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Phone Number</label>
                                                    <div class="pass-group group-img">
                                                        <span class="lock-icon"><i class="feather-phone-call"></i></span>
                                                        <input type="tel" class="form-control" value="{{ $user->phone }}" name="phone" required>													
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Email Address</label>
                                                    <div class="group-img">
                                                        <i class="feather-mail"></i>
                                                        <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                                                    </div>
                                                    @if (!$user->hasVerifiedEmail())
                                                        <div>
                                                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                                                {{ __('Your email address is unverified.') }}

                                                                <button form="send-verification" class="email-listing">
                                                                    {{ __('Click here to re-send the verification email.') }}
                                                                </button>
                                                            </p>

                                                            @if (session('status') === 'verification-link-sent')
                                                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>											
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Address</label>
                                            <div class="pass-group group-img">
                                                <textarea name="address" class="form-control">{{ ($user->address)??'' }}</textarea>												
                                            </div>
                                        </div>
                                        <div class="row socialmedia-info">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Country</label>
                                                    <div class="pass-group group-img">
                                                        <span class="lock-icon"><i class="feather-map-pin"></i></span>
                                                        <input type="text" class="form-control" value="{{ ($user->country)??'' }}" name="country">													
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">State</label>
                                                    <div class="pass-group group-img">
                                                        <span class="lock-icon"><i class="feather-map-pin"></i></span>
                                                        <input type="text" class="form-control" value="{{ ($user->state)??'' }}" name="state">													
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">City</label>
                                                    <div class="pass-group group-img">
                                                        <span class="lock-icon"><i class="feather-map-pin"></i></span>
                                                        <input type="text" class="form-control" value="{{ ($user->city)??'' }}" name="city">													
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="col-form-label">Notes</label>
                                            <div class="pass-group group-img">
                                                <textarea rows="4" class="form-control">Mauris vestibulum lorem a condimentum vulputate. Integer vitae turpis turpis. Cras at tincidunt urna. Aenean leo justo, congue et felis a, elementum rutrum felis. Fusce rutrum ipsum eu pretium faucibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean leo justo, congue et felis a.  Aenean leo justo, congue et felis a.	</textarea>												
                                            </div>
                                        </div>
                                        <div class="row socialmedia-info">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Facebook</label>
                                                    <div class="pass-group group-img">
                                                        <span class="lock-icon"><i class="fab fa-facebook-f"></i></span>
                                                        <input type="text" class="form-control" value="https://www.facebook.com/">												
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Twitter</label>
                                                    <div class="pass-group group-img">
                                                        <span class="lock-icon"><i class="fab fa-twitter"></i></span>
                                                        <input type="text" class="form-control" value="https://twitter.com/">												
                                                    </div>
                                                </div>
                                            </div>											
                                        </div>
                                        <div class="row socialmedia-info">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group formlast-input">
                                                    <label class="col-form-label">Google+</label>
                                                    <div class="pass-group group-img">
                                                        <span class="lock-icon"><i class="fa-brands fa-google-plus-g"></i></span>
                                                        <input type="text" class="form-control" value="https://www.google.com/">												
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group formlast-input">
                                                    <label class="col-form-label">Instagram</label>
                                                    <div class="pass-group group-img">
                                                        <span class="lock-icon"><i class="fab fa-instagram"></i></span>
                                                        <input type="text" class="form-control" value="https://www.instagram.com/">												
                                                    </div>
                                                </div>
                                            </div>											
                                        </div>										  --}}
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                                
                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                </form>

                            </div>								
                        </div>	
                    </div>
                    <div class="col-lg-3">
                        <div class="profile-sidebar">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Change Password</h4>
                                </div>	
                                <div class="card-body">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')
                                        <div class="form-group">
                                            <label class="col-form-label">Current Password</label>
                                            <div class="pass-group group-img">
                                                <span class="lock-icon"><i class="feather-lock"></i></span>
                                                <input type="password" class="form-control pass-input" placeholder="Password" name="current_password" required>													
                                            </div>
                                            @error('current_password')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">New Password</label>
                                            <div class="pass-group group-img">
                                                <span class="lock-icon"><i class="feather-lock"></i></span>
                                                <input type="password" class="form-control pass-input" name="new_password" required>
                                                <span class="toggle-password feather-eye-off"></span>
                                            </div>
                                            @error('new_password')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Confirm New Password</label>
                                            <div class="pass-group group-img">
                                                <span class="lock-icon"><i class="feather-lock"></i></span>
                                                <input type="password" class="form-control pass-input" name="new_password_confirmation" required>
                                                <span class="toggle-password feather-eye-off"></span>
                                            </div>
                                        </div>	
                                        <input type="hidden" name="name" value="{{($user->name)??''}}" />
                                        <input type="hidden" name="phone" value="{{($user->phone)??''}}" />
                                        <button class="btn btn-primary" type="submit"> Change Password</button>											
                                </form>								
                                </div>  									
                            </div>							
                        </div>
                    </div>							
                </div>				
            </div>
        </div>		
    </div>		
    <!-- /Profile Content -->
@endsection

@section('customScripts')
@endsection