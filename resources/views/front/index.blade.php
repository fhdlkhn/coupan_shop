{{-- This page is rendered by index() method in Front/IndexController.php --}}
@extends('front.layout.layout')


@section('content')
    <!-- Main-Slider -->
    <!-- <div class="default-height ph-item">
        <div class="slider-main owl-carousel">

            {{-- Show the banner dynamically depending on the Admin Panel choice --}} 
            @foreach ($sliderBanners as $banner)
                <div class="bg-image">
                    <div class="slide-content">
                        <h1>
                            <a @if (!empty($banner['link'])) href="{{ url($banner['link']) }}" @else href="javascript:;" @endif>
                                <img src="{{ asset('front/images/banner_images/' . $banner['image']) }}" title="{{ $banner['title'] }}" alt="{{ $banner['title'] }}">
                            </a>
                        </h1>Our company is the world’s largest car sharing
                        <h2>{{ $banner['title'] }}</h2>
                    </div>Browse top online businesses
                </div>
            @endforeach
        </div>
    </div> -->
    
    
    
    
    

    <!-- theme header start -->
    <!--<div class="ly-menu sb-header header-shadow transparent viewport-lg">-->
    <!--    <div class="container">-->
            <!-- sb header -->
    <!--        <div class="sb-header-container">-->
                <!--Logo-->
    <!--            <div class="logo" data-mobile-logo="imgs/Logo.png" data-sticky-logo="imgs/Logo.png"> <a href="index.html"><img src="{{ asset('logo.png')}}" alt=""></a></div>-->
                <!-- Burger menu -->
    <!--            <div class="burger-menu">-->
    <!--                <div class="line-menu line-half first-line"></div>-->
    <!--                <div class="line-menu"></div>-->
    <!--                <div class="line-menu line-half last-line"></div>-->
    <!--            </div>-->
                <!--Navigation menu-->
    <!--            <nav class="sb-menu menu-caret submenu-top-border submenu-scale">-->
    <!--                <ul>-->
    <!--                    <li class="">-->
    <!--                        <a href="#">Start Selling</a>-->
    <!--                    </li>-->
    <!--                    <li class="">-->
    <!--                        <a href="#">How it works</a>-->
    <!--                    </li>-->
    <!--                    <li class="ly-list">-->
    <!--                        <a href="" class="ly-social ly-linkedin">-->
    <!--                            <span>-->
    <!--                                <span class="iconify" data-icon="akar-icons:linkedin-fill"></span>-->
    <!--                            </span>-->
    <!--                        </a>-->
    <!--                        <a href="" class="ly-social ly-facebook">-->
    <!--                            <span>-->
    <!--                                <span class="iconify" data-icon="uil:facebook-messenger"></span>-->
    <!--                            </span>-->
    <!--                        </a>-->
    <!--                        <a href="" class="ly-social ly-telegram">-->
    <!--                            <span>-->
    <!--                                <span class="iconify" data-icon="mingcute:telegram-fill"></span>-->
    <!--                            </span>-->
    <!--                        </a>-->
    <!--                        <a href="" class="ly-social ly-discord">-->
    <!--                            <span>-->
    <!--                                <span class="iconify" data-icon="ic:baseline-discord"></span>-->
    <!--                            </span>-->
    <!--                        </a>-->
                          
    <!--                        <div class="ly-loged-in-drop-down">-->
    <!--                            <div class="selected">-->
    <!--                                <a href="#">-->
    <!--                                    <div class="img-box">-->
    <!--                                     <img src="{{ asset('images/client-1.png') }}" alt="location-img">-->
    <!--                                    </div>-->
    <!--                                    <div class="meta-box">-->
    <!--                                        <h6>Asep Asomething</h6>-->
    <!--                                        <small>asepasomething@gmail.com</small>-->
    <!--                                    </div>-->
    <!--                                </a>-->
    <!--                            </div>-->
    <!--                            <div class="options">-->
    <!--                                <ol class="list">-->
    <!--                                    <li>-->
    <!--                                        <a href="#">-->
    <!--                                            <span class="value">-->
    <!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14 14"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M.906 10.68a1 1 0 0 0 1 1h10.188a1 1 0 0 0 1-1V8.84a1.907 1.907 0 0 1 0-3.68V3.32a1 1 0 0 0-1-1H1.906a1 1 0 0 0-1 1v1.836a1.907 1.907 0 0 1 0 3.688zM9.11 2.328v1.64m0 2.212v1.64m0 2.22v1.64"/></svg>-->
    <!--                                                Booking-->
    <!--                                            </span>-->
    <!--                                            <span class="badge active">2</span>-->
    <!--                                        </a>-->
    <!--                                    </li>-->
    <!--                                    <li>-->
    <!--                                        <a href="#">-->
    <!--                                            <span class="value">-->
    <!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 12H3l9-9l9 9h-2M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7"/><path d="M9 21v-6a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v6"/></g></svg>-->
    <!--                                                My listing-->
    <!--                                            </span>-->
    <!--                                            <span class="badge">0</span>-->
    <!--                                        </a>-->
    <!--                                    </li>-->
    <!--                                    <li>-->
    <!--                                        <a href="#">-->
    <!--                                            <span class="value">-->
    <!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m8.962 18.91l.464-.588zM12 5.5l-.54.52a.75.75 0 0 0 1.08 0zm3.038 13.41l.465.59zm-5.612-.588C7.91 17.127 6.253 15.96 4.938 14.48C3.65 13.028 2.75 11.335 2.75 9.137h-1.5c0 2.666 1.11 4.7 2.567 6.339c1.43 1.61 3.254 2.9 4.68 4.024zM2.75 9.137c0-2.15 1.215-3.954 2.874-4.713c1.612-.737 3.778-.541 5.836 1.597l1.08-1.04C10.1 2.444 7.264 2.025 5 3.06C2.786 4.073 1.25 6.425 1.25 9.137zM8.497 19.5c.513.404 1.063.834 1.62 1.16c.557.325 1.193.59 1.883.59v-1.5c-.31 0-.674-.12-1.126-.385c-.453-.264-.922-.628-1.448-1.043zm7.006 0c1.426-1.125 3.25-2.413 4.68-4.024c1.457-1.64 2.567-3.673 2.567-6.339h-1.5c0 2.198-.9 3.891-2.188 5.343c-1.315 1.48-2.972 2.647-4.488 3.842zM22.75 9.137c0-2.712-1.535-5.064-3.75-6.077c-2.264-1.035-5.098-.616-7.54 1.92l1.08 1.04c2.058-2.137 4.224-2.333 5.836-1.596c1.659.759 2.874 2.562 2.874 4.713zm-8.176 9.185c-.526.415-.995.779-1.448 1.043c-.452.264-.816.385-1.126.385v1.5c.69 0 1.326-.265 1.883-.59c.558-.326 1.107-.756 1.62-1.16z"/></svg>-->
    <!--                                                Wishlist-->
    <!--                                            </span>-->
    <!--                                            <span class="badge active">4</span>-->
    <!--                                        </a>-->
    <!--                                    </li>-->
    <!--                                    <li>-->
    <!--                                        <a href="#">-->
    <!--                                            <span class="value">-->
    <!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11v-.5m4 .5v-.5M8 11v-.5m-4.536 6.328C2 15.657 2 14.771 2 11c0-3.771 0-5.657 1.464-6.828C4.93 3 7.286 3 12 3c4.714 0 7.071 0 8.535 1.172C22 5.343 22 7.229 22 11c0 3.771 0 4.657-1.465 5.828C19.072 18 16.714 18 12 18c-2.51 0-3.8 1.738-6 3v-3.212c-1.094-.163-1.899-.45-2.536-.96"/></svg>-->
    <!--                                                Message-->
    <!--                                            </span>-->
    <!--                                            <span class="badge active">6</span>-->
    <!--                                        </a>-->
    <!--                                    </li>-->
    <!--                                </ol>-->
    <!--                                <div class="list-divider"></div>-->
    <!--                                <ol class="list extra-links">-->
    <!--                                    <li>-->
    <!--                                        <a href="#">-->
    <!--                                            <span class="value">-->
    <!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14 14"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M5 6.5a2.5 2.5 0 1 0 0-5a2.5 2.5 0 0 0 0 5m-4.5 7h9v-.542A4.51 4.51 0 0 0 4.796 8.5A4.51 4.51 0 0 0 .5 12.958zm8.5-7a2.5 2.5 0 0 0 0-5m2.5 12h2v-.542A4.51 4.51 0 0 0 10 8.61"/></svg>-->
    <!--                                                Host your home-->
    <!--                                            </span>-->
    <!--                                        </a>-->
    <!--                                    </li>-->
    <!--                                    <li>-->
    <!--                                        <a href="#">-->
    <!--                                            <span class="value">-->
    <!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3v2m0 16v-8m0-8h12l-2 4l2 4H8m0-8v8"/></svg>-->
    <!--                                                Host an experience-->
    <!--                                            </span>-->
    <!--                                        </a>-->
    <!--                                    </li>-->
    <!--                                    <li>-->
    <!--                                        <a href="#">-->
    <!--                                            <span class="value">-->
    <!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4m0-4h.01"/></g></svg>-->
    <!--                                                Help-->
    <!--                                            </span>-->
    <!--                                        </a>-->
    <!--                                    </li>-->
    <!--                                </ol>-->
    <!--                                <div class="user-profile-info">-->
    <!--                                    <div class="img-box">-->
    <!--                                        <a href="#"><img src="imgs/user-5.png" alt="user-img"></a>-->
    <!--                                    </div>-->
    <!--                                    <div class="meta-box">-->
    <!--                                        <a href="#"><h6>Asep Asomething</h6></a>-->
    <!--                                        <small>asepasomething@gmail.com</small>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <button class="logout-btn">Log Out</button>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </li>-->
    <!--                </ul>-->
    <!--            </nav>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- theme header end -->

    <!-- ly-hero-section-start -->
    <section class="ly-hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-top-box">
                        <h1><span>Discover</span> Forver Discount</h1>
                        <h6>Discover America's Premier Discount</h6>
                    </div>
                    <div class="ly-main-searchbar">
                        <form action="">
                            <div class="ly-search-dropdown">
                                <div class="dropdown">
                                    <span class="ly-search-label">Business Lookup</span>
                                       <input type ="text"  name = "bussiness_name"  class="btn btn-secondary dropdown-toggle">

                                </div>
                            </div>
                            <div class="ly-search-dropdown">
                               
                                <div class="ly-dropdown-sub">
                                    <div class="dropdown">
                                        <span class="ly-search-label">Date</span>
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select your Location
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="#">Action</a></li>
                                          <li><a class="dropdown-item" href="#">Another action</a></li>
                                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="ly-search-dropdown">
                             
                                <div class="ly-dropdown-sub">
                                    <div class="dropdown">
                                        <span class="ly-search-label">Date</span>
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select your Location
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="#">Action</a></li>
                                          <li><a class="dropdown-item" href="#">Another action</a></li>
                                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                            <button class="ly-search-btn" type="submit"><span class="iconify" data-icon="lucide:search"></span></button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="hero-meta-box">
                        <a href="#">
                            <svg width="126" height="16" viewBox="0 0 126 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 7C0.447715 7 0 7.44772 0 8C0 8.55228 0.447715 9 1 9L1 7ZM125.707 8.70711C126.098 8.31658 126.098 7.68342 125.707 7.29289L119.343 0.928932C118.953 0.538408 118.319 0.538408 117.929 0.928932C117.538 1.31946 117.538 1.95262 117.929 2.34315L123.586 8L117.929 13.6569C117.538 14.0474 117.538 14.6805 117.929 15.0711C118.319 15.4616 118.953 15.4616 119.343 15.0711L125.707 8.70711ZM1 9L125 9V7L1 7L1 9Z" fill="#131212"/>
                            </svg> 
                        </a>
                        <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse null.</p>
                        <div class="ly-popular-client">
                            <ul class="popular-client-img">
                                <li> 
                                    <a href="#" class="avatar" data-bs-tooltip="hussnain">
                                       
                                        <img src="{{ asset('images/client-1.png') }}" alt="location-img">
                                    </a>
                                </li>
                                <li> 
                                    <a href="#" class="avatar" data-bs-tooltip="kashif">
                                        <img src="{{ asset('images/client-2.png') }}" alt="location-img">
                                    </a>
                                </li>
                                <li> 
                                    <a href="#" class="avatar" data-bs-tooltip="sheezy">
                                        <img src="{{ asset('images/client-3.png') }}" alt="location-img">
                                    </a>
                                </li>
                                <li> 
                                    <a href="#" class="avatar" data-bs-tooltip="sheezy">
                                          <img src="{{ asset('images/client-4.png') }}" alt="location-img">
                                    </a>
                                </li>
                                <li> 
                                    <a href="#" class="avatar" data-bs-tooltip="sheezy">
                                         <img src="{{ asset('images/client-5.png') }}" alt="location-img">
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="avatar avatar-box" data-bs-tooltip="view more"><span class="iconify" data-icon="icomoon-free:plus"></span></a>
                                </li>
                            </ul>
                        </div>
                        <h6>100+ Popular Clients</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-8">
                    <div class="hero-main-img-box">
                       <img src="{{ asset('images/main-hero.png') }}" alt="location-img">
                        <a href="#" class="ly-explore-btn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_325_2782)"><path d="M19 14.9998H17V8.40976L5.41 19.9998L4 18.5898L15.59 6.99976H9V4.99976H19V14.9998Z" fill="white"/></g><defs><clipPath id="clip0_325_2782"><rect width="24" height="24" fill="white" transform="matrix(1 0 0 -1 0 24)"/></clipPath></defs></svg>
                            <span>Explore</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ly-hero-section-end -->

    <!-- ly-location-section-start -->
    <section class="ly-location-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="ly-heading-content">
                        <h2 class="ly-heading">Browse by location</h2>
                    </div>
                    <div class="owl-carousel owl-theme ly-location-carousel">
                        <div class="item">
                            <a href="#" class="ly-location-card">
                                <span class="location-img-box">
                                   <img src="{{ asset('images/location-1.png') }}" alt="location-img">
                                </span>
                                <h4 class="location-name">Los Angeles</h4>
                                <span class="location-goto">
                                    <span class="arrow-icon">
                                        <span class="iconify" data-icon="ph:arrow-up-right-bold"></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#" class="ly-location-card">
                                <span class="location-img-box">
                                   <img src="{{ asset('images/location-2.png') }}" alt="location-img">
                                </span>
                                <h4 class="location-name">Miami</h4>
                                <span class="location-goto">
                                    <span class="arrow-icon">
                                        <span class="iconify" data-icon="ph:arrow-up-right-bold"></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#" class="ly-location-card">
                                <span class="location-img-box">
                                     <img src="{{ asset('images/location-3.png') }}" alt="location-img">
                                </span>
                                <h4 class="location-name">Honolulu</h4>
                                <span class="location-goto">
                                    <span class="arrow-icon">
                                        <span class="iconify" data-icon="ph:arrow-up-right-bold"></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#" class="ly-location-card">
                                <span class="location-img-box">
                                   <img src="{{ asset('images/location-4.png') }}" alt="location-img">
                                </span>
                                <h4 class="location-name">San Francisco</h4>
                                <span class="location-goto">
                                    <span class="arrow-icon">
                                        <span class="iconify" data-icon="ph:arrow-up-right-bold"></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#" class="ly-location-card">
                                <span class="location-img-box">
                                  <img src="{{ asset('images/location-1.png') }}" alt="location-img">
                                </span>
                                <h4 class="location-name">Los Angeles</h4>
                                <span class="location-goto">
                                    <span class="arrow-icon">
                                        <span class="iconify" data-icon="ph:arrow-up-right-bold"></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#" class="ly-location-card">
                                <span class="location-img-box">
                                    <img src="{{ asset('images/location-2.png') }}" alt="location-img">
                                </span>
                                <h4 class="location-name">Miami</h4>
                                <span class="location-goto">
                                    <span class="arrow-icon">
                                        <span class="iconify" data-icon="ph:arrow-up-right-bold"></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#" class="ly-location-card">
                                <span class="location-img-box">
                                   <img src="{{ asset('images/location-1.png') }}" alt="location-img">
                                </span>
                                <h4 class="location-name">Honolulu</h4>
                                <span class="location-goto">
                                    <span class="arrow-icon">
                                        <span class="iconify" data-icon="ph:arrow-up-right-bold"></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#" class="ly-location-card">
                                <span class="location-img-box">
                                     <img src="{{ asset('images/location-4.png') }}" alt="location-img">
                                </span>
                                <h4 class="location-name">San Francisco</h4>
                                <span class="location-goto">
                                    <span class="arrow-icon">
                                        <span class="iconify" data-icon="ph:arrow-up-right-bold"></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ly-location-section-end -->

    <!-- ly-info-section-start -->
    <section class="ly-info-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ly-info-card">
                       <img src="{{ asset('images/info-2.png') }}" alt="location-img">
                        <h4>Register Business Entity</h4>
                        <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ly-info-card">
                       <img src="{{ asset('images/info-1.png') }}" alt="location-img">
                        <h4>Become a host</h4>
                        <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ly-info-section-end -->

    <!-- ly-features-section-start -->
    <section class="ly-features-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="ly-heading-content">
                        <h2 class="ly-heading">Our features</h2>
                        <p class="ly-desc">Our company stands as the world's leading marketplace for unparalleled discounts, offering the best deals from renowned brands. Explore and secure unbeatable discounts with us.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ly-feature-box">
                        <div class="feature-icon-box">
                           <img src="{{ asset('images/feature-icon.png') }}" alt="location-img">
                        </div>
                        <h3>30+</h3>
                        <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ly-feature-box">
                        <div class="feature-icon-box">
                             <img src="{{ asset('images/feature-icon.png') }}" alt="location-img">
                        </div>
                        <h3>20+</h3>
                        <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ly-feature-box">
                        <div class="feature-icon-box">
                             <img src="{{ asset('images/feature-icon.png') }}" alt="location-img">
                        </div>
                        <h3>90+</h3>
                        <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ly-feature-box">
                        <div class="feature-icon-box">
                             <img src="{{ asset('images/feature-icon.png') }}" alt="location-img">
                        </div>
                        <h3>20+</h3>
                        <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ly-features-section-end -->

    <!-- ly-works-section-start -->
    <section class="ly-works-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="work-process-content">
                        <h3>How does it works</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>1</span>
                            </div>
                            <div class="step-meta">
                                <h6>Explore Discounts and Memberships</h6>
                                <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.</p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>2</span>
                            </div>
                            <div class="step-meta">
                                <h6>Purchase Desired Discounts</h6>
                                <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.</p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>3</span>
                            </div>
                            <div class="step-meta">
                                <h6>Enjoy Exclusive discounts</h6>
                                <p>Lorem ipsum dolor sit amet consectetur. Dolor ultricies molestie consequat tortor. Suspendisse nulla.</p>
                            </div>
                        </div>
                        <button class="ly-button-1">Get Started <span class="iconify" data-icon="tabler:chevron-right"></span></button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="work-img-box">
                       <img src="{{ asset('images/white-card.png') }}" alt="location-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ly-works-section-end -->

    <!-- ly-faq-section-start -->
    <section class="ly-faq-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="ly-heading-content">
                        <h2 class="ly-heading">Frequently Asked Questions</h2>
                    </div>
                    <div class="accordion ly-accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    What services does your marketing agency offer?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    How can your agency help my business?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    What sets your agency apart from competitors?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    What sets your agency apart from competitors?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                    What sets your agency apart from competitors?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-btn-box">
                        <button class="ly-button-1">Get Started <span class="iconify" data-icon="tabler:chevron-right"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
      
     
     
     
 <section class="fr-serv-2 fr-services-content-2">
  <div class="container">
    <div class="row fr-serv2">
      <div class="col-xl-12 col-sm-12 col-md-12 col-xs-12 col-lg-12">
        <div class="heading-panel section-center">
          <div class="heading-meta">
            <h2>Hand Picked Top Services</h2>
            <p>Most viewed and all-time top-selling services</p>
          </div>
        </div>
      </div>
      <div class="row grid" >
          @foreach ($newProducts as $product)
					  <div class="col-xl-3 col-xs-12 col-lg-4 col-sm-6 col-md-6">
					      <div class="fr-latest-grid">
						  <div class="fr-latest-img">
						  	<a href="{{ url('product/' . $product['id']) }}">
						  	    
						  	    @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                           
                                        @endphp
						  	    
						  	     @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                                    @else {{-- show the dummy image --}}
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                                    @endif
						  	    
						  	</a>
							 <div class="fr-latest-btn"> <span class="badge">Featured</span> </div>
						  </div>
						  <div class="fr-latest-details">
						  		<div class="fr-latest-content-service">
									
								  <p>   <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</h3></p>
								  <a href="javascript:void(0)" class="queue">1 Order in queue</a>
								  <span class="price"></i> ${{ $product['product_price'] }}</span>
								   <span class="discount"></i> 30% off</span>
								  
							  </div>
							  <div class="fr-latest-bottom">
							      
							  <p>Starting From<span><span class="currency"></span><span class="price">${{ $product['product_price'] }}</span></span></p>
							  <a href="javascript:void(0)" class="save_service protip" data-pt-position="top" data-pt-scheme="black" data-pt-title="Save Service" data-post-id="355"><i class="fa fa-heart" aria-hidden="true"></i></a>
							  </div>
						  </div>
					  </div>
					  </div>
					  
					   @endforeach
    </div>
  </div>
