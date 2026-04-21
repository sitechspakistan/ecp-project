<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
      <ul class="nav-main">
        <li class="nav-main-item">
          <a class="nav-main-link" href="{{route('dashboard')}}">
            <i class="nav-main-link-icon si si-speedometer"></i>
            <span class="nav-main-link-name">Dashboard</span>
          </a>
        </li>
        <li class="nav-main-heading">CMS</li>
        @if(check_access(Auth::user()->id,'pages','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
            <i class="nav-main-link-icon si si-list"></i>
            <span class="nav-main-link-name">Pages</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('pages.index')}}">
                <span class="nav-main-link-name">List</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('pages.create')}}">
                <span class="nav-main-link-name">Create</span>
              </a>
            </li>
          </ul>
        </li>
        @endif
        @if(check_access(Auth::user()->id,'categories','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
            <i class="nav-main-link-icon fa fa-cart-shopping"></i>
            <span class="nav-main-link-name">Puppies</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('products-categories.index')}}">
                <span class="nav-main-link-name">Breeds</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('products-categories.create')}}">
                <span class="nav-main-link-name">Add Breed</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('products.index')}}">
                <span class="nav-main-link-name">Puppy</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('products.create')}}">
                <span class="nav-main-link-name">Add Puppy</span>
              </a>
            </li>
          </ul>
        </li>
        @endif
        @if(check_access(Auth::user()->id,'orders','_show')==1)
          <li class="nav-main-item">
            <a class="nav-main-link" href="{{route('orders.index')}}">
              <i class="nav-main-link-icon fa fa-cart-shopping"></i>
              <span class="nav-main-link-name">Orders</span>
            </a>
          </li>
        @endif
        {{-- @if(check_access(Auth::user()->id,'services','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
            <i class="nav-main-link-icon fa fa-gears"></i>
            <span class="nav-main-link-name">Services</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('services.index')}}">
                <span class="nav-main-link-name">List</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('services.create')}}">
                <span class="nav-main-link-name">Create</span>
              </a>
            </li>
          </ul>
        </li>
        @endif --}}
        {{-- @if(check_access(Auth::user()->id,'news','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
            <i class="nav-main-link-icon fa fa-clipboard-check"></i>
            <span class="nav-main-link-name">News</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('news-categories.index')}}">
                <span class="nav-main-link-name">Categories</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('news.index')}}">
                <span class="nav-main-link-name">List</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('news.create')}}">
                <span class="nav-main-link-name">Create</span>
              </a>
            </li>
          </ul>
        </li>
        @endif --}}
        @if(check_access(Auth::user()->id,'blogs','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
            <i class="nav-main-link-icon fa fa-clipboard-check"></i>
            <span class="nav-main-link-name">Blogs</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('blogs-categories.index')}}">
                <span class="nav-main-link-name">Categories</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('blogs.index')}}">
                <span class="nav-main-link-name">List</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('blogs.create')}}">
                <span class="nav-main-link-name">Create</span>
              </a>
            </li>
          </ul>
        </li>
        @endif
        {{-- @if(check_access(Auth::user()->id,'events','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
            <i class="nav-main-link-icon fa fa-clipboard-check"></i>
            <span class="nav-main-link-name">Events</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('events-categories.index')}}">
                <span class="nav-main-link-name">Categories</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('events.index')}}">
                <span class="nav-main-link-name">List</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('events.create')}}">
                <span class="nav-main-link-name">Create</span>
              </a>
            </li>
          </ul>
        </li>
        @endif --}}
        {{-- @if(check_access(Auth::user()->id,'albums','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link" href="{{route('albums.index')}}">
            <i class="nav-main-link-icon fa fa-clipboard-check"></i>
            <span class="nav-main-link-name">Albums</span>
          </a>
        </li>
        @endif --}}
        {{-- @if(check_access(Auth::user()->id,'clients','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link" href="{{route('clients.index')}}">
            <i class="nav-main-link-icon fa fa-boxes-stacked"></i>
            <span class="nav-main-link-name">Clients</span>
          </a>
        </li>
        @endif --}}
        @if(check_access(Auth::user()->id,'testimonials','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link" href="{{route('testimonials.index')}}">
            <i class="nav-main-link-icon fa fa-users"></i>
            <span class="nav-main-link-name">Testimonials</span>
          </a>
        </li>
        @endif
        @if(check_access(Auth::user()->id,'users','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
            <i class="nav-main-link-icon fa fa-users-gear"></i>
            <span class="nav-main-link-name">User Management</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('users.index')}}">
                <span class="nav-main-link-name">Users</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('users.seller')}}">
                <span class="nav-main-link-name">Sellers</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('memberships.index')}}">
                <span class="nav-main-link-name">Memberships</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('usergroups.index')}}">
                <span class="nav-main-link-name">Groups</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{route('logsPage')}}">
                <span class="nav-main-link-name">Activity Logs</span>
              </a>
            </li>
          </ul>
        </li>
        @endif
        @if(check_access(Auth::user()->id,'redirections','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link" href="{{route('redirections.index')}}">
            <i class="nav-main-link-icon fa fa-square-arrow-up-right"></i>
            <span class="nav-main-link-name">Redirections</span>
          </a>
        </li>
        @endif

        <li class="nav-main-heading">Additionals</li>
        @if(check_access(Auth::user()->id,'menu','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link" href="{{route('menuEditor')}}">
            <i class="nav-main-link-icon fa fa-rectangle-list"></i>
            <span class="nav-main-link-name">Menu</span>
          </a>
        </li>
        @endif
        @if(check_access(Auth::user()->id,'configuration','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link" href="{{route('configurationPage')}}">
            <i class="nav-main-link-icon fa fa-cog"></i>
            <span class="nav-main-link-name">Configurations</span>
          </a>
        </li>
        @endif
        @if(check_access(Auth::user()->id,'inbox','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link" href="{{route('inboxPage')}}">
            <i class="nav-main-link-icon fa fa-inbox"></i>
            <span class="nav-main-link-name">Inbox</span>
          </a>
        </li>
        @endif
        @if(check_access(Auth::user()->id,'subscribers','_show')==1)
        <li class="nav-main-item">
          <a class="nav-main-link" href="{{route('subscribersPage')}}">
            <i class="nav-main-link-icon fa fa-inbox"></i>
            <span class="nav-main-link-name">Subscribers</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
    <!-- END Side Navigation -->
  </div>
