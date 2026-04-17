<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="cta-content">
                    <h3>
                        @if(isset($meta['heading']))
                            {{ ($meta['heading'])??'' }} <br />
                        @endif

                        @if(isset($meta['sub_heading']))
                            {{ ($meta['sub_heading'])??'' }}
                        @endif

                    </h3>
                    @if(isset($meta['desc']))
                        <p>{{ ($meta['desc'])??'' }}</p>
                    @endif
                    <div class="cta-btn">
                        @if(isset($meta['btn1_txt']))
                            <a href="{{ ($meta['btn1_link'])??'#' }}" class="btn-primary postad-btn">{{ ($meta['btn1_txt'])??'' }}</a>
                        @endif

                        @if(isset($meta['btn2_txt']))
                            <a href="{{ ($meta['btn2_link'])??'#' }}" class="browse-btn">{{ ($meta['btn2_txt'])??'' }}</a>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="cta-img">
                    <img src="{{ asset(($meta['img'])??'') }}" class="img-fluid" alt="{{ env('APP_NAME') }}" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /CTA Section -->