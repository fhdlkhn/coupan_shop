@extends('front.layout.layout')
  @section('content')
  <style type="text/css">
        #mw_map {
          height: 400px;
        }
    </style>
    <!-- ly-page-top-section-start -->
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
                @endif -->



                {{-- Displaying Laravel Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}    
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
                <div class="col-lg-12">
                    <form class="new_listing_submission" @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif id="new_listing_submission" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="snet-car-listing-wrapper listing-step-2">
                     
                      
                        <div class="row" style="width:100%;">
                            <div class="col-sm-8" style="float:left;">
                                <h3> List your product </h3>
                                <div class="snet-lisitng-cover-photos">
                                  
                                    <h5>Upload photo </h5>
                                     <p>Drag or Choose your photo to upload</p>
                                      <input type="file" name="product_image[]" id="images" multiple class="form-control">
                                    <div id="dropzone_new" class="dropzone_new dz-clickable dz-started">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 5C3 2.79086 4.79086 1 7 1H15.3431C16.404 1 17.4214 1.42143 18.1716 2.17157L19.8284 3.82843C20.5786 4.57857 21 5.59599 21 6.65685V19C21 21.2091 19.2091 23 17 23H7C4.79086 23 3 21.2091 3 19V5ZM19 8V19C19 20.1046 18.1046 21 17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H14V5C14 6.65685 15.3431 8 17 8H19ZM18.8891 6C18.7909 5.7176 18.6296 5.45808 18.4142 5.24264L16.7574 3.58579C16.5419 3.37035 16.2824 3.20914 16 3.11094V5C16 5.55228 16.4477 6 17 6H18.8891Z" fill="#777E91"/>
                                            <path d="M11.6172 9.07588C11.4993 9.12468 11.3888 9.19702 11.2929 9.29289L8.29289 12.2929C7.90237 12.6834 7.90237 13.3166 8.29289 13.7071C8.68342 14.0976 9.31658 14.0976 9.70711 13.7071L11 12.4142V17C11 17.5523 11.4477 18 12 18C12.5523 18 13 17.5523 13 17V12.4142L14.2929 13.7071C14.6834 14.0976 15.3166 14.0976 15.7071 13.7071C16.0976 13.3166 16.0976 12.6834 15.7071 12.2929L12.7071 9.29289C12.4125 8.99825 11.9797 8.92591 11.6172 9.07588Z" fill="#777E91"/>
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
                                                <select name="category_id" id="category_id" class="form-control text-dark" style="border-radius: 12px; border: 2px solid #E6E8EC !important;">
                                                    <option value="">Select Category</option>
                                                         @foreach ($categories as $section)
                                                            <optgroup label="{{ $section['name'] }}"> 
                                                                @foreach ($section['categories'] as $category) 
                                                                    <option value="{{ $category['id'] }}" @if (!empty($product['category_id'] == $category['id'])) selected @endif>{{$category['category_name']}}</option>
                                                                    @foreach ($category['sub_categories'] as $subcategory) 
                                                                        <option value="{{ $subcategory['id'] }}" @if (!empty($product['category_id'] == $subcategory['id'])) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['category_name'] }}</option> 
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
                                                <input required type="number" class="form-control" id="product_code" placeholder="Enter Tax Id" name="product_code" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif> 
                                            </div>
                                            <div class="car_detail">
                                                <label for="product_type">Listing Type</label>
                                                <input required type="text" class="form-control" id="product_type" placeholder="Enter Listing Type" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="product_type" @if (!empty($product['product_type'])) value="{{ $product['product_type'] }}" @else value="{{ old('product_type') }}" @endif> 
                                            </div>
                                            
                                            <div class="car_detail">
                                                <label for="gross_sale">What’s your annual savings?</label>
                                                <input required type="text" class="form-control" id="gross_sale" placeholder="Enter Monthly Savings" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="gross_sale" @if (!empty($product['gross_sale'])) value="{{ $product['gross_sale'] }}" @else value="{{ old('gross_sale') }}" @endif>
                                            </div>
                                            <div class="car_detail" >
                                                <label for="avg_customer">Membership Valid Through?</label>
                                                <select required name="avg_customer" id="avg_customer" class="form-control text-dark" style="border-radius: 12px; border: 2px solid #E6E8EC !important; margin-top:-5px;" onchange="disablePermanent(this.value)">
                                                    <option value="" selected disabled style="margin-bottom:-10px;">Select Membership (Years)</option>
                                                    @for($i = 0; $i < 10; $i++)
                                                        <option value="{{$i + 1}}" {{ $product['avg_customer'] == ($i + 1) ? 'selected' : '' }}>{{$i + 1}}</option>
                                                    @endfor
                                                        <option value="permanent">Permanent</option>
                                                </select>
                                            </div>
                                            <div class="car_detail">
                                                <label for="is_featured">Featured Item (Yes/No)</label>
                                                <input  type="checkbox" name="is_featured" id="is_featured" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" value="Yes" @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked @endif>
                                            </div>

                                        </div>
                                        <div class="col-6">

                                            <div class="car_detail">
                                                <label for="product_name">Listing Name</label>
                                                <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="product_name" @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif>  
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
                                                <input type="number" class="form-control" id="product_discount" placeholder="Enter Total Savings" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="product_discount" @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                                            </div>
                                           
                                            <div class="car_detail" id="validity">
                                                <label for="validity">Validity</label>
                                                <input type="date" class="form-control"  placeholder="Enter Product Discount" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="validity" @if (!empty($product['validity'])) value="{{ $product['validity'] }}" @else value="{{ old('validity') }}" @endif>
                                            </div>
                                            

                                        </div>

                                        <div class="col-12">
                                            <div class="car_detail">
                                                <label for="description">Listing Description</label>
                                                <textarea required name="description" id="description" class="form-control" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" rows="3">{{ $product['description'] }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="car_detail">
                                                <label for="address">Listing Address</label>
                                                <input type="text" required name="address" id="mw_address" class="form-control" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" @if (!empty($product['address'])) value="{{ $product['address'] }}" @else value="{{ old('address') }}" @endif></input>
                                            </div>
                                        </div>
                                        <div id="mw_map">
                                            
                                        </div>
                                        <input type="hidden" name="lat" id="mw_latt" @if (!empty($product['latitude'])) value="{{ $product['latitude'] }}" @else value="40.7128" @endif>
                                        <input type="hidden" name="long" id="mw_long" @if (!empty($product['longitude'])) value="{{ $product['longitude'] }}" @else value="-74.0060" @endif>
                                    </div>
                                </div>




                            </div>

                            <div class="col-sm-4" style="float:right;">

                                <div class="snet-listing-preview-box">
                                    <h5>Preview</h5>
                                    <div class="ly-car-card ly-car-card-grid">
                                        <div class="car-img-box">
                                            <a href="#"><img src="{{ !empty($product['product_image']) ? asset('front/images/product_images/small/'.$product['product_image']) : 'https://placehold.co/395x240?text=Preview+Image' }}" alt="list-img"></a>
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
    
    

    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZIwomjpgXMHZdAmwubQ-0iNghQHfbCKU&libraries=places"></script>
   
    <!-- <script type="text/javascript">
        function initMap() {
          const myLatLng = { lat: 22.2734719, lng: 70.7512559 };
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
          });
  
          new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello Rajkot!",
          });
        }
  
        window.initMap = initMap;
    </script> -->
    <script type="text/javascript">
    var chk_container = document.getElementById('mw_map'); // Corrected map container id
    
    var map_lat = document.getElementById('mw_latt').value;
    var map_long = document.getElementById('mw_long').value;
      
      
      
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
    
    google.maps.event.addListener(get_markers, "mouseup", function(event) {
        var latitude = this.position.lat();
        var longitude = this.position.lng();
        $('#mw_latt').val(latitude);
        $('#mw_long').val(longitude);
    });
    
    var places_input = document.getElementById('mw_address');
    console.log(places_input);
    var autocomplete = new google.maps.places.Autocomplete(places_input);
    autocomplete.bindTo('bounds', map);
    
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var fetch_places = autocomplete.getPlace();
        
        if (!fetch_places.geometry) {
            return;
        }
        
        if (fetch_places.geometry.viewport) {
            map.fitBounds(fetch_places.geometry.viewport);
        } else {
            map.setCenter(fetch_places.geometry.location);
            map.setZoom(13);
        }
        
        get_markers.setPosition(fetch_places.geometry.location); // Update marker position
        get_markers.setVisible(true);
        $('#mw_latt').val(get_markers.getPosition().lat());
        $('#mw_long').val(get_markers.getPosition().lng());
    });
