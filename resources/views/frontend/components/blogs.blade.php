<section id="mu-from-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-from-blog-area">
            <!-- start title -->
            <div class="mu-title">
                @isset($meta['title'])
                <h1>{{$meta['title']}}</h1>
                @endisset
                @isset($meta['desc'])
                <p>{{$meta['desc']}}</p>
                @endisset
            </div>
            <!-- end title -->
            <!-- start from blog content   -->
            <div class="mu-from-blog-content">
              <div class="row">
                @foreach(getBlogs($meta['limit']??null) as $blog) 
                <div class="col-md-4 col-sm-4">
                  <article class="mu-blog-single-item">
                    @if(!empty($blog->image))
                    <figure class="mu-blog-single-img">
                      <a href="{{route('blogDetail', $blog->slug)}}"><img src="{{$blog->image}}" alt="{{$blog->title}}"></a>
                      <figcaption class="mu-blog-caption">
                        <h3><a href="{{route('blogDetail', $blog->slug)}}">{{$blog->title}}</a></h3>
                      </figcaption>
                    </figure>
                    @endif
                    <div class="mu-blog-description">
                      <p>{{Str::limit($blog->short_description, 128, '...')}}</p>
                      <div class="mu-blog-meta">
                        <span><i class="fa fa-comments-o"></i>{{$blog->views_count}}</span>
                      </div>
                      <a class="mu-read-more-btn" href="{{route('blogDetail', $blog->slug)}}">Read More</a>
                    </div>
                  </article>
                </div>
                @endforeach
  
                
  
                @isset($meta['btntext'])
                <p class="soa_pera"> <a href="{{$meta['btnlink']??'#'}}">{{$meta['btntext']}}</a> </p>
                @endisset
              </div>
            </div>
            <!-- end from blog content   -->
          </div>
        </div>
      </div>
    </div>
  </section>