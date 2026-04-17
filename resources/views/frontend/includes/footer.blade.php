<!-- Footer -->
<footer class="footer">
  <div class="container">
    <div class="stay-tuned">
      <h3>Stay Tuned With Us</h3>
      <p>
        {{getConfigurations()['footer_meta']['nl_text']??''}}
      </p>
      <form id="subsForm" method="post">
        <div class="form-group">
          <div class="group-img">
            <i class="feather-mail"></i>
            <input
              type="email"
              class="form-control"
              placeholder="Enter Email Address"
              name="email"
            />
          </div>
        </div>
        @csrf
        <button class="btn btn-primary" id="btnSub" type="submit">Subscribe</button>
      </form>
      <p id="subMsg" style="margin: 0 auto 0px;position: absolute;left: 50%;bottom: 6%;transform: translate(-50%, 0%);"></p>
    </div>
  </div>

  <!-- Footer Top -->
  <div class="footer-top aos" data-aos="fade-up">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <!-- Footer Widget -->
          <div class="footer-widget">
            <div class="footer-logo">
              <a href="#"
                ><img
                  src="{{asset('assets_frontend')}}/img/main-logo.png"
                  style="width: 200px"
                  alt="logo"
              /></a>
            </div>
            <div class="footer-content">
              <p>
                {{getConfigurations()['footer_meta']['content']??''}}
              </p>
            </div>
            <div class="social-icon">
              <ul>
                @isset(getConfigurations()['social_meta']['facebook'])
                <li><a target="_blank" href="{{getConfigurations()['social_meta']['facebook']}}"><i class="fab fa-facebook"></i></a></li>
                @endisset
                @isset(getConfigurations()['social_meta']['twitter'])
                <li><a target="_blank" href="{{getConfigurations()['social_meta']['twitter']}}"><i class="fab fa-twitter"></i></a></li>
                @endisset
                @isset(getConfigurations()['social_meta']['linkedin'])
                <li><a target="_blank" href="{{getConfigurations()['social_meta']['linkedin']}}"><i class="fab fa-linkedin-in"></i></a></li>
                @endisset
                @isset(getConfigurations()['social_meta']['instagram'])
                <li><a target="_blank" href="{{getConfigurations()['social_meta']['instagram']}}"><i class="fab fa-instagram"></i></a></li>
                @endisset
                @isset(getConfigurations()['social_meta']['youtube'])
                <li><a target="_blank" href="{{getConfigurations()['social_meta']['youtube']}}"><i class="fab fa-youtube"></i></a></li>
                @endisset
                @isset(getConfigurations()['social_meta']['pinterest'])
                <li><a target="_blank" href="{{getConfigurations()['social_meta']['pinterest']}}"><i class="fab fa-pinterest"></i></a></li>
                @endisset
                @isset(getConfigurations()['social_meta']['tiktok'])
                <li><a target="_blank" href="{{getConfigurations()['social_meta']['tiktok']}}"><i class="fab fa-tiktok"></i></a></li>
                @endisset
              </ul>
            </div>
          </div>
          <!-- /Footer Widget -->
        </div>
        @isset(getConfigurations()['footer_meta']['menu_1'])
          <div class="col-lg-2 col-md-6">
            <!-- Footer Widget -->
              <div class="footer-widget footer-menu">
                <h2 class="footer-title">{{getMenuByID(getConfigurations()['footer_meta']['menu_1'])['title']??''}}</h2>
                <ul>
                  @foreach(getMenuByID(getConfigurations()['footer_meta']['menu_1'])->items??[] as $item)
                    <li>
                      @if($item->slug=='home')
                      <a title="" href="{{url('/')}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                      @elseif($item->type=='page')
                      <a title="" href="{{route('dynamicPage', $item->slug)}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                      @elseif($item->type=='custom')
                      <a title="" href="{{$item->url}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                      @endif
                    </li>
                  @endforeach
                </ul>
              </div>
            <!-- /Footer Widget -->
          </div>
        @endisset

        @isset(getConfigurations()['footer_meta']['menu_2'])
          <div class="col-lg-2 col-md-6">
            <!-- Footer Widget -->
            <div class="footer-widget footer-menu">
              <h2 class="footer-title">{{getMenuByID(getConfigurations()['footer_meta']['menu_2'])['title']??''}}</h2>
              <ul>
                @foreach(getMenuByID(getConfigurations()['footer_meta']['menu_2'])->items??[] as $item)
                  <li>
                    @if($item->slug=='home')
                    <a title="" href="{{url('/')}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                    @elseif($item->type=='page')
                    <a title="" href="{{route('dynamicPage', $item->slug)}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                    @elseif($item->type=='custom')
                    <a title="" href="{{$item->url}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                    @endif
                  </li>
                @endforeach
              </ul>
            </div>
            <!-- /Footer Widget -->
          </div>
        @endisset

        @isset(getConfigurations()['footer_meta']['menu_3'])
        <div class="col-lg-2 col-md-6">
          <!-- Footer Widget -->
          <div class="footer-widget footer-menu">
            <h2 class="footer-title">{{getMenuByID(getConfigurations()['footer_meta']['menu_3'])['title']??''}}</h2>
            <ul>
              @foreach(getMenuByID(getConfigurations()['footer_meta']['menu_3'])->items??[] as $item)
                <li>
                  @if($item->slug=='home')
                  <a title="" href="{{url('/')}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                  @elseif($item->type=='page')
                  <a title="" href="{{route('dynamicPage', $item->slug)}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                  @elseif($item->type=='custom')
                  <a title="" href="{{$item->url}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                  @endif
                </li>
              @endforeach
            </ul>
          </div>
          <!-- /Footer Widget -->
        </div>
        @endisset

        <div class="col-lg-3 col-md-6">
          <!-- Footer Widget -->
          <div class="footer-widget">
            <h2 class="footer-title">Communication</h2>
            <div class="footer-contact-info">
              <div class="footer-address">
                <img src="{{asset('assets_frontend')}}/img/call-calling.svg" alt="Callus" />
                <p>
                  <span>Call Us</span> <br />
                  {{getConfigurations()['contact_meta']['phone']??''}}
                </p>
              </div>
              <div class="footer-address">
                <img src="{{asset('assets_frontend')}}/img/sms-tracking.svg" alt="Callus" />
                <p>
                  <span>Send Message</span> <br />
                  {{getConfigurations()['contact_meta']['email']??''}}
                </p>
              </div>
            </div>
          </div>
          <!-- /Footer Widget -->
        </div>
      </div>

      <!-- Footer Counter Section-->
      <div class="footercount">
        <div class="row">
          @isset(getConfigurations()['footer_meta']['unique_vistor'])
            @foreach(getConfigurations()['footer_meta']['unique_vistor'] as $key => $unique_vistor)
              <div class="col-lg-3 col-md-3">
                <div class="vistors-details">
                  <p>{{ ($unique_vistor['heading'])??'' }}</p>
                  <p class="visitors-value">{{ $unique_vistor['content'] }}</p>
                </div>
              </div>
            @endforeach
          @endisset
          <div class="col-lg-3 col-md-3">
            <div class="vistors-details">
              <p>We Accept</p>
              <ul class="d-flex">
                <li>
                  <a href="javascript:void(0)"
                    ><img
                      class="img-fluid"
                      src="{{asset('assets_frontend')}}/img/amex-pay.svg"
                      alt="amex"
                  /></a>
                </li>
                <li>
                  <a href="javascript:void(0)"
                    ><img
                      class="img-fluid"
                      src="{{asset('assets_frontend')}}/img/apple-pay.svg"
                      alt="pay"
                  /></a>
                </li>
                <li>
                  <a href="javascript:void(0)"
                    ><img
                      class="img-fluid"
                      src="{{asset('assets_frontend')}}/img/gpay.svg"
                      alt="gpay"
                  /></a>
                </li>
                <li>
                  <a href="javascript:void(0)"
                    ><img
                      class="img-fluid"
                      src="{{asset('assets_frontend')}}/img/master.svg"
                      alt="paycard"
                  /></a>
                </li>
                <li>
                  <a href="javascript:void(0)"
                    ><img
                      class="img-fluid"
                      src="{{asset('assets_frontend')}}/img/phone.svg"
                      alt="spay"
                  /></a>
                </li>
                <li>
                  <a href="javascript:void(0)"
                    ><img
                      class="img-fluid"
                      src="{{asset('assets_frontend')}}/img/visa.svg"
                      alt="visa"
                  /></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- /Footer  Counter Section-->
    </div>
  </div>
  <!-- /Footer Top -->

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <div class="container">
      <!-- Copyright -->
      <div class="copyright">
        <div class="row">
          <div class="col-md-6">
            <div class="copyright-text">
              <p class="mb-0">
                All Copyrights Reserved &copy; {{date('Y')}} - EasCoastPuppies.
              </p>
            </div>
          </div>
          <div class="col-md-6">
            @isset(getConfigurations()['footer_meta']['menu_4'])
              <!-- Copyright Menu -->
                <div class="copyright-menu">
                  <ul class="policy-menu">
                    @foreach(getMenuByID(getConfigurations()['footer_meta']['menu_4'])->items??[] as $item)
                      <li>
                        @if($item->slug=='home')
                        <a title="" href="{{url('/')}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                        @elseif($item->type=='page')
                        <a title="" href="{{route('dynamicPage', $item->slug)}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                        @elseif($item->type=='custom')
                        <a title="" href="{{$item->url}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                        @endif
                      </li>
                    @endforeach
                  </ul>
                </div>
              <!-- /Copyright Menu -->
            @endisset
          </div>
        </div>
      </div>
      <!-- /Copyright -->
    </div>
  </div>
  <!-- /Footer Bottom -->
</footer>
<!-- /Footer -->