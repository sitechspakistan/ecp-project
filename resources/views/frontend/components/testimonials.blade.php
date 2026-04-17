<section id="mu-testimonial">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-testimonial-area">
            <div id="mu-testimonial-slide" class="mu-testimonial-content">
              @foreach(getTestimonials() as $test)
              <!-- start testimonial single item -->
              <div class="mu-testimonial-item">
                <div class="mu-testimonial-quote">
                  <blockquote>
                    <p>{{$test->testimonial}}</p>
                  </blockquote>
                </div>
                @if(!empty($test->image))
                <div class="mu-testimonial-img">
                  <img src="{{$test->image}}" alt="{{$test->name}}">
                </div>
                @endif
                <div class="mu-testimonial-info">
                  <h4>{{$test->name}}</h4>
                  <span>{{$test->designation??''}}</span>
                </div>
              </div>
              <!-- end testimonial single item -->
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>