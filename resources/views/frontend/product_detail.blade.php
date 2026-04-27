@extends('layouts.frontend')
@section('title',(!empty($data->meta_title))?$data->meta_title:$data['title'].' | East Coast Puppies')
@section('seo')
    @include('frontend.seo', [ 'description'=>$data->meta_description??'', 'schema'=>$data['schema_code']??'', 'seo'=>$data['seo_meta']??[] ])
@endsection
@section('customStyles')
    <style>
        .callnow a{padding: 14px 24px;}
        .bubble-container ul {
            list-style: none;
            padding: 0;
        }

        .bubble-container li {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background: #f0f0f0;
            border-radius: 20px;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }

        .bubble-container li:hover {
            background: #4caf50;
            color: white;
            transform: scale(1.1);
        }

        .bubble-container {
            margin-top: 20px;
        }

        .bubble {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            background: #2196f3;
            color: white;
            border-radius: 50%;
            font-size: 14px;
            text-align: center;
        }
    </style>
@endsection
@section('content')

    <!--Galler Slider Section-->
        <section>
            <div class="breadcrumb-bar">
                <div class="container">
                    <div class="row align-items-center text-center">
                        <div class="col-md-12 col-12">
                            <h2 class="breadcrumb-title">{{ $data->title }}</h2>
                            <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{url('products')}}">Product</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
                            </ol>
                            </nav>							
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--/Galler Slider Section-->

    <!--Details Description  Section-->
      <section>
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-1 p-0 thumbnail-container side-images">
                            <img src="{{ asset(($data->image)??'#') }}" alt="{{($data->title)??''}}" class="thumbnail">
                            @if(isset($data->gallery))
                                @if(gettype($data->gallery) === 'array')
                                    @foreach($data->gallery as $k => $gallery)
                                        <img src="{{asset($gallery)}}" alt="{{($data->title)??''}}" class="thumbnail">
                                    @endforeach
                                @else
                                    @foreach(explode(',', $data->gallery) as $k => $gallery)
                                        <img src="{{asset($gallery)}}" alt="{{($data->title)??''}}" class="thumbnail">
                                    @endforeach
                                @endif
                                
                            @endif
                        </div>
                        <div class="col-md-11">
                            <div class="detail-main-image">
                                <img id="mainImage" src="{{ asset(($data->image)??'#') }}" class="main-image" alt="{{($data->title)??''}}">
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($data->user_id))
                        <div class="row">
                            <div class="card mt-4">
                                <div class="row">
                                    <div class="col-md-12"><h5>About the Owner dog</h5></div>
                                    <div class="col-md-3">
                                        @if(isset($data->user->image))
                                        <img src="{{ url($data->user->image) }}" alt="{{$data->user->name}}">
                                        @else
                                        <img src="{{ asset('assets_frontend/img/profile-img.jpg') }}" alt="{{$data->user->name}}">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <h6>{{ $data->user->name}}</h6>
                                        <p><strong>Phone No: </strong><small>{{$data->user->phone}}</small></p>
                                        <p><strong>Email: </strong><small>{{$data->user->email}}</small></p>
                                        <p><strong>Member Since: </strong><small>{{ Carbon\Carbon::parse($data->user->created_at)->format('m/d/Y') }}</small></p>
                                        <p><strong>Location: </strong> <small class="text-info">{{$data->user->city}}, {{$data->user->state}}, {{$data->user->country}}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- About the Owner
