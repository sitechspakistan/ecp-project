@extends('layouts.frontend')
@section('title', 'Dashboard | East Coast Puppies')
@section('content')
    <!-- Breadscrumb Section -->
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Dashboard</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>							
                    </div>
                </div>
            </div>
        </div>
    <!-- /Breadscrumb Section -->
    
    <!-- Dashboard Content -->
        <div class="dashboard-content">		
            <div class="container">
                @include('frontend.includes.dashboard_menu')
                <div class="dashboard-details">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="card dash-cards">
                                    <div class="card-body">
                                    <div class="dash-top-content">
                                        <div class="dashcard-img">
                                            <img src="{{asset('assets_frontend')}}/img/icons/verified.svg" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Active Listing</h6>
                                        <h3 class="counter">{{ ($activeListing)??0 }}</h3>
                                    </div>
                                </div>									
                            </div>
                        </div>
                            <div class="col-lg-3 col-md-3">
                            <div class="card dash-cards">
                                    <div class="card-body">
                                    <div class="dash-top-content">
                                        <div class="dashcard-img">
                                            <img src="{{asset('assets_frontend')}}/img/icons/rating.svg" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Reviews</h6>
                                        <h3>{{ ($totalReview)??0 }}</h3>
                                    </div>
                                </div>									
                            </div>
                        </div>
                            <div class="col-lg-3 col-md-3">
                            <div class="card dash-cards">
                                    <div class="card-body">
                                    <div class="dash-top-content">
                                        <div class="dashcard-img">
                                            <img src="{{asset('assets_frontend')}}/img/icons/chat.svg" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Messages</h6>
                                        <h3>{{ ($messages)??0 }}</h3>
                                    </div>
                                </div>									
                            </div>
                        </div>
                            <div class="col-lg-3 col-md-3">
                            <div class="card dash-cards">
                                    <div class="card-body">
                                    <div class="dash-top-content">
                                        <div class="dashcard-img">
                                            <img src="{{asset('assets_frontend')}}/img/icons/bookmark.svg" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Bookmark</h6>
                                        <h3>{{ ($bookmark)??0 }}</h3>
                                    </div>
                                </div>									
                            </div>
                        </div>
                    </div>	
                    <div class="row dashboard-info">
                        <div class="col-lg-6 d-flex">
                            <div class="card dash-cards w-100">
                                <div class="card-header">
                                    <h4>Visitor Review</h4>
                                    <div class="card-dropdown">
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
                                    </div>								
                                </div>	
                                <div class="card-body">
                                    <ul class="review-list">
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
                                                        <div><i class="fa-sharp fa-solid fa-calendar-days"></i> {{ Carbon\Carbon::parse($review->created_at)->diffForHumans(); }}</div>
                                                        {{-- <div>by: Demo Test</div> --}}
                                                    </div>		
                                                    @if(isset($review->review))
                                                        <p>
                                                        {!! ($review->review)??'' !!}
                                                        </p>
                                                    @endif																	
                                                </div>
                                            </li>
                                        @endforeach											
                                    </ul>								
                                </div>								
                            </div>							 
                        </div>					
                    </div> 					
                </div>				
            </div>				
        </div>					
    <!-- /Dashboard Content -->
@endsection

@section('customScripts')
@endsection