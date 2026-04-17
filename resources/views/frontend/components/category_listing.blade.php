<!-- Categories Section -->
<div class="categorieslist-section">
    <div class="container">
        <div class="row">
            @foreach(GetProductCategory() as $k => $category)
                <div class="col-lg-3 col-md-4">
                    <div class="card aos categories-cards" data-aos="fade-up">
                        <div class="blog-widget">
                        <div class="blog-img overflow-hidden">
                            <a href="{{ url('products?cat_id='.$category->id) }}">
                            <img
                                src="{{ url(($category->image)??'#') }}"
                                class="img-fluid"
                                alt="{{ ($category->title)??'' }}"
                            />
                            </a>
                            
                        </div>
                        <div class="bloglist-content">
                            <div class="card-body d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <h6>
                                        <a href="{{ url('products?cat_id='.$category->id) }}" title="{{ ($category->title)??'' }}"
                                            >{{ ($category->title)??'' }}</a>
                                        </h6>
                                </div>
                                <div class="amount-details">
                                    <div class="amount w-100 text-end">
                                        <a href="{{ url('products?cat_id='.$category->id) }}">
                                            <i class="fa-regular fa-circle-right me-1" style="font-size: 20px; color: #DF965E;" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- /Categories Section -->