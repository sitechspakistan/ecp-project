<div class="">
    <ul class="dashborad-menus">
        {{-- <li @if(request()->path() === 'dashboard') class="active" @endif>
            <a href="{{ route('front.dashbaord') }}">
                <i class="feather-grid"></i> <span>Dashboard</span>
            </a>
        </li> --}}
        <li @if(request()->path() === 'profile') class="active" @endif>
            <a href="{{ route('profile.edit') }}">
                <i class="fa-solid fa-user"></i> <span>Profile</span>
            </a>
        </li>
        <li @if(request()->path() === 'my-listing') class="active" @endif>
            <a href="{{ route('mylisting') }}">
                <i class="feather-list"></i> <span>My Listing</span>
            </a>
        </li>
        <li @if(request()->path() === 'bookmark-listing') class="active" @endif>
            <a href="{{ route('listing.bookmark') }}">
                <i class="fas fa-solid fa-heart"></i> <span>Bookmarks</span>
            </a>
        </li>
        <li>
            <a href="{{ route('askquestion') }}">
                <i class="fa-solid fa-question"></i> <span>Ask Question</span>
            </a>
        </li>
        <li>
            <a href="{{ route('offers') }}">
                <i class="fa-solid fa-money-bill"></i> <span>Offers</span>
            </a>
        </li>
        <li>
            <a href="{{ route('reviews') }}">
                <i class="fas fa-solid fa-star"></i> <span>Reviews</span>
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
            <a href="{{ route('frontblogs') }}">
                <i class="fa-solid fa-blog"></i> <span>Blogs</span>
            </a>
        </li>
        @endif
        <form action="{{route('logout')}}" id="logoutForm" method="POST">@csrf</form>
        <li>
            <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                <i class="fas fa-light fa-circle-arrow-left"></i> <span>Logout</span>
            </a>
        </li>
    </ul>
</div>
