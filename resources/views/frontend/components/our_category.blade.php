@php
    $category_type = NULL;
    if(isset($meta['category_type'])){
        $category_type = $meta['category_type'];
    }
    $category = GetProductCategory($category_type, ($meta['limit'])??12);
@endphp

<!-- Category Section -->
    <section class="category-section">
    <div class="container">
        <div class="section-heading">
            <div class="row align-items-center">
                <div class="col-md-6 aos aos-init aos-animate" data-aos="fade-up">
                @if(isset($meta['heading']))<h2>{{ ($meta['heading'])??'' }}</h2>@endif
                @if(isset($meta['sub_heading']))<p>{{ ($meta['sub_heading'])??'' }}</p>@endif
                </div>
                @if(isset($meta['heading']))
                    <div
                    class="col-md-6 text-md-end aos aos-init aos-animate"
                    data-aos="fade-up"
                    >
                    <a href="{{ url(($meta['btn_link'])??'#') }}" class="btn btn-view">{{ ($meta['btn_txt'])??'' }}</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            @if(isset($category))
                @foreach($category as $k => $cat)
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <a href="{{ url('products?cat_id='.$cat->id) }}" class="category-links">
                        <h5>{{ ($cat->title)??'' }}</h5>
                        <span>{{ count($cat->products) }} Puppies</span>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    </section>
<!-- /Category Section -->
