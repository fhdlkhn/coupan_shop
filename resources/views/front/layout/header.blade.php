<?php
// Getting the 'enabled' sections ONLY and their child categories (using the 'categories' relationship method) which, in turn, include their 'subcategories`
$sections = \App\Models\Section::sections();
// dd($sections);

?>
<!-- Header -->
<header>
    <!-- Top-Header -->
    <div class="full-layer-outer-header">
        <div class="container clearfix">
        <nav>
        <div display="none" id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none; position: fixed; top: 10px; right: 10px; width: 500px; z-index: 999;">
            <strong>Error:</strong> <span id="error-text"></span>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
                @if (Session::has('error'))
                <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; top: 10px; right: 10px; width: 500px; z-index: 999;">
                    <strong>Error:</strong>{{ Session::get('error') }}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <script>
                    // Automatically close the error message after 5000 milliseconds (5 seconds)
                    setTimeout(function () {
                        document.getElementById('error-message').style.display = 'none';
                    }, 5000);
                </script>
                @endif
                @if (Session::has('success_message'))
                <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 10px; right: 10px; width: 500px; z-index: 999;">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <script>
                    // Automatically close the error message after 5000 milliseconds (5 seconds)
                    setTimeout(function () {
                        document.getElementById('success-message').style.display = 'none';
                    }, 5000);
                </script>
                @endif
            <!-- <ul class="primary-nav g-nav">
                <li>
                    <a href="tel:+201255845857">
                        <i class="fas fa-phone u-c-brand u-s-m-r-9"></i>
                        Telephone: +201255845857
                    </a>
                </li>
                <li>
                    <a href="mailto:info@bod-exchange.com">
                        <i class="fas fa-envelope u-c-brand u-s-m-r-9"></i>
                        E-mail: info@bod-exchange.com
                    </a>
                </li>
            </ul> -->
        </nav>
            <!-- <nav>
                <ul class="secondary-nav g-nav">
                    <li>



                        <a>
                            {{-- If the user is authenticated/logged in, show 'My Account', if not, show 'Login/Register' --}} 
                            @if (\Illuminate\Support\Facades\Auth::check() || \Illuminate\Support\Facades\Auth::guard('admin')->check()) {{-- Determining If The Current User Is Authenticated: https://laravel.com/docs/9.x/authentication#determining-if-the-current-user-is-authenticated --}}
                                My Account
                            @else
                                Login/Register
                            @endif

                            <i class="fas fa-chevron-down u-s-m-l-9"></i>
                        </a>
                        <ul class="g-dropdown" style="width:200px">
                            <li>
                                <a href="{{ url('cart') }}">
                                <i class="fas fa-cog u-s-m-r-9"></i>
                                My Cart</a>
                            </li>
                            <li>
                                <a href="{{ url('checkout') }}">
                                <i class="far fa-check-circle u-s-m-r-9"></i>
                                Checkout</a>
                            </li>
                            {{-- If the user is authenticated/logged in, show 'My Account' and 'Logout', if not, show 'Customer Login' and 'Vendor Login' --}} 
                            @if (\Illuminate\Support\Facades\Auth::check() || \Illuminate\Support\Facades\Auth::guard('admin')->check()) 
                                @if(Auth::user() && \App\Models\OrdersProduct::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->exists())
                                <li>
                                    <a href="{{ route('user.ordered.listings') }}"> 
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        My Listings Details
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{ url('user/account') }}"> 
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        My Account
                                    </a>
                                </li>

                                
                                <li>
                                    <a href="{{ url('user/orders') }}"> 
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        My Orders
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('user/logout') }}"> 
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Logout
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="#loginModal2" data-bs-toggle="modal">
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Login
                                    </a>
                                </li>
                                <li>
                                    <a href="#registerModal2" data-toggle="modal">
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Register
                                    </a>
                                </li>
                            @endif



                        </ul>
                    </li>
                    @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::guard('admin') == 'vendor')
                        <li>
                            @dd("inif")
                            @if(Auth::user() && \App\Models\UserWallet::where('is_vendor','1')->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->exists())
                            <?php $amount = \App\Models\UserWallet::where('is_vendor','1')->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first()['amount']; ?>
                            {{$amount == null ? 0 : $amount}}$
                            @endif
                        </li>
                    @elseif(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user())
                        <li>
                            @if(Auth::user() && \App\Models\UserWallet::where('is_vendor','0')->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->exists())
                            <?php $amount = \App\Models\UserWallet::where('is_vendor','0')->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first()['amount']; ?>
                            {{$amount == null ? 0 : $amount}}$
                            @endif
                        </li>
                    @endif
                </ul>
            </nav> -->
        </div>
    </div>
      <div class="sb-header sb-header-1 viewport-lg" style="margin-top: 0px;">
        <div class="container">
        <!-- sb header -->
        <div class="sb-header-container">
            <!--Logo-->

            <div class="row">
                
                
                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                    <div class="logo">
                   
                </div>
                    <div class="burger-menu">
                        <div class="line-menu line-half first-line"></div>
                        <div class="line-menu"></div>
                        <div class="line-menu line-half last-line"></div>
                    </div>
                    <!--Navigation menu-->      
                    <nav class="sb-menu menu-caret submenu-top-border submenu-scale mega-menu">
                        <ul class="menu-links"><li class="mega-menu dropdown_menu"> <a href="#">Home  <i class="fa fa-angle-down fa-indicator" aria-hidden="true"></i><span></span></a><span class="dropdown-plus"></span></li></ul>                    </nav>
                </div>
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-pm">
                    <div class="sign-in-up">
                        <ul class="list-sign-in ">




