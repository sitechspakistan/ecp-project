<!-- Header -->
<header class="header">
  <div class="container">
    <nav class="navbar navbar-expand-lg header-nav">
      <div class="navbar-header">
        <a id="mobile_btn" href="javascript:void(0);">
          <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </a>
        <a href="{{url('/')}}" class="navbar-brand logo">
          <img
            src="{{asset('assets_frontend')}}/img/main-logo.png"
            style="height: 40px"
            class="img-fluid"
            alt="Logo"
          />
        </a>
      </div>
      <div class="main-menu-wrapper">
        <div class="menu-header">
          <a href="{{url('/')}}" class="menu-logo">
            <img
              src="{{asset('assets_frontend')}}/img/main-logo.png"
              class="img-fluid"
              alt="Logo"
            />
          </a>
          <a
            id="menu_close"
            class="menu-close"
            href="javascript:void(0);"
          >
            <i class="fas fa-times"></i
          ></a>
        </div>
        <ul class="main-nav">
          @isset(getConfigurations()['topbar_meta']['menu_id'])
            @foreach(getMenuByID(getConfigurations()['topbar_meta']['menu_id'])->items??[] as $item)
              @if($item->slug=='home')
                <li @if(request()->url() === url($item->slug)) class="active" @endif>
                  <a href="{{url('/')}}" @if($item->new_window==1) target="_blank" @endif>{{$item->title}}</a>
                </li>
              @elseif($item->type=='page')
                <li @if(request()->url() === url($item->slug)) class="active" @endif>
                  <a href="{{route('dynamicPage', $item->slug)}}" @if($item->new_window==1) target="_blank" @endif>
                    {{$item->title}}
                  </a>
                </li>
              @elseif($item->type=='custom')
                <li @if(request()->url() === $item->slug) class="active" @endif>
                  <a href="{{$item->url}}" @if($item->new_window==1) target="_blank" @endif>
                    {{$item->title}}
                  </a>
                </li>
              @endif
            @endforeach
          @endisset
        </ul>
      </div>
      <ul class="nav header-navbar-rht">
        @if(!Auth::check())
          <li class="nav-item">
            <a class="nav-link header-login" href="{{ route('front.login') }}">Register or Sign in</a>
          </li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link header-login dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user"></i> {{ Auth::user()->first_name ?? Auth::user()->name ?? 'User' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('front.dashbaord') }}">
                  <i class="fa-solid fa-house me-2"></i> Dashboard
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                  <i class="fa-solid fa-user me-2"></i> Profile
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('mylisting') }}">
                  <i class="feather-list me-2"></i> My Listing
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('listing.bookmark') }}">
                  <i class="fas fa-solid fa-heart me-2"></i> Bookmarks
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('askquestion') }}">
                  <i class="fa-solid fa-question me-2"></i> Ask Question
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('offers') }}">
                  <i class="fa-solid fa-money-bill me-2"></i> Offers
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('reviews') }}">
                  <i class="fas fa-solid fa-star me-2"></i> Reviews
                </a>
              </li>
              @php
                $show_blog = false;
                $page_membership = array(1,2,3);
                $user_membership = Auth::user()->membership_id;
                $membership_expiry = Auth::user()->expiry_date;

                if(in_array($user_membership, $page_membership)){
                    if(Carbon\Carbon::parse($membership_expiry)->format('Y-m-d') >= Carbon\Carbon::now()->format('Y-m-d')){
                        $show_blog = true;
                    }
                }
              @endphp
              @if($show_blog)
              <li>
                <a class="dropdown-item" href="{{ route('frontblogs') }}">
                  <i class="fa-solid fa-blog me-2"></i> Blogs
                </a>
              </li>
              @endif
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{route('logout')}}" method="POST" id="headerLogoutForm">
                  @csrf
                </form>
                <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('headerLogoutForm').submit();">
                  <i class="fas fa-light fa-circle-arrow-left me-2"></i> Logout
                </a>
              </li>
            </ul>
          </li>
        @endif
        <li class="nav-item">
          <a
          class="nav-link header-login add-listing"
          href="{{ route('add_product') }}"
          >Sell Your Puppy</a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link header-reg position-relative p-0" href="{{route('cartPage')}}">
            <img src="{{asset('assets_frontend')}}/uploads/icons/bag-shopping-solid.svg" style="width: 35px;" alt="">
            <span style="font-size: 8px;" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
              {{ count(getCart()) }}
              <!-- <span class="visually-hidden">unread messages</span> -->
            </span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</header>
<!-- /Header -->