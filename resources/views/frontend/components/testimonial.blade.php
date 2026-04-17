@php
    $testimonials = getTestimonials();
@endphp

<!-- Client Testimonilas Section -->
<section class="testimonials-section">
    <div class="row">
        <div class="col-lg-5">
        <div class="testimonial-heading d-flex">
            <h4>
                @if(isset($meta['heading'])){{ ($meta['heading'])??'' }}<br />@endif
                @if(isset($meta['sub_heading'])){{ ($meta['sub_heading'])??'' }}@endif
            </h4>
            <img src="{{asset('assets_frontend')}}/img/quotes.png" alt="quotes" />
        </div>
        </div>
        <div class="col-lg-7">
        <div class="rightimg"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="testimonials-slidersection">
                <div class="owl-nav mynav1"></div>
                <div class="owl-carousel testi-slider">
                    @if(isset($testimonials))
                        @foreach($testimonials as $k => $testimonial)
                            <div class="testimonial-info">
                                <div class="testimonialslider-heading d-flex">
                                <div class="testi-img">
                                    <img
                                    src="{{ asset(($testimonial->image)??'#') }}"
                                    class="img-fluid"
                                    alt="{{ ($testimonial->name)??'' }}"
                                    />
                                </div>
                                <div class="testi-author">
                                    @if(isset($testimonial->name))<h6>{{ ($testimonial->name)??'' }}</h6>@endif
                                    @if(isset($testimonial->designation))<p>{{ ($testimonial->designation)??'' }}</p>@endif
                                </div>
                                </div>
                                <div class="testimonialslider-content">
                                <p>
                                    {!! ($testimonial->testimonial)??'' !!}
                                </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Client Testimonilas Section -->