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
            @php
                $activeMemberships = \App\Models\Membership::where('is_active', 1)->orderBy('code')->get();
            @endphp
            @if($activeMemberships->count() > 0)
                @foreach($activeMemberships as $k => $membership)
                    <div class="col-lg-3 d-flex col-md-6">
                        <div class="price-card flex-fill">
                            <div class="price-head">
                                <div class="price-level">
                                    <h6>{{ $membership->title }}</h6>
                                </div>
                                @php
                                    $price = (float) $membership->price;
                                    $formattedPrice = ($price == floor($price)) ? number_format($price, 0) : number_format($price, 2);
                                @endphp
                                <h4>${{ $formattedPrice }}<span>/{{ $membership->duration_type }}</span></h4>
                            </div>
                            <div class="price-body">
                                <p>
                                    {{ $membership->description ?: ($membership->duration_value.' '.$membership->duration_type.' membership for '.ucfirst($membership->user_type).'.') }}
                                </p>

                                <div>
                                <form method="POST" id="MemberShipPurchase{{ $membership->id }}" action="{{ route('purchase_membership') }}">
                                    @csrf
                                    <input type="hidden" name="membership_code" value="{{ $membership->code }}" />
                                </form>
                                <a
                                    class="btn viewdetails-btn sub-button"
                                    data-type="general"
                                    href="javascript:;"
                                    onclick="event.preventDefault(); document.getElementById('MemberShipPurchase{{ $membership->id }}').submit();"
                                    >{{ $membership->btn_txt ?: 'Choose Plan' }}</a
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