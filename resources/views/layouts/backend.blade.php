<!doctype html>
<html lang="en" class="remember-theme">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>@yield('title') - Webefy Today</title>

    <meta name="author" content="Asif Rasool">
    {{-- <link rel="icon" type="image/jpg" href="{{asset('fav.jpg')}}"> --}}
    {{-- <link rel="shortcut icon" href="{{asset('assets_backend')}}/media/favicons/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets_backend')}}/media/favicons/apple-touch-icon-180x180.png"> --}}
    <!-- END Icons -->

    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="{{asset('assets_backend')}}/css/oneui.min.css">

    <!-- Load and set color theme + dark mode preference (blocking script to prevent flashing) -->
    <script src="{{asset('assets_backend')}}/js/setTheme.js"></script>
    @yield('customStyles')
  </head>

  <body>
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
      <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="content-header">
          <!-- Logo -->
          <a class="fw-semibold text-dual" href="{{route('dashboard')}}">
            <span class="smini-visible">
              <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider">
              {{-- <img src="{{asset('webefy-logo.png')}}" class="img-fluid" alt="Webefy Today"> --}}
              <img src="{{asset('webefy-logo.jpg')}}" class="img-fluid" alt="Webefy Today">
              {{-- <img src="{{asset('fav.jpg')}}" alt="Webefy Today" style="width: 50px;border-radius: 6px;border: 1px solid #fff;"> --}}
            </span>
          </a>
          <!-- END Logo -->

          <!-- Extra -->
          <div class="d-flex align-items-center gap-1">
            <!-- Dark Mode -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <div class="dropdown">
              <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-dark-mode-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="far fa-fw fa-moon" data-dark-mode-icon></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end smini-hide border-0" aria-labelledby="sidebar-dark-mode-dropdown">
                <button type="button" class="dropdown-item d-flex align-items-center gap-2" data-toggle="layout" data-action="dark_mode_off" data-dark-mode="off">
                  <i class="far fa-sun fa-fw opacity-50"></i>
                  <span class="fs-sm fw-medium">Light</span>
                </button>
                <button type="button" class="dropdown-item d-flex align-items-center gap-2" data-toggle="layout" data-action="dark_mode_on" data-dark-mode="on">
                  <i class="far fa-moon fa-fw opacity-50"></i>
                  <span class="fs-sm fw-medium">Dark</span>
                </button>
                <button type="button" class="dropdown-item d-flex align-items-center gap-2" data-toggle="layout" data-action="dark_mode_system" data-dark-mode="system">
                  <i class="fa fa-desktop fa-fw opacity-50"></i>
                  <span class="fs-sm fw-medium">System</span>
                </button>
              </div>
            </div>
            <!-- END Dark Mode -->

            <!-- Options -->
            <div class="dropdown">
              <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-brush"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                <!-- Color Themes -->
                <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="default">
                  <span>Default</span>
                  <i class="fa fa-circle text-default"></i>
                </button>
                <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="{{asset('assets_backend')}}/css/themes/amethyst.min.css">
                  <span>Amethyst</span>
                  <i class="fa fa-circle text-amethyst"></i>
                </button>
                <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="{{asset('assets_backend')}}/css/themes/city.min.css">
                  <span>City</span>
                  <i class="fa fa-circle text-city"></i>
                </button>
                <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="{{asset('assets_backend')}}/css/themes/flat.min.css">
                  <span>Flat</span>
                  <i class="fa fa-circle text-flat"></i>
                </button>
                <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="{{asset('assets_backend')}}/css/themes/modern.min.css">
                  <span>Modern</span>
                  <i class="fa fa-circle text-modern"></i>
                </button>
                <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="{{asset('assets_backend')}}/css/themes/smooth.min.css">
                  <span>Smooth</span>
                  <i class="fa fa-circle text-smooth"></i>
                </button>
                <!-- END Color Themes -->

                <div class="dropdown-divider d-dark-none"></div>

                <!-- Sidebar Styles -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="dropdown-item fw-medium d-dark-none" data-toggle="layout" data-action="sidebar_style_light" href="javascript:void(0)">
                  <span>Sidebar Light</span>
                </a>
                <a class="dropdown-item fw-medium d-dark-none" data-toggle="layout" data-action="sidebar_style_dark" href="javascript:void(0)">
                  <span>Sidebar Dark</span>
                </a>
                <!-- END Sidebar Styles -->

                <div class="dropdown-divider d-dark-none"></div>

                <!-- Header Styles -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="dropdown-item fw-medium d-dark-none" data-toggle="layout" data-action="header_style_light" href="javascript:void(0)">
                  <span>Header Light</span>
                </a>
                <a class="dropdown-item fw-medium d-dark-none" data-toggle="layout" data-action="header_style_dark" href="javascript:void(0)">
                  <span>Header Dark</span>
                </a>
                <!-- END Header Styles -->
              </div>
            </div>
            <!-- END Options -->

            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
              <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
          </div>
          <!-- END Extra -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        @include('backend.includes.sidebar')
        <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
        @include('backend.includes.topbar')
      <!-- END Header -->

      <!-- Main Container -->
      <main id="main-container">
        @yield('content')
      </main>
      <!-- END Main Container -->

      <!-- Footer -->
      <footer id="page-footer" class="bg-body-light">
        <div class="content py-3">
          <div class="row fs-sm">
            <div class="col-sm-8 order-sm-2 py-1 text-center text-sm-end">
              For Help ? Email: <a href="mailto:info@webefytoday.com">info@webefytoday.com</a> | Call: +1 (703) 712-7808
            </div>
            <div class="col-sm-4 order-sm-1 py-1 text-center text-sm-start">
              {{-- <a class="fw-semibold" href="{{url('/')}}" target="_blank">Main IT Servies</a> &copy; <span data-toggle="year-copy"></span> --}}
              &copy; <span data-toggle="year-copy"></span> Webefy Today.
            </div>
          </div>
        </div>
      </footer>
      <!-- END Footer -->
    </div>
    <!-- END Page Container -->
    <script src="{{asset('assets_backend')}}/js/oneui.app.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @yield('customScripts')
  </body>
</html>