dog
ashley garner
Phone No: 9736527758 Email Address: agarner923@Juno.com Member Since: Jan 2013 Location: Paterson , New Jersey , United States -->

                    {{-- @if(Auth::check())
                      @if(Auth::user()->membership_id !== 4 && Carbon\Carbon::parse(Auth::user()->expiry_date)->format('Y-m-d') >= Carbon\Carbon::now()->format('Y-m-d'))
                        <div class="row">
                          <div class="card mt-4">
                            <div class="row">
                              <div class="col-md-12"><h5>About the Owner dog</h5></div>
                              <div class="col-md-3">
                                @if(isset(Auth::user()->image))
                                  <img src="{{ url(Auth::user()->image) }}" alt="{{Auth::user()->name}}">
                                @else
                                  <img src="{{ asset('assets_frontend/img/profile-img.jpg') }}" alt="{{Auth::user()->name}}">
                                @endif
                              </div>
                              <div class="col-md-8">
                                <h6>{{Auth::user()->name}}</h6>
                                <p><strong>Phone No: </strong><small>{{Auth::user()->name}}</small></p>
                                <p><strong>Email: </strong><small>{{Auth::user()->email}}</small></p>
                                <p><strong>Member Since: </strong><small>{{ Carbon\Carbon::parse(Auth::user()->created_at)->format('m/d/Y') }}</small></p>
                                <p><strong>Location: </strong> <small class="text-info">{{Auth::user()->city}}, {{Auth::user()->state}}, {{Auth::user()->country}}</small></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif
                    @endif --}}
                </div>              
            </div>
            <div class="col-lg-6">
              <div class="about-details">
                <div class="about-headings">
                  
                  <div class="authordetails">
                    @if(isset($data->title))<h1>{{ $data->title }}</h1>@endif
                    @if(isset($data->category_id))<p>Breed: {{ $data->category->title }}</p>@endif
                    <div class="rating">
                        @for($x=1; $x <= 5; $x++)
                            @if($x <= Round(showReviews($data->id),0))
                                <i class="fas fa-star filled"></i>
                            @else
                                <i class="fa-regular fa-star rating-color"></i>
                            @endif
                        @endfor
                        <span class="d-inline-block average-rating"> {{ Round(showReviews($data->id), 0) }} </span>
                    </div>
                  </div>
                </div>
                <div class="price-detail m-2">
                  <h3>${{ number_format($data->sell_price, 2) }}</h3>
                  <ul>
                    @if(Auth::check())
                        @if(isset($data->cost_price) && $data->cost_price > 0 && $data->created_by !== auth()->user()->id)
                            <li class="nav-item mb-1">
                                <a href="javascript:void(0)" class="btn btn-offer" data-bs-toggle="modal" data-bs-target="#makeOfferModal">
                                    Make an Offer 
                                </a>
                            </li>
                        @endif
                    @else
                        @if(isset($data->cost_price) && $data->cost_price > 0)
                            <li class="nav-item mb-1">
                                <a href="javascript:void(0)" class="btn btn-offer" data-bs-toggle="modal" data-bs-target="#LoginModal">Make an Offer </a>
                            </li>
                        @endif
                    @endif
                  </ul>
                  <!-- <p>Fixed</p> -->
                </div>
              </div>
              <!-- ########### -->
                <table class="table table-bordered detail-table">
                    <tbody>
                        @if(isset($data->category_id))
                        <tr>
                        <td><strong>Breed:</strong></td>
                        <td class="text-success">{{ $data->category->title }}</td>
                        </tr>
                        @endif
                        @if(isset($data->gender))
                        <tr>
                        <td><strong>Gender:</strong></td>
                        <td>{{ $data->gender }}</td>
                        </tr>
                        @endif
                        @if(isset($data->title))
                            <tr>
                            <td><strong>NickName:</strong></td>
                            <td>{{$data->title}}</td>
                            </tr>
                        @endif
                        @if(isset($data->age))
                            <tr>
                            <td><strong>Age:</strong></td>
                            <td>{{Carbon\Carbon::parse($data->age)->format('m/d/Y')}}</td>
                            </tr>
                        @endif
                        @if(isset($data->color_markings))
                            <tr>
                            <td><strong>Color/Marketing:</strong></td>
                            <td>{{$data->color_markings}}</td>
                            </tr>
                        @endif
                        @if(isset($data->potential))
                            <tr>
                            <td><strong>Potential:</strong></td>
                            <td>{{$data->potential}}</td>
                            </tr>
                        @endif
                        @if(isset($data->champion_bloodlines))
                            <tr>
                            <td><strong>Champion Bloodlines:</strong></td>
                            <td>{{$data->champion_bloodlines}}</td>
                            </tr>
                        @endif
                        @if(isset($data->champion_bloodlines))
                            <tr>
                            <td><strong>Champion Sired:</strong></td>
                            <td>{{$data->champion_sired}}</td>
                            </tr>
                        @endif
                        @if(isset($data->product_listing))
                            <tr>
                            <td><strong>Availability Date:</strong></td>
                            <td>{{Carbon\Carbon::parse($data->product_listing)->format('m/d/Y')}}</td>
                            </tr>
                        @endif
                        @if(isset($data->photo_date))
                            <tr>
                            <td><strong>Date Photographed:</strong></td>
                            <td>{{Carbon\Carbon::parse($data->photo_date)->format('m/d/Y')}}</td>
                            </tr>
                        @endif
                        @if(isset($data->location_id))
                            <tr>
                            <td><strong>Location:</strong></td>
                            <td>{{$data->location->name}}</td>
                            </tr>
                        @endif
                        @if(isset($data->size))
                            <tr>
                            <td><strong>Available Size:</strong></td>
                            <td>{{$data->size}}</td>
                            </tr>
                        @endif
                        @if(isset($data->avaiable_color))
                            <tr>
                            <td><strong>Available Color:</strong></td>
                            <td>{{$data->avaiable_color}}</td>
                            </tr>
                        @endif
                        @if(isset($data->vaccinations))
                            <tr>
                            <td><strong>Vaccinations &amp; Deworming:</strong></td>
                            <td>{{ productYesNoLabel($data->vaccinations) }}</td>
                            </tr>
                        @endif
                        @if(isset($data->health_warranty))
                            <tr>
                            <td><strong>Health Warranty:</strong></td>
                            <td>{{ ($data->health_warranty*1 === 0)?'No':'Yes' }}</td>
                            </tr>
                        @endif
                        @if(isset($data->health_certificate))
                            <tr>
                            <td><strong>Health Certificate:</strong></td>
                            <td>{{ productYesNoLabel($data->health_certificate) }}</td>
                            </tr>
                        @endif
                        @if(isset($data->health_record))
                            <tr>
                            <td><strong>Health Record:</strong></td>
                            <td>{{ productYesNoLabel($data->health_record) }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @if(isset($data->description) && !empty($data->description))
                <div class="m-2 mt-4">
                  <h5 class="mb-3">Description</h5>
                  <div class="product-description">
                    {!! $data->description !!}
                  </div>
                </div>
                @endif
                <div class="m-2">
                  <ul class="d-flex justify-content-start" style="gap: 10px;">
                    @if(Auth::check() && $data->created_by !== auth()->user()->id)
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="btn btn-offer" data-bs-toggle="modal" data-bs-target="#askQuestionModal">
                                Ask Question
                            </a>
                        </li>
                        @if(getProductOrder($data->id) > 0)
                          <li class="nav-item">
                              <a class="btn btn-offer" href="javascript:void(0)">
                                  <i class="feather-shopping-bag"></i> Out of stock
                              </a>
                          </li>
                        @else
                          @if(getCartProduct($data->id) === true)
                            <li class="nav-item">
                                <a class="btn btn-offer" href="javascript:void(0)">
                                    <i class="feather-shopping-bag"></i> Out of stock
                                </a>
                            </li>
                          @else
                            <li class="nav-item">
                                <a class="btn btn-offer addToCart" href="javascript:void(0)" data-id="{{$data->id}}" data-qty="1">
                                    <i class="feather-shopping-bag"></i> Add To Cart
                                </a>
                            </li>
                          @endif
                          
                        @endif
                    @else
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="btn btn-offer" data-bs-toggle="modal" data-bs-target="#LoginModal">Ask Question</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="btn btn-offer" data-bs-toggle="modal" data-bs-target="#LoginModal">Add To Cart</a>
                        </li>
                    @endif

                    @if(Auth::check())
                      @if(isset($data->user->phone) && $data->created_by !== auth()->user()->id)
                          <li class="nav-item">
                              <a href="tel:{{$data->user->phone}}" class="btn btn-offer">Call Now</a>
                          </li>
                      @endif
                    @else
                      @if(isset($data->user->phone))
                      <li class="nav-item">
                              <a href="tel:{{$data->user->phone}}" class="btn btn-offer">Call Now</a>
                          </li>
                      @endif
                    @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!--/Details Description  Section-->

        <!--Details Main  Section-->
        <div class="details-main-wrapper">
            <div class="container">
            <div class="row">
            <div class="col-lg-10 offset-1">
            <!--Ratings Section-->
            <div class="card">
            <div class="card-header align-items-center">
            <i class="feather-star"></i>
            <h4>Ratings</h4>
            </div>
            <div class="card-body">
            <div class="ratings-content">
            <div class="row">
            <div class="col-lg-3">
            <div class="ratings-info">
            <p class="ratings-score"><span>{{ Round(showReviews($data->id),0) }}</span>/5</p>
            <p>OVERALL</p>
            <p>
                @for($x=1; $x<=5; $x++)
                    @if($x <= Round(showReviews($data->id),0))
                        <i class="fas fa-star filled"></i>
                    @else
                        <i class="fa-regular fa-star"></i>
                    @endif
                @endfor
            </p>
            <p>Based on Listing</p>
            </div>
            </div>
            <div class="col-lg-9">
            <div class="ratings-table table-responsive">
            <table class="">
                <tr>
                    <td class="star-ratings">
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    </td>
                    <td class="scrore-width @if(getRating($data->id, 5) >= 1) selected @endif"><span> </span></td>
                    <td>{{ getRating($data->id, 5) }}</td>
                </tr>
                <tr>
                    <td class="star-ratings">
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    </td>

                    <td class="scrore-width @if(getRating($data->id, 4) >= 1) selected @endif">
                    <span> </span>
                    </td>
                    <td>{{ getRating($data->id, 4) }}</td>
                </tr>
                <tr>
                    <td class="star-ratings">
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    </td>
                    <td class="scrore-width @if(getRating($data->id, 3) >= 1) selected @endif"><span> </span></td>
                    <td>{{ getRating($data->id, 3) }}</td>
                </tr>
                <tr>
                    <td class="star-ratings">
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    </td>

                    <td class="scrore-width @if(getRating($data->id, 2) >= 1) selected @endif"><span> </span></td>
                    <td>{{ getRating($data->id, 2) }}</td>
                </tr>
                <tr>
                    <td class="star-ratings">
                    <i class="fas fa-star filled"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    <i class="fa-regular fa-star rating-color"></i>
                    </td>
                    <td class="scrore-width @if(getRating($data->id, 1) >= 1) selected @endif"><span> </span></td>
                    <td>{{ getRating($data->id, 1) }}</td>
                </tr>
            </table>
            </div>
            </div>
            </div>
            </div>
            </div>
        </div>
        <!--/Ratings Section-->

            <!--Review  Section-->
            <div class="card review-sec mb-0" id="reviews">
                <div class="card-header align-items-center">
                    <i class="fa-regular fa-comment-dots"></i>
                    <h4>Write a Review</h4>
                </div>
                <div class="card-body">
                    <div class="review-list">
                        <ul class="">
                            @if(isset($data->reviews))
                                @foreach($data->reviews as $k => $review)
                                    <li class="review-box">
                                        <div class="review-profile">
                                            <div class="review-img">
                                            <img
                                                src="{{asset('assets_frontend')}}/uploads/detail-img/users.png"
                                                class="img-fluid"
                                                alt="img"
                                            />
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
                                                <i class="fa-sharp fa-solid fa-calendar-days"></i>
                                                {{ Carbon\Carbon::parse($review->created_at)->format('m/d/Y'); }}
                                            </div>
                                            </div>
                                            <br><br>
                                            @if(isset($review->review))
                                                <p>
                                                {!! ($review->review)??'' !!}
                                                </p>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            @endif

                            <li class="review-box feedbackbox mb-0">
                                <div class="review-details">
                                <h6>Leave feedback about this</h6>
                                </div>
                                <div class="card-body">
                                    <form class="" action="{{ route('productReview.store', $data->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $data->id }}" />
                                        <div class="namefield">
                                            @if(Auth::check())
                                                <div class="form-group">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Name*"
                                                    name="name"
                                                    required
                                                    value="{{ Auth()->user()->name }}"
                                                    readonly
                                                />
                                                </div>
                                                <div class="form-group me-0">
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    placeholder="Email*"
                                                    name="email"
                                                    required
                                                    value="{{ Auth()->user()->email }}"
                                                    readonly
                                                />
                                                </div>
                                            @else
                                            <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Name*"
                                                name="name"
                                                required
                                            />
                                            </div>
                                            <div class="form-group me-0">
                                            <input
                                                type="email"
                                                class="form-control"
                                                placeholder="Email*"
                                                name="email"
                                                required
                                            />
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <textarea
                                            rows="4"
                                            class="form-control"
                                            placeholder="Write a Review*"
                                            name="review"
                                            required
                                            ></textarea>
                                        </div>
                                        <div class="reviewbox-rating d-flex align-items-center">
                                            <p>
                                                Rating: 
                                            </p>
                                                <fieldset class="rating">
                                                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                    <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                    <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                </fieldset>
                                        </div>
                                        <div class="submit-section">
                                            <button
                                            class="btn btn-primary submit-btn"
                                            type="submit"
                                            >
                                            Submit Review
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/Review Section-->
        </div>
        </div>
        </div>
        </div>
    <!-- /Details Main Section -->

    @php
        $featuredProducts = getFeaturedProducts(1, [], null, 1)->where('id', '!=', $data->id);
    @endphp
    @if($featuredProducts->count() > 0)
    <section class="featured-section">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 aos aos-init aos-animate" data-aos="fade-up">
              <div class="section-heading">
                <h2>Featured Ads</h2>
                <p>Checkout these latest featureds products</p>
              </div>
            </div>
            <div class="col-md-6 text-md-end aos" data-aos="fade-up">
              <div class="owl-nav mynav0"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="owl-carousel featured-slider grid-view">
                @foreach($featuredProducts as $product)
                <div class="card aos" data-aos="fade-up">
                  <div class="blog-widget">
                    <div class="blog-img">
                      <a href="{{ productDetailUrl($product) }}">
                        <img
                          src="{{ asset($product->image) }}"
                          class="img-fluid"
                          alt="{{ ($product->title)??env('APP_NAME') }}"
                        />
                      </a>
                      <div class="fav-item">
                        @if($product->is_featured === 1)<span class="Featured-text">Featured</span>@endif
                        <a href="javascript:void(0)" class="fav-icon">
                          <i class="feather-heart"></i>
                        </a>
                      </div>
                    </div>
                    <div class="bloglist-content">
                      <div class="card-body">
                        @if(isset($product->location_id) && isset($product->location))
                        <div class="blogfeaturelink">
                          <div class="blog-features">
                            <a href="javascript:void(0)">
                              <span>
                                <i class="fa-regular fa-circle-stop"></i>{{ $product->location->name }}
                              </span>
                            </a>
                          </div>
                        </div>
                        @endif
                        <h6>
                          <a href="{{ productDetailUrl($product) }}">{{ productTitleWithCategory($product) }}</a>
                        </h6>
                        <div class="blog-location-details">
                          <div class="location-info">
                            <i class="fa-regular fa-calendar-days"></i> {{ Carbon\Carbon::parse($product->product_listing)->format('m/d/Y') }}
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
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </section>
    @endif

    @if(isset($data->cost_price) && $data->cost_price > 0)
      <div style="z-index: 10000;" class="modal fade" id="makeOfferModal" tabindex="-1" aria-labelledby="makeOfferLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="makeOfferLabel">Make An Offer</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="col-md-12 col-lg-12 mx-auto">
                          <div class="login-wrap" style="border: none; box-shadow: none;">
                          <!-- Login Form -->
                          <form action="{{ route('make_offer') }}" method="POST">
                              @csrf
                              <input type="hidden" name="product_id" value="{{$data->id}}" />
                              <input type="hidden" name="product_user_id" value="{{$data->user_id}}" />
                              <div class="form-group">
                                  <label class="col-form-label">Offer <span>*</span></label>
                                  <input type="number" name="offer" class="form-control pass-input @error('message') is-invalid @enderror" required  placeholder="Your Offer" max="{{ (($data->sell_price)??0) - 1 }}" min="{{ (($data->cost_price)??0) + 1 }}" onchange="validateOfferInput(this)" />
                                  @error('offer')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror

                                  @php
                                    
                                    
                                    if($data->cost_price+1 < $data->sell_price-1){
                                        $randomNumbers = [
                                          random_int($data->cost_price+1, $data->sell_price-1),
                                          random_int($data->cost_price+1, $data->sell_price-1),
                                          random_int($data->cost_price+1, $data->sell_price-1)
                                      ];
                                    }else{
                                        $randomNumbers = [
                                          random_int($data->sell_price-1, $data->cost_price+1),
                                          random_int($data->sell_price-1, $data->cost_price+1),
                                          random_int($data->sell_price-1, $data->cost_price+1)
                                      ];
                                    }

                                      $randomNumbers = array_unique($randomNumbers);
                                  @endphp

                                  <div class="bubble-container" id="bubbleContainer">
                                      <ul id="list">
                                          @foreach ($randomNumbers as $randomNumber)
                                              <li data-value="{{ $randomNumber }}" onclick="setPrice(event)">{{ $randomNumber }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              </div>
                              {{-- <a class=""></a>	 --}}
                              <button class="btn modal-signin" type="submit">Save</button>							
                          </form>
                          <!-- /Login Form -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    @endif

<!-- Ask Question -->
<div style="z-index: 10000;" class="modal fade" id="askQuestionModal" tabindex="-1" aria-labelledby="askQuestionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="askQuestionLabel">Ask Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 col-lg-12 mx-auto">
            <div class="login-wrap p-0" style="border: none; box-shadow: none;">
                <!-- Login Form -->
                    <form action="{{ route('ask_question') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$data->id}}" />
                        <input type="hidden" name="product_user_id" value="{{$data->user_id}}" />
                        <div class="form-group">
                            <label class="col-form-label">Question <span>*</span></label>
                            <textarea name="message" rows="6" class="form-control listingdescription" placeholder="Write Your Question" required></textarea>												
                        </div>
                        <button class="btn modal-signin" type="submit">Save</button>							
                    </form>
                <!-- /Login Form -->
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Ask Question -->

@endsection

@section('customScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        $(document).on('click','.addToCart',function(){
            $this = $(this); 
            var btntext = $this.html(); $this.text("Adding..");
            $this.removeClass('addToCart');
            var qty = $(this).attr('data-qty');
            if(qty==0){
                toastr["error"]("Quantity can't be zero");
                $this.html(btntext);
                return false;
            }
            var data = {'_token':"{{csrf_token()}}",'product_id':$(this).data('id'),'qty':qty};
            $.ajax({
                url:'{{route("addToCart")}}',
                type: 'post',
                data: data,
                success: function(data){
                    if(data.status=="added") {
                        location.href = "{{route('cartPage')}}";
                    }else if(data.status=="quantity_error"){
                      location.href = "{{route('cartPage')}}";
                    }else if(data.status=="error"){
                        toastr["error"](data.msg);
                    }

                    if(data.status=="quantity_error"){
                      $this.html('Out of stock');
                      $this.removeClass('addToCart');
                    }else{
                      $this.html(btntext);
                      $this.addClass('addToCart');
                    }   
                }
            })
        })

        function validateOfferInput(input) {
            const min = parseFloat(input.min); // Get the min value from the input
            const max = parseFloat(input.max); // Get the max value from the input
            const value = parseFloat(input.value); // Get the current value of the input

            if (value < min) {
              input.value = min; // Set to min if the value is below the min
            } else if (value > max) {
              input.value = max; // Set to max if the value is above the max
            }
        }

        function setPrice(e){
            var value = $(e.target).data('value');
            $('[name="offer"]').val(value);
        }

        document.querySelectorAll('.thumbnail').forEach(function(thumbnail) {
            thumbnail.addEventListener('click', function() {
                const mainImage = document.getElementById('mainImage');
                mainImage.src = this.src;
            });
        });
    </script>
@endsection