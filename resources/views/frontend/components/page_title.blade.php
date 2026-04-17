<section id="mu-page-breadcrumb" @if(!empty($meta['bg'])) style="background-image: url('{{$meta['bg']}}')" @endif>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-page-breadcrumb-area">
           <h1 style="margin-top:50px;">{{ $slot ?? '' }}</h1>
          </div>
        </div>
      </div>
    </div>
</section>