@extends('layouts.frontend')
@section('title',(!empty($data->meta_title))?$data->meta_title:$data['title'].' | Main IT Services')
@section('seo')
    @include('frontend.seo', [ 'description'=>$data->meta_description??'', 'schema'=>$data['schema_code']??'', 'seo'=>$data['seo_meta']??[] ])
@endsection
@section('customStyles')
<style>
.mu-latest-course-single-content table span {
    color: #0082cb !important;
}
#mu-course-content .mu-course-content-area .mu-course-details .mu-latest-course-single .mu-latest-course-single-content ul {
    margin-bottom: 30px;
    padding-left: 20px;
    display: flex;
    flex-direction: column;
}
.mu-latest-course-single-content ul li, .mu-blog-description ul li {
    list-style: disc;
}
</style>
@endsection
@section('seo')

@endsection
@section('content')
<section id="mu-page-breadcrumb" class="serv_sec">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="mu-page-breadcrumb-area">
                <!-- <ol class="breadcrumb">
                   <li><a href="index.html">Home</a></li>
                   <li><a href="#">Services</a></li>
                   <li class="active">Web Services</li>
                </ol> -->
                <h1 style="margin-top:50px;">{{$data['title']}}</h1>
             </div>
          </div>
       </div>
    </div>
 </section>

 <section id="mu-course-content" class="serv_sec_2">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="mu-course-content-area">
                @if(!empty($sidebar))
                <div class="row">
                  @if(isset($sidebar['sidebar_position']) && $sidebar['sidebar_position']=='left')                  
                  <div class="col-md-3">
                     <!-- start sidebar -->
                     <aside class="mu-sidebar">
                         @if($childrens->count()>0)
                        <!-- start single sidebar -->
                        <div class="mu-single-sidebar">
                           <div class="mu-sidebar-popular-courses">
                               @foreach($childrens as $child)
                               <div class="media" class="dim">
                                   <div class="media-left">
                                       <a href="{{route('dynamicPage', $child->slug)}}">
                                       <span class="bcfpwht">{{substr($child->title, 0, 1)}}</span>
                                       </a>
                                   </div>
                                   <div class="media-body">
                                       <h4 class="media-heading"><a href="{{route('dynamicPage', $child->slug)}}">{{$child->title}}</a></h4>
                                       <!-- <span class="popular-course-price">
                                           Website Designer in Alexandria
                                           
                                           In this digital world, websites have become a steady platform fo</span>-->
                                   </div>
                               </div>
                              @endforeach
                           </div>
                        </div>
                        <!-- end single sidebar -->
                        @endif
                        @if($others->count()>0)
                        <!-- start single sidebar -->
                        <div class="mu-single-sidebar">
                           <h3>Other Services</h3>
                           <ul class="mu-sidebar-catg">
                               @foreach($others as $other)
                              <li><a href="{{route('dynamicPage', $other->slug)}}">{{$other->title}}</a></li>
                              @endforeach                               
                           </ul>
                        </div>
                        <!-- end single sidebar -->
                        @endif
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
                        @endisset

                     </aside>
                     <!-- / end sidebar -->
                  </div>
                  <div class="col-md-9">
                     <!-- start course content container -->
                     <div class="mu-course-container mu-course-details">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="mu-latest-course-single">
                                 <div class="mu-latest-course-single-content">
                                    <p><img class="main_bn" src="{{$data['image']}}" alt="{{$data['title']}}"></p>
                                    <div class="page-intro">
                                       {!! $data['description'] !!}
                                       @isset($data->meta->btntext)
                                       <div style="clear: both;"></div>
                                       <a href="{{$data->meta->btnlink??'#'}}" target="_blank" style="color: white;font-size: 15px;font-weight: 600;">
                                           <div style="background: #0082cb;padding: 10px 20px;text-align: center;border-radius: 4px;width: fit-content;margin: 0 auto;">
                                                {{$data->meta->btntext}}
                                           </div>
                                       </a>
                                       @endisset
                                    </div>
                                    <!-- end course content container -->
                                    <!--Insert photos -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end course content container -->
                  </div>
                  @else
                  <div class="col-md-9">
                     <!-- start course content container -->
                     <div class="mu-course-container mu-course-details">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="mu-latest-course-single">
                                 <div class="mu-latest-course-single-content">
                                    <p><img class="main_bn" src="{{$data['image']}}" alt="{{$data['title']}}"></p>
                                    <div class="page-intro">
                                       {!! $data['description'] !!}
                                       @isset($data->meta->btntext)
                                       <div style="clear: both;"></div>
                                       <a href="{{$data->meta->btnlink??'#'}}" target="_blank" style="color: white;font-size: 15px;font-weight: 600;">
                                           <div style="background: #0082cb;padding: 10px 20px;text-align: center;border-radius: 4px;width: fit-content;margin: 0 auto;">
                                                {{$data->meta->btntext}}
                                           </div>
                                       </a>
                                       @endisset
                                    </div>
                                    <!-- end course content container -->
                                    <!--Insert photos -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end course content container -->
                  </div>
                  <div class="col-md-3">
                     <!-- start sidebar -->
                     <aside class="mu-sidebar">
                         @if($childrens->count()>0)
                        <!-- start single sidebar -->
                        <div class="mu-single-sidebar">
                           <div class="mu-sidebar-popular-courses">
                               @foreach($childrens as $child)
                               <div class="media" class="dim">
                                   <div class="media-left">
                                       <a href="{{route('dynamicPage', $child->slug)}}">
                                       <span class="bcfpwht">{{substr($child->title, 0, 1)}}</span>
                                       </a>
                                   </div>
                                   <div class="media-body">
                                       <h4 class="media-heading"><a href="{{route('dynamicPage', $child->slug)}}">{{$child->title}}</a></h4>
                                       <!-- <span class="popular-course-price">
                                           Website Designer in Alexandria
                                           
                                           In this digital world, websites have become a steady platform fo</span>-->
                                   </div>
                               </div>
                              @endforeach
                           </div>
                        </div>
                        <!-- end single sidebar -->
                        @endif
                        @if($others->count()>0)
                        <!-- start single sidebar -->
                        <div class="mu-single-sidebar">
                           <h3>Other Services</h3>
                           <ul class="mu-sidebar-catg">
                               @foreach($others as $other)
                              <li><a href="{{route('dynamicPage', $other->slug)}}">{{$other->title}}</a></li>
                              @endforeach                               
                           </ul>
                        </div>
                        <!-- end single sidebar -->
                        @endif
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
                        @endisset

                     </aside>
                     <!-- / end sidebar -->
                  </div>
                  @endif
               </div>
                @else
                <div class="row">
                  <div class="col-md-12">
                     <!-- start course content container -->
                     <div class="mu-course-container mu-course-details">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="mu-latest-course-single">
                                 <div class="mu-latest-course-single-content">
                                    <p><img class="main_bn" src="{{$data['image']}}" alt="{{$data['title']}}"></p>
                                    <div class="page-intro">
                                       {!! $data['description'] !!}
                                       @isset($data->meta->btntext)
                                       <div style="clear: both;"></div>
                                       <a href="{{$data->meta->btnlink??'#'}}" target="_blank" style="color: white;font-size: 15px;font-weight: 600;">
                                           <div style="background: #0082cb;padding: 10px 20px;text-align: center;border-radius: 4px;width: fit-content;margin: 0 auto;">
                                                {{$data->meta->btntext}}
                                           </div>
                                       </a>
                                       @endisset
                                    </div>
                                    <!-- end course content container -->
                                    <!--Insert photos -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end course content container -->
                  </div>
                </div>
                @endif
             </div>
          </div>
       </div>
    </div>
 </section>
@endsection