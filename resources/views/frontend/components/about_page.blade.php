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
                          <!-- start single sidebar -->
                          @isset($meta['show_childrens'])
                          @php $childrens = pageChildrens($parent_id); @endphp
                           @if (count($childrens) > 0)
                              <div class="mu-single-sidebar dab_1">

                                 <div class="mu-sidebar-popular-courses">
                                       @foreach ($childrens as $child)
                                          <div class="media" class="dim">
                                             <div class="media-left">
                                                   <a href="professional-associations">
                                                      <span
                                                         class="bcfpwht">{{ substr($child->title, 0, 1) }}</span>
                                                   </a>
                                             </div>
                                             <div class="media-body">
                                                   <h4 class="media-heading">
                                                      <a href="{{ url($child->slug) }}">
                                                         {{ $child->title }}
                                                      </a>
                                                   </h4>
                                             </div>
                                          </div>
                                       @endforeach
                                 </div>
                              </div>
                           @endif
                           @endisset
                           @isset($meta['show_related'])
                           @php $related = relatedPage($page_id); @endphp
                           @if (count($related) > 0)
                              <div class="mu-single-sidebar"
                                 style="background-color:#ffcecc; margin-top:12px;">
                                 <h3 style="color:brown;">Related Items</h3>
                                 <ul class="mu-sidebar-catg">
                                       @foreach ($related as $child)
                                          <li>
                                             <a href="{{ url($child->slug) }}">
                                                   {{ $child->title }}
                                             </a>
                                          </li>
                                       @endforeach
                                 </ul>
                              </div>
                           @endif
                          <!-- end single sidebar -->
                          @endisset
                          @isset($meta['sidebar_menu'])
                          <!-- start single sidebar -->
                          <div class="mu-single-sidebar">
                            <h3>{{getMenuByID($meta['sidebar_menu'])['title']??''}}</h3>
                            <div class="tag-cloud">
                               @foreach(getMenuByID($meta['sidebar_menu'])->items as $m)
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
                        @isset($meta['img'])
                         <p><img src="{{$meta['img']}}" alt="{{$meta['title']}}" class="about_img_1"></p>
                         @endisset
                         @isset($meta['title'])
                         <p><strong><span class="saus_h">{{$meta['title']}}</span></strong></p>
                         @endisset
                         {!! $meta['desc']??'' !!}                         
                         <p><span class="fs_17"><br></span></p>                              
                         <!-- end course content container -->
                          <!--Insert photos -->
                          @isset($meta['btntext'])
                          <a href="{{$meta['btnlink']??'#'}}" style="color: white;font-size: 15px;font-weight: 600;">
                           <div style="background: #0082cb;padding: 10px 20px;text-align: center;border-radius: 4px;width: fit-content;margin: 0 auto;">
                                {{$meta['btntext']}}
                           </div>
                           </a>
                           @endisset
                       </div>
                    @else                    
                     <div class="col-md-9">
                        @isset($meta['img'])
                         <p><img src="{{$meta['img']}}" alt="{{$meta['title']}}" class="about_img_1"></p>
                         @endisset
                         @isset($meta['title'])
                         <p><strong><span class="saus_h">{{$meta['title']}}</span></strong></p>
                         @endisset
                         {!! $meta['desc']??'' !!}
                         <p><span class="fs_17"><br></span></p>                              
                         <!-- end course content container -->
                          <!--Insert photos -->
                          @isset($meta['btntext'])
                          <a href="{{$meta['btnlink']??'#'}}" style="color: white;font-size: 15px;font-weight: 600;">
                           <div style="background: #0082cb;padding: 10px 20px;text-align: center;border-radius: 4px;width: fit-content;margin: 0 auto;">
                                {{$meta['btntext']}}
                           </div>
                           </a>
                           @endisset
                       </div>
                       <div class="col-md-3">
                        <!-- start sidebar -->
                        <aside class="mu-sidebar">
                          <!-- start single sidebar -->
                          @isset($meta['show_childrens'])
                          @php $childrens = pageChildrens($page_id); @endphp
                           @if (count($childrens) > 0)
                              <div class="mu-single-sidebar dab_1">

                                 <div class="mu-sidebar-popular-courses">
                                       @foreach ($childrens as $child)
                                          <div class="media" class="dim">
                                             <div class="media-left">
                                                   <a href="professional-associations">
                                                      <span
                                                         class="bcfpwht">{{ substr($child->title, 0, 1) }}</span>
                                                   </a>
                                             </div>
                                             <div class="media-body">
                                                   <h4 class="media-heading">
                                                      <a href="{{ url($child->slug) }}">
                                                         {{ $child->title }}
                                                      </a>
                                                   </h4>
                                             </div>
                                          </div>
                                       @endforeach
                                 </div>
                              </div>
                           @endif
                           @endisset
                           
                           @isset($meta['show_related'])
                           @php $related = relatedPage($page_id); @endphp
                           @if (count($related) > 0)
                              <div class="mu-single-sidebar"
                                 style="background-color:#ffcecc; margin-top:12px;">
                                 <h3 style="color:brown;">Related Items</h3>
                                 <ul class="mu-sidebar-catg">
                                       @foreach ($related as $child)
                                          <li>
                                             <a href="{{ url($child->slug) }}">
                                                   {{ $child->title }}
                                             </a>
                                          </li>
                                       @endforeach
                                 </ul>
                              </div>
                           @endif
                           @endisset
                          <!-- end single sidebar -->
                          @isset($meta['sidebar_menu'])
                          <!-- start single sidebar -->
                          <div class="mu-single-sidebar">
                            <h3>{{getMenuByID($meta['sidebar_menu'])['title']??''}}</h3>
                            <div class="tag-cloud">
                               @foreach(getMenuByID($meta['sidebar_menu'])->items as $m)
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
                @else
                <div class="col-md-12">
                    @isset($meta['img'])
                     <p><img src="{{$meta['img']}}" alt="{{$meta['title']}}" class="about_img_1"></p>
                     @endisset
                     @isset($meta['title'])
                     <p><strong><span class="saus_h">{{$meta['title']}}</span></strong></p>
                     @endisset
                     {!! $meta['desc']??'' !!}
                     <p><span class="fs_17"><br></span></p>                              
                     <!-- end course content container -->
                      <!--Insert photos -->
                      @isset($meta['btntext'])
                     <a href="{{$meta['btnlink']??'#'}}" style="color: white;font-size: 15px;font-weight: 600;">
                     <div style="background: #0082cb;padding: 10px 20px;text-align: center;border-radius: 4px;width: fit-content;margin: 0 auto;">
                           {{$meta['btntext']}}
                     </div>
                     </a>
                     @endisset
                   </div>
                @endif
             </div>
          </div>
        </div>
      </div>
    </div>
   </section>