</section>

<style>
.fr-serv2 {
	background-color: transparent;
}
.fr-serv2 a {
	text-decoration: none;
}
.fr-serv-2 {
	height: auto;
	background-position: center center;
	background-size: cover;
}
.fr-serv-2 .row {
	padding: 0 !important;
}
.fr-serv2 .heading-contents h3 {
	font-size: 28px;
	margin-bottom: 10px !important;
}
.fr-serv2 .heading-contents h3 span {
	font-weight: 500;
}
.fr-serv2 .heading-contents {
	margin-bottom: 50px;
	float: left;
}
.fr-serv2 .fr-top-details {
	background-color: #fff;
}
.fr-serv2 .top-services-2 {
	display: flex !important;
}
.fr-serv2-btn {
	float: right;
	margin-top: 10px;
}

.section-center {
	text-align: center;
	margin-bottom: 50px;
}

.heading-panel {
    margin-bottom: 50px;
    position: relative;
    z-index: 999;
}
.heading-panel h2 {
    font-size: 34px;
    margin-bottom: 0;
    color: #242424;
    font-weight: 600;
    line-height: 1.8;
}


.fr-latest-grid {
	background-color: #fff;
	padding: 15px;
	box-shadow:1px 0px 20px rgba(0,0,0,0.07);
	margin-bottom:30px;
	border-radius:4px;
}

