@php
    $category = GetProductCategory();
@endphp

<!-- Banner Section -->
    <section class="banner-section">
        <div class="banner-circle">
            <img
            src="{{asset('assets_frontend')}}/img/bannerbg.png"
            class="img-fluid"
            alt="bannercircle"
            />
        </div>
        <div class="container">
            <div class="home-banner">
            <div class="row align-items-center">
                <div class="col-lg-7">
                <div class="section-search aos" data-aos="fade-up">
                    <p class="explore-text">
                        @if(isset($meta['tag']))<span>{{ ($meta['tag'])??'' }}</span>@endif
                    </p>
                    <img
                    src="{{asset('assets_frontend')}}/img/arrow-banner.png"
                    class="arrow-img"
                    alt="arrow"
                    />
                    <h1>
                    @if(isset($meta['title'])) {{ ($meta['title'])??'' }} <br /> @endif
                    @if(isset($meta['title2']))<span>{{ ($meta['title2'])??'' }}</span> @endif @if(isset($meta['title3'])){{ ($meta['title3'])??'' }} @endif
                    </h1>
                    @if(isset($meta['desc']))<p>{!! ($meta['desc'])??'' !!}
                    </p>@endif

                    @if(isset($meta['is_searchbar']))
                        <div class="search-box">
                        <form
                            action="http://eastcoastpuppies.cc/search"
                            class="d-flex"
                        >
                            <div class="search-input">
                            <div class="form-group">
                                <div class="group-img">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Keyword"
                                    name="q"
                                />
                                <i class="feather-search"></i>
                                </div>
                            </div>
                            </div>
                            <div class="search-input line">
                            <div class="form-group">
                                <select
                                class="form-control select category-select"
                                name="category_id"
                                >
                                    <option value="" selected disabled style="visiblity:hidden;">Choose Category</option>
                                    @if(isset($category))
                                        @foreach($category as $k => $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            </div>
                            <div class="search-btn">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i> Search
                            </button>
                            </div>
                        </form>
                        </div>
                    @endif
                </div>
                </div>
                <div class="col-lg-5">
                <div class="banner-imgs">
                    <img
                    src="{{asset('assets_frontend')}}/img/Right-img.png"
                    class="img-fluid"
                    alt="bannerimage"
                    />
                </div>
                </div>
            </div>
            </div>
        </div>
        <img
            src="{{asset('assets_frontend')}}/img/bannerellipse.png"
            class="img-fluid banner-elipse"
            alt="arrow"
        />
        <img
            src="{{asset('assets_frontend')}}/img/banner-arrow.png"
            class="img-fluid bannerleftarrow"
            alt="arrow"
        />
    </section>
<!-- /Banner Section -->