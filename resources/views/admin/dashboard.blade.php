@extends('admin.layout.layout')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome {{ Auth::guard('admin')->user()->name }}</h3>
                        {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}}
                        <!-- https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user -->
                        <!-- https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances -->
                        <!-- https://laravel.com/docs/9.x/eloquent#retrieving-models -->
                        <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">


            <!-- <div class="col-md-6 grid-margin transparent">


                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Total Sections</p>
                                    <p class="fs-30 mb-2">{{ $sectionsCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Categories</p>
                                    <p class="fs-30 mb-2">{{ $categoriesCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Listings</p>
                                    <p class="fs-30 mb-2">{{ $productsCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Total Brands</p>
                                    <p class="fs-30 mb-2">{{ $brandsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Total Orders</p>
                                    <p class="fs-30 mb-2">{{ $ordersCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Coupons</p>
                                    <p class="fs-30 mb-2">{{ $couponsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Users</p>
                                    <p class="fs-30 mb-2">{{ $usersCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Total Subscribers</p>
                                    <p class="fs-30 mb-2">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            <section class="py-5 py-md-6">
                <div class="container">

                    <h4 class="section_heading">Your Listings</h4>

                    @foreach ($newProducts as $product)

                    @php
                    $product_image_path = 'front/images/product_images/small/' . $product->product_image;

                    @endphp

                    <div class="ads-list-archive featured_ads">
                        <div class="row">
                            <!-- Image Block -->

                            <div class="col-lg-4 col-md-4 col-sm-4 no-padding">
                                <!-- Img Block -->
                                <div class="ad-archive-img">

                                    <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                        @if (!empty($product->product_image) && file_exists($product_image_path))
                                        {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                        @else {{-- show the dummy image --}}
                                        <img class="img-fluid"
                                            src="{{ asset('front/images/product_images/small/no-image.png') }}"
                                            alt="Product">
                                        @endif
                                    </a>
                                    <div class="featured-ribbon">
                                        <!-- <span>Featured</span> -->
                                    </div>
                                </div>
                            </div>
                            <!-- Ads Listing -->

                            <!-- Content Block -->
                            <div class="col-lg-8 col-md-8 col-sm-8 no-padding">
                                <!-- Ad Desc -->
                                <div class="ad-archive-desc">

                                    <!-- Title -->
                                    <h3> <a
                                            href="{{ url('product/' . $product['id']) }}">{{ $product->product_name }}</a>
                                    </h3>
                                    <!-- Category -->
                                    <div class="category-title"><span class="padding_cats"><a
                                                href="">{{$product->category_name}}</a></span><span
                                            class="padding_cats"></span></div>
                                    <!-- Short Description -->
                                    <div class="clearfix visible-xs-block"></div>
                                    <p class="hidden-sm">{{$product->description}}</p>
                                    <!-- Ad Features -->
                                    <ul class="short-meta list-inline">
                                        <li>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- Ad History -->
                                    <!-- Price -->
                                    <div class="ad-price-simple">
                                        ${{ $product->product_price }}<span class=""></span>
                                    </div>
                                    <div class="clearfix archive-history">
                                        <div class="last-updated">Posted :
                                            {{date('d M Y', strtotime($product->created_at))}}</div>
                                    </div>
                                    <div>
                                        <a title="Edit Product"
                                            href="{{ url('admin/add-edit-product/' . $product->id) }}">
                                            <i style="font-size: 25px" class="mdi mdi-pencil-box"></i>
                                           
                                        </a>
                                        <a title="Add Multiple Images"
                                            href="{{ url('admin/add-images/' . $product->id) }}">
                                            <i style="font-size: 25px" class="mdi mdi-library-plus"></i>
                                            {{-- Icons from Skydash Admin Panel Template --}}
                                        </a>

                                        <!-- <a title="Product" class="confirmDelete" href="{{ url('admin/delete-product/' . $product->id) }}">
                                        
                                        <i style="font-size: 25px" class="mdi mdi-file-excel-box"></i> 
                                        
                                        </a>  -->
                                        <a href="JavaScript:void(0)" class="confirmDelete" module="product"
                                            moduleid="{{ $product->id }}">
                                            {{-- Check admin/js/custom.js and web.php (routes) --}}
                                            <i style="font-size: 25px" class="mdi mdi-file-excel-box"></i>
                                            {{-- Icons from Skydash Admin Panel Template --}}
                                        </a>
                                    </div>
                                </div>
                                <!-- Ad Desc End -->
                            </div>

                        </div>
                        <!-- Content Block End -->
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection