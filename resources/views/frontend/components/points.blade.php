<section id="mu-service">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-service-area">
            @if(isset($meta['point_1']['icon']) || isset($meta['point_1']['title']) || isset($meta['point_1']['desc']))
            <!-- Start single service -->
            <div class="mu-service-single">
                @isset($meta['point_1']['icon'])
                <span class="{{$meta['point_1']['icon']}}"></span>
                @endisset
                @isset($meta['point_1']['title'])
                <h3>{{$meta['point_1']['title']}}</h3>
                @endisset
                @isset($meta['point_1']['desc'])
                <p>{{$meta['point_1']['desc']}}</p>
                @endisset
            </div>
            @endif
            @if(isset($meta['point_2']['icon']) || isset($meta['point_2']['title']) || isset($meta['point_2']['desc']))
            <!-- Start single service -->
            <div class="mu-service-single">
                @isset($meta['point_2']['icon'])
                <span class="{{$meta['point_2']['icon']}}"></span>
                @endisset
                @isset($meta['point_2']['title'])
                <h3>{{$meta['point_2']['title']}}</h3>
                @endisset
                @isset($meta['point_2']['desc'])
                <p>{{$meta['point_2']['desc']}}</p>
                @endisset
            </div>
            @endif
            @if(isset($meta['point_3']['icon']) || isset($meta['point_3']['title']) || isset($meta['point_3']['desc']))
            <!-- Start single service -->
            <div class="mu-service-single">
                @isset($meta['point_3']['icon'])
                <span class="{{$meta['point_3']['icon']}}"></span>
                @endisset
                @isset($meta['point_3']['title'])
                <h3>{{$meta['point_3']['title']}}</h3>
                @endisset
                @isset($meta['point_3']['desc'])
                <p>{{$meta['point_3']['desc']}}</p>
                @endisset
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>