.fr-latest-details p span{
	color: #fe696a;
	font-weight: 500;
	font-size: 18px;
	margin-left: 5px;
	vertical-align: baseline;
}

.fr-latest-img{
	position: relative;
	border-radius: 4px;
	overflow: hidden;
}

.fr-latest-content-service {
	position:relative;	
}
.fr-latest-content-service .fr-latest-profile {
	position:relative;
	overflow:hidden;
	margin-bottom:10px;	
}
.fr-latest-content-service .fr-latest-profile .user-image {
	float: left;
	margin-right: 10px;	
}
.fr-latest-content-service .fr-latest-profile .fr-latest-profile-data {
	display:inline-block;
	line-height: 30px;	
}
.fr-latest-content-service .fr-latest-profile .fr-latest-profile-data .fr-latest-name  {
	color:#242424;
	line-height: 30px;
	font-size:14px;
}

.fr-latest-content-service .fr-latest-profile .fr-latest-profile-data .fr-latest-name i {
	background-color:#DDD;
	color:#FFF;	
	font-size: 8px;
	padding: 3px;
	border-radius: 50%;
	margin-left: 5px;
	vertical-align: middle;
}
.fr-latest-content-service .fr-latest-profile .fr-latest-profile-data .fr-latest-name i.verified {
	background-color:#559250;	
}
.fr-latest-content-service .fr-latest-profile .fr-latest-profile-data .fr-latest-member {
	color:#777;	
}
.fr-latest-content-service p {
	margin-bottom: 10px;
	font-size: 18px;
	line-height: 30px;
	font-weight: 500;
}
.fr-latest-content-service p a {
	color:#242424;
	text-transform:capitalize;
}
.fr-latest-content-service p a:hover {
	color:#fe696a;
}
.fr-latest-content-service span.reviews {
	color: #777;
	font-size: 14px;
	display:block;
}

