@php
    $cat_id = request('cat_id');
    $sort_by = request('sort_by', 'DESC');
    $sort_column = request('sort_column', 'created_at');
    $page = request('page', 1);
    $no_of_record = ($meta['no_of_record'])??6;
    $price_min = request('price_min');
    $price_max = request('price_max');
    $q = request('q');
    $availability = request('availability', 'all');
    if (!in_array($availability, ['all', 'available', 'unavailable'], true)) {
        $availability = 'all';
    }
    $filterBreeds = GetProductCategory()->whereIn('category_type', [1, 2])->values();
    $products = getProductPage($cat_id, $sort_by, $sort_column, $page, $no_of_record, [
        'price_min' => $price_min,
        'price_max' => $price_max,
        'q' => $q,
        'availability' => $availability,
    ]);
@endphp

<style>
    .fav-item .fav-icon.active {
        background-color: #df965e;
        color: #fff;
    }
</style>

<!-- Main Content Section -->
<div class="list-content">
    <div class="container">
        <div class="row">
            @if(isset($meta['is_searchbar']) && $meta['is_searchbar']*1 === 1)
                <div class="col-lg-4 theiaStickySidebar">
                    <div class="listings-sidebar">
                        <div class="card">
                            <h4><img  src="{{asset('assets_frontend')}}/img/details-icon.svg" alt="details-icon"> Filter</h4>
                            <form method="get" action="{{ request()->url() }}" class="product-listing-filters" id="productListingFilterForm">
                                <input type="hidden" name="sort_by" value="{{ $sort_by }}">
                                <input type="hidden" name="sort_column" value="{{ $sort_column }}">
                                <div class="filter-content form-group">
                                    <h4 class="mb-2">Search</h4>
                                    <input type="text" name="q" class="form-control mb-3" placeholder="Search puppies..." value="{{ $q }}">
                                </div>
                                <div class="filter-content form-group">
                                    <h4 class="mb-2">Breed</h4>
                                    <select name="cat_id" class="form-control mb-3" onchange="document.getElementById('productListingFilterForm').submit();">
                                        <option value="">All breeds</option>
                                        @foreach($filterBreeds as $category)
                                            <option value="{{ $category->id }}" @selected((string) $cat_id === (string) $category->id)>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="filter-content form-group">
                                    <h4 class="mb-2">Price ($)</h4>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input type="number" name="price_min" class="form-control" placeholder="Min" min="0" step="0.01" value="{{ $price_min }}">
                                        </div>
                                        <div class="col-6">
                                            <input type="number" name="price_max" class="form-control" placeholder="Max" min="0" step="0.01" value="{{ $price_max }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-content form-group mb-3">
                                    <h4 class="mb-2">Availability</h4>
                                    <select name="availability" class="form-control">
                                        <option value="all" @selected($availability === 'all')>All</option>
                                        <option value="available" @selected($availability === 'available')>Available</option>
                                        <option value="unavailable" @selected($availability === 'unavailable')>Sold / Unavailable</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                                    <a href="{{ request()->url() }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-8">
                <div class="row sorting-div">
                    <div class="col-lg-4 col-md-4 col-sm-4 align-items-center d-flex">
                        <div class="count-search">
                            @if ($products->total() > 0)
                                Showing <span>{{ $products->firstItem() }} to {{ $products->lastItem() }}</span> of {{ $products->total() }} Results.
                            @else
                                No products found.
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8  align-items-center">
                        <div class="sortbyset">
                            <span class="sortbytitle">Sort by</span>
                            <div class="sorting-select">
                                <select class="form-control select sortselect product-listing-sort" onchange="applyProductListSort()">
                                    <option value="ASC" data-column="created_at" @if($sort_column === 'created_at') selected @endif>Default</option>
                                    <option value="ASC" data-column="sell_price" @if($sort_by === 'ASC' && $sort_column === 'sell_price') selected @endif>Price Low to High</option>
                                    <option value="DESC" data-column="sell_price" @if($sort_by === 'DESC' && $sort_column === 'sell_price') selected @endif>Price High to Low</option>
                                    <option value="ASC" data-column="title" @if($sort_by === 'ASC' && $sort_column === 'title') selected @endif>A to Z</option>
                                    <option value="DESC" data-column="title" @if($sort_by === 'DESC' && $sort_column === 'title') selected @endif>Z to A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-view listgrid-sidebar">
                    <div class="row">
                        @foreach($products as $k => $product)
                            <div class="col-lg-6 col-md-4">
                                <div class="card">
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
                                            @if($product->category_id)
                                                <span class="Featured-text">{{ $product->category->title }}</span>
                                            @endif
                                            @if(Auth::check())
                                                @php
                                                    $bookmark = $product->bookmarks->where('user_id',Auth::user()->id);
                                                @endphp
                                                
                                                <a href="{{route('product.bookmark', $product->slug)}}" class="fav-icon">
                                                    @if(count($bookmark) === 0) <i class="feather-heart"></i> @endif
                                                    @if(count($bookmark) > 0) <i class="fa-solid fa-heart"></i> @endif
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" class="fav-icon" data-bs-toggle="modal" data-bs-target="#LoginModal">
                                                    <i class="feather-heart"></i>
                                                </a>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="bloglist-content">
                                        <div class="card-body">
                                            <div class="blogfeaturelink">
                                            <div class="blog-features">
                                                <a href="javascript:void(0)">
                                                    <span>
                                                        <i class="fa-regular fa-circle-stop"></i>{{ $product->location->name }}
                                                    </span>
                                                </a>
                                            </div>
                                            </div>
                                            <h6>
                                                <a href="{{ productDetailUrl($product) }}" title="{{ productTitleWithCategory($product) }}">
                                                    {{ productTitleWithCategory($product) }}
                                                </a>
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
                            </div>
                        @endforeach
                    </div>
                </div>
            <!--Pagination--> 
                {{$products->links('pagination.frontend')}}
             <!--Pagination-->
             
            </div>
        </div>
    </div>			  
</div>
<!-- /Main Content Section -->

<script>
    function goProductListing(overrides) {
        var url = new URL(window.location.href);
        var params = new URLSearchParams(url.search);
        for (var key in overrides) {
            if (Object.prototype.hasOwnProperty.call(overrides, key)) {
                var v = overrides[key];
                if (v === null || v === undefined || v === '') {
                    params.delete(key);
                } else {
                    params.set(key, String(v));
                }
            }
        }
        params.set('page', '1');
        url.search = params.toString();
        window.location.href = url.toString();
    }
    function applyProductListSort() {
        var el = document.querySelector('.product-listing-sort');
        if (!el) { return; }
        var opt = el.selectedOptions[0];
        goProductListing({
            sort_by: el.value,
            sort_column: opt && opt.getAttribute('data-column') ? opt.getAttribute('data-column') : 'created_at'
        });
    }
    /** Retained for any legacy onclick references (e.g. featured blocks linking with JS). */
    function searchCategory(id) {
        if (id === undefined || id === null || id === '') {
            goProductListing({ cat_id: null });
        } else {
            goProductListing({ cat_id: id });
        }
    }
</script>