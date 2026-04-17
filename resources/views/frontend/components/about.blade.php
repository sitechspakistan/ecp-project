<section id="mu-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-about-us-area">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-left">
                    @isset($meta['title'])
                    <!-- Start Title -->
                    <div class="mu-title">
                        <h2>{{$meta['title']}}</h2>
                    </div>
                    <!-- End Title -->
                    @endisset                    
                    {!! $meta['desc'] !!}
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-right">
                    @if(isset($meta['video']))
                    <div>
                        {!! $meta['video'] !!}
                    </div>
                    @else
                    @isset($meta['img'])
                    <img src="{{$meta['img']}}" alt="{{$meta['title']}}">
                    @endisset
                    @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>