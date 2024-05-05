{{-- This page is rendered by index() method in Front/IndexController.php --}}
@extends('front.layout.layout')


@section('content')
   <section class="ly-page-top-section home-banner company-work" style="background-image: url('{{ asset('front/images/banners/banner.png') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-content-wrapper">
                      
                        <h1>Start your car sharing business on Turo</h1>
                        <p>Join top UK hosts who make an average of £6,492 every year for each car they list on Turo*</p>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="snet-company-started-section inventory-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                   
                </div>
                <div class="col-lg-5">
                    <div class="snet-started-company-box">
                        <div class="img-box">
                            <img src="{{asset('front/images/banners/company-started-1.svg')}}" alt="company-started"> 
                        </div>
                        <h4>Tell us about your place</h4>
                        <p>With thousands of PSLs for sale at below market prices, you are sure to find the perfect seats that fit your needs and budget. There are no buyers fees!</p>
                         <button class="ly-button-inv">View inventory <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24" data-icon="tabler:chevron-right" class="iconify iconify--tabler"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 6l6 6l-6 6"></path></svg></button>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="snet-started-company-box">
                        <div class="img-box">
                            <img src="{{asset('front/images/banners/company-started-2.svg')}}" alt="company-started"> 
                        </div>
                        <h4>Make it stand out</h4>
                        <p>With thousands of PSLs for sale at below market prices, you are sure to find the perfect seats that fit your needs and budget. There are no buyers fees! </p>
                        <button class="ly-button-inv">View Inventory <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24" data-icon="tabler:chevron-right" class="iconify iconify--tabler"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 6l6 6l-6 6"></path></svg></button>
                    </div>
                </div>
                <div class="col-lg-1">
                   
                </div>
            </div>
        </div>
    </section>
    <section class="categories-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-content-wrapper">
                        <h2>Marketplace Categories</h2>
                        <p class="cat-description">Our company stands as the world's leading marketplace for unparalleled discounts, offering the best deals from renowned brands. Explore and secure unbeatable discounts with us.</p>
                       
                    </div>
                </div>
                <div class="col-12 cats-container">
                    <div class="row">
                        @foreach($getAllCats as $cats)
                        <div class="col-3">
                            <div class="cat-item">
                                <div class="cat-img"><img src="{{asset('front/images/banners/cat_1.png')}}"></div>
                                <a href="{{route('search.product',['cat'=>$cats->id])}}">{{$cats->category_name}}
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="categories-section colored">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-content-wrapper">
                      
                        <h2>Marketplace Categories</h2>
                        <p class="cat-description">Our company stands as the world's leading marketplace for unparalleled discounts, offering the best deals from renowned brands. Explore and secure unbeatable discounts with us.</p>
                       
                    </div>
                </div>
                <div class="col-12 cats-container">
                    <div class="row">
                        @foreach($getAllCats as $cats)
                        <div class="col-3">
                            <div class="cat-item">
                                <div class="cat-img"><img src="{{asset('front/images/banners/cat_1.png')}}"></div>
                                <a href="{{route('search.product',['cat'=>$cats->id])}}">{{$cats->category_name}}
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                <h6>Find the perfect car</h6>
                                <p>Enter a location and date and browse thousands of cars shared by local hosts. </p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>2</span>
                            </div>
                            <div class="step-meta">
                                <h6>Book your trip</h6>
                                <p>Book on the Turo app or online, choose a protection plan, and  say hi to your host! Cancel for free up to 24 hours before your  trip. </p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>3</span>
                            </div>
                            <div class="step-meta">
                                <h6>Hit the road </h6>
                                <p>Have the car delivered or pick it up from your host. Check in with  the app, grab the keys, and hit the road!</p>
                            </div>
                        </div>
                        <button class="ly-button-1">Get Started <span class="iconify" data-icon="tabler:chevron-right"></span></button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="work-img-box">
                        <img src="{{asset('front/images/banners/work-2.png')}}" alt="main-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ly-works-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="work-img-box">
                        <img src="{{asset('front/images/banners/work-1.png')}}" alt="main-img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="work-process-content">
                        <h3>How does it works</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>1</span>
                            </div>
                            <div class="step-meta">
                                <h6>Find the perfect car</h6>
                                <p>Enter a location and date and browse thousands of cars shared by local hosts. </p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>2</span>
                            </div>
                            <div class="step-meta">
                                <h6>Book your trip</h6>
                                <p>Book on the Turo app or online, choose a protection plan, and  say hi to your host! Cancel for free up to 24 hours before your  trip. </p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>3</span>
                            </div>
                            <div class="step-meta">
                                <h6>Hit the road </h6>
                                <p>Have the car delivered or pick it up from your host. Check in with  the app, grab the keys, and hit the road!</p>
                            </div>
                        </div>
                        <button class="ly-button-1">Get Started <span class="iconify" data-icon="tabler:chevron-right"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="more-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="snet-started-company-box">
                      
                        <h4>Tell us about your place</h4>
                        <p>Share some basic info, like where it is and how many guests can stay.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="snet-started-company-box">
                       
                        <h4>Make it stand out</h4>
                        <p>Add 5 or more photos plus a title and description—we'll help you out </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="snet-started-company-box remove-arrow">
                      
                        <h4>Finish up and publish</h4>
                        <p>Choose if you'd like to start with an experienced guest, set a starting price, and publish your listing.</p>
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

