<section id="mu-abtus-counter" @if(!empty($meta['bg'])) style="background-image: url('{{$meta['bg']}}')" @endif>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-abtus-counter-area">
            <div class="row">
                @if(isset($meta['counter_1']['icon']) || isset($meta['counter_1']['title']) || isset($meta['counter_1']['count']))
                <!-- Start counter item -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="mu-abtus-counter-single">
                        @isset($meta['counter_1']['icon'])
                        <span class="{{$meta['counter_1']['icon']}}"></span>
                        @endisset
                        @isset($meta['counter_1']['count'])
                        <h4 class="counter">{{$meta['counter_1']['count']}}</h4>
                        @endisset
                        @isset($meta['counter_1']['title'])
                        <p>{{$meta['counter_1']['title']}}</p>
                        @endisset
                    </div>
                </div>
                <!-- End counter item -->
                @endif              
                @if(isset($meta['counter_2']['icon']) || isset($meta['counter_2']['title']) || isset($meta['counter_2']['count']))
                <!-- Start counter item -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="mu-abtus-counter-single">
                        @isset($meta['counter_2']['icon'])
                        <span class="{{$meta['counter_2']['icon']}}"></span>
                        @endisset
                        @isset($meta['counter_2']['count'])
                        <h4 class="counter">{{$meta['counter_2']['count']}}</h4>
                        @endisset
                        @isset($meta['counter_2']['title'])
                        <p>{{$meta['counter_2']['title']}}</p>
                        @endisset
                    </div>
                </div>
                <!-- End counter item -->
                @endif              
                @if(isset($meta['counter_3']['icon']) || isset($meta['counter_3']['title']) || isset($meta['counter_3']['count']))
                <!-- Start counter item -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="mu-abtus-counter-single">
                        @isset($meta['counter_3']['icon'])
                        <span class="{{$meta['counter_3']['icon']}}"></span>
                        @endisset
                        @isset($meta['counter_3']['count'])
                        <h4 class="counter">{{$meta['counter_3']['count']}}</h4>
                        @endisset
                        @isset($meta['counter_3']['title'])
                        <p>{{$meta['counter_3']['title']}}</p>
                        @endisset
                    </div>
                </div>
                <!-- End counter item -->
                @endif              
                @if(isset($meta['counter_4']['icon']) || isset($meta['counter_4']['title']) || isset($meta['counter_4']['count']))
                <!-- Start counter item -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="mu-abtus-counter-single">
                        @isset($meta['counter_4']['icon'])
                        <span class="{{$meta['counter_4']['icon']}}"></span>
                        @endisset
                        @isset($meta['counter_4']['count'])
                        <h4 class="counter">{{$meta['counter_4']['count']}}</h4>
                        @endisset
                        @isset($meta['counter_4']['title'])
                        <p>{{$meta['counter_4']['title']}}</p>
                        @endisset
                    </div>
                </div>
                <!-- End counter item -->
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>