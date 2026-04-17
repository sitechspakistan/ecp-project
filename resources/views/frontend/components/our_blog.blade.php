<!-- Blog  Section -->
<section class="blog-section">
    <div class="section-heading">
        <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 aos aos-init aos-animate" data-aos="fade-up">
                @if(isset($meta['heading']))<h2>{{ ($meta['heading'])??'' }}</h2>@endif
                @if(isset($meta['sub_heading']))<p>{{ ($meta['sub_heading'])??'' }}</p>@endif
            </div>
            <div
            class="col-md-6 text-md-end aos aos-init aos-animate"
            data-aos="fade-up"
            >
            <a href="{{url($meta['btnlink']??'#')}}" class="btn btn-view">{{$meta['btntext']}}</a>
            </div>
        </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach(getBlogs($meta['limit']??null) as $blog)
                <div class="col-lg-4 col-md-4 d-flex">
                    <div class="blog grid-blog">
                        @if(!empty($blog->image))
                            <div class="blog-image">
                                <a href="{{route('blogDetail', $blog->slug)}}"
                                ><img
                                    class="img-fluid"
                                    src="{{$blog->image}}"
                                    alt="{{$blog->title}}"
                                /></a>
                            </div>
                        @endif
                        <div class="blog-content">
                            @if(isset($blog->categories))
                            <p class="blog-category">
                                @foreach($blog->categories as $k => $blog_category)
                                    <a href="javascript:void(0);"><span>{{ $blog_category->title }}</span></a>
                                @endforeach
                            </p>
                            @endif
                            <ul class="entry-meta meta-item">
                                @if(!empty($blog->author))
                                    <li>
                                        <div class="post-author">
                                        <div class="post-author-img">
                                            <img
                                            src="{{asset('assets_frontend')}}/img/profiles/avatar-14.jpg"
                                            alt="{{$blog->author}}"
                                            />
                                        </div>
                                        <a href="javascript:void(0);" class="mb-0">
                                            <span> {{ $blog->author }} </span></a
                                        >
                                        </div>
                                    </li>
                                @endif
                            <li class="date-icon">
                                <i class="fa-solid fa-calendar-days"></i> {{ Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}
                            </li>
                            </ul>
                            <h3 class="blog-title">
                            <a href="{{route('blogDetail', $blog->slug)}}">{{$blog->title}}</a>
                            </h3>
                            <p class="blog-description">
                                {{Str::limit($blog->short_description, 128, '...')}}
                            </p>
                            <p class="viewlink">
                            <a href="{{route('blogDetail', $blog->slug)}}"
                                >View Details <i class="feather-arrow-right"></i
                            ></a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /Blog  Section -->