<section class="our-goal">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <button class="btn btn-full">Create an Account to Get Started</button>
                </div>
            </div>

            <div class="goal-details">
                <div class="row">
                    <div class="col-12">
                        <h3>
                            Use our Tools to Get the Edge
                        </h3>
                        <p> Our members have access to metrics that provide valuable insight into the state and trend of the seat license market.</p>
                    </div>
                </div>
            </div>

             <div class="goal-points">
                    <ul>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                               <path d="M0 14.7074C0.0500722 13.4967 0.563312 12.6128 1.60857 12.126C2.6726 11.6391 3.67405 11.8249 4.53779 12.6192C5.86471 13.8298 7.16659 15.0661 8.48098 16.296C8.73134 16.5266 8.9817 16.7636 9.23207 16.9942C9.60761 17.3401 9.94559 17.3272 10.2836 16.9365C13.1314 13.6377 15.9793 10.3388 18.8272 7.03998C20.7549 4.81086 22.6765 2.57533 24.6042 0.346212C24.8796 0.0259364 25.1801 -0.0637408 25.5055 0.057964C25.7997 0.173263 26.0188 0.467917 26 0.788193C25.9875 0.954737 25.9186 1.13409 25.831 1.27501C23.6091 4.95819 21.3746 8.64136 19.1464 12.3245C16.6678 16.4177 14.1892 20.5108 11.7106 24.6039C11.2725 25.3277 10.6716 25.821 9.83293 25.9619C8.88782 26.1156 8.09292 25.8017 7.49206 25.0459C5.33269 22.3428 3.17959 19.6332 1.02648 16.9301C0.625903 16.4241 0.19403 15.9372 0.0751083 15.2583C0.0438132 15.0661 0.0187771 14.8675 0 14.7074Z" fill="#3E7EFF"/>
                               </svg>
                              <p>See New listings</p>
                        </li>
                         <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                               <path d="M0 14.7074C0.0500722 13.4967 0.563312 12.6128 1.60857 12.126C2.6726 11.6391 3.67405 11.8249 4.53779 12.6192C5.86471 13.8298 7.16659 15.0661 8.48098 16.296C8.73134 16.5266 8.9817 16.7636 9.23207 16.9942C9.60761 17.3401 9.94559 17.3272 10.2836 16.9365C13.1314 13.6377 15.9793 10.3388 18.8272 7.03998C20.7549 4.81086 22.6765 2.57533 24.6042 0.346212C24.8796 0.0259364 25.1801 -0.0637408 25.5055 0.057964C25.7997 0.173263 26.0188 0.467917 26 0.788193C25.9875 0.954737 25.9186 1.13409 25.831 1.27501C23.6091 4.95819 21.3746 8.64136 19.1464 12.3245C16.6678 16.4177 14.1892 20.5108 11.7106 24.6039C11.2725 25.3277 10.6716 25.821 9.83293 25.9619C8.88782 26.1156 8.09292 25.8017 7.49206 25.0459C5.33269 22.3428 3.17959 19.6332 1.02648 16.9301C0.625903 16.4241 0.19403 15.9372 0.0751083 15.2583C0.0438132 15.0661 0.0187771 14.8675 0 14.7074Z" fill="#3E7EFF"/>
                               </svg>
                              <p>See New listings</p>
                        </li>
                         <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                               <path d="M0 14.7074C0.0500722 13.4967 0.563312 12.6128 1.60857 12.126C2.6726 11.6391 3.67405 11.8249 4.53779 12.6192C5.86471 13.8298 7.16659 15.0661 8.48098 16.296C8.73134 16.5266 8.9817 16.7636 9.23207 16.9942C9.60761 17.3401 9.94559 17.3272 10.2836 16.9365C13.1314 13.6377 15.9793 10.3388 18.8272 7.03998C20.7549 4.81086 22.6765 2.57533 24.6042 0.346212C24.8796 0.0259364 25.1801 -0.0637408 25.5055 0.057964C25.7997 0.173263 26.0188 0.467917 26 0.788193C25.9875 0.954737 25.9186 1.13409 25.831 1.27501C23.6091 4.95819 21.3746 8.64136 19.1464 12.3245C16.6678 16.4177 14.1892 20.5108 11.7106 24.6039C11.2725 25.3277 10.6716 25.821 9.83293 25.9619C8.88782 26.1156 8.09292 25.8017 7.49206 25.0459C5.33269 22.3428 3.17959 19.6332 1.02648 16.9301C0.625903 16.4241 0.19403 15.9372 0.0751083 15.2583C0.0438132 15.0661 0.0187771 14.8675 0 14.7074Z" fill="#3E7EFF"/>
                               </svg>
                              <p>See New listings</p>
                        </li>
                         <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                               <path d="M0 14.7074C0.0500722 13.4967 0.563312 12.6128 1.60857 12.126C2.6726 11.6391 3.67405 11.8249 4.53779 12.6192C5.86471 13.8298 7.16659 15.0661 8.48098 16.296C8.73134 16.5266 8.9817 16.7636 9.23207 16.9942C9.60761 17.3401 9.94559 17.3272 10.2836 16.9365C13.1314 13.6377 15.9793 10.3388 18.8272 7.03998C20.7549 4.81086 22.6765 2.57533 24.6042 0.346212C24.8796 0.0259364 25.1801 -0.0637408 25.5055 0.057964C25.7997 0.173263 26.0188 0.467917 26 0.788193C25.9875 0.954737 25.9186 1.13409 25.831 1.27501C23.6091 4.95819 21.3746 8.64136 19.1464 12.3245C16.6678 16.4177 14.1892 20.5108 11.7106 24.6039C11.2725 25.3277 10.6716 25.821 9.83293 25.9619C8.88782 26.1156 8.09292 25.8017 7.49206 25.0459C5.33269 22.3428 3.17959 19.6332 1.02648 16.9301C0.625903 16.4241 0.19403 15.9372 0.0751083 15.2583C0.0438132 15.0661 0.0187771 14.8675 0 14.7074Z" fill="#3E7EFF"/>
                               </svg>
                              <p>See New listings</p>
                        </li>
                        

                    </ul>

                 </div>
          <div class="row">
                <div class="col-lg-12">
                  <button class="btn btn-full">Create an Account to Get Started</button>
                </div>
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