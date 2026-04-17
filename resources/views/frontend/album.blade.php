@extends('layouts.frontend')
@section('title',$data['title'].' | Main IT Services')
@section('seo')
    {{-- @include('frontend.seo', [ 'description'=>$data->meta_desc??'', 'schema'=>$data['schema_code']??'', 'seo'=>$data['seo_meta']??[] ]) --}}
@endsection
@section('customStyles')
    
@endsection
@section('content')
<section id="mu-page-breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="mu-page-breadcrumb-area">
              <!--<ol class="breadcrumb">-->
              <!--    <li><a href="https://mainitsol.com">Home</a></li>-->
              <!--    <li><a href="https://mainitsol.com/album">Album</a></li>-->
              <!--    <li class="active">Printers Services</li>-->
              <!--</ol>-->
              <h1 style="margin-top: 50px">{{$data['title']}}</h1>
            </div>
          </div>
        </div>
      </div>
</section>
<section id="mu-course-content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-course-content-area">
            <div class="row">
              <div class="col-md-3">
                <aside class="mu-sidebar">
                  <div class="mu-single-sidebar" style="background: #00445512">
                    <h3 style="border-bottom: 2px solid brown; color: brown">
                      Our Album
                    </h3>
                    <div class="mu-sidebar-popular-courses">
                        @foreach($recents as $v)
                        <div class="media">
                            <div class="media-left" title="Professional Service and repair - Printer Repair Services.">
                              <a href="{{route('albumDetail', $v->slug)}}">
                                <img class="media-object ellipse" src="{{$v->image}}" alt="{{$v->title}}" />
                              </a>
                            </div>
                            <div class="media-body" style="vertical-align: top">
                              <h4 class="media-heading">
                                <a style="font-weight: 700; color: gray" title="{{$v->title}}." class="ellipse" href="{{route('albumDetail', $v->slug)}}">{{$v->title}}</a>
                              </h4>
                              <span class="popular-course-price" style="color: gray">{{$v->created_at->format('D, M d, Y')}}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                  </div>

                  @isset($sidebar['sidebar_menu'])  
                  <!-- start single sidebar -->
                  <div class="mu-single-sidebar">
                    <h3>{{getMenuByID($sidebar['sidebar_menu'])['title']??''}}</h3>
                    <div class="tag-cloud">
                      @foreach(getMenuByID($sidebar['sidebar_menu'])->items as $m)
                      <a href="{{$m->url}}">{{$m->title}}</a>  
                      @endforeach
                    </div>
                  </div>
                  <!-- end single sidebar -->
                  @endif
                </aside>
              </div>

              <div class="col-md-9">
                <div class="mu-course-container mu-blog-archive">
                  <h1 style=" color: blue;margin-bottom: 0px;border-bottom: 2px solid red;">
                    <i class="fa fa-images"></i>Album
                    <span class="ellipse" style="color: red; font-size: 0.9em">{{$data['title']}}</span>
                  </h1>
                  <div
                    style="
                      width: 100%;
                      padding: 10px 10px;
                      min-height: 50px;
                      background-color: #000;
                      color: #fff;
                      margin-bottom: 30px;
                    "
                  >{{$data['description']}}</div>
                  <div class="row">
                    @if(!empty($data['gallery']))
                    @foreach($data['gallery'] as $k => $gal)
                    <div class="col-md-6 col-sm-6" style="margin-bottom: 14px">
                      <article class="mu-blog-single-item">
                        <figure class="mu-blog-single-img">
                          <a href="javascript:void(0);"><img src="{{$gal}}" alt="{{$data['title']}}"/></a>
                          {{-- <figcaption class="mu-blog-caption">
                            <h3></h3>
                          </figcaption> --}}
                        </figure>
                      </article>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection