@extends('front.layout.layout')


@section('content')

<section class="ly-page-top-section change-bg company-work">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-content-wrapper">
                        <h1>Your listing</h1>
                        <p>Join top online hosts who earn an average of £6,492 per year for each car they list
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="snet-car-listing-section car-submit-steps ">
        <div class="container">
            <div class="row">
                <!-- @if (Session::has('error_message')) 
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong> {{ Session::get('error_message') }}
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif   -->
                <!-- @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">


                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                 @endif -->
                    <!-- @if (Session::has('success_message')) 
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif -->
                    <!-- @if (Session::has('error')) 
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif -->
                <div class="col-lg-12">
                    <form class="new_listing_submission" action="{{ route('update.user.products') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                    <input type="hidden" name="order_product" value="{{$order_id}}">
                    <div class="snet-car-listing-wrapper listing-step-2">
                     
                      
                        <div class="row" style="width:100%;">
                            <div class="col-sm-8" style="float:left;">
                                <h3> List your product </h3>
                                <div class="snet-lisitng-cover-photos">
                                  
                                    <h5>Upload photo </h5>
                                     <p>Drag or Choose your photo to upload</p>
                                    <input type="file" name="product_image[]" id="images" multiple class="form-control" disabled>
                                    <div id="dropzone_new" class="dropzone_new dz-clickable dz-started">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <!-- <path fill-rule="evenodd" clip-rule="evenodd" d="M3 5C3 2.79086 4.79086 1 7 1H15.3431C16.404 1 17.4214 1.42143 18.1716 2.17157L19.8284 3.82843C20.5786 4.57857 21 5.59599 21 6.65685V19C21 21.2091 19.2091 23 17 23H7C4.79086 23 3 21.2091 3 19V5ZM19 8V19C19 20.1046 18.1046 21 17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H14V5C14 6.65685 15.3431 8 17 8H19ZM18.8891 6C18.7909 5.7176 18.6296 5.45808 18.4142 5.24264L16.7574 3.58579C16.5419 3.37035 16.2824 3.20914 16 3.11094V5C16 5.55228 16.4477 6 17 6H18.8891Z" fill="#777E91"/> -->
                                            <!-- <path d="M11.6172 9.07588C11.4993 9.12468 11.3888 9.19702 11.2929 9.29289L8.29289 12.2929C7.90237 12.6834 7.90237 13.3166 8.29289 13.7071C8.68342 14.0976 9.31658 14.0976 9.70711 13.7071L11 12.4142V17C11 17.5523 11.4477 18 12 18C12.5523 18 13 17.5523 13 17V12.4142L14.2929 13.7071C14.6834 14.0976 15.3166 14.0976 15.7071 13.7071C16.0976 13.3166 16.0976 12.6834 15.7071 12.2929L12.7071 9.29289C12.4125 8.99825 11.9797 8.92591 11.6172 9.07588Z" fill="#777E91"/> -->
                                            </svg>
                                            <div class="form-group"><div id="image_preview" style="width:100%;"> </div>
                                         <p>PNG, GIF, WEBP, MP4. Max 5Mb.</p>

                                        </div>
                                    
                                    </div>

                               </div>
                                <div class="listing_details">
                                    <h6>Listing Details</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="car_detail">
                                                <label for="category_id">Select Category</label>
                                                <select name="category_id" id="category_id" class="form-control text-dark" disabled style="border-radius: 12px; border: 2px solid #E6E8EC !important;">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $section) 
                                                        <optgroup label="{{ $section['name'] }}"> 
                                                            @foreach ($section['categories'] as $category)
                                                                <option value="{{ $category['id'] }}" @if (!empty($product['category_id'] == $category['id'])) selected @endif>{{ $category['category_name'] }}</option> {{-- parent categories --}}
                                                                @foreach ($category['sub_categories'] as $subcategory) {{-- subcategories or child categories --}} {{-- Check ProductsController.php --}}
                                                                    <option value="{{ $subcategory['id'] }}" @if (!empty($product['category_id'] == $subcategory['id'])) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['category_name'] }}</option> {{-- subcategories or child categories --}}
                                                                @endforeach
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="loadFilters">
                                                @include('admin.filters.category_filters')
                                            </div>
                                            <div class="car_detail">
                                                <label for="product_type">Tax id </label>
                                                <input disabled type="number" class="form-control" id="product_code" placeholder="Enter Tax Id" name="product_code" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif> 
                                            </div>
                                            <div class="car_detail">
                                                <label for="product_type">Listing Type</label>
                                                <input disabled type="text" class="form-control" id="product_type" placeholder="Enter Listing Type" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="product_type" @if (!empty($product['product_type'])) value="{{ $product['product_type'] }}" @else value="{{ old('product_type') }}" @endif> 
                                            </div>
                                            
                                            <div class="car_detail">
                                                <label for="gross_sale">What’s your annual savings?</label>
                                                <input disabled type="text" class="form-control" id="gross_sale" placeholder="Enter Monthly Savings" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="gross_sale" @if (!empty($product['gross_sale'])) value="{{ $product['gross_sale'] }}" @else value="{{ old('gross_sale') }}" @endif>
                                            </div>
                                            <div class="car_detail" >
                                                <label for="avg_customer">Membership Valid Through?</label>
                                                <select disabled name="avg_customer" id="avg_customer" class="form-control text-dark" style="border-radius: 12px; border: 2px solid #E6E8EC !important; margin-top:-5px;" onchange="disablePermanent(this.value)">
                                                    <option value="" selected disabled style="margin-bottom:-10px;">Select Membership (Years)</option>
                                                    @for($i = 0; $i < 10; $i++)
                                                        <option value="{{$i + 1}}">{{$i + 1}}</option>
                                                    @endfor
                                                        <option value="permanent">Permanent</option>
                                                </select>
                                            </div>
                                            <div class="car_detail">
                                                <label for="is_featured">Featured Item (Yes/No)</label>
                                                <input  disabled type="checkbox" name="is_featured" id="is_featured" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" value="Yes" @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked @endif>
                                            </div>

                                        </div>
                                        <div class="col-6">

                                            <div class="car_detail">
                                                <label for="product_name">Listing Name</label>
                                                <input disabled type="text" class="form-control" id="product_name" placeholder="Enter Product Name" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="product_name" @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif>  
                                            </div>
                                            <div class="car_detail">
                                                <label for="product_price">Listing Price</label>
                                                <input type="text" class="form-control" id="product_price" placeholder="Enter Listing Price"  style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="product_price" @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif> 
                                            </div>
                                            <div class="car_detail">
                                                <label for="product_units">No of Units of BOD</label>
                                                <input type="text" class="form-control" id="product_units" placeholder="Enter Listing Units" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="product_units" @if (!empty($product['product_units'])) value="{{ $product['product_units'] }}" @else value="{{ old('product_units') }}" @endif>
                                            </div>

                                            <div class="car_detail">
                                                <label for="product_discount">Annual Savings</label>
                                                <input disabled type="number" class="form-control" id="product_discount" placeholder="Enter Total Savings" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="product_discount" @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                                            </div>
                                           
                                            <div class="car_detail" id="validity">
                                                <label for="validity">Validity</label>
                                                <input disabled type="date" class="form-control"  placeholder="Enter Product Discount" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="validity" @if (!empty($product['validity'])) value="{{ $product['validity'] }}" @else value="{{ old('validity') }}" @endif>
                                            </div>
                                            

                                        </div>

                                        <div class="col-12">
                                            <div class="car_detail">
                                                <label for="description">Listing Description</label>
                                                <textarea disabled required name="description" id="description" class="form-control" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" rows="3">{{ $product['description'] }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                            </div>

                            <div class="col-sm-4" style="float:right;">

                                <div class="snet-listing-preview-box">
                                       <h5>Preview</h5>
                                    <div class="ly-car-card ly-car-card-grid">
                                        <div class="car-img-box">
                                            <a href="#"><img src="https://placehold.co/395x240?text=Preview+Image" alt="list-img"></a>
                                            <span class="card-tag">superhost</span>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                            
                             <div class="col-lg-8 col-xl-8 col-sm-12" style="">
                             <input type="submit" class="submit_product"></input>
                             </div>
                            
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        const imageUrls = {!! json_encode($getProductImages) !!};
        console.log(imageUrls);
        const imagePreviewDiv = document.getElementById('image_preview');

    imageUrls.forEach(filename => {
        const imgElement = document.createElement('img');
        imgElement.src = "{{ asset('front/images/product_images/small') }}" + '/' + filename;
        imgElement.style.maxWidth = '100px'; 
        imgElement.style.marginRight = '10px';

        // Append img element to the image preview div
        imagePreviewDiv.appendChild(imgElement);
    });
    </script>
@endsection