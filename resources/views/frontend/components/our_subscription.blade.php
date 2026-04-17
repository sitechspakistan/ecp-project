<!-- Pricing Plan Section -->
<section class="pricingplan-section">
    <div class="section-heading">
        <div class="container">
        <div class="row text-center">
            @if(isset($meta['heading']))<h2>{{ ($meta['heading'])??'' }}</h2>@endif
            @if(isset($meta['sub_heading']))<p>{{ ($meta['sub_heading'])??'' }}</p>@endif
        </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            @if(isset($meta['subs']) && count($meta['subs']) > 0)
                @foreach($meta['subs'] as $k => $subscription)
                    <div class="col-lg-3 d-flex col-md-6">
                        <div class="price-card flex-fill">
                            <div class="price-head">
                                <div class="price-level">
                                    @if(isset($subscription['heading']))<h6>{{ $subscription['heading'] }}</h6>@endif
                                </div>
                                @if(isset($subscription['price']))<h4>${{ ($subscription['price'])??0 }}<span>/{{ ($subscription['type'])??'' }}</span></h4>@endif
                            </div>
                            <div class="price-body">
                                @if(isset($subscription['price']))
                                    <p>
                                        {{ ($subscription['txt'])??'' }}
                                    </p>
                                @endif

                                <div>
                                <form method="POST" id="MemberShipPurchase{{ $k }}" action="{{ route('purchase_membership') }}">
                                    @csrf
                                    <input type="hidden" name="membership_details[title]" value="{{ ($subscription['heading'])??'' }}" />
                                    <input type="hidden" name="membership_details[price]" value="{{ ($subscription['price'])??0 }}" />
                                    <input type="hidden" name="membership_details[type]" value="{{ ($subscription['type'])??'' }}" />
                                    <input type="hidden" name="membership_details[code]" value="{{ $k+1 }}" />
                                </form>
                                <a
                                    class="btn viewdetails-btn sub-button"
                                    data-type="general"
                                    href="javascript:;"
                                    onclick="event.preventDefault(); document.getElementById('MemberShipPurchase{!! $k !!}').submit();"
                                    >{{ ($subscription['btn_txt'])??'' }}</a
                                >
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- /Pricing Plan Section -->