</ul>
                    </div>
                </div>
            </div>   
        </div>
    </div>
    <div class="header-shadow-wrapper">
    </div>
</div>
<div class="ly-menu sb-header header-shadow transparent viewport-lg">
        <div class="container">
            <!-- sb header -->
            <div class="sb-header-container">
                <!--Logo-->
                <div class="logo" data-mobile-logo="imgs/Logo.png" data-sticky-logo="imgs/Logo.png"> <a href="{{route('index')}}"><img src="{{ asset('logo.png')}}" alt=""></a></div>
                <!-- Burger menu -->
                <div class="burger-menu">
                    <div class="line-menu line-half first-line"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu line-half last-line"></div>
                </div>
                <!--Navigation menu-->
                <nav class="sb-menu menu-caret submenu-top-border submenu-scale">
                    <ul>
                        <li class="">
                            <a href="#">Start Selling</a>
                        </li>
                        <li class="">
                            <a href="#">How it works</a>
                        </li>
                        <li class="ly-list">
                            <a href="" class="ly-social ly-linkedin">
                                <span>
                                    <span class="iconify" data-icon="akar-icons:linkedin-fill"></span>
                                </span>
                            </a>
                            <a href="" class="ly-social ly-facebook">
                                <span>
                                    <span class="iconify" data-icon="uil:facebook-messenger"></span>
                                </span>
                            </a>
                            <a href="" class="ly-social ly-telegram">
                                <span>
                                    <span class="iconify" data-icon="mingcute:telegram-fill"></span>
                                </span>
                            </a>
                            <a href="" class="ly-social ly-discord">
                                <span>
                                    <span class="iconify" data-icon="ic:baseline-discord"></span>
                                </span>
                            </a>
                            @if(!(\Illuminate\Support\Facades\Auth::check()) && !(\Illuminate\Support\Facades\Auth::guard('admin')->check()))
                            <a href="{{route('user.login')}}" class="ly-login">
                                <span>
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_325_2916)"><path d="M10.2517 0.699463C7.06445 0.699463 4.47145 3.2925 4.47145 6.47968C4.47145 8.45385 5.46654 10.1998 6.98126 11.243C5.56707 11.731 4.27086 12.5371 3.1819 13.6261C1.29343 15.5146 0.253418 18.0253 0.253418 20.696H1.81564C1.81564 16.0443 5.60002 12.2599 10.2517 12.2599C13.4389 12.2599 16.0319 9.6669 16.0319 6.47968C16.0319 3.29246 13.4389 0.699463 10.2517 0.699463ZM10.2517 10.6977C7.92586 10.6977 6.03368 8.80553 6.03368 6.47972C6.03368 4.15391 7.92586 2.26169 10.2517 2.26169C12.5775 2.26169 14.4697 4.15387 14.4697 6.47972C14.4697 8.80557 12.5775 10.6977 10.2517 10.6977Z" fill="white"></path><path d="M17.0104 15.8591V12.5784H15.4482V15.8591H12.1675V17.4213H15.4482V20.702H17.0104V17.4213H20.2911V15.8591H17.0104Z" fill="white"></path></g><defs><clipPath id="clip0_325_2916"><rect width="20.0356" height="20.0356" fill="white" transform="translate(0.253418 0.679932)"></rect></clipPath></defs></svg> 
                                Log in
                                </span>
                            </a>
                            @endif

                            @if(\Illuminate\Support\Facades\Auth::check() || \Illuminate\Support\Facades\Auth::guard('admin')->check())
                                <div class="ly-loged-in-drop-down">
                                    <div class="selected">
                                        <a href="#">
                                            <div class="img-box">
                                            <img src="{{ (\Illuminate\Support\Facades\Auth::guard('admin')->check() && \Illuminate\Support\Facades\Auth::guard('admin')->user()->image !=null) ? asset('admin/images/photos/'.\Illuminate\Support\Facades\Auth::guard('admin')->image) : asset('admin/images/photos/client-1.png') }}" alt="location-img">
                                            </div>
                                            <div class="meta-box">
                                                @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
                                                <h6>{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</h6>
                                                <small>{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->email}}</small>
                                                @else
                                                <h6>{{\Illuminate\Support\Facades\Auth::user()->name}}</h6>
                                                <small>{{\Illuminate\Support\Facades\Auth::user()->email}}</small>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <div class="options">
                                        <ol class="list">
                                            @if (\Illuminate\Support\Facades\Auth::guard('admin')->check())
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">
                                                    <span class="value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14 14"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.906 10.68a1 1 0 0 0 1 1h10.188a1 1 0 0 0 1-1V8.84a1.907 1.907 0 0 1 0-3.68V3.32a1 1 0 0 0-1-1H1.906a1 1 0 0 0-1 1v1.836a1.907 1.907 0 0 1 0 3.688zM9.11 2.328v1.64m0 2.212v1.64m0 2.22v1.64"/></svg>                                                        Dashboard
                                                    </span>
                                                    <!-- <span class="badge active">4</span> -->
                                                </a>
                                            </li>
                                            @endif
                                            <li>
                                                <a href="#">
                                                    <span class="value">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14 14"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.906 10.68a1 1 0 0 0 1 1h10.188a1 1 0 0 0 1-1V8.84a1.907 1.907 0 0 1 0-3.68V3.32a1 1 0 0 0-1-1H1.906a1 1 0 0 0-1 1v1.836a1.907 1.907 0 0 1 0 3.688zM9.11 2.328v1.64m0 2.212v1.64m0 2.22v1.64"/></svg>
                                                        Wallet
                                                    </span>
                                                    
                                                    @if (\Illuminate\Support\Facades\Auth::guard('admin')->check() && \Illuminate\Support\Facades\Auth::guard('admin')->user()->type == 'vendor')
                                                        @if(\App\Models\UserWallet::where('is_vendor','1')->where('user_id',\Illuminate\Support\Facades\Auth::guard('admin')->user()->id)->exists())
                                                            <?php $amount = \App\Models\UserWallet::where('is_vendor','1')->where('user_id',\Illuminate\Support\Facades\Auth::guard('admin')->user()->id)->first()['amount']; ?>
                                                            <span>{{$amount == null ? 0 : $amount}}$</span>
                                                        @endif
                                                    @elseif(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user())
                                                        @if(Auth::user() && \App\Models\UserWallet::where('is_vendor','0')->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->exists())
                                                            <?php $amount = \App\Models\UserWallet::where('is_vendor','0')->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first()['amount']; ?>
                                                            <span>{{$amount == null ? 0 : $amount}}$</span>
                                                        @endif
                                                    @endif
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('user/orders') }}">
                                                    <span class="value">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14 14"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.906 10.68a1 1 0 0 0 1 1h10.188a1 1 0 0 0 1-1V8.84a1.907 1.907 0 0 1 0-3.68V3.32a1 1 0 0 0-1-1H1.906a1 1 0 0 0-1 1v1.836a1.907 1.907 0 0 1 0 3.688zM9.11 2.328v1.64m0 2.212v1.64m0 2.22v1.64"/></svg>
                                                        Orders
                                                    </span>
                                                    <!-- <span class="badge active">2</span> -->
                                                </a>
                                            </li>
                                            @if(Auth::user() && \App\Models\OrdersProduct::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->exists())
                                            <li>
                                                <a href="{{ route('user.ordered.listings') }}">
                                                    <span class="value">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 12H3l9-9l9 9h-2M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7"/><path d="M9 21v-6a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v6"/></g></svg>
                                                        My listings
                                                    </span>
                                                    <span class="badge">{{\App\Models\OrdersProduct::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->count()}}</span>
                                                </a>
                                            </li>
                                            @endif
                                            
                                            <li>
                                                <a href="{{ url('cart') }}">
                                                    <span class="value">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m8.962 18.91l.464-.588zM12 5.5l-.54.52a.75.75 0 0 0 1.08 0zm3.038 13.41l.465.59zm-5.612-.588C7.91 17.127 6.253 15.96 4.938 14.48C3.65 13.028 2.75 11.335 2.75 9.137h-1.5c0 2.666 1.11 4.7 2.567 6.339c1.43 1.61 3.254 2.9 4.68 4.024zM2.75 9.137c0-2.15 1.215-3.954 2.874-4.713c1.612-.737 3.778-.541 5.836 1.597l1.08-1.04C10.1 2.444 7.264 2.025 5 3.06C2.786 4.073 1.25 6.425 1.25 9.137zM8.497 19.5c.513.404 1.063.834 1.62 1.16c.557.325 1.193.59 1.883.59v-1.5c-.31 0-.674-.12-1.126-.385c-.453-.264-.922-.628-1.448-1.043zm7.006 0c1.426-1.125 3.25-2.413 4.68-4.024c1.457-1.64 2.567-3.673 2.567-6.339h-1.5c0 2.198-.9 3.891-2.188 5.343c-1.315 1.48-2.972 2.647-4.488 3.842zM22.75 9.137c0-2.712-1.535-5.064-3.75-6.077c-2.264-1.035-5.098-.616-7.54 1.92l1.08 1.04c2.058-2.137 4.224-2.333 5.836-1.596c1.659.759 2.874 2.562 2.874 4.713zm-8.176 9.185c-.526.415-.995.779-1.448 1.043c-.452.264-.816.385-1.126.385v1.5c.69 0 1.326-.265 1.883-.59c.558-.326 1.107-.756 1.62-1.16z"/></svg>
                                                        My Cart
                                                    </span>
                                                    <span class="badge active">4</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('checkout') }}">
                                                    <span class="value">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m8.962 18.91l.464-.588zM12 5.5l-.54.52a.75.75 0 0 0 1.08 0zm3.038 13.41l.465.59zm-5.612-.588C7.91 17.127 6.253 15.96 4.938 14.48C3.65 13.028 2.75 11.335 2.75 9.137h-1.5c0 2.666 1.11 4.7 2.567 6.339c1.43 1.61 3.254 2.9 4.68 4.024zM2.75 9.137c0-2.15 1.215-3.954 2.874-4.713c1.612-.737 3.778-.541 5.836 1.597l1.08-1.04C10.1 2.444 7.264 2.025 5 3.06C2.786 4.073 1.25 6.425 1.25 9.137zM8.497 19.5c.513.404 1.063.834 1.62 1.16c.557.325 1.193.59 1.883.59v-1.5c-.31 0-.674-.12-1.126-.385c-.453-.264-.922-.628-1.448-1.043zm7.006 0c1.426-1.125 3.25-2.413 4.68-4.024c1.457-1.64 2.567-3.673 2.567-6.339h-1.5c0 2.198-.9 3.891-2.188 5.343c-1.315 1.48-2.972 2.647-4.488 3.842zM22.75 9.137c0-2.712-1.535-5.064-3.75-6.077c-2.264-1.035-5.098-.616-7.54 1.92l1.08 1.04c2.058-2.137 4.224-2.333 5.836-1.596c1.659.759 2.874 2.562 2.874 4.713zm-8.176 9.185c-.526.415-.995.779-1.448 1.043c-.452.264-.816.385-1.126.385v1.5c.69 0 1.326-.265 1.883-.59c.558-.326 1.107-.756 1.62-1.16z"/></svg>
                                                        Checkout
                                                    </span>
                                                    <span class="badge active">4</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('user/account') }}">
                                                    <span class="value">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11v-.5m4 .5v-.5M8 11v-.5m-4.536 6.328C2 15.657 2 14.771 2 11c0-3.771 0-5.657 1.464-6.828C4.93 3 7.286 3 12 3c4.714 0 7.071 0 8.535 1.172C22 5.343 22 7.229 22 11c0 3.771 0 4.657-1.465 5.828C19.072 18 16.714 18 12 18c-2.51 0-3.8 1.738-6 3v-3.212c-1.094-.163-1.899-.45-2.536-.96"/></svg>
                                                        My Account
                                                    </span>
                                                    <!-- <span class="badge active">6</span> -->
                                                </a>
                                            </li>
                                        </ol>
                                        <div class="user-profile-info">
                                            <div class="img-box">
                                                <a href="#"><img src="{{ (\Illuminate\Support\Facades\Auth::guard('admin')->check() && \Illuminate\Support\Facades\Auth::guard('admin')->user()->image !=null) ? asset('admin/images/photos/'.\Illuminate\Support\Facades\Auth::guard('admin')->image) : asset('admin/images/photos/client-1.png') }}" alt="user-img"></a>
                                            </div>
                                            <div class="meta-box">
                                                 @if(\Illuminate\Support\Facades\Auth::guard('admin')->check() && \Illuminate\Support\Facades\Auth::guard('admin')->user()->type == 'vendor')
                                                    <a href="#"><h6>{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</h6></a>
                                                    <small>{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->email}}</small>
                                                @else
                                                    <a href="#"><h6>{{\Illuminate\Support\Facades\Auth::user()->name}}</h6>
                                                    <small>{{\Illuminate\Support\Facades\Auth::user()->email}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{ url('user/logout') }}"><button class="logout-btn">Log Out</button></a>
                                    </div>
                                </div>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->is_role_set == '0')
    <?php $checkRole = 1;
    $pass = session('data');?>
     @include('front.layout.user_type')
    @else
    <?php $checkRole = 0;
    $pass = null?>
    @endif
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).bind('click', function(e) {
    var $clicked = $(e.target);
    if (! $clicked.parents().hasClass("ly-loged-in-drop-down"))
        $(".ly-loged-in-drop-down .options").hide();
});
    function changePassword(){
        var getPass = document.getElementById('register_pass');
        var eyeIcon = document.getElementById('eyeIcon');
        if(getPass.type == 'password'){
            getPass.type = "text";
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
        else if(getPass.type == "text"){
            getPass.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
    function loginEye(){
        var getPass = document.getElementById('vendor-password');
        var eyeIcon = document.getElementById('loginEye');
        if(getPass.type == 'password'){
            getPass.type = "text";
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
        else if(getPass.type == "text"){
            getPass.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
    function changePassword1(){
        var getPass = document.getElementById('vendorpassword');
        var eyeIcon = document.getElementById('eyeIcon1');
        if(getPass.type == 'password'){
            getPass.type = "text";
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
        else if(getPass.type == "text"){
            getPass.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
    window.onload = function () {
        var role = {!! $checkRole !!};
        if(role == 1){
            openModal();
        }
        };
        function openModal() {
            $('#exampleModalCenter').modal('show');
            $('#registerModal2').modal('hide');
        }
        function closeModal() {
            $('#exampleModalCenter').modal('hide');
        }
    function userLogin(){
        var email = $("#vendor-email").val();
        var pass = $("#vendor-password").val();

        $.ajax({
                type: 'POST',
                url: '{{ url('admin/login') }}',
                data: {
                    email: email, // You can customize this data
                    password: pass, // You can customize this data
                    _token: '{{ csrf_token() }}', // Add CSRF token for Laravel
                },
                success: function (response) {
                    if(response.show_modal == 1){
                        $('#loginModal2').modal('hide');
                        $('#exampleModalCenter').modal('show');
                        $("#passed_email").val(email);
                        $("#passed_email2").val(email);
                        $("#passed_password").val(pass);
                        $("#passed_password2").val(pass);
                    }
                    else if(response.show_modal == 0){
                        console.log(response)
                        window.location.href = "{{url('user/account')}}"
                    }
                    if(response.vendor == 1){
                        window.location.href = "{{url('admin/dashboard')}}"
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown)
                    $('#error-text').text(jqXHR.responseJSON.message);
                    $('#error-message').show();
                    setTimeout(function () {
                    $('#error-message').fadeOut('slow');
                }, 5000);
                }
            });
    }
</script>