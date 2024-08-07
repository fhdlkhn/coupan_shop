<!-- partial:partials/_navbar.html -->
<style>
    nav.navbar.col-lg-12.col-12.fixed-top.d-flex.flex-row {
    height: auto;
    padding: 11px 15px 11px 24px;
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.58);
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(9px);
}


ul.menu-links {
    display: block;
    padding-bottom: 0;
    margin: auto;
}

ul.menu-links li {
    display:inline;
}


ul.menu-links li a {
    font-size: 18px;
    font-weight: 400;
    padding: 0 15px;
    color: #000;
    height: 50px;
    line-height: 50px;
    text-transform: capitalize;
    text-decoration:none;
}
</style>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a href="{{ url('/') }}">

    <img src="{{ url('admin/images/logo.png') }}" alt="logo" style="
    max-width: 80px;">
     </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
        </button>
        <ul class="menu-links">
            @if((!(\Illuminate\Support\Facades\Auth::check()) && !(\Illuminate\Support\Facades\Auth::guard('admin')->check())) || (\Illuminate\Support\Facades\Auth::guard('admin')->check()))
                <li class="">
                    <a href="{{ url('admin/add-edit-product') }}">Start Selling</a>
                </li>
            @endif
            <li class="">
                <a href="{{route('how.it.works')}}">How it works</a>
            </li>
            <li class="">
                <a href="{{route('search.product')}}">Shop</a>
            </li>
            <li class="">
                <a href="{{route('listing.verification')}}">Listing Verification</a>
            </li>
        </ul>
        
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="{{ url('admin/update-admin-details') }}" data-toggle="dropdown" id="profileDropdown">


                    {{-- Show the admin image if exists --}}
                    @if (!empty(Auth::guard('admin')->user()->image)) {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                        <img src="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}" alt="profile"> {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                    @else
                        <img src="{{ url('admin/images/photos/no-image.gif') }}" alt="profile">
                    @endif


                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a href="{{ url('admin/update-admin-details') }}" class="dropdown-item">
                    <i class="ti-settings text-primary"></i>
                    Settings
                    </a>
                    <a href="{{ url('admin/logout') }}" class="dropdown-item">
                    <i class="ti-power-off text-primary"></i>
                    Logout
                    </a>
                </div>
            </li>
            <!-- <li class="nav-item nav-settings d-none d-lg-flex">
                <a class="nav-link" href="#">
                <i class="icon-ellipsis"></i>
                </a>
            </li> -->
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
        </button>
        
    </div>
</nav>