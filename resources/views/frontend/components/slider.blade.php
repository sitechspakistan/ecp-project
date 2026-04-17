<section id="mu-slider">
    @isset($meta['images'])
    @foreach($meta['images'] as $k => $img)
    <!-- Start single slider item -->
    <div class="mu-slider-single">
      <div class="mu-slider-img">
        <figure>
          <img src="{{$img}}" alt="{{$meta['titles'][$k]??'*'}}">
        </figure>
      </div>
      <div class="mu-slider-content">
        @isset($meta['top_titles'][$k])
        <h4>{{$meta['top_titles'][$k]}}</h4>
        <span></span>
        @endisset
        @isset($meta['titles'][$k])
        <h2>{{$meta['titles'][$k]}}</h2>
        @endisset
        @isset($meta['desc'][$k])
        <p>{{$meta['desc'][$k]}}</p>
        @endisset
        @isset($meta['btntext'][$k])
        <a href="{{$meta['btnlink'][$k]}}" class="mu-read-more-btn">{{$meta['btntext'][$k]}}</a>
        @endisset
      </div>
    </div>
    @endforeach
    @endisset  
</section>