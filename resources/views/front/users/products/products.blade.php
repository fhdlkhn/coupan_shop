@extends('front.layout.layout')


@section('content')
    <section class="ly-page-top-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>My Listings</h1>
                    <p>Join top hosts and showcase your listings to a wide audience.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ly-page-top-section-end -->

    <!-- ly-listing-projects-section-start -->
    <section class="ly-listing-projects-section">
        <div class="container">
            @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="ly-car-show-map">
                        <h2>My Listings</h2>
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-4">
                                    <div class="ly-car-card ly-car-card-grid ly-grid-2">
                                        <div class="car-img-box">
                                            @if (!empty($product['product_image']))
                                                <a href="#"><img src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}" alt="list-img"></a>
                                            @else
                                                <a href="#"><img src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="list-img"></a>
                                            @endif
                                            <span class="card-tag">listed</span>
                                        </div>
                                        <div class="car-detail-box">
                                            <div class="car-title-box">
                                                <div class="meta-box">
                                                    <h5 class="car-title"><a <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a></h5>
                                                    <span>{{ $product['product_code'] }}</span>
                                                    <div class="car-meta-box">
                                                        <div class="sub-meta car-location">
                                                            <span class="iconify" data-icon="ri:route-line" data-flip="vertical"></span>
                                                            <span>{{ $product['category']['category_name'] }}</span>
                                                            <span>{{ $product['section']['name'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="car-price-box" style="height:30px; width:55px;">
                                                    @if ($product['status'] == 1)
                                                        <button type="button" style="border: none; background-color:#FAFAFA; color: green; text-align: center; text-decoration: none; font-size: 100%;">
                                                            <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                                <i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                            </a>
                                                            Edit
                                                        </button>
                                                        
                                                    @else 
                                                        <button type="button" style="border: none; background-color:#FAFAFA; color: green; text-align: center; text-decoration: none; font-size: 100%;">
                                                            <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                                <i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                            </a>
                                                        Edit
                                                        </button>
                                                    @endif
                                                </div> -->
                                                <!-- <div class="car-price-box" style="height:30px; width:55px;">
                                                    @if ($product['status'] == 1)
                                                        <button type="button" style="border: none; background-color:#FAFAFA; margin-left:-2px; color: green; text-align: center; text-decoration: none; font-size: 100%;">
                                                        <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                        Price
                                                        </button>
                                                    @else 
                                                       <button type="button" style="border: none; background-color:#FAFAFA; margin-left:-2px; color: green; text-align: center; text-decoration: none; font-size: 100%;">
                                                        <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                        Price
                                                        </button>
                                                    @endif
                                                    <a title="Edit Product" href="{{ route('edit.user.products' , ['id'=> $product['id']]) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-pencil-box"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a>
                                                    <a title="Add Multiple Images" href="{{ url('admin/add-images/' . $product['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-library-plus"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a>
                                                    <a href="JavaScript:void(0)" class="confirmDelete" module="product" moduleid="{{ $product['id'] }}"> {{-- Check admin/js/custom.js and web.php (routes) --}}
                                                        <i style="font-size: 25px" class="mdi mdi-file-excel-box"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a>
                                                </div> -->
                                            </div>
                                            <div class="car-price-rating-box">
                                                <h6 class="total-price">${{$product['product_price']}} total</h6>
                                                <div class="rating-box">
                                                    <span class="iconify" data-icon="lets-icons:star-fill"></span>
                                                    <strong>4.9</strong>
                                                    <span>(12 reviews)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection