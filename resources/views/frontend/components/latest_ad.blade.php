@php
    $products = getProducts(0, ($meta['category_type'])??[], $meta['limit'], 1);
@endphp

<!-- Latest Ads Section -->
    <section class="latestad-section grid-view featured-slider p-2">
        <div class="container">
            <div class="section-heading">
                <div class="row align-items-center">
                    <div class="col-md-6 aos aos-init aos-animate" data-aos="fade-up">
                        @if(isset($meta['heading']))<h2>{{ ($meta['heading'])??'' }}</h2>@endif
                        @if(isset($meta['sub_heading']))<p>{{ ($meta['sub_heading'])??'' }}</p>@endif
                        </div>
                        <div class="col-md-6 text-md-end aos aos-init aos-animate" data-aos="fade-up">
                            <a href="{{ url(($meta['btn_link'])??'#') }}" class="btn btn-view">{{ ($meta['btn_txt'])??'' }}</a>
                        </div>
                    </div>
                </div>
                <div class="lateestads-content">
                <div class="row">
                    @if(isset($products))
                        @foreach($products as $k => $product)
                            
                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
                                <div class="card aos flex-fill" data-aos="fade-up">
                                    <div class="blog-widget">
                                        <div class="blog-img">
                                            <a href="{{ productDetailUrl($product) }}">
                                                <img
                                                    src="{{ asset($product->image) }}"
                                                    class="img-fluid"
                                                    alt="{{ ($product->title)??env('APP_NAME') }}"
                                                />
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
    </section>
<!-- /Latest Ads Section -->