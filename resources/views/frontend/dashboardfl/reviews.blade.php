@extends('layouts.frontend')
@section('title', 'Reviews | East Coast Puppies')

@section('customStyles')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Breadscrumb Section -->
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Reviews</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                            </ol>
                        </nav>							
                    </div>
                </div>
            </div>
        </div>
    <!-- /Breadscrumb Section -->

    <!-- Reviews Content -->
    <div class="dashboard-content">		
        <div class="container">
            @include('frontend.includes.dashboard_menu')
            <div class="row dashboard-info reviewpage-content">

                <div class="col-lg-6 d-flex">
                    <div class="card dash-cards">
                        <div class="card-header">
                            <h4>Visitor Review</h4>
                            {{-- <div class="card-dropdown">
                                <ul>
                                    <li class="nav-item dropdown has-arrow logged-item">
                                        <a href="#" class="dropdown-toggle pageviews-link" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span>All Listing</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0)">Next Week</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Last Month</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Next Month</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>--}}
                        </div>	
                        <div class="card-body">
                            <ul class="review-list">
                                @if(isset($reviews) && count($reviews) > 0)
                                    @foreach($reviews as $k => $review)
                                        <li class="review-box">
                                            <div class="review-profile">
                                                <div class="review-img">
                                                    <img src="{{asset('assets_frontend')}}/img/profiles/avatar-11.jpg" class="img-fluid" alt="img">
                                                </div>															
                                            </div>
                                            <div class="review-details">
                                                @if(isset($review->name))<h6>{{ $review->name }}</h6>@endif
                                                <div class="rating">
                                                    <div class="rating-star">
                                                        @for ($x=1; $x<=5; $x++)
                                                            @if($x <= Round($review->rating, 0))
                                                                <i class="fas fa-star filled"></i>
                                                            @else
                                                                <i class="fa-regular fa-star rating-overall"></i>
                                                            @endif
                                                        @endfor                                            
                                                    </div>
                                                <div>		
                                                @if(isset($review->review))
                                                    <p>
                                                    {!! ($review->review)??'' !!}
                                                    </p>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="review-box">
                                        <h6>No Reviews Found</h6>
                                    </li>	
                                @endif								
                            </ul>								
                        </div>							
                    </div>						 
                </div>
                
                <div class="col-lg-6 d-flex">
                    <div class="card dash-cards">
                        <div class="card-header">
                            <h4>Your Review</h4>
                            {{-- <div class="card-dropdown">
                                <ul>
                                    <li class="nav-item dropdown has-arrow logged-item">
                                        <a href="#" class="dropdown-toggle pageviews-link" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span>All Listing</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0)">Next Week</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Last Month</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Next Month</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>--}}
                        </div>	
                        <div class="card-body">
                            <ul class="review-list">
                                @if(isset($myreviews) && count($myreviews) > 0)
                                    @foreach($myreviews as $k => $review)
                                        <li class="review-box">
                                            <div class="review-profile">
                                                <div class="review-img">
                                                    <img src="{{asset('assets_frontend')}}/img/profile-img.jpg" class="img-fluid" alt="img">
                                                </div>															
                                            </div>
                                            <div class="review-details">
                                                @if(isset($review->name))<h6>{{ $review->name }}</h6>@endif
                                                <div class="rating">
                                                    <div class="rating-star">
                                                        @for ($x=1; $x<=5; $x++)
                                                            @if($x <= Round($review->rating, 0))
                                                                <i class="fas fa-star filled"></i>
                                                            @else
                                                                <i class="fa-regular fa-star rating-overall"></i>
                                                            @endif
                                                        @endfor                                            
                                                    </div>
                                                <div>																
                                                @if(isset($review->review))
                                                    <p>
                                                        {!! ($review->review)??'' !!}
                                                    </p>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="review-box">
                                        <h6>No Reviews Found</h6>
                                    </li>
                                @endif
                            </ul>								
                        </div>								
                    </div>							 
                </div>	
            </div> 					
        </div>		
    </div>		
    <!-- /Reviews Content -->
@endsection

@section('customScripts')
@endsection