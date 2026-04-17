@extends('layouts.frontend')
@section('title', 'Bookmark | East Coast Puppies')

@section('customStyles')
@endsection

@section('content')
    <!-- Breadscrumb Section -->
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Bookmarks</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bookmarks</li>
                            </ol>
                        </nav>							
                    </div>
                </div>
            </div>
        </div>
    <!-- /Breadscrumb Section -->

    <!-- Bookmark Content -->
    <div class="dashboard-content">		
        <div class="container">
            @include('frontend.includes.dashboard_menu')
            <div class="bookmarks-content grid-view featured-slider">
                <div class="row">
                    @foreach($bookmarks as $k => $bookmark)
                        @php
                            $product = $bookmark->product;
                        @endphp

                        <div class="col-lg-4 col-md-4 col-sm-6 ">
                            <div class="card aos aos-init aos-animate" data-aos="fade-up">
                                <div class="blog-widget">
                                    <div class="blog-img">
                                        <a href="{{ productDetailUrl($product) }}">
                                            <img src="{{ asset($product->image) }}" class="img-fluid" alt="{{ ($product->title)??env('APP_NAME') }}">
                                        </a>
                                        <div class="fav-item">
                                            @if(isset($product->is_featured) && $product->is_featured === 1)
                                                <span class="Featured-text">Featured</span>
                                            @endif
                                            @if(Auth::check())
                                                <a href="{{route('product.bookmark', $product->slug)}}" class="fav-icon">
                                                    <i class="fa-solid fa-heart"></i>
                                                </a>
                                            @endif										
                                        </div>	
                                    </div>
                                    <div class="bloglist-content">
                                        <div class="card-body">
                                            <div class="blogfeaturelink">
                                                @if(isset($product->user_id))
                                                    <div class="grid-author">
                                                        <img  src="{{asset('uploads/user_image/'.$product->user->image)}}" alt="{{ $product->user->name }}">	
                                                    </div>
                                                @endif
                                                @if($product->category_id)
                                                    <div class="blog-features">
                                                        <a href="javascript:void(0)"><span> <i class="fa-regular fa-circle-stop"></i> {{ $product->category->title }}</span></a>
                                                    </div>
                                                @endif
                                                																	  
                                                <div class="blog-author text-end"> 
                                                    <span>  <img src="{{asset('assets_frontend')}}/img/eye.svg" alt="electronics"> {{ ($product->views_count)??0 }}  </span>
                                                </div>
                                            </div> 
                                            <h6><a href="{{ productDetailUrl($product) }}">{{ productTitleWithCategory($product) }}</a></h6>																	 
                                            <div class="blog-location-details">
                                                @if($product->location_id)
                                                    <div class="location-info">
                                                        <i class="feather-map-pin"></i> {{ $product->location->name }}
                                                    </div>
                                                @endif
                                                <div class="location-info">
                                                    <i class="fa-solid fa-calendar-days"></i> {{ Carbon\Carbon::parse($product->product_listing)->format('d M, Y') }}
                                                </div>
                                            </div>
                                            <div class="amount-details">
                                                <div class="amount">
                                                    <span>${{ number_format($product->sell_price, 2) }}</span>
                                                </div>
                                                <div class="ratings"><span>{{ showReviews($product->id) }}</span> ({{ count($product->reviews) }})</div>												
                                            </div>	
                                        </div>	
                                    </div>			 
                                </div> 
                            </div>
                        </div>

                    @endforeach

                    
                     <!--Pagination--> 
                        {{$bookmarks->links('pagination.frontend')}}
                    <!--/Pagination-->	
                    
                </div>						
            </div>
        </div>		
    </div>		
    <!-- /Bookmark Content -->
@endsection

@section('customScripts')
@endsection