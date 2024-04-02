@extends('front.layout.layout')


@section('content')
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
                    @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                            {{-- There are TWO ways to: Displaying Unescaped Data: https://laravel.com/docs/9.x/blade#displaying-unescaped-data --}}
                            <strong>Success:</strong> @php echo Session::get('success_message') . " " .'<a href="/cart" style="text-decoration: underline !important">View Cart</a>'@endphp       {{-- Displaying Unescaped Data: https://laravel.com/docs/9.x/blade#displaying-unescaped-data --}}

                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails"> {{-- EasyZoom plugin --}}
                        <a      href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}">
                            <img src="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}" alt="" width="500" height="500" />
                        </a>
                    </div>
                    <div class="thumbnails" style="margin-top: 30px"> {{-- EasyZoom plugin --}}
                        <a      href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}" data-standard="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}">
                            <img src="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}" width="120" height="120" alt="" />
                        </a>
                        {{-- Show the product Alternative images (`image` in `products_images` table) --}}
                        @foreach ($productDetails['images'] as $image)
                            {{-- EasyZoom plugin --}}
                            <a      href="{{ asset('front/images/product_images/large/' . $image['image']) }}" data-standard="{{ asset('front/images/product_images/small/' . $image['image']) }}">
                                <img src="{{ asset('front/images/product_images/small/' . $image['image']) }}" width="120" height="120" alt="" />
                            </a>
                        @endforeach
                    </div>
                </div> -->
            </div>
            <!-- Product-Detail /- -->
            <!-- Detail-Tabs -->
            <!-- <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="detail-tabs-wrapper u-s-p-t-80">
                        <div class="detail-nav-wrapper u-s-m-b-30">
                            <ul class="nav single-product-nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#video">Listing Video</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#detail">Listing Details</a>
                                </li>
                                <li class="nav-item">
                                    {{-- <a class="nav-link" data-toggle="tab" href="#review">Reviews (15)</a> --}}
                                    <a class="nav-link" data-toggle="tab" href="#review">Reviews {{ count($ratings) }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            
                            <div class="tab-pane fade active show" id="video">
                                <div class="description-whole-container">
                                    @if ($productDetails['product_video'])
                                        <video controls>
                                            <source src="{{ url('front/videos/product_videos/' . $productDetails['product_video']) }}" type="video/mp4">
                                        </video>
                                    @else
                                        Listing Video does not exist    
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="detail">
                                <div class="specification-whole-container">
                                    <div class="spec-table u-s-m-b-50">
                                        <h4 class="spec-heading">Listing Details</h4>
                                        <table>



                                            @php
                                                $productFilters = \App\Models\ProductsFilter::productFilters(); // Get ALL the (enabled/active) Filters
                                                // dd($productFilters);
                                            @endphp

                                            @foreach ($productFilters as $filter) {{-- show ALL the (enabled/active) Filters --}}
                                                @php
                                                    // echo '<pre>', var_dump($product), '</pre>';
                                                    // exit;
                                                    // echo '<pre>', var_dump($filter), '</pre>';
                                                    // exit;
                                                    // dd($filter);
                                                @endphp

                                                @if (isset($productDetails['category_id'])) {{-- which comes from the AJAX call (passed in through the categoryFilters() method in Admin/FilterController.php, and ALSO may come from the if condition above there (in this page) in case of 'Edit Product' (not 'Add a Product') from addEditProduct() method in Admin/ProductsController --}}
                                                    @php
                                                        // dd($filter);

                                                        // Firstly, for every filter in the `products_filters` table, Get the filter's (from the foreach loop) `cat_ids` using filterAvailable() method, then check if the current category id (using the $productDetails['category_id'] variable and depending on the URL) exists in the filter's `cat_ids`. If it exists, then show the filter, if not, then don't show the filter
                                                        $filterAvailable = \App\Models\ProductsFilter::filterAvailable($filter['id'], $productDetails['category_id']);
                                                    @endphp

                                                    @if ($filterAvailable == 'Yes') {{-- if the filter has the current productDetails['category_id'] in its `cat_ids` --}}

                                                        <tr>
                                                            <td>{{ $filter['filter_name'] }}</td>
                                                            <td>
                                                                @foreach ($filter['filter_values'] as $value) {{-- show the related values of the filter of the product --}}
                                                                    @php
                                                                        // echo '<pre>', var_dump($value), '</pre>'; exit;
                                                                    @endphp
                                                                    @if (!empty($productDetails[$filter['filter_column']]) && $productDetails[$filter['filter_column']] == $value['filter_value']) {{-- $value['filter_value'] is like '4GB' --}} {{-- $productDetails[$filter['filter_column']]    is like    $productDetails['screen_size']    which in turn, may be equal to    '5 to 5.4 in' --}}
                                                                        {{ ucwords($value['filter_value']) }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>

                                                    @endif
                                                @endif
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
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
                                    <div class="get-reviews u-s-p-b-22">
                                        <div class="review-options u-s-m-b-16">
                                            <div class="review-option-heading">
                                                <h6>Reviews
                                                    <span> ({{ count($ratings) }}) </span>
                                                </h6>
                                            </div>
                                        </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="detail-different-product-section u-s-p-t-80">
                <!-- Similar-Products /- -->
                <!-- Recently-View-Products  -->
                <!-- <section class="section-maker">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3">Recently Viewed Listing</h3>
                        </div>
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">




                                {{-- Recently Viewed Products (Items) functionality --}}
                                @foreach ($recentlyViewedProducts as $product)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">



                                                @php
                                                    $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                                @endphp
                        
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
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">



                                                        <a href="shop-v1-root-category.html">{{ $product['product_code'] }}</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="listing.html">{{ $product['product_color'] }}</a>
                                                    </li>
                                                    <li>
                                                        <a href="listing.html">{{ $product['brand'] != null ? $product['brand']['name'] : "" }}</a>



                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                </h6>
                                            </div>



                                            {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout --}}
                                            @php
                                                $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                            @endphp

                                            @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        ${{ $getDiscountPrice }} 
                                                    </div>
                                                    <div class="item-old-price">
                                                        ${{ $product['product_price'] }}
                                                    </div>
                                                </div>
                                            @else {{-- if there's no discount on the price, show the original price --}}
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        ${{ $product['product_price'] }}
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
                </section> -->
                <!-- Recently-View-Products /- -->
            </div>
            <!-- Different-Product-Section /- -->
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
                                            <strong>4.8</strong>
                                            <span>(12 reviews)</span>
                                        </span>
                                    </div>
                                    <div class="car-action-icons">
                                        <ul>
                                            <li>
                                                <a href="#" class="icon-box">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M8.684 3.051a1 1 0 0 1 .632 0L15 4.946l4.367-1.456A2 2 0 0 1 22 5.387V17.28a2 2 0 0 1-1.367 1.898l-5.317 1.772a1 1 0 0 1-.632 0L9 19.054L4.632 20.51A2 2 0 0 1 2 18.613V6.72a2 2 0 0 1 1.368-1.898L8.684 3.05zM10 17.28l4 1.334V6.72l-4-1.334zM8 5.387L4 6.721v11.892l4-1.334zm8 1.334v11.892l4-1.334V5.387z"/></svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="icon-box">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 1.25a.75.75 0 0 1 .57.262l3 3.5a.75.75 0 1 1-1.14.976l-1.68-1.96V15a.75.75 0 0 1-1.5 0V4.027L9.57 5.988a.75.75 0 1 1-1.14-.976l3-3.5A.75.75 0 0 1 12 1.25M6.996 8.252a.75.75 0 0 1 .008 1.5c-1.093.006-1.868.034-2.457.142c-.566.105-.895.272-1.138.515c-.277.277-.457.666-.556 1.4c-.101.755-.103 1.756-.103 3.191v1c0 1.436.002 2.437.103 3.192c.099.734.28 1.122.556 1.4c.277.276.665.456 1.4.555c.754.102 1.756.103 3.191.103h8c1.435 0 2.436-.001 3.192-.103c.734-.099 1.122-.279 1.399-.556c.277-.277.457-.665.556-1.399c.101-.755.103-1.756.103-3.192v-1c0-1.435-.002-2.436-.103-3.192c-.099-.733-.28-1.122-.556-1.399c-.244-.243-.572-.41-1.138-.515c-.589-.108-1.364-.136-2.457-.142a.75.75 0 1 1 .008-1.5c1.082.006 1.983.032 2.72.167c.758.14 1.403.405 1.928.93c.602.601.86 1.36.982 2.26c.116.866.116 1.969.116 3.336v1.11c0 1.368 0 2.47-.116 3.337c-.122.9-.38 1.658-.982 2.26c-.602.602-1.36.86-2.26.982c-.867.116-1.97.116-3.337.116h-8.11c-1.367 0-2.47 0-3.337-.116c-.9-.121-1.658-.38-2.26-.982c-.602-.602-.86-1.36-.981-2.26c-.117-.867-.117-1.97-.117-3.337v-1.11c0-1.367 0-2.47.117-3.337c.12-.9.38-1.658.981-2.26c.525-.524 1.17-.79 1.928-.929c.737-.135 1.638-.161 2.72-.167" clip-rule="evenodd"/></svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="icon-box favourite">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m11.645 20.91l-.007-.003l-.022-.012a15.247 15.247 0 0 1-.383-.218a25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25C2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052A5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25c0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17a15.247 15.247 0 0 1-.383.219l-.022.012l-.007.004l-.003.001a.752.752 0 0 1-.704 0z"/></svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="icon-box">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a1 1 0 1 0 2 0a1 1 0 1 0-2 0m7 0a1 1 0 1 0 2 0a1 1 0 1 0-2 0m7 0a1 1 0 1 0 2 0a1 1 0 1 0-2 0"/></svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails"> {{-- EasyZoom plugin --}}
                                            <a      href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}">
                                                <img src="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}" alt="" width="500" height="500" />
                                            </a>
                                        </div>
                                        <div class="thumbnails" style="margin-top: 30px"> {{-- EasyZoom plugin --}}
                                            <a      href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}" data-standard="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}">
                                                <img src="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}" width="120" height="120" alt="" />
                                            </a>
                                            {{-- Show the product Alternative images (`image` in `products_images` table) --}}
                                            @foreach ($productDetails['images'] as $image)
                                                {{-- EasyZoom plugin --}}
                                                <a      href="{{ asset('front/images/product_images/large/' . $image['image']) }}" data-standard="{{ asset('front/images/product_images/small/' . $image['image']) }}">
                                                    <img src="{{ asset('front/images/product_images/small/' . $image['image']) }}" width="120" height="120" alt="" />
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        @php
                                            $getDiscountPrice = \App\Models\Product::getDiscountPrice($productDetails['id']);
                                        @endphp
                                        <div class="ly-reserve-sidebar">
                                            <h3 class="stay-price">${{ $getDiscountPrice }}</h3>
                                            <!-- <span class="txt">5 Nights in Pasir putih resort</span>
                                            <small class="from-to-date">Feb 8, 2023 - Feb 13, 2023</small> -->
                                            <!-- <form action="" class="reserve-action-box">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="input-field">
                                                            <label for="checkIn" class="form-label">Check in</label>
                                                            <input type="date" class="form-control" id="checkIn" placeholder="Feb 15, 2022">
                                                        </div>                                                
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="input-field">
                                                            <label for="checkOut" class="form-label">Check out</label>
                                                            <input type="date" class="form-control" id="checkOut" placeholder="Feb 20, 2022">
                                                        </div>                                                
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="input-field">
                                                            <label for="guest" class="form-label">Guest</label>
                                                            <select class="js-example-basic-single" name="sort">
                                                                <option value="2" selected>2 Guest</option>
                                                                <option value="5">5 Guest</option>
                                                                <option value="7">7 Guest</option>
                                                            </select>
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.15957 11.62C9.12957 11.62 9.10957 11.62 9.07957 11.62C9.02957 11.61 8.95957 11.61 8.89957 11.62C5.99957 11.53 3.80957 9.25 3.80957 6.44C3.80957 3.58 6.13957 1.25 8.99957 1.25C11.8596 1.25 14.1896 3.58 14.1896 6.44C14.1796 9.25 11.9796 11.53 9.18957 11.62C9.17957 11.62 9.16957 11.62 9.15957 11.62ZM8.99957 2.75C6.96957 2.75 5.30957 4.41 5.30957 6.44C5.30957 8.44 6.86957 10.05 8.85957 10.12C8.91957 10.11 9.04957 10.11 9.17957 10.12C11.1396 10.03 12.6796 8.42 12.6896 6.44C12.6896 4.41 11.0296 2.75 8.99957 2.75Z" fill="#09080D"/>
                                                                <path d="M16.5394 11.75C16.5094 11.75 16.4794 11.75 16.4494 11.74C16.0394 11.78 15.6194 11.49 15.5794 11.08C15.5394 10.67 15.7894 10.3 16.1994 10.25C16.3194 10.24 16.4494 10.24 16.5594 10.24C18.0194 10.16 19.1594 8.96 19.1594 7.49C19.1594 5.97 17.9294 4.74 16.4094 4.74C15.9994 4.75 15.6594 4.41 15.6594 4C15.6594 3.59 15.9994 3.25 16.4094 3.25C18.7494 3.25 20.6594 5.16 20.6594 7.5C20.6594 9.8 18.8594 11.66 16.5694 11.75C16.5594 11.75 16.5494 11.75 16.5394 11.75Z" fill="#09080D"/>
                                                                <path d="M9.16961 22.55C7.20961 22.55 5.23961 22.05 3.74961 21.05C2.35961 20.13 1.59961 18.87 1.59961 17.5C1.59961 16.13 2.35961 14.86 3.74961 13.93C6.74961 11.94 11.6096 11.94 14.5896 13.93C15.9696 14.85 16.7396 16.11 16.7396 17.48C16.7396 18.85 15.9796 20.12 14.5896 21.05C13.0896 22.05 11.1296 22.55 9.16961 22.55ZM4.57961 15.19C3.61961 15.83 3.09961 16.65 3.09961 17.51C3.09961 18.36 3.62961 19.18 4.57961 19.81C7.06961 21.48 11.2696 21.48 13.7596 19.81C14.7196 19.17 15.2396 18.35 15.2396 17.49C15.2396 16.64 14.7096 15.82 13.7596 15.19C11.2696 13.53 7.06961 13.53 4.57961 15.19Z" fill="#09080D"/>
                                                                <path d="M18.3392 20.75C17.9892 20.75 17.6792 20.51 17.6092 20.15C17.5292 19.74 17.7892 19.35 18.1892 19.26C18.8192 19.13 19.3992 18.88 19.8492 18.53C20.4192 18.1 20.7292 17.56 20.7292 16.99C20.7292 16.42 20.4192 15.88 19.8592 15.46C19.4192 15.12 18.8692 14.88 18.2192 14.73C17.8192 14.64 17.5592 14.24 17.6492 13.83C17.7392 13.43 18.1392 13.17 18.5492 13.26C19.4092 13.45 20.1592 13.79 20.7692 14.26C21.6992 14.96 22.2292 15.95 22.2292 16.99C22.2292 18.03 21.6892 19.02 20.7592 19.73C20.1392 20.21 19.3592 20.56 18.4992 20.73C18.4392 20.75 18.3892 20.75 18.3392 20.75Z" fill="#09080D"/>
                                                            </svg>
                                                        </div> 
                                                        <button class="book-your-car">Book a car</button>                                               
                                                    </div>
                                                </div>
                                            </form> -->
                                            <!-- <span>You won't be charged yet</span> -->
                                            <ul class="reserve-services-list-box">
                                                <li class="service-list-item">
                                                    <span>Original Price</span>
                                                    <strong>${{ $productDetails['product_price'] }}</strong>
                                                </li>
                                                <li class="service-list-item">
                                                    <span>Availability</span>
                                                    @if ($productDetails['product_units'] > 0)
                                                        <strong>In Stock</strong>
                                                    @else
                                                        <strong style="color: red">Out of Stock (Sold-out)</strong>
                                                    @endif
                                                </li>
                                            </ul>
                                            <form action="{{ url('cart/add') }}" method="Post" class="post-form" >
                                                @csrf 
                                                <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}"> {{-- Add to Cart <form> --}} 
                                                <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                                                    <div class="quantity-wrapper u-s-m-b-22">
                                                        <span>Quantity:</span>
                                                        <div class="quantity">
                                                            <input class="quantity-text-field" type="number" name="quantity" value="1" max="{{$productDetails['product_units']}}" title=" Available stock is{{$productDetails['product_units']}}">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button class="button button-outline-secondary" type="submit">Add to cart</button>
                                                        <button class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                                                        <button class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="#" class="ly-report-list">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.15039 22.75C4.74039 22.75 4.40039 22.41 4.40039 22V2C4.40039 1.59 4.74039 1.25 5.15039 1.25C5.56039 1.25 5.90039 1.59 5.90039 2V22C5.90039 22.41 5.56039 22.75 5.15039 22.75Z" fill="#5E5D65"/>
                                                    <path d="M16.3504 16.75H5.15039C4.74039 16.75 4.40039 16.41 4.40039 16C4.40039 15.59 4.74039 15.25 5.15039 15.25H16.3504C17.4404 15.25 17.9504 14.96 18.0504 14.71C18.1504 14.46 18.0004 13.9 17.2204 13.13L16.0204 11.93C15.5304 11.5 15.2304 10.85 15.2004 10.13C15.1704 9.37 15.4704 8.62 16.0204 8.07L17.2204 6.87C17.9604 6.13 18.1904 5.53 18.0804 5.27C17.9704 5.01 17.4004 4.75 16.3504 4.75H5.15039C4.73039 4.75 4.40039 4.41 4.40039 4C4.40039 3.59 4.74039 3.25 5.15039 3.25H16.3504C18.5404 3.25 19.2404 4.16 19.4704 4.7C19.6904 5.24 19.8404 6.38 18.2804 7.94L17.0804 9.14C16.8304 9.39 16.6904 9.74 16.7004 10.09C16.7104 10.39 16.8304 10.66 17.0404 10.85L18.2804 12.08C19.8104 13.61 19.6604 14.75 19.4404 15.3C19.2104 15.83 18.5004 16.75 16.3504 16.75Z" fill="#5E5D65"/>
                                                </svg>
                                                Report this listing
                                            </a>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <div class="ly-car-img-box">
                                            <img src="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}" alt="car-img">
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-lg-4">
                                        <div class="ly-car-img-box">
                                            <img src="imgs/car-img-2.png" alt="car-img">
                                        </div>
                                        <div class="ly-car-img-box">
                                            <img src="imgs/car-img-3.png" alt="car-img">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="car-detail-content">
                                            <h2 class="title">Listing Detail</h2>
                                            <!-- <ul class="features-list">
                                                <li>
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.15957 11.62C9.12957 11.62 9.10957 11.62 9.07957 11.62C9.02957 11.61 8.95957 11.61 8.89957 11.62C5.99957 11.53 3.80957 9.25 3.80957 6.44C3.80957 3.58 6.13957 1.25 8.99957 1.25C11.8596 1.25 14.1896 3.58 14.1896 6.44C14.1796 9.25 11.9796 11.53 9.18957 11.62C9.17957 11.62 9.16957 11.62 9.15957 11.62ZM8.99957 2.75C6.96957 2.75 5.30957 4.41 5.30957 6.44C5.30957 8.44 6.86957 10.05 8.85957 10.12C8.91957 10.11 9.04957 10.11 9.17957 10.12C11.1396 10.03 12.6796 8.42 12.6896 6.44C12.6896 4.41 11.0296 2.75 8.99957 2.75Z" fill="#7D7C84"/>
                                                        <path d="M16.5394 11.75C16.5094 11.75 16.4794 11.75 16.4494 11.74C16.0394 11.78 15.6194 11.49 15.5794 11.08C15.5394 10.67 15.7894 10.3 16.1994 10.25C16.3194 10.24 16.4494 10.24 16.5594 10.24C18.0194 10.16 19.1594 8.96 19.1594 7.49C19.1594 5.97 17.9294 4.74 16.4094 4.74C15.9994 4.75 15.6594 4.41 15.6594 4C15.6594 3.59 15.9994 3.25 16.4094 3.25C18.7494 3.25 20.6594 5.16 20.6594 7.5C20.6594 9.8 18.8594 11.66 16.5694 11.75C16.5594 11.75 16.5494 11.75 16.5394 11.75Z" fill="#7D7C84"/>
                                                        <path d="M9.16961 22.55C7.20961 22.55 5.23961 22.05 3.74961 21.05C2.35961 20.13 1.59961 18.87 1.59961 17.5C1.59961 16.13 2.35961 14.86 3.74961 13.93C6.74961 11.94 11.6096 11.94 14.5896 13.93C15.9696 14.85 16.7396 16.11 16.7396 17.48C16.7396 18.85 15.9796 20.12 14.5896 21.05C13.0896 22.05 11.1296 22.55 9.16961 22.55ZM4.57961 15.19C3.61961 15.83 3.09961 16.65 3.09961 17.51C3.09961 18.36 3.62961 19.18 4.57961 19.81C7.06961 21.48 11.2696 21.48 13.7596 19.81C14.7196 19.17 15.2396 18.35 15.2396 17.49C15.2396 16.64 14.7096 15.82 13.7596 15.19C11.2696 13.53 7.06961 13.53 4.57961 15.19Z" fill="#7D7C84"/>
                                                        <path d="M18.3392 20.75C17.9892 20.75 17.6792 20.51 17.6092 20.15C17.5292 19.74 17.7892 19.35 18.1892 19.26C18.8192 19.13 19.3992 18.88 19.8492 18.53C20.4192 18.1 20.7292 17.56 20.7292 16.99C20.7292 16.42 20.4192 15.88 19.8592 15.46C19.4192 15.12 18.8692 14.88 18.2192 14.73C17.8192 14.64 17.5592 14.24 17.6492 13.83C17.7392 13.43 18.1392 13.17 18.5492 13.26C19.4092 13.45 20.1592 13.79 20.7692 14.26C21.6992 14.96 22.2292 15.95 22.2292 16.99C22.2292 18.03 21.6892 19.02 20.7592 19.73C20.1392 20.21 19.3592 20.56 18.4992 20.73C18.4392 20.75 18.3892 20.75 18.3392 20.75Z" fill="#7D7C84"/>
                                                    </svg>
                                                    <span>2 Guests</span>
                                                </li>
                                                <li>
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.15039 22.75C4.74039 22.75 4.40039 22.41 4.40039 22V2C4.40039 1.59 4.74039 1.25 5.15039 1.25C5.56039 1.25 5.90039 1.59 5.90039 2V22C5.90039 22.41 5.56039 22.75 5.15039 22.75Z" fill="#7D7C84"/>
                                                        <path d="M16.3504 16.75H5.15039C4.74039 16.75 4.40039 16.41 4.40039 16C4.40039 15.59 4.74039 15.25 5.15039 15.25H16.3504C17.4404 15.25 17.9504 14.96 18.0504 14.71C18.1504 14.46 18.0004 13.9 17.2204 13.13L16.0204 11.93C15.5304 11.5 15.2304 10.85 15.2004 10.13C15.1704 9.37 15.4704 8.62 16.0204 8.07L17.2204 6.87C17.9604 6.13 18.1904 5.53 18.0804 5.27C17.9704 5.01 17.4004 4.75 16.3504 4.75H5.15039C4.73039 4.75 4.40039 4.41 4.40039 4C4.40039 3.59 4.74039 3.25 5.15039 3.25H16.3504C18.5404 3.25 19.2404 4.16 19.4704 4.7C19.6904 5.24 19.8404 6.38 18.2804 7.94L17.0804 9.14C16.8304 9.39 16.6904 9.74 16.7004 10.09C16.7104 10.39 16.8304 10.66 17.0404 10.85L18.2804 12.08C19.8104 13.61 19.6604 14.75 19.4404 15.3C19.2104 15.83 18.5004 16.75 16.3504 16.75Z" fill="#7D7C84"/>
                                                    </svg>
                                                    <span>1 Bedroom</span>
                                                </li>
                                                <li>
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.15039 22.75C4.74039 22.75 4.40039 22.41 4.40039 22V2C4.40039 1.59 4.74039 1.25 5.15039 1.25C5.56039 1.25 5.90039 1.59 5.90039 2V22C5.90039 22.41 5.56039 22.75 5.15039 22.75Z" fill="#7D7C84"/>
                                                        <path d="M16.3504 16.75H5.15039C4.74039 16.75 4.40039 16.41 4.40039 16C4.40039 15.59 4.74039 15.25 5.15039 15.25H16.3504C17.4404 15.25 17.9504 14.96 18.0504 14.71C18.1504 14.46 18.0004 13.9 17.2204 13.13L16.0204 11.93C15.5304 11.5 15.2304 10.85 15.2004 10.13C15.1704 9.37 15.4704 8.62 16.0204 8.07L17.2204 6.87C17.9604 6.13 18.1904 5.53 18.0804 5.27C17.9704 5.01 17.4004 4.75 16.3504 4.75H5.15039C4.73039 4.75 4.40039 4.41 4.40039 4C4.40039 3.59 4.74039 3.25 5.15039 3.25H16.3504C18.5404 3.25 19.2404 4.16 19.4704 4.7C19.6904 5.24 19.8404 6.38 18.2804 7.94L17.0804 9.14C16.8304 9.39 16.6904 9.74 16.7004 10.09C16.7104 10.39 16.8304 10.66 17.0404 10.85L18.2804 12.08C19.8104 13.61 19.6604 14.75 19.4404 15.3C19.2104 15.83 18.5004 16.75 16.3504 16.75Z" fill="#7D7C84"/>
                                                    </svg>
                                                    <span>1 Private bath</span>
                                                </li>
                                            </ul> -->
                                            <div class="car-host-box-grid">
                                                <div class="car-host-box-meta">
                                                    <p>Hosted by:</p>
                                                    <div class="host-box-cont">
                                                        <div class="img-box">
                                                            <img src="imgs/host-1.png" alt="host-img">
                                                        </div>
                                                        <div class="meta-box">
                                                            <span>{{isset($getUser->name) ? $getUser->name : ''}}</span>
                                                            <small>{{date('d M Y', strtotime($productDetails['created_at']))}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="car-host-box-meta">
                                                    <p>Hosted by:</p>
                                                    <div class="host-box-cont">
                                                        <div class="img-box">
                                                            <img src="imgs/host-2.png" alt="host-img">
                                                        </div>
                                                        <div class="meta-box">
                                                            <span>Roger Bergson</span>
                                                            <small>Joined in March 2014</small>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <!-- <div class="extra-specs-grid">
                                                <div class="specs-box">
                                                    <div class="icon-box">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M13 22.75H5C2.58 22.75 1.25 21.42 1.25 19V11C1.25 8.58 2.58 7.25 5 7.25H10C10.41 7.25 10.75 7.59 10.75 8V19C10.75 20.58 11.42 21.25 13 21.25C13.41 21.25 13.75 21.59 13.75 22C13.75 22.41 13.41 22.75 13 22.75ZM5 8.75C3.42 8.75 2.75 9.42 2.75 11V19C2.75 20.58 3.42 21.25 5 21.25H9.79999C9.43999 20.66 9.25 19.91 9.25 19V8.75H5Z" fill="#09080D"/>
                                                            <path d="M10 8.75H5C4.59 8.75 4.25 8.41 4.25 8V6C4.25 4.48 5.48 3.25 7 3.25H10.11C10.34 3.25 10.56 3.35998 10.7 3.53998C10.84 3.72998 10.89 3.97 10.83 4.19C10.77 4.41 10.75 4.66 10.75 5V8C10.75 8.41 10.41 8.75 10 8.75ZM5.75 7.25H9.25V5C9.25 4.91 9.25 4.83 9.25 4.75H7C6.31 4.75 5.75 5.31 5.75 6V7.25Z" fill="#09080D"/>
                                                            <path d="M14 13.75C13.59 13.75 13.25 13.41 13.25 13V8C13.25 7.59 13.59 7.25 14 7.25C14.41 7.25 14.75 7.59 14.75 8V13C14.75 13.41 14.41 13.75 14 13.75Z" fill="#09080D"/>
                                                            <path d="M18 13.75C17.59 13.75 17.25 13.41 17.25 13V8C17.25 7.59 17.59 7.25 18 7.25C18.41 7.25 18.75 7.59 18.75 8V13C18.75 13.41 18.41 13.75 18 13.75Z" fill="#09080D"/>
                                                            <path d="M18 22.75H14C13.59 22.75 13.25 22.41 13.25 22V18C13.25 17.04 14.04 16.25 15 16.25H17C17.96 16.25 18.75 17.04 18.75 18V22C18.75 22.41 18.41 22.75 18 22.75ZM14.75 21.25H17.25V18C17.25 17.86 17.14 17.75 17 17.75H15C14.86 17.75 14.75 17.86 14.75 18V21.25Z" fill="#09080D"/>
                                                            <path d="M6 17.75C5.59 17.75 5.25 17.41 5.25 17V13C5.25 12.59 5.59 12.25 6 12.25C6.41 12.25 6.75 12.59 6.75 13V17C6.75 17.41 6.41 17.75 6 17.75Z" fill="#09080D"/>
                                                            <path d="M19 22.75H13C10.58 22.75 9.25 21.42 9.25 19V5C9.25 2.58 10.58 1.25 13 1.25H19C21.42 1.25 22.75 2.58 22.75 5V19C22.75 21.42 21.42 22.75 19 22.75ZM13 2.75C11.42 2.75 10.75 3.42 10.75 5V19C10.75 20.58 11.42 21.25 13 21.25H19C20.58 21.25 21.25 20.58 21.25 19V5C21.25 3.42 20.58 2.75 19 2.75H13Z" fill="#09080D"/>
                                                        </svg>
                                                    </div>
                                                    <div class="spec-meta-box">
                                                        <span>Dedicated workspace</span>
                                                        <small>A common area with wifi that’s well-suited for working.</small>
                                                    </div>
                                                </div>
                                                <div class="specs-box">
                                                    <div class="icon-box">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.9599 21.32C15.7699 21.32 15.5799 21.25 15.4299 21.1L13.9099 19.58C13.6199 19.29 13.6199 18.81 13.9099 18.52C14.1999 18.23 14.6799 18.23 14.9699 18.52L15.9599 19.51L18.4699 17C18.7599 16.71 19.2399 16.71 19.5299 17C19.8199 17.29 19.8199 17.77 19.5299 18.06L16.4899 21.1C16.3399 21.25 16.1499 21.32 15.9599 21.32Z" fill="#09080D"/>
                                                            <path d="M12.1597 11.62C12.1297 11.62 12.1097 11.62 12.0797 11.62C12.0297 11.61 11.9597 11.61 11.8997 11.62C8.99971 11.53 6.80971 9.25 6.80971 6.44C6.79971 5.06 7.33971 3.76 8.31971 2.78C9.29971 1.8 10.5997 1.25 11.9897 1.25C14.8497 1.25 17.1797 3.58 17.1797 6.44C17.1797 9.25 14.9897 11.52 12.1897 11.62C12.1797 11.62 12.1697 11.62 12.1597 11.62ZM11.9897 2.75C10.9997 2.75 10.0797 3.14 9.37971 3.83C8.68971 4.53 8.30971 5.45 8.30971 6.43C8.30971 8.43 9.86971 10.05 11.8597 10.11C11.9197 10.1 12.0497 10.1 12.1797 10.11C14.1497 10.02 15.6797 8.41 15.6797 6.43C15.6797 4.41 14.0197 2.75 11.9897 2.75Z" fill="#09080D"/>
                                                            <path d="M11.9902 22.5599C9.95016 22.5599 8.02016 22.0299 6.56016 21.0499C5.17016 20.1199 4.41016 18.8499 4.41016 17.4799C4.41016 16.1099 5.18016 14.8499 6.56016 13.9299C9.55016 11.9299 14.4102 11.9299 17.4002 13.9299C17.7402 14.1599 17.8402 14.6299 17.6102 14.9699C17.3802 15.3199 16.9102 15.4099 16.5702 15.1799C14.0802 13.5199 9.88016 13.5199 7.39016 15.1799C6.43016 15.8199 5.91016 16.6299 5.91016 17.4799C5.91016 18.3299 6.43016 19.1599 7.39016 19.7999C8.60016 20.6099 10.2302 21.0499 11.9802 21.0499C12.3902 21.0499 12.7302 21.3899 12.7302 21.7999C12.7302 22.2099 12.4002 22.5599 11.9902 22.5599Z" fill="#09080D"/>
                                                        </svg>
                                                    </div>
                                                    <div class="spec-meta-box">
                                                        <span>Self check-in</span>
                                                        <small>Check yourself in with the lockbox.</small>
                                                    </div>
                                                </div>
                                                <div class="specs-box">
                                                    <div class="icon-box">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8 5.75C7.59 5.75 7.25 5.41 7.25 5V2C7.25 1.59 7.59 1.25 8 1.25C8.41 1.25 8.75 1.59 8.75 2V5C8.75 5.41 8.41 5.75 8 5.75Z" fill="#09080D"/>
                                                            <path d="M16 5.75C15.59 5.75 15.25 5.41 15.25 5V2C15.25 1.59 15.59 1.25 16 1.25C16.41 1.25 16.75 1.59 16.75 2V5C16.75 5.41 16.41 5.75 16 5.75Z" fill="#09080D"/>
                                                            <path d="M8.5 14.4999C8.24 14.4999 7.97999 14.3899 7.78999 14.2099C7.74999 14.1599 7.7 14.1099 7.67 14.0599C7.63 13.9999 7.6 13.9399 7.58 13.8799C7.55 13.8199 7.53 13.76 7.52 13.7C7.51 13.63 7.5 13.5599 7.5 13.4999C7.5 13.2399 7.60999 12.98 7.78999 12.79C8.15999 12.42 8.83001 12.42 9.21001 12.79C9.39001 12.98 9.5 13.2399 9.5 13.4999C9.5 13.5599 9.49 13.63 9.48 13.7C9.47 13.76 9.45 13.8199 9.42 13.8799C9.4 13.9399 9.37 13.9999 9.33 14.0599C9.29 14.1099 9.25001 14.1599 9.21001 14.2099C9.02001 14.3899 8.76 14.4999 8.5 14.4999Z" fill="#09080D"/>
                                                            <path d="M12 14.4999C11.87 14.4999 11.74 14.4699 11.62 14.4199C11.49 14.3699 11.38 14.2999 11.29 14.2099C11.25 14.1599 11.2 14.1099 11.17 14.0599C11.13 13.9999 11.1 13.9399 11.08 13.8799C11.05 13.8199 11.03 13.7599 11.02 13.6999C11.01 13.6299 11 13.5599 11 13.4999C11 13.2399 11.11 12.9799 11.29 12.7899C11.38 12.6999 11.49 12.6299 11.62 12.5799C11.98 12.4199 12.43 12.5099 12.71 12.7899C12.89 12.9799 13 13.2399 13 13.4999C13 13.5599 12.99 13.6299 12.98 13.6999C12.97 13.7599 12.95 13.8199 12.92 13.8799C12.9 13.9399 12.87 13.9999 12.83 14.0599C12.79 14.1099 12.75 14.1599 12.71 14.2099C12.52 14.3899 12.26 14.4999 12 14.4999Z" fill="#09080D"/>
                                                            <path d="M8.5 18C8.23 18 7.97999 17.89 7.78999 17.71C7.60999 17.52 7.5 17.26 7.5 17C7.5 16.74 7.60999 16.48 7.78999 16.29C7.83999 16.25 7.89 16.2 7.94 16.17C8 16.13 8.06 16.1 8.12 16.08C8.18 16.05 8.24 16.03 8.3 16.02C8.5 15.98 8.7 16 8.88 16.08C9.01 16.13 9.11001 16.2 9.21001 16.29C9.39001 16.48 9.5 16.74 9.5 17C9.5 17.26 9.39001 17.52 9.21001 17.71C9.11001 17.8 9.01 17.87 8.88 17.92C8.76 17.97 8.63 18 8.5 18Z" fill="#09080D"/>
                                                            <path d="M20.5 9.83984H3.5C3.09 9.83984 2.75 9.49984 2.75 9.08984C2.75 8.67984 3.09 8.33984 3.5 8.33984H20.5C20.91 8.33984 21.25 8.67984 21.25 9.08984C21.25 9.49984 20.91 9.83984 20.5 9.83984Z" fill="#09080D"/>
                                                            <path d="M18 23.75C15.38 23.75 13.25 21.62 13.25 19C13.25 16.38 15.38 14.25 18 14.25C20.62 14.25 22.75 16.38 22.75 19C22.75 21.62 20.62 23.75 18 23.75ZM18 15.75C16.21 15.75 14.75 17.21 14.75 19C14.75 20.79 16.21 22.25 18 22.25C19.79 22.25 21.25 20.79 21.25 19C21.25 17.21 19.79 15.75 18 15.75Z" fill="#09080D"/>
                                                            <path d="M19.0704 20.8599C18.8804 20.8599 18.6904 20.79 18.5404 20.64L16.4304 18.5299C16.1404 18.2399 16.1404 17.7599 16.4304 17.4699C16.7204 17.1799 17.2004 17.1799 17.4904 17.4699L19.6004 19.5799C19.8904 19.8699 19.8904 20.35 19.6004 20.64C19.4504 20.79 19.2604 20.8599 19.0704 20.8599Z" fill="#09080D"/>
                                                            <path d="M16.9301 20.8897C16.7401 20.8897 16.5501 20.8197 16.4001 20.6697C16.1101 20.3797 16.1101 19.8997 16.4001 19.6097L18.5101 17.4997C18.8001 17.2097 19.2801 17.2097 19.5701 17.4997C19.8601 17.7897 19.8601 18.2697 19.5701 18.5597L17.4601 20.6697C17.3101 20.8097 17.1201 20.8897 16.9301 20.8897Z" fill="#09080D"/>
                                                            <path d="M15.37 22.75H8C4.35 22.75 2.25 20.65 2.25 17V8.5C2.25 4.85 4.35 2.75 8 2.75H16C19.65 2.75 21.75 4.85 21.75 8.5V16.36C21.75 16.67 21.56 16.95 21.26 17.06C20.97 17.17 20.64 17.09 20.43 16.85C19.81 16.15 18.92 15.75 17.99 15.75C16.2 15.75 14.74 17.21 14.74 19C14.74 19.59 14.9 20.17 15.21 20.67C15.38 20.97 15.6 21.22 15.84 21.43C16.08 21.63 16.17 21.96 16.06 22.26C15.97 22.55 15.69 22.75 15.37 22.75ZM8 4.25C5.14 4.25 3.75 5.64 3.75 8.5V17C3.75 19.86 5.14 21.25 8 21.25H13.82C13.45 20.57 13.25 19.8 13.25 19C13.25 16.38 15.38 14.25 18 14.25C18.79 14.25 19.57 14.45 20.25 14.82V8.5C20.25 5.64 18.86 4.25 16 4.25H8Z" fill="#09080D"/>
                                                        </svg>
                                                    </div>
                                                    <div class="spec-meta-box">
                                                        <span>Free cancellation</span>
                                                        <small>Places in free cancellation for 48 hours.</small>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="ly-over-view-wrapper">
                                                <div class="ly-over-view-box">
                                                    <span class="ly-overview">Overview</span>
                                                    <span class="ly-reviews">40+ Reviews</span>
                                                </div>
                                                <p>{{ $productDetails['description'] }}</p>
                                                <!-- <button class="ly-read-more">Read More</button> -->
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                 <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="detail-tabs-wrapper mt-5">
                                            <div class="detail-nav-wrapper mb-4">
                                                <ul class="nav nav-tabs justify-content-center">
                                                    <li class="nav-item">
                                                        <a class="nav-link active " data-bs-toggle="tab" href="#video">Listing Video</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#detail">Listing Details</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#review">Reviews ({{ count($ratings) }})</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="video">
                                                    <div class="description-whole-container">
                                                        @if ($productDetails['product_video'])
                                                            <video controls>
                                                                <source src="{{ url('front/videos/product_videos/' . $productDetails['product_video']) }}" type="video/mp4">
                                                            </video>
                                                        @else
                                                            Listing Video does not exist    
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="detail">
                                                    <div class="specification-whole-container">
                                                        <div class="spec-table mb-4">
                                                            <h4 class="spec-heading">Listing Details</h4>
                                                            <table class="table">
                                                                <!-- Your table content goes here -->
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="review">
                                                    <div class="review-whole-container">
                                                        <div class="row mb-4">
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
                                                                    <!-- Your star meter content goes here -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-lg-12">
                                                                <form method="POST" action="{{ url('add-rating') }}" name="formRating" id="formRating">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                                                                    <div class="your-rating-wrapper">
                                                                        <h6 class="review-h6">Your Review matters.</h6>
                                                                        <h6 class="review-h6">Have you used this product before?</h6>
                                                                        <!-- Your form content goes here -->
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="get-reviews mb-4">
                                                            <div class="review-options">
                                                                <div class="review-option-heading">
                                                                    <h6>Reviews ({{ count($ratings) }})</h6>
                                                                </div>
                                                            </div>
                                                            <div class="reviewers">
                                                                <!-- Your reviewer content goes here -->
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
                    </div>
                </div>
            </section>
             <section class="fr-serv-2 fr-services-content-2">
                <div class="container">
                    <<div class="sec-maker-header text-center">
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
@endsection