.fr-latest-content-service span.reviews i{
	color: #fe696a;
	margin-right: 5px;
}
.fr-latest-content-service a.queue {
	font-size:14px;
	color:#777;
	margin-bottom: 5px;
	display: block;	
}


.fr-latest-details .fr-latest-bottom {
    border-top: 1px solid #ebebeb;
    padding-top: 10px;
    margin-top: 15px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}

.fr-latest-content-service img {
	max-width: 30px;
	border-radius: 50%;
}
.fr-latest-details {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    padding-top: 15px;
}

.fr-latest-btn span{
background: #E52D27;
color: #fff;
position: relative;
font-size: 14px;
padding: 7px 12px;
border-radius: 4px;
font-weight: 400;
	display: inline-block;
}

.fr-latest-btn{
	position: absolute;
	top: 10px;
	left: 10px;	
}
</style>

     
     
    <!-- ly-faq-section-end -->

    <!-- ly-footer-start -->
    <!--<section class="ly-footer">-->
    <!--    <div class="container">-->
    <!--        <div class="footer-content">-->
    <!--            <div class="row">-->
    <!--                <div class="col-12">-->
    <!--                    <div class="footer-logo-bar">-->
    <!--                        <a href="#" class="footer-logo">-->
    <!--                            <img src="{{ asset('logo.png') }}" alt="location-img">-->
                             
    <!--                        </a>-->
    <!--                        <div class="meta-box">-->
    <!--                            <span>Ready to get started?</span>-->
    <!--                            <button class="ly-button-2">Get Started</button>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-4">-->
    <!--                    <div class="footer-newsletter-box">-->
    <!--                        <h5>Subscribe to our newsletter</h5>-->
    <!--                        <form action="">-->
    <!--                            <div class="input-group">-->
    <!--                                <input type="email" class="form-control" placeholder="Email address" aria-label="Email address" aria-describedby="button-addon2">-->
    <!--                                <button class="btn ly-button-2" type="button" id="button-addon2"><span class="iconify" data-icon="ic:twotone-chevron-right"></span></button>-->
    <!--                            </div>                                  -->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-3">-->
    <!--                    <div class="footer-extra-links">-->
    <!--                        <h6>Services</h6>-->
    <!--                        <ul>-->
    <!--                            <li>-->
    <!--                                <a href="#">Become a host</a>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <a href="#">Rent out</a>-->
    <!--                            </li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-3">-->
    <!--                    <div class="footer-extra-links">-->
    <!--                        <h6>About</h6>-->
    <!--                        <ul>-->
    <!--                            <li>-->
    <!--                                <a href="#">Our Story</a>-->
    <!--                            </li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-2">-->
    <!--                    <div class="footer-extra-links">-->
    <!--                        <h6>Help</h6>-->
    <!--                        <ul>-->
    <!--                            <li>-->
    <!--                                <a href="#">FAQs</a>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <a href="#">Support</a>-->
    <!--                            </li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-12">-->
    <!--                    <div class="footer-botm-links">-->
    <!--                        <div class="extra-links">-->
    <!--                            <a href="#">Terms & Conditions</a>-->
    <!--                            <a href="#">Privacy Policy</a>-->
    <!--                        </div>-->
    <!--                        <div class="social-links">-->
    <!--                            <a href="#"><span class="iconify" data-icon="ri:facebook-fill"></span></a>-->
    <!--                            <a href="#"><span class="iconify" data-icon="simple-icons:twitter"></span></a>-->
    <!--                            <a href="#"><span class="iconify" data-icon="akar-icons:instagram-fill"></span></a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- ly-footer-end -->

    <!-- ly-copyright-section-start -->
    <!--<div class="ly-copyright-section">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-12">-->
    <!--                <div class="meta-box">-->
    <!--                    <p>© Copyright Company 2023. All rights reserved.</p>-->
    <!--                    <p><span>Cookie preferences</span><span>Do not sell or share my personal information</span></p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- ly-copyright-section-end -->
    
  

    

    <!--<section class="simple-search" style="background: rgba(0, 0, 0, 0) url('{{ asset('home1.jpg') }}') center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">-->
    <!--     <div class="container">-->
		  <!--  <h1>Buy the most exclusive Permanent Discounts on the world's first BOD Exchange</h1>-->
          
    <!--        <div class="search-holder">-->
    <!--           <div id="custom-search-input">-->
				<!--  <form method="get" action="">-->
    <!--                <div class="row">-->
				<!--  <div class="col-md-11 col-sm-11 col-xs-11 no-padding">-->
    <!--                 <input type="text" autocomplete="off" name="ad_title" id="autocomplete-dynamic" class="form-control " placeholder="What Are You Looking For...">-->
				<!--</div>-->
				<!--<div class="col-md-1 col-sm-1 col-xs-1 no-padding">	 -->
    <!--                 <button class="btn btn-theme" type="submit"> <span class="fa fa-search"></span> </button>-->
				<!--</div>-->
    <!--                </div>-->
				<!--	</form>-->

                    <!-- <button class="btn btn-theme">  Sell Your </button> -->
    <!--           </div>-->
    <!--        </div>-->
    <!--     </div>-->
    <!--  </section>-->




    <!-- Main-Slider /- -->



    
    @if (isset($fixBanners[1]['image']))
        <!-- Banner-Layer -->
        <!-- <div class="banner-layer">
            <div class="container">
                <div class="image-banner">
                    <a target="_blank" rel="nofollow" href="{{ url($fixBanners[1]['link']) }}" class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('front/images/banner_images/' . $fixBanners[1]['image']) }}" alt="{{ $fixBanners[1]['alt'] }}" title="{{ $fixBanners[1]['title'] }}">
                    </a>
                </div>
            </div>
        </div> -->
        <!-- Banner-Layer /- -->    
    @endif


<!--     <section class="py-5 py-md-6">-->
<!--     <div class="container">-->

<!--     <h4 class="section_heading">Browse top online businesses</h4>-->
<!--     <p>These are all revenue generating websites, ecommerce stores and other online businesses</p>-->

<!--     @foreach ($newProducts as $product)-->

<!--     @php-->
<!--                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];-->
                                           
<!--                                        @endphp-->
     
<!--    <div class="ads-list-archive featured_ads">-->
<!--      <div class="row">                             -->
    <!-- Image Block -->
                                 
<!--                                 <div class="col-lg-4 col-md-4 col-sm-4 no-padding">-->
                                    <!-- Img Block -->
<!--									 <div class="ad-archive-img">-->
									 
<!--                                     <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">-->
<!--                                                    @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}-->
<!--                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">-->
<!--                                                    @else {{-- show the dummy image --}}-->
<!--                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">-->
<!--                                                    @endif-->
<!--                                                </a>-->
<!--										<div class="featured-ribbon">-->
			                             <!-- <span>Featured</span> -->
<!--		                              </div>-->
<!--									 </div>-->
<!--                                 </div>-->
                                 <!-- Ads Listing -->
                                
                                 <!-- Content Block -->
<!--                                 <div class="col-lg-8 col-md-8 col-sm-8 no-padding">-->
                                    <!-- Ad Desc -->
