@extends('front.layout.layout')


@section('content')
<style type="text/css">
#mw_map {
    height: 400px;
}
</style>

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
                <form class="new_listing_submission" action="{{ route('update.user.products') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                    <input type="hidden" name="order_product" value="{{$order_id}}">
                    <div class="snet-car-listing-wrapper listing-step-2">


                        <div class="row" style="width:100%;">
                            <div class="col-sm-6" style="float:left;">
                                <h3> List your product </h3>
                                <div class="snet-lisitng-cover-photos">
                                    <h5>Upload photo </h5>
                                    <p>Drag or Choose your photo to upload</p>
                                    <input type="file" name="product_image[]" id="images" multiple class="form-control"
                                        disabled>
                                    <div id="dropzone_new" class="dropzone_new dz-clickable dz-started">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <!-- <path fill-rule="evenodd" clip-rule="evenodd" d="M3 5C3 2.79086 4.79086 1 7 1H15.3431C16.404 1 17.4214 1.42143 18.1716 2.17157L19.8284 3.82843C20.5786 4.57857 21 5.59599 21 6.65685V19C21 21.2091 19.2091 23 17 23H7C4.79086 23 3 21.2091 3 19V5ZM19 8V19C19 20.1046 18.1046 21 17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H14V5C14 6.65685 15.3431 8 17 8H19ZM18.8891 6C18.7909 5.7176 18.6296 5.45808 18.4142 5.24264L16.7574 3.58579C16.5419 3.37035 16.2824 3.20914 16 3.11094V5C16 5.55228 16.4477 6 17 6H18.8891Z" fill="#777E91"/> -->
                                            <!-- <path d="M11.6172 9.07588C11.4993 9.12468 11.3888 9.19702 11.2929 9.29289L8.29289 12.2929C7.90237 12.6834 7.90237 13.3166 8.29289 13.7071C8.68342 14.0976 9.31658 14.0976 9.70711 13.7071L11 12.4142V17C11 17.5523 11.4477 18 12 18C12.5523 18 13 17.5523 13 17V12.4142L14.2929 13.7071C14.6834 14.0976 15.3166 14.0976 15.7071 13.7071C16.0976 13.3166 16.0976 12.6834 15.7071 12.2929L12.7071 9.29289C12.4125 8.99825 11.9797 8.92591 11.6172 9.07588Z" fill="#777E91"/> -->
                                        </svg>
                                        <div class="form-group">
                                            <div id="image_preview" style="width:100%;"> </div>
                                            <p>PNG, JPG, JPEG</p>
                                        </div>
                                    </div>
                                    <div class="car_detail">
                                        <label for="extras">Extras</label>
                                        <input type="checkbox" disabled
                                            style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                            name="extras" id="extras" @if (!empty($product['extras_description']))
                                            checked @endif onclick="toggleTextarea()">
                                    </div>
                                    <div id="textarea-container" class="textarea-hidden"
                                        style="display: {{$product['split_payment_select'] != null ? 'block' : 'none'}}">
                                        <label for="extras-description">Description of Extras</label>
                                        <textarea disabled id="extras-description" name="extras-description"
                                            class="form-control"
                                            style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                            rows="3">{{ $product['extras_description'] }}</textarea>
                                    </div>
                                    <div class="car_detail">
                                        <label for="split_payments">Split Payments</label>
                                        <input type="checkbox" disabled
                                            style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                            name="split_payments" id="split_payments"
                                            @if(!empty($product['split_payment_select'])) checked @endif
                                            onclick="toggleSplitPayment()">
                                    </div>
                                    <div id="split-payment-container"
                                        style="display: {{$product['split_payment_select'] != null ? 'block' : 'none'}}">
                                        <div class="textarea-hidden">
                                            <label for="split-payment-select">Select Plans</label>
                                            <select id="split-payment-select" name="split-payment-select" disabled
                                                class="form-control"
                                                style="border-radius: 12px; border: 0px solid #E6E8EC !important;">
                                                <option value="">Choose Months</option>
                                                <option value="12" @if (!empty($product['split_payment_select']) &&
                                                    $product['split_payment_select']==12) selected @endif>12</option>
                                                <option value="24" @if (!empty($product['split_payment_select']) &&
                                                    $product['split_payment_select']==24) selected @endif>24</option>
                                                <option value="36" @if (!empty($product['split_payment_select']) &&
                                                    $product['split_payment_select']==36) selected @endif>36</option>
                                                <option value="48" @if (!empty($product['split_payment_select']) &&
                                                    $product['split_payment_select']==48) selected @endif>48</option>
                                                <option value="60" @if (!empty($product['split_payment_select']) &&
                                                    $product['split_payment_select']==60) selected @endif>60</option>

                                            </select>
                                        </div>
                                        <div class="car_detail">
                                            <label for="split_amount">Split Amount</label>
                                            <input type="number" class="form-control" placeholder="Split Amount"
                                                style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                                name="split_amount" id="split_amount" disabled
                                                @if(!empty($product['split_amount']))
                                                value="{{$product['split_amount']}}" @else value="" @endif>
                                        </div>
                                    </div>
                                    <div class="car_detail">
                                        <label for="divident">Dividends or Profit Sharing</label>
                                        <input type="checkbox" disabled
                                            style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                            name="divident" id="divident" @if (!empty($product['divident_description']))
                                            checked @endif onclick="toggleDividentTextarea()">
                                    </div>
                                    <div id="divedent-textarea-container" class="textarea-hidden"
                                        style="display: {{$product['divident_description'] != null ? 'block' : 'none'}}">
                                        <label for="divident-description">Description of Dividends or Profit
                                            Sharing</label>
                                        <textarea disabled id="divident-description" name="divident-description"
                                            class="form-control"
                                            style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                            rows="3">{{ $product['divident_description'] }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="car_detail">
                                            <label for="address">Listing Address</label>
                                            <input type="text" required name="address" id="mw_address"
                                                class="form-control"
                                                style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                                @if(!empty($product['address'])) value="{{ $product['address'] }}" @else
                                                value="{{ old('address') }}" @endif></input>
                                        </div>
                                    </div>
                                    <div id="mw_map"></div>
                                    <input type="hidden" name="lat" id="mw_latt" @if (!empty($product['latitude']))
                                        value="{{ $product['latitude'] }}" @else value="40.7128" @endif>
                                    <input type="hidden" name="long" id="mw_long" @if(!empty($product['longitude']))
                                        value="{{ $product['longitude'] }}" @else value="-74.0060" @endif>
                                </div>
                            </div>
                            <div class="col-sm-6" style="float:right;">
                                <div class="listing_details">
                                    <h6>Listing Details</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="car_detail">
                                                <label for="category_id">Select Category</label>
                                                <select name="category_id" id="category_id"
                                                    class="form-control text-dark" disabled
                                                    style="border-radius: 12px; border: 0px solid #E6E8EC !important;">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $section)
                                                    <optgroup label="{{ $section['name'] }}">
                                                        @foreach ($section['categories'] as $category)
                                                        <option value="{{ $category['id'] }}"
                                                            @if(!empty($product['category_id']==$category['id']))
                                                            selected @endif>{{ $category['category_name'] }}</option>
                                                        {{-- parent categories --}}
                                                        @foreach ($category['sub_categories'] as $subcategory)
                                                        {{-- subcategories or child categories --}}
                                                        {{-- Check ProductsController.php --}}
                                                        <option value="{{ $subcategory['id'] }}"
                                                            @if(!empty($product['category_id']==$subcategory['id']))
                                                            selected @endif>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['category_name'] }}
                                                        </option> {{-- subcategories or child categories --}}
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
                                                <label for="product_type">Discount Type</label>
                                                <select disabled class="form-control" id="product_type"
                                                    style="border-radius: 12px; border: 0px solid #E6E8EC !important;"
                                                    name="product_type">
                                                    <option value="">Select Discount Type</option>
                                                    <option value="membership"
                                                        {{ $product['product_type'] == 'membership' ? 'selected' : '' }}>
                                                        Membership</option>
                                                    <option value="coupan"
                                                        {{ $product['product_type'] == 'coupan' ? 'selected' : '' }}>
                                                        Coupan</option>
                                                </select>
                                                <!--<input required type="text" class="form-control" id="product_type" placeholder="Enter Listing Type" style="border-radius: 12px; border: 2px solid #E6E8EC !important;" name="product_type" @if (!empty($product['product_type'])) value="{{ $product['product_type'] }}" @else value="{{ old('product_type') }}" @endif> -->
                                            </div>
                                            <div class="car_detail">
                                                <label for="gross_sale">Annual Savings?</label>
                                                <input disabled type="text" class="form-control" id="gross_sale"
                                                    placeholder="Enter Annual Saving"
                                                    style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                                    name="gross_sale" @if (!empty($product['gross_sale']))
                                                    value="{{ $product['gross_sale'] }}" @else
                                                    value="{{ old('gross_sale') }}" @endif>
                                            </div>
                                            <div class="car_detail">
                                                <label for="avg_customer">Membership Valid Through?</label>
                                                <select disabled name="avg_customer" id="avg_customer"
                                                    class="form-control text-dark"
                                                    style="border-radius: 12px; border: 0px solid #E6E8EC !important; margin-top:-5px;"
                                                    onchange="disablePermanent(this.value)">
                                                    <option value="" selected disabled style="margin-bottom:-10px;">
                                                        Select Membership (Years)</option>
                                                    @for($i = 0; $i < 10; $i++) <option value="{{$i + 1}}"
                                                        {{ $product['avg_customer'] == ($i + 1) ? 'selected' : '' }}>
                                                        {{$i + 1}} Years</option>
                                                        @endfor
                                                        <option value="permanent">Permanent</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">

                                            <div class="car_detail">
                                                <label for="product_name">Title</label>
                                                <input disabled type="text" class="form-control" id="product_name"
                                                    placeholder="Enter Listing Name"
                                                    style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                                    name="product_name" @if (!empty($product['product_name']))
                                                    value="{{ $product['product_name'] }}" @else
                                                    value="{{ old('product_name') }}" @endif>
                                            </div>
                                            <div class="car_detail">
                                                <label for="product_price">Price</label>
                                                <input type="text" class="form-control" id="product_price"
                                                    placeholder="Enter Listing Price"
                                                    style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                                    name="product_price" @if (!empty($product['product_price']))
                                                    value="{{ $product['product_price'] }}" @else
                                                    value="{{ old('product_price') }}" @endif>
                                            </div>
                                            <div class="car_detail">
                                                <label for="product_units">Unit / Qty</label>
                                                <input type="text" class="form-control" id="product_units"
                                                    placeholder="Enter Listing Units"
                                                    style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                                    name="product_units" @if (!empty($product['product_units']))
                                                    value="{{ $product['product_units'] }}" @else
                                                    value="{{ old('product_units') }}" @endif>
                                            </div>

                                            <div class="car_detail">
                                                <label for="product_discount">Discount</label>
                                                <input disabled type="number" class="form-control" id="product_discount"
                                                    placeholder="Enter Discount"
                                                    style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                                    name="product_discount" @if (!empty($product['product_discount']))
                                                    value="{{ $product['product_discount'] }}" @else
                                                    value="{{ old('product_discount') }}" @endif max="100">
                                            </div>
                                        </div>

                                        <div class="col-12">

                                            <div class="car_detail" id="validity">
                                                <label for="validity">Valid Date</label>
                                                <input disabled type="date" class="form-control"
                                                    placeholder="Enter Product Discount"
                                                    style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                                    name="validity" id="validityInput">
                                            </div>
                                            <div class="textarea-hidden">
                                                <label for="target_audiesnce">Targeted Audience</label>
                                                <select disabled id="split-payment-select" name="target_audiesnce"
                                                    class="form-control"
                                                    style="border-radius: 12px; border: 0px solid #E6E8EC !important;">
                                                    <option value="">Choose Location</option>
                                                    <option value="international"
                                                        @if(!empty($product['target_audiesnce']) &&
                                                        $product['target_audiesnce']=='internation' ) selected @endif>
                                                        International</option>
                                                    <option value="local" @if (!empty($product['target_audiesnce']) &&
                                                        $product['target_audiesnce']=='local' ) selected @endif>Local
                                                    </option>
                                                    <option value="both" @if (!empty($product['target_audiesnce']) &&
                                                        $product['target_audiesnce']=='both' ) selected @endif>Both
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="car_detail">
                                                <label for="description">Description</label>
                                                <textarea disabled required name="description" id="description"
                                                    class="form-control"
                                                    style="border-radius: 12px; border: 2px solid #E6E8EC !important;"
                                                    rows="3">{{ $product['description'] }}</textarea>
                                            </div>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZIwomjpgXMHZdAmwubQ-0iNghQHfbCKU&libraries=places">
</script>
<script tye="text/javascript">
function toggleTextarea() {
    var checkbox = document.getElementById('extras');
    var textareaContainer = document.getElementById('textarea-container');
    if (checkbox.checked) {
        textareaContainer.style.display = 'block';
    } else {
        textareaContainer.style.display = 'none';
    }
}

function toggleSplitPayment() {
    var checkbox = document.getElementById('split_payments');
    var textareaContainer = document.getElementById('split-payment-container');
    if (checkbox.checked) {
        textareaContainer.style.display = 'block';
    } else {
        textareaContainer.style.display = 'none';
    }
}

function toggleDividentTextarea() {
    var checkbox = document.getElementById('divident');
    var textareaContainer = document.getElementById('divedent-textarea-container');
    if (checkbox.checked) {
        textareaContainer.style.display = 'block';
    } else {
        textareaContainer.style.display = 'none';
    }
}
</script>
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
    var imageUrls = {!! json_encode($getProductImages) !!};
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