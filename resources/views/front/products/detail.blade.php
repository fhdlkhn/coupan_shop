@extends('front.layout.layout')


@section('content')
<style type="text/css">
        #mw_map {
          height: 400px;
        }
    </style>
    {{-- Star Rating (of a Product) (in the "Reviews" tab) --}}
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            /* position:absolute; */
            position:inherit;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
    </style>


    
    <!-- Page Introduction Wrapper -->
    <!-- <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>{{$productDetails['product_name']}}</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascript:;">{{$productDetails['product_name']}}</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </div> -->
    <!-- Page Introduction Wrapper /- -->
    <!-- Single-Product-Full-Width-Page -->
    <title>{{ $productDetails['product_name'] }}</title>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $productDetails['product_name'] }}">
    <meta property="og:description" content="{{ $productDetails['description'] }}">
    <meta property="og:image" content="{{ $productDetails['product_image'] != null ? url(asset('front/images/product_images/large/' . $productDetails['product_image'])) : url(asset('front/images/product_images/large/no-image.png')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="BOD">
    <div class="page-detail u-s-p-t-80">
        <div class="container">
            <!-- Product-Detail -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    @if (Session::has('error_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error_message') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('success_messages')) <!-- Check AdminController.php, updateAdminPassword() method -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                            {{-- There are TWO ways to: Displaying Unescaped Data: https://laravel.com/docs/9.x/blade#displaying-unescaped-data --}}
                            <strong>Success:</strong> @php echo Session::get('success_messages') . " " .'<a href="/cart" style="text-decoration: underline !important">View Cart</a>'@endphp       {{-- Displaying Unescaped Data: https://laravel.com/docs/9.x/blade#displaying-unescaped-data --}}

                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <section class="ly-card-detail-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="ly-car-show-map ly-car-detail-content-wrapper">
                                <div class="car-detail-info-header">
                                    <div class="title-rating-box">
                                        <h1 class="title">{{$productDetails['product_name']}}</h1>
                                        <!-- <span class="info">Resort</span>
                                        <span class="location">Indonesia</span> -->
                                        <span class="rating-box">
                                            <span class="iconify" data-icon="lets-icons:star-fill"></span>
                                            <strong>{{ $avgRating }}</strong>
                                            <span>({{ count($ratings) }} reviews)</span>
                                        </span>
                                    </div>
                                    <div class="car-action-icons">
                                        <ul>
                                            <li>
                                                <a class="facebook-share" href="https://www.facebook.com/sharer/sharer.php?u=https://coupon-shop.smartdevpk.com/product/{{$productDetails['id']}}" target="_blank" class="icon-box">
                                                    <span class="fb-span">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.325 24h11.49v-9.294H9.689v-3.622h3.126V8.413c0-3.1 1.893-4.788 4.658-4.788 1.325 0 2.463.1 2.794.144v3.24l-1.918.001c-1.504 0-1.794.717-1.794 1.765v2.316h3.587l-.467 3.622h-3.12V24h6.116c.725 0 1.325-.6 1.325-1.326V1.326C24 .6 23.4 0 22.675 0z"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="instagram-share" href="https://www.instagram.com" target="_blank" class="icon-box">
                                                    <span class="fb-span">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.313 3.608 1.288.975.975 1.226 2.242 1.288 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.062 1.366-.313 2.633-1.288 3.608-.975.975-2.242 1.226-3.608 1.288-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.062-2.633-.313-3.608-1.288-.975-.975-1.226-2.242-1.288-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.849c.062-1.366.313-2.633 1.288-3.608.975-.975 2.242-1.226 3.608-1.288C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.756 0 8.333.014 7.052.072 5.77.131 4.555.318 3.424 1.449 2.294 2.579 2.107 3.794 2.048 5.076.988 6.357.976 6.78.976 12s.012 5.643.072 6.924c.059 1.281.246 2.496 1.377 3.627 1.131 1.131 2.346 1.318 3.627 1.377 1.281.059 1.704.072 6.924.072s5.643-.012 6.924-.072c1.281-.059 2.496-.246 3.627-1.377 1.131-1.131 1.318-2.346 1.377-3.627.059-1.281.072-1.704.072-6.924s-.012-5.643-.072-6.924c-.059-1.281-.246-2.496-1.377-3.627C19.072.318 17.857.131 16.576.072 15.295.014 14.872 0 12 0zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162S8.597 18.162 12 18.162 18.162 15.403 18.162 12 15.403 5.838 12 5.838zm0 10.287a4.125 4.125 0 1 1 0-8.25 4.125 4.125 0 0 1 0 8.25zm6.406-11.845a1.44 1.44 0 1 1 0-2.88 1.44 1.44 0 0 1 0 2.88z"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="twitter-share" href="https://twitter.com/intent/tweet?url=https://coupon-shop.smartdevpk.com/product/{{$productDetails['id']}}" target="_blank" class="icon-box">
                                                    <span class="fb-span">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M23.954 4.569c-.885.393-1.833.657-2.828.776 1.018-.611 1.798-1.577 2.165-2.724-.953.565-2.004.974-3.127 1.194-.896-.956-2.177-1.556-3.59-1.556-2.718 0-4.92 2.2-4.92 4.916 0 .385.043.76.126 1.122-4.083-.205-7.705-2.16-10.133-5.144-.424.725-.667 1.565-.667 2.465 0 1.703.87 3.207 2.188 4.087-.807-.026-1.566-.247-2.23-.616v.061c0 2.373 1.687 4.356 3.923 4.807-.41.111-.841.171-1.287.171-.314 0-.62-.031-.922-.088.624 1.948 2.433 3.369 4.568 3.408-1.675 1.312-3.782 2.095-6.085 2.095-.396 0-.787-.023-1.174-.068 2.178 1.394 4.767 2.208 7.548 2.208 9.057 0 14.001-7.507 14.001-14.001 0-.213-.004-.425-.014-.637.961-.692 1.8-1.558 2.463-2.549l-.047-.02z"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails is-ready"> {{-- EasyZoom plugin --}}
                                            <a      href="{{ $productDetails['product_image'] !=null ? asset('front/images/product_images/large/' . $productDetails['product_image']) : asset('front/images/product_images/large/no-image.png')}}">
                                                <img src="{{ $productDetails['product_image'] !=null ? asset('front/images/product_images/large/' . $productDetails['product_image']) : asset('front/images/product_images/large/no-image.png')}}" alt="" width="500" height="500" />
                                            </a>
                                        </div>
                                        <div class="thumbnails" style="margin-top: 30px"> {{-- EasyZoom plugin --}}
                                            <a      href="{{ $productDetails['product_image'] !=null ? asset('front/images/product_images/large/' . $productDetails['product_image']) : asset('front/images/product_images/large/no-image.png')}}" data-standard="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}">
                                                <img src="{{ $productDetails['product_image'] !=null ? asset('front/images/product_images/large/' . $productDetails['product_image']) : asset('front/images/product_images/large/no-image.png')}}" width="120" height="120" alt="" />
                                            </a>
                                            {{-- Show the product Alternative images (`image` in `products_images` table) --}}
                                            @foreach ($productDetails['images'] as $image)
                                                {{-- EasyZoom plugin --}}
                                                <a      href="{{ $image['image'] != null ? asset('front/images/product_images/large/' . $image['image']) : asset('front/images/product_images/large/no-image.png')}}" data-standard="{{ asset('front/images/product_images/small/' . $image['image']) }}">
                                                    <img src="{{ $image['image'] != null ? asset('front/images/product_images/small/' . $image['image']) : asset('front/images/product_images/small/no-image.png')}}" width="120" height="120" alt="" />
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        @php
                                            $getDiscountPrice = \App\Models\Product::getDiscountPrice($productDetails['id']);
                                        @endphp
                                        <div class="ly-reserve-sidebar">
                                            <!-- <h3 class="stay-price">${{ $getDiscountPrice }}</h3> -->
                                            <h3 class="stay-price">Price: {{round($productDetails['product_price'],2)}} {{Session::get('currency') != null ? Session::get('currency') : 'USD'}}</h3>
                                            <ul class="reserve-services-list-box">
                                                <li class="service-list-item">
                                                    <span>Listing Discount(On Membership)</span>
                                                    <strong>{{ $productDetails['product_discount'] }}%</strong>
                                                </li>
                                                <li class="service-list-item">
                                                    <span>Category</span>
                                                    <strong>{{ $productDetails['category']['category_name'] }}</strong>
                                                </li>
                                                <li class="service-list-item">
                                                    <span>Discount Type</span>
                                                    <strong>{{ ucfirst($productDetails['product_type']) }}</strong>
                                                </li>
                                                <li class="service-list-item">
                                                    <span>Validity Through</span>
                                                    <strong>{{ $productDetails['avg_customer'] == 'permanent' ? ucfirst($productDetails['avg_customer']) :  $productDetails['avg_customer'] . 'Years'}}</strong>
                                                </li>
                                                <li class="service-list-item">
                                                    <span>Validity Date</span>
                                                    <strong>{{ $productDetails['validity'] != null ?  $productDetails['validity'] : 'NULL'}}</strong>
                                                </li>
                                                <li class="service-list-item">
                                                    <span>Annual Savings</span>
                                                    <strong>{{ $productDetails['gross_sale'] }} %</strong>
                                                </li>
                                                <li class="service-list-item">
                                                    <span>Availability</span>
                                                    @if ($productDetails['product_units'] > 0)
                                                        <strong>In Stock</strong>
                                                    @else
                                                        <strong style="color: red">Out of Stock (Sold-out)</strong>
                                                    @endif
                                                </li>
                                                <li class="service-list-item">
                                                    <!--<span>Discount Type</span>-->
                                                    <!--<strong>{{ ucfirst($productDetails['product_type']) }}</strong>-->
                                                </li>
                                                
                                                
                                            </ul>
                                            <form action="{{ url('cart/add') }}" method="Post" class="post-form" >
                                                @csrf 
                                                <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}"> {{-- Add to Cart <form> --}} 
                                                <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                                                    <div class="quantity-wrapper u-s-m-b-22">
                                                        <!-- <span>Quantity:</span> -->
                                                        <div class="quantity">
                                                            <input class="quantity-text-field" type="number" name="quantity" value="1" max="{{$productDetails['product_units']}}" title=" Available stock is{{$productDetails['product_units']}}">
                                                        </div>
                                                        <button class="button button-outline-secondary" type="submit">Add to Cart</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="car-host-box-meta">
                                                    <p>Hosted by:</p>
                                                    <div class="host-box-cont">
                                                        <div class="img-box">
                                                            <img src="{{asset('front/images/banners/user_image.png')}}" alt="host-img">
                                                        </div>
                                                        <div class="meta-box">
                                                            <span>{{isset($getUser->name) ? $getUser->name : ''}}</span>
                                                            <small>{{date('d M Y', strtotime($productDetails['created_at']))}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- <a href="#" class="ly-report-list">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.15039 22.75C4.74039 22.75 4.40039 22.41 4.40039 22V2C4.40039 1.59 4.74039 1.25 5.15039 1.25C5.56039 1.25 5.90039 1.59 5.90039 2V22C5.90039 22.41 5.56039 22.75 5.15039 22.75Z" fill="#5E5D65"/>
                                                    <path d="M16.3504 16.75H5.15039C4.74039 16.75 4.40039 16.41 4.40039 16C4.40039 15.59 4.74039 15.25 5.15039 15.25H16.3504C17.4404 15.25 17.9504 14.96 18.0504 14.71C18.1504 14.46 18.0004 13.9 17.2204 13.13L16.0204 11.93C15.5304 11.5 15.2304 10.85 15.2004 10.13C15.1704 9.37 15.4704 8.62 16.0204 8.07L17.2204 6.87C17.9604 6.13 18.1904 5.53 18.0804 5.27C17.9704 5.01 17.4004 4.75 16.3504 4.75H5.15039C4.73039 4.75 4.40039 4.41 4.40039 4C4.40039 3.59 4.74039 3.25 5.15039 3.25H16.3504C18.5404 3.25 19.2404 4.16 19.4704 4.7C19.6904 5.24 19.8404 6.38 18.2804 7.94L17.0804 9.14C16.8304 9.39 16.6904 9.74 16.7004 10.09C16.7104 10.39 16.8304 10.66 17.0404 10.85L18.2804 12.08C19.8104 13.61 19.6604 14.75 19.4404 15.3C19.2104 15.83 18.5004 16.75 16.3504 16.75Z" fill="#5E5D65"/>
                                                </svg>
                                                Report this listing
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2 class="title title-main">Listing Detail</h2>
                                    <div class="col-lg-6">
                                        <div class="car-detail-content">
                                            
                                            <!-- <div class="car-host-box-grid">
                                                <div class="car-host-box-meta">
                                                    <p>Hosted by:</p>
                                                    <div class="host-box-cont">
                                                        <div class="img-box">
                                                            <img src="{{asset('front/images/banners/user_image.png')}}" alt="host-img">
                                                        </div>
                                                        <div class="meta-box">
                                                            <span>{{isset($getUser->name) ? $getUser->name : ''}}</span>
                                                            <small>{{date('d M Y', strtotime($productDetails['created_at']))}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="ly-over-view-wrapper">
                                                <div class="ly-over-view-box">
                                                    <span class="ly-overview">Overview</span>
                                                </div>
                                                <p>{{ $productDetails['description'] }}</p>
                                                <!-- <button class="ly-read-more">Read More</button> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if( isset($productDetails['address']) && $productDetails['address'] != null )
                                        <div id="mw_map">
                                        @endif
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="detail-tabs-wrapper mt-5">
                                            <div class="detail-nav-wrapper mb-4">
                                                <ul class="nav nav-tabs justify-content-center">
                                                    <!-- <li class="nav-item">
                                                        <a class="nav-link active " data-bs-toggle="tab" href="#video">Listing Video</a>
                                                    </li> -->
                                                    <!-- <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#detail">Listing Details</a>
                                                    </li> -->
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#review">Reviews ({{ count($ratings) }})</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content">
                                                <!-- <div class="tab-pane fade show active" id="video">
                                                    <div class="description-whole-container">
                                                        @if ($productDetails['product_video'])
                                                            <video controls>
                                                                <source src="{{ url('front/videos/product_videos/' . $productDetails['product_video']) }}" type="video/mp4">
                                                            </video>
                                                        @else
                                                            Listing Video does not exist    
                                                        @endif
                                                    </div>
                                                </div> -->
                                                <!-- <div class="tab-pane fade " id="detail">
                                                    <div class="specification-whole-container">
                                                        <div class="spec-table mb-4">
                                                            <h4 class="spec-heading">Listing Details</h4>
                                                            <table class="table">
                                                             
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="tab-pane fade" id="review">
                                                    <div class="review-whole-container">
                                                        <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="total-score-wrapper">
                                                                    <h6 class="review-h6">Average Rating</h6>
                                                                    <div class="circle-wrapper">
                                                                        <h1>{{ $avgRating }}</h1>
                                                                    </div>
                                                                    <h6 class="review-h6">Based on {{ count($ratings) }} Reviews</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="total-star-meter">
                                                                    <div class="star-wrapper">
                                                                        <span>5 Stars</span>
                                                                        <div class="star">
                                                                            <span style='width:0'></span>
                                                                        </div>
                                                                        <span>({{ $ratingFiveStarCount }})</span>
                                                                    </div>
                                                                    <div class="star-wrapper">
                                                                        <span>4 Stars</span>
                                                                        <div class="star">
                                                                            <span style='width:0'></span>
                                                                        </div>
                                                                        <span>({{ $ratingFourStarCount }})</span>
                                                                    </div>
                                                                    <div class="star-wrapper">
                                                                        <span>3 Stars</span>
                                                                        <div class="star">
                                                                            <span style='width:0'></span>
                                                                        </div>
                                                                        <span>({{ $ratingThreeStarCount }})</span>
                                                                    </div>
                                                                    <div class="star-wrapper">
                                                                        <span>2 Stars</span>
                                                                        <div class="star">
                                                                            <span style='width:0'></span>
                                                                        </div>
                                                                        <span>({{ $ratingTwoStarCount }})</span>
                                                                    </div>
                                                                    <div class="star-wrapper">
                                                                        <span>1 Star</span>
                                                                        <div class="star">
                                                                            <span style='width:0'></span>
                                                                        </div>
                                                                        <span>({{ $ratingOneStarCount }})</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                                            <div class="col-lg-12">


                                                                {{-- Star Rating (of a Product) (in the "Reviews" tab). --}}
                                                                <form method="POST" action="{{ url('add-rating') }}" name="formRating" id="formRating">
                                                                    @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}

                                                                    <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                                                                    <div class="your-rating-wrapper">
                                                                        <h6 class="review-h6">Your Review matters.</h6>
                                                                        <h6 class="review-h6">Have you used this product before?</h6>
                                                                        <div class="star-wrapper u-s-m-b-8">


                                                                            {{-- Star Rating (of a Product) (in the "Reviews" tab). --}}
                                                                            <div class="rate">
                                                                                <input style="display: none" type="radio" id="star5" name="rating" value="5" />
                                                                                <label for="star5" title="text">5 stars</label>

                                                                                <input style="display: none" type="radio" id="star4" name="rating" value="4" />
                                                                                <label for="star4" title="text">4 stars</label>

                                                                                <input style="display: none" type="radio" id="star3" name="rating" value="3" />
                                                                                <label for="star3" title="text">3 stars</label>

                                                                                <input style="display: none" type="radio" id="star2" name="rating" value="2" />
                                                                                <label for="star2" title="text">2 stars</label>

                                                                                <input style="display: none" type="radio" id="star1" name="rating" value="1" />
                                                                                <label for="star1" title="text">1 star</label>
                                                                            </div>


                                                                        </div>
                                                                            <textarea class="text-area u-s-m-b-8" id="review-text-area" placeholder="Your Review" name="review" required></textarea>
                                                                            <button class="button button-outline-secondary">Submit Review</button>
                                                                        {{-- </form> --}}
                                                                    </div>
                                                                </form>


                                                            </div>
                                                        </div>
                                                        <!-- Get-Reviews -->
                                                        <div class="get-reviews u-s-p-b-22">
                                                            <!-- Review-Options -->
                                                            <div class="review-options u-s-m-b-16">
                                                                <div class="review-option-heading">
                                                                    <h6>Reviews
                                                                        <span> ({{ count($ratings) }}) </span>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                            <!-- Review-Options /- -->
                                                            <!-- All-Reviews -->
                                                            <div class="reviewers">

                                                                {{-- Display/Show user's Ratings --}}
                                                                @if (count($ratings) > 0) {{-- if there're any ratings for the product --}}
                                                                    @foreach($ratings as $rating)
                                                                        <div class="review-data">
                                                                            <div class="reviewer-name-and-date">
                                                                                <h6 class="reviewer-name">{{ $rating['user']['name'] }}</h6>
                                                                                <h6 class="review-posted-date">{{ date('d-m-Y H:i:s', strtotime($rating['created_at'])) }}</h6>
                                                                            </div>
                                                                            <div class="reviewer-stars-title-body">
                                                                                <div class="reviewer-stars">


                                                                                    {{-- Show/Display the Star Rating of the Review/Rating --}}
                                                                                    @php
                                                                                        $count = 0;

                                                                                        // Show the stars
                                                                                        while ($count < $rating['rating']): // while $count is 0, 1, 2, 3, 4, or 5 Stars
                                                                                    @endphp

                                                                                            <span style="color: gold">&#9733;</span> {{-- "BLACK STAR" HTML Entity --}} {{-- HTML Entities: https://www.w3schools.com/html/html_entities.asp --}}

                                                                                    @php
                                                                                            $count++;
                                                                                        endwhile;
                                                                                    @endphp


                                                                                </div>
                                                                                <p class="review-body">
                                                                                    {{ $rating['review'] }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif

                                                            </div>
                                                            <!-- All-Reviews /- -->
                                                            <!-- Pagination-Review -->

                                                            <!-- Pagination-Review /- -->
                                                        </div>
                                                        <!-- Get-Reviews /- -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             <section class="fr-serv-2 fr-services-content-2">
                <div class="container">
                    <div class="sec-maker-header text-center">
                        <h3 class="sec-maker-h3">Similar Listing</h3>
                    </div>
                    <div class="row grid" >
                        @foreach ($similarProducts as $product)
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
        </div>
    </div>
    
    <!-- Single-Product-Full-Width-Page /- -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZIwomjpgXMHZdAmwubQ-0iNghQHfbCKU&libraries=places"></script>
    <script type="text/javascript">
    // Initialize map
    
        var chk_container = document.getElementById('mw_map'); 
    var map_lat = {!! isset($productDetails['latitude']) ? $productDetails['latitude'] : 40.7128 !!};
    var map_long = {!! isset($productDetails['longitude']) ? $productDetails['longitude'] :  -74.0060!!};

    var map_center_positionr = new google.maps.LatLng(map_lat, map_long);
    var mapOptions = {
        zoom: 13,
        center: map_center_positionr,
        disableDefaultUI: false
    };
    var map = new google.maps.Map(chk_container, mapOptions);
    
    var get_markers = new google.maps.Marker({
        position: map_center_positionr,
        map: map,
      //  icon: admin_varible.p_path + 'libs/images/map-marker.png',
        labelAnchor: new google.maps.Point(1, 1),
        draggable: true,
    });
</script>
@endsection