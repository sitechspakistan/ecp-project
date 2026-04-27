@php
    $products = getFeaturedProducts(1, ($meta['category_type'])??[], NULL, 1);
@endphp

@if(isset($products) && $products->count() > 0)
<!-- Featured ADS Section -->
    <section class="featured-section">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-6 aos aos-init aos-animate" data-aos="fade-up">
            <div class="section-heading">
            @if(isset($meta['heading']))<h2>{{ ($meta['heading'])??'' }}</h2>@endif
            @if(isset($meta['sub_heading']))<p>{{ ($meta['sub_heading'])??'' }}</p>@endif
            </div>
        </div>
        <div class="col-md-6 text-md-end aos" data-aos="fade-up">
            <div class="owl-nav mynav0"></div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel featured-slider grid-view">
                    @if(isset($products))
                        @foreach($products as $k => $product)
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
                                        @if(isset($product->location_id))
                                            <div class="blogfeaturelink">
                                                <div class="blog-features">
                                                <a href="javascript:void(0)"
                                                    ><span>
                                                    <i class="fa-regular fa-circle-stop"></i>{{ $product->location->name }}</span
                                                    ></a
                                                >
                                                </div>
                                            </div>
                                        @endif
                                        <h6>
                                            <a href="{{ productDetailUrl($product) }}"
                                            >{{ productTitleWithCategory($product) }}</a
                                            >
                                        </h6>
                                        <div class="blog-location-details">
                                            <div class="location-info">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            {{ Carbon\Carbon::parse($product->product_listing)->format('m/d/Y') }}
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
                    @endif
                </div>
            </div>
        </div>
    </div>
    </section>
<!-- /Featured ADS Section -->
 @endif