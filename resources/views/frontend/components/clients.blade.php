<section id="mu-from-blog" class="ls_sec_page">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @isset($meta['title'])
          <div class="mu-from-blog-area">
            <!-- start title -->
            <div class="mu-title">
              <h2>{{$meta['title']}}</h2>
            </div>
          </div>
          @endisset
          <!-- start horizontal slider -->
          <script src="{{asset('assets_frontend')}}/js/jssor.slider-27.5.0.min.js" type="text/javascript"></script>
          <script type="text/javascript">
            jssor_1_slider_init = function() {
              var jssor_1_options = {
                $AutoPlay: 1,
                $Idle: 0,
                $SlideDuration: 5000,
                $SlideEasing: $Jease$.$Linear,
                $PauseOnHover: 4,
                $SlideWidth: 140,
                $Align: 0
              };
              var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
              var MAX_WIDTH = 980;
  
              function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;
                if (containerWidth) {
                  var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                  jssor_1_slider.$ScaleWidth(expectedWidth);
                } else {
                  window.setTimeout(ScaleSlider, 30);
                }
              }
  
              ScaleSlider();
  
              $Jssor$.$AddEvent(window, "load", ScaleSlider);
              $Jssor$.$AddEvent(window, "resize", ScaleSlider);
              $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
              /*#endregion responsive code end*/
            };
          </script>
          <style>
            /*jssor slider loading skin spin css*/
            .jssorl-009-spin img {
              animation-name: jssorl-009-spin;
              animation-duration: 1.6s;
              animation-iteration-count: infinite;
              animation-timing-function: linear;
            }
  
            @keyframes jssorl-009-spin {
              from {
                transform: rotate(0deg);
              }
  
              to {
                transform: rotate(360deg);
              }
  
            }
  
            .islide {
              margin-right: 10px;
            }
          </style>
          <div id="jssor_1" class="logo_slider">
            <!-- Loading Screen -->
            <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
              <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{asset('assets_frontend')}}/img/partners/spin.svg"/>
            </div>
            <div id="rollingimages" data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:100px;overflow:hidden;">
                @foreach(getClients() as $client)
              <div class="islide">
                <img title="{{$client->title}}" data-u="image" src="{{$client->image}}"/>
              </div>
              @endforeach  
            </div>
          </div>
          <script type="text/javascript">
            jssor_1_slider_init();
          </script>
          <!-- #endregion Jssor Slider End -->
  
  
          <!-- end horizontal slider-->
  
        </div>
      </div>
    </div>
  </section>