<!--                                    <div class="ad-archive-desc">-->
                                      
                                       <!-- Title -->
<!--                                       <h3> <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a></h3>-->
                                       <!-- Category -->
<!--                                       <div class="category-title"><span class="padding_cats"><a href="">Business Category</a></span><span class="padding_cats"></span></div>-->
                                       <!-- Short Description -->
<!--                                       <div class="clearfix visible-xs-block"></div>-->
<!--                                       <p class="hidden-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>-->
                                       <!-- Ad Features -->
<!--                                       <ul class="short-meta list-inline">-->
<!--										  <li>-->
<!--                                          <div class="item-stars">-->
<!--                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">-->
<!--                                                            <span style='width:0'></span>-->
<!--                                                        </div>-->
<!--                                                        <span>(0)</span>-->
<!--                                                    </div>-->
<!--                                          </li>-->
<!--                                       </ul>-->
                                       <!-- Ad History -->
									    <!-- Price -->
<!--                                       <div class="ad-price-simple">-->
<!--                                       ${{ $product['product_price'] }}<span class=""></span>-->
<!--									   </div>-->
<!--                                       <div class="clearfix archive-history">-->
<!--                                          <div class="last-updated">Posted : January 24, 2023</div>-->
<!--                                          <div class="ad-meta">-->
<!--										  <a  href="{{ url('product/' . $product['id']) }}" class="btn btn-success"> Add to Cart</a>-->
<!--										   </div>-->
<!--                                       </div>-->
<!--                                    </div>-->
                                    <!-- Ad Desc End -->
