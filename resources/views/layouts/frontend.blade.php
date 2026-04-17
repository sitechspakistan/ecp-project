<!DOCTYPE html>
<html lang="en">    
    <head>    
        <title>@yield('title')</title>
        
        @yield('seo')

        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        @if (env('APP_ENV') === 'production')        
        <!-- Google Analytics -->
        <script>

        </script>
        <!-- End Google Analytics -->
        @endif

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{asset('assets_frontend')}}/uploads/icons/favicon.png" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets_frontend')}}/css/bootstrap.min.css" />

        <!-- Fontawesome CSS -->
        <link
          rel="stylesheet"
          href="{{asset('assets_frontend')}}/plugins/fontawesome/css/fontawesome.min.css"
        />
        <link rel="stylesheet" href="{{asset('assets_frontend')}}/plugins/fontawesome/css/all.min.css" />

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{asset('assets_frontend')}}/plugins/select2/css/select2.min.css" />

        <!-- Aos CSS -->
        <link rel="stylesheet" href="{{asset('assets_frontend')}}/plugins/aos/aos.css" />

        <!-- Fearther CSS -->
        <link rel="stylesheet" href="{{asset('assets_frontend')}}/css/feather.css" />

        <!-- Owl carousel CSS -->
        <link rel="stylesheet" href="{{asset('assets_frontend')}}/css/owl.carousel.min.css" />

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets_frontend')}}/css/style.css" />
        <link rel="stylesheet" href="{{asset('assets_frontend')}}/css/custom.css" />
        <style>
          .price-body p {
            min-height: 140px;
          }
        </style>

        @yield('customStyles')
        @stack('additionalStyles')
    </head>
<body>

  <div class="main-wrapper">
    @include('frontend.includes.header')

    @if(Session::has('success'))
      <div class="alert alert-success alert-icon" style="position: absolute;top: 2%;right: 1%;z-index: 9999;">
        <em class="icon ni ni-check-circle"></em> <strong>{{Session::get('success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width: 6px;height: 10px;margin-left: 20px;"></button>
      </div>
    @endif

    @if(Session::has('error'))
      <div class="alert alert-danger alert-icon" style="position: absolute;top: 2%;right: 1%;z-index: 9999;">
        <em class="icon fa fa-exclamation-circle"></em> <strong>{{Session::get('error')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width: 6px;height: 10px;margin-left: 20px;"></button>
      </div>
    @endif
      
    @yield('content')
    
    @include('frontend.includes.footer')
  </div>

  @if(Request()->path() !== 'login')
    <div style="z-index: 10000;" class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="LoginModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="col-md-12 col-lg-12 mx-auto">
              <div class="login-wrap" style="border: none; box-shadow: none;">
                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="form-group group-img">
                      <div class="group-img">
                      <i class="feather-mail"></i>
                      <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" placeholder="Email Address" name="email" required  value="{{ old('email') }}" autofocus autocomplete="email">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="pass-group group-img">
                        <i class="feather-lock"></i>
                      <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                      <span class="toggle-password feather-eye"></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <label class="custom_check">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="rememberme">
                        <span class="checkmark"></span>Remember Me
                      </label>
                    </div>									
                    {{-- <div class="col-md-6 col-sm-6">
                      <div class="text-md-end">
                        <a class="forgot-link" href="forgot-password.html">Forgot password?</a>
                      </div>
                    </div>									 --}}
                  </div>
                    {{-- <a class=""></a>	 --}}
                    <button class="btn modal-signin" type="submit">Sign in</button>							
                </form>
                <!-- /Login Form -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

  <!-- scrollToTop start -->
    <div class="progress-wrap active-progress">
      <svg
        class="progress-circle svg-content"
        width="100%"
        height="100%"
        viewBox="-1 -1 102 102"
      >
        <path
          d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
          style="
            transition: stroke-dashoffset 10ms linear 0s;
            stroke-dasharray: 307.919px, 307.919px;
            stroke-dashoffset: 228.265px;
          "
        ></path>
      </svg>
    </div>
  <!-- scrollToTop end -->
  
    <!-- jQuery -->
    <script src="{{asset('assets_frontend')}}/js/jquery-3.6.3.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{asset('assets_frontend')}}/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS -->
    <script src="{{asset('assets_frontend')}}/plugins/select2/js/select2.min.js"></script>

    <!-- Aos -->
    <script src="{{asset('assets_frontend')}}/plugins/aos/aos.js"></script>

    <!-- Top JS -->
    <script src="{{asset('assets_frontend')}}/js/backToTop.js"></script>

    <!-- Fearther JS -->
    <script src="{{asset('assets_frontend')}}/js/feather.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="{{asset('assets_frontend')}}/js/owl.carousel.min.js"></script>

    <!-- Custom JS -->
    <script src="{{asset('assets_frontend')}}/js/script.js"></script>

    <script>
      $(document).on("click", ".sub-button", function () {
        var s_type = $(this).data("type");
        $("#subscriptionSelect").val(s_type).change();
        $("#register").modal("show");
      });
    </script>
  
    @if (env('APP_ENV') === 'production')
      <!--Start of Tawk.to Script-->
      
          <!--End of Tawk.to Script-->
          
          <!-- Google tag (gtag.js) -->
      <script>
          
      </script>
    @endif

    <script>
      $("#subsForm").submit(function(e) {
          e.preventDefault();
          $("#subMsg").text('');
          var va = $("#btnSub").text();
          $("#btnSub").html('subscribing...');
          var data = $(this).serialize();
          jQuery.ajax({
              url: "{{route('saveSubscriber')}}",
              type: 'post',
              dataType: 'html',
              data: data,
              success: function(data) {
                  $("#subsForm").trigger('reset');
                  $("#subMsg").fadeIn(300);
                  $("#subMsg").text(data).delay(5000).fadeOut(300);
                  $("#btnSub").text(va);
              }
          });
      });
    </script>

    @yield('customScripts')
    @stack('additionalScripts')
</body>

</html>