<section id="mu-course-content">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="mu-course-content-area">
                  <div class="row">
                    @if(isset($meta['is_sidebar']))
                    @if(isset($meta['sidebar_position']) && $meta['sidebar_position']=='left')
                    <div class="col-md-3">
                        <!-- start sidebar -->
                        <aside class="mu-sidebar">
                          @isset($meta['sidebar_menu'])  
                          <div class="mu-single-sidebar">
                                <h3>{{getMenuByID($meta['sidebar_menu'])['title']??''}}</h3>
                                <div class="tag-cloud">
                                  @foreach(getMenuByID($meta['sidebar_menu'])->items as $m)
                                  <a href="{{$m->url}}">{{$m->title}}</a> 
                                  @endforeach
                                </div>
                            </div>
                          @endisset
                        </aside>
                        <!-- / end sidebar -->
                    </div>                      
                    <div class="col-md-9">
                        <div class="mu-course-container mu-blog-archive">
                          @isset($meta['title'])  
                          <h1 style="color:blue; margin-bottom:0px; border-bottom:2px solid red;">
                                <i class="fa fa-images"></i>{{$meta['title']}}</span>
                            </h1>
                            @endisset
                            <div class="row">
                              @foreach(getAlbums() as $album)
                                <div class="col-md-6 col-sm-6" style="margin-bottom:14px;">
                                    <article class="mu-blog-single-item">
                                        <figure class="mu-blog-single-img">
                                            <a href="{{route('albumDetail', $album->slug)}}"><img
                                                    src="{{$album->image}}"
                                                    alt="{{$album->title}}"></a>
                                            <figcaption class="mu-blog-caption">
                                                <h3><a href="{{route('albumDetail', $album->slug)}}">{{$album->title}}</a></h3>
                                            </figcaption>
                                        </figure>
                                    </article>
                                </div>
                              @endforeach
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-9">
                      <div class="mu-course-container mu-blog-archive">
                        @isset($meta['title'])  
                        <h1 style="color:blue; margin-bottom:0px; border-bottom:2px solid red;">
                              <i class="fa fa-images"></i>{{$meta['title']}}</span>
                          </h1>
                          @endisset
                          <div class="row">
                            @foreach(getAlbums() as $album)
                              <div class="col-md-6 col-sm-6" style="margin-bottom:14px;">
                                  <article class="mu-blog-single-item">
                                      <figure class="mu-blog-single-img">
                                          <a href="{{route('albumDetail', $album->slug)}}"><img
                                                  src="{{$album->image}}"
                                                  alt="{{$album->title}}"></a>
                                          <figcaption class="mu-blog-caption">
                                              <h3><a href="{{route('albumDetail', $album->slug)}}">{{$album->title}}</a></h3>
                                          </figcaption>
                                      </figure>
                                  </article>
                              </div>
                            @endforeach
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3">
                    <!-- start sidebar -->
                    <aside class="mu-sidebar">
                      @isset($meta['sidebar_menu'])  
                      <div class="mu-single-sidebar">
                            <h3>{{getMenuByID($meta['sidebar_menu'])['title']??''}}</h3>
                            <div class="tag-cloud">
                              @foreach(getMenuByID($meta['sidebar_menu'])->items as $m)
                              <a href="{{$m->url}}">{{$m->title}}</a> 
                              @endforeach
                            </div>
                        </div>
                      @endisset
                    </aside>
                    <!-- / end sidebar -->
                </div>
                @endif
                @else
                <div class="col-md-12">
                  <div class="mu-course-container mu-blog-archive">
                    @isset($meta['title'])  
                    <h1 style="color:blue; margin-bottom:0px; border-bottom:2px solid red;">
                          <i class="fa fa-images"></i>{{$meta['title']}}</span>
                      </h1>
                      @endisset
                      <div class="row">
                        @foreach(getAlbums() as $album)
                          <div class="col-md-4 col-sm-4" style="margin-bottom:14px;">
                              <article class="mu-blog-single-item">
                                  <figure class="mu-blog-single-img">
                                      <a href="{{route('albumDetail', $album->slug)}}"><img
                                              src="{{$album->image}}"
                                              alt="{{$album->title}}"></a>
                                      <figcaption class="mu-blog-caption">
                                          <h3><a href="{{route('albumDetail', $album->slug)}}">{{$album->title}}</a></h3>
                                      </figcaption>
                                  </figure>
                              </article>
                          </div>
                        @endforeach
                      </div>
                  </div>
              </div>
                    @endif                      
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>