</script>
    <script type="text/javascript">
        function disablePermanent(value){
            if(value == 'permanent'){
                document.getElementById('validity').style.display = 'none';
            }
            else{
                document.getElementById('validity').style.display = 'block';
            }
        }

        
    </script>
    <script type="text/javascript">

       $(document).ready(function() {
    var fileArr = [];

    // Function to add images to the preview
    function addImagesToPreview(files) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.size > 1048576) {
                return false;
            } else {
                fileArr.push(file);
                $('#image_preview').append("<div class='img-div'><img src='" + URL.createObjectURL(file) + "' class='img-responsive image img-thumbnail' title='" + file.name + "'><div class='middle'><button class='btn btn-danger delete-btn'><i class='fa fa-trash'></i></button></div></div>");
            }
        }
    }

    // Handle file input change event
    $("#images").change(function(event) {
        var total_file = event.target.files;
        if (!total_file.length) return;

        // Add new images to preview
        addImagesToPreview(total_file);
    });

    // Handle delete button click event
    $('#image_preview').on('click', '.delete-btn', function(event) {
        event.preventDefault(); // Prevent default behavior

        var imgDiv = $(this).closest('.img-div');
        var fileName = imgDiv.find('img').attr('title');

        // Remove the image div from the preview
        imgDiv.remove();

        // Remove the corresponding file from fileArr
        fileArr = fileArr.filter(function(file) {
            return file.name !== fileName;
        });
    });

    // Trigger file input click when dropzone is clicked
    $('.dropzone_new').on('click', function() {
        $('#images').click();
    });

    // Append existing images to the preview
    const imageUrls = {!! json_encode($getAllIMages) !!};
    imageUrls.forEach(function(filename) {
        $('#image_preview').append("<div class='img-div'><img src='{{ asset('front/images/product_images/small') }}/" + filename + "' class='img-responsive image img-thumbnail' title='" + filename + "'><div class='middle'><button class='btn btn-danger delete-btn'><i class='fa fa-trash'></i></button></div></div>");
    });
});


    </script>
@endsection