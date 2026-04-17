@php
    $products = getProducts(0, ($meta['category_type'])??[]);
@endphp

<!-- product section  -->
<section class="featured-section">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-6 aos aos-init aos-animate" data-aos="fade-up">
            <div class="section-heading">
                @if(isset($meta['heading']))<h2>{{ ($meta['heading'])??'' }}</h2>@endif
            </div>
        </div>
        <div class="col-md-6 text-md-end aos" data-aos="fade-up">
            <div class="owl-nav mynav2"></div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel pet-slider grid-view">
                    @if(isset($products))
                        @foreach($products as $k => $product)
                            <div class="card aos" data-aos="fade-up">
                                <div class="blog-widget">
                                    <div class="blog-img">
                                        <a
                                        href="{{ productDetailUrl($product) }}"
                                        >
                                        <img
                                            src="{{ asset($product->image) }}"
                                            class="img-fluid"
                                            alt="{{ ($product->title)??env('APP_NAME') }}"
                                        />
                                        </a>
                                        
                                    </div>
                                    <div class="bloglist-content">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <h6>
                                                    <a
                                                        href="{{ productDetailUrl($product) }}" title="{{ productTitleWithCategory($product) }}"
                                                        >{{ productTitleWithCategory($product) }}</a
                                                    >
                                                    </h6>
                                            </div>
                                            <div class="amount-details">
                                                <div class="amount w-100 text-end">
                                                <span>${{ number_format($product->sell_price, 2) }}</span>
                                                </div>
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
<!-- product section  -->