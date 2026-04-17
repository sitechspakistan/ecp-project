@php
    $cat_id = ($_GET['cat_id'])??NULL;
    $sort_by = ($_GET['sort_by'])??'DESC';
    $sort_column = ($_GET['sort_column'])??'created_at';
    $page = ($_GET['page'])??1;
    $no_of_record = ($meta['no_of_record'])??6;
    
    $products = getProductPage($cat_id,$sort_by,$sort_column,$page,$no_of_record);
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
                @php
                    $categories = GetProductCategory();
                @endphp

                <div class="col-lg-4 theiaStickySidebar">
                    <div class="listings-sidebar">
                        <div class="card">
                            <h4><img  src="{{asset('assets_frontend')}}/img/details-icon.svg" alt="details-icon"> Filter</h4>
                            <form>
                                <div class="filter-content form-group amenities">
                                    <h4> Breed</h4>
                                    <ul>
                                        @foreach (GetProductCategory(1) as $k => $category)
                                            <li>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="cat_id" @if($cat_id*1 !== $category->id) onchange="searchCategory({{ $category->id }})" @else disabled checked @endif>
                                                    <span class="checkmark"></span> {{ ($category->title)??'' }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
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
                                <select class="form-control select sortselect" onchange="searchCategory({{ $cat_id }})">
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
                                                <i class="fa-regular fa-calendar-days"></i> {{ Carbon\Carbon::parse($product->product_listing)->format('d M, Y') }}
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
    function searchCategory(id) {
        var page_id = 1;
        var sort_by = $('.sortselect').find('option:selected').val();
        var sort_column = $('.sortselect').find('option:selected').data('column');

        // Initialize the base URL
        var url = new URL('{!! url("products") !!}'); // This creates a URL object for manipulation
        
        // Set or update the query parameters
        var params = new URLSearchParams(url.search); // Get the existing query params

        // Update or add parameters
        params.set('page', page_id);
        params.set('sort_by', sort_by);
        params.set('sort_column', sort_column);

        // If id is defined, set or update cat_id
        if (id !== undefined) {
            params.set('cat_id', id); // Update or add the cat_id parameter
        }

        // Update the URL search with the new params
        url.search = params.toString();

        // Redirect to the constructed URL
        window.location.href = url.toString();
    }
</script>