<!--                                 </div>-->

<!--</div>-->
                                 <!-- Content Block End -->
<!--                              </div>-->
<!--                              @endforeach-->
<!--     </div>-->
     </section>



    <!-- Top Collection -->
    <!-- <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">TOP COLLECTION</h3>
                <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#men-latest-products">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-best-selling-products">Best Sellers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#discounted-products">Discounted Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-featured-products">Featured Products</a>
                    </li>
                </ul>
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="men-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">

                                    {{-- Show 'New Arrivals'. Show the LATEST 8 products ONLY. Check the index() method in IndexController.php --}} 
                                    @foreach ($newProducts as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                            // dd($product['product_image']);
                                            // dd($product_image_path);
                                            // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                            //     dd('Yes');
                                            // } else {
                                            //     dd('No');
                                            // }
                                        @endphp

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                                    @else {{-- show the dummy image --}}
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                                    @endif
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>



                                                {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp


                                                @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            Rs . {{ $getDiscountPrice }}
                                                        </div>
                                                        <div class="item-old-price">
                                                            Rs . {{ $product['product_price'] }}
                                                        </div>
                                                    </div>
                                                @else {{-- if there's no discount on the price, show the original price --}}
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            Rs . {{ $product['product_price'] }}
                                                        </div>
                                                    </div>
                                                @endif



                                            </div>
                                            <div class="tag new">
                                                <span>NEW</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane show fade" id="men-best-selling-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">


                                    {{-- Show the 'Best Seller' products. Check the index() method in IndexController.php --}} 
                                    @foreach ($bestSellers as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                            // dd($product['product_image']);
                                            // dd($product_image_path);
                                            // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                            //     dd('Yes');
                                            // } else {
                                            //     dd('No');
                                            // }
                                        @endphp

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                                    @else {{-- show the dummy image --}}
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                                    @endif
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>

                                                {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp
                                                @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            Rs . {{ $getDiscountPrice }}
                                                        </div>
                                                        <div class="item-old-price">
                                                            Rs . {{ $product['product_price'] }}
                                                        </div>
                                                    </div>
                                                @else {{-- if there's no discount on the price, show the original price --}}
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            Rs . {{ $product['product_price'] }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tag new">
                                                <span>NEW</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="discounted-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">


                                    {{-- Show the 'Best Seller' products. Check the index() method in IndexController.php --}} 
                                    @foreach ($discountedProducts as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                            // dd($product['product_image']);
                                            // dd($product_image_path);
                                            // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                            //     dd('Yes');
                                            // } else {
                                            //     dd('No');
                                            // }
                                        @endphp

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                                    @else {{-- show the dummy image --}}
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                                    @endif
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>

                                                {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp
                                                @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            Rs . {{ $getDiscountPrice }}
                                                        </div>
                                                        <div class="item-old-price">
                                                            Rs . {{ $product['product_price'] }}
                                                        </div>
                                                    </div>
                                                @else {{-- if there's no discount on the price, show the original price --}}
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            Rs . {{ $product['product_price'] }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tag new">
                                                <span>NEW</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="men-featured-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">


                                    {{-- Show the 'Best Seller' products. Check the index() method in IndexController.php --}} 
                                    @foreach ($featuredProducts as $product)
                                        @php
                                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                            // dd($product['product_image']);
                                            // dd($product_image_path);
                                            // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                            //     dd('Yes');
                                            // } else {
                                            //     dd('No');
                                            // }
                                        @endphp

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                                    @else {{-- show the dummy image --}}
                                                        <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                                    @endif
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                    <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>

                                                {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                                @php
                                                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                                @endphp
                                                @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            Rs . {{ $getDiscountPrice }}
                                                        </div>
                                                        <div class="item-old-price">
                                                            Rs . {{ $product['product_price'] }}
                                                        </div>
                                                    </div>
                                                @else {{-- if there's no discount on the price, show the original price --}}
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            Rs . {{ $product['product_price'] }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="tag new">
                                                <span>NEW</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Top Collection /- -->



    
    @if (isset($fixBanners[1]['image']))
        <!-- Banner-Layer -->
        <!-- <div class="banner-layer">
            <div class="container">
                <div class="image-banner">
                    <a target="_blank" rel="nofollow" href="{{ url($fixBanners[1]['link']) }}" class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('front/images/banner_images/' . $fixBanners[1]['image']) }}" alt="{{ $fixBanners[1]['alt'] }}" title="{{ $fixBanners[1]['title'] }}">
                    </a>
                </div>
            </div>
        </div> -->
        <!-- Banner-Layer /- -->    
    @endif



    <!-- Site-Priorities -->
    <!--<section class="app-priority">-->
    <!--    <div class="container">-->
    <!--        <div class="priority-wrapper u-s-p-b-80">-->
    <!--            <div class="row">-->
    <!--                <div class="col-lg-3 col-md-3 col-sm-3">-->
    <!--                    <div class="single-item-wrapper">-->
    <!--                        <div class="single-item-icon">-->
    <!--                            <i class="ion ion-md-star"></i>-->
    <!--                        </div>-->
    <!--                        <h2>-->
    <!--                            Great Value-->
    <!--                        </h2>-->
    <!--                        <p>We offer competitive prices on our 100 million plus listing range</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-3 col-md-3 col-sm-3">-->
    <!--                    <div class="single-item-wrapper">-->
    <!--                        <div class="single-item-icon">-->
    <!--                            <i class="ion ion-md-cash"></i>-->
    <!--                        </div>-->
    <!--                        <h2>-->
    <!--                            Business with Confidence-->
    <!--                        </h2>-->
    <!--                        <p>Our Protection covers your purchase from click to delivery</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-3 col-md-3 col-sm-3">-->
    <!--                    <div class="single-item-wrapper">-->
    <!--                        <div class="single-item-icon">-->
    <!--                            <i class="ion ion-ios-card"></i>-->
    <!--                        </div>-->
    <!--                        <h2>-->
    <!--                            Safe Payment-->
    <!--                        </h2>-->
    <!--                        <p>Pay with the world’s most popular and secure payment methods</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-3 col-md-3 col-sm-3">-->
    <!--                    <div class="single-item-wrapper">-->
    <!--                        <div class="single-item-icon">-->
    <!--                            <i class="ion ion-md-contacts"></i>-->
    <!--                        </div>-->
    <!--                        <h2>-->
    <!--                            24/7 Help Center-->
    <!--                        </h2>-->
    <!--                        <p>Round-the-clock assistance for a smooth shopping experience</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- Site-Priorities /- -->
@endsection