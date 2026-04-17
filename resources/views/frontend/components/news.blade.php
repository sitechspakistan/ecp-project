<section id="mu-latest-courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-latest-courses-area">
            @isset($meta['title'])
            <!-- Start Title -->
            <div class="mu-title">
              <h2>{{$meta['title']}}</h2>
            </div>
            <!-- End Title -->
            @endisset
            <!-- Start latest course content -->
            <div id="mu-latest-course-slide" class="mu-latest-courses-content">
             @foreach(getNews($meta['limit']??null) as $news) 
             <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="mu-latest-course-single">
                  <figure class="mu-latest-course-img">
                    <a href="{{route('newsDetail', $news->slug)}}">
                      <img src="{{$news->image}}" alt="{{$news->title}}">
                    </a>
                    <figcaption class="mu-latest-course-imgcaption">
                      <a href="#">TECHNOLOGY</a>
                      <span><i class="fa fa-clock-o"></i>{{$news['publish_date']??$news['created_at']->format('d/m/Y')}} </span>
                    </figcaption>
                  </figure>
                  <div class="mu-latest-course-single-content">
                    <h4 class="ellipse"><a title="{{$news->title}}" href="{{route('newsDetail', $news->slug)}}">{{$news->title}}</a></h4>
                    <span>
                      <p>{{Str::limit($news->short_description, 128, '...')}}</p>
                    </span>
                    <div class="mu-latest-course-single-contbottom">
                      <a class="mu-course-details" href="{{route('newsDetail', $news->slug)}}">Details</a>
  
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <!-- End latest course content -->
          </div>
        </div>
      </div>
    </div>
  </section>