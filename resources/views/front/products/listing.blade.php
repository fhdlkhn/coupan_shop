@extends('front.layout.layout')
@section('content')
<style>
     #mw_map {
          height: 900px;
           padding-left: 15px;
           margin-top: 40px;
           background-color: #f0f0f0;
        }
/* Custom CSS for toggle switch */
.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 24px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 24px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #007bff;
}

input:checked + .slider:before {
  transform: translateX(16px);
}


section.ly-page-top-section::before {
    content: "";
    width: 100%;
    /* height: 1000px; */
    background-color: rgba(0, 35, 82, 0.4);
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    height: 286px;
    z-index: 0;
}

form#priceForm {
    z-index: 1;
    position: relative;
}
#filterProducts {
        border-right: 1px solid #ddd;
        padding-right: 15px;
    }



#priceForm input.form-control ,#priceForm  select{
    width: 100% !important;
    border: 2px solid #E6E8EC !important;
    border-radius: 12px !important;
    padding: 12px 16px !important;
    background: #fff !important;
    height: 50px;
    line-height: 30px;
    color: #777;
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: var(--bs-body-color);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: var(--bs-body-bg);
    background-clip: padding-box;
    border: var(--bs-border-width) solid var(--bs-border-color);
    border-radius: var(--bs-border-radius);
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    margin-bottom : 20px;
}

.map_toggle {
    float: right;
    position: relative;
    /* display: inline-block; */
    /* position: absolute; */
    right: 0;
    top: 0;
    margin-bottom: 25px;
    text-align: right;
}
.ly-car-card-list .car-img-box {
    width: 50%;
    height: 160px;
    min-width: 290px;
}


</style>
        <section class="ly-page-top-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                     <form action="{{ url('search-products', ['cat' => null]) }}" method="get" id="priceForm">
                        <div class="d-flex flex-wrap align-items-center">
                            <!-- Product Name Input -->
                            <div class="p-2 flex-grow-1">
                                <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" value="{{ request()->input('product_name') }}" name="product_name" @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                            </div>
                            
                            <!-- Category Select -->
                            <div class="p-2 flex-grow-1">
                                <select name="category_id" id="category_id" class="form-control text-dark">
                                    <option value="">Select Category</option>
                                    @foreach ($fetchAllCategories as $section)
                                        <option value="{{ $section['id'] }}" label="{{ $section['category_name'] }}">
                                            @if (!empty($section['sub_categories']))
                                                @foreach ($section['sub_categories'] as $subcategory)
                                                    <option value="{{ $subcategory['id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['category_name'] }}</option>
                                                @endforeach
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Discount Range Select -->
                            <div class="p-2 flex-grow-1">
                                <select class="form-select" id="discount" name="discount">
                                    <option value="">Select Discount Range</option>
                                    @php
                                        $prices = array('0-10', '11-20', '21-30', '31-40', '41-50', '51-60');
                                    @endphp
                                    @foreach ($prices as $key => $price)
                                        <option value="{{ $price }}" @if ($Sprice == $price) selected @endif>{{ $price }}%</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Search Button -->
                            <div class="p-2" style="margin-bottom: 15px">
                                <input type="submit" name="Search" class="ly-button-3" value="Search"></input>
                                @if (!empty($_GET))
                                    <button type="reset" class="ly-button-3" onclick="clearRecord()">Clear</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="ly-listing-projects-section">
        <div class="page-shop u-s-p-t-80">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6" id="filterProducts">
                        @include('front.products.ajax_products_listing')
                    </div>
                    <div class="col-lg-6">
                        <form action="{{ url('search-products', ['cat' => null]) }}" method="get" id="priceForm">
                            <div class="form-row row">
                                <div class="form-group col-md-6">
                                    <label for="mw_address">Address</label>
                                    <input type="text" name="address" id="mw_address" class="form-control pac-target-input" placeholder="Address" value="" autocomplete="off">
                                    <input type="hidden" name="lat" id="mw_latt" value="40.7128">
                                    <input type="hidden" name="long" id="mw_long" value="-74.0060">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mw_radius">Radius in KM</label>
                                    <input type="number" name="radius" id="mw_radius" class="form-control" placeholder="Radius in KM" value="">
                                </div>
                                
                            </div>
                            <div class="form-group">
                                    <button type="submit" class="ly-button-3 btn btn-primary w-100">Search</button>
                                </div>
                        </form>
                        <div id="mw_map"></div>
                    </div>
                    @if (!isset($_REQUEST['search']))
                        @if (isset($_GET['sort']))
                            <div class="col-12">
                                {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                            </div>
                        @elseif($categoryProducts instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <div>
                                    {{ $categoryProducts->links() }}
                                </div>
                        @endif
                    @endif
                    <div class="col-12 my-3">
                        {{ $categoryDetails != null ? $categoryDetails['categoryDetails']['description'] : '' }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZIwomjpgXMHZdAmwubQ-0iNghQHfbCKU&libraries=places"></script>
    <script  src="https://googlemaps.github.io/js-marker-clusterer/src/markerclusterer.js"></script>
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
            // position: map_center_positionr,
            map: map,
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
        var autocomplete = new google.maps.places.Autocomplete(places_input);
        autocomplete.bindTo('bounds', map);
        
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var fetch_places = autocomplete.getPlace();
            
            if (!fetch_places.geometry) {
                return;
            }
            
            if (fetch_places.geometry.viewport) {
                // map.fitBounds(fetch_places.geometry.viewport);
            } else {
                // map.setCenter(fetch_places.geometry.location);
                // map.setZoom(13);
            }
            
            get_markers.setPosition(fetch_places.geometry.location); // Update marker position
            get_markers.setVisible(true);
          
            $('#mw_latt').val(get_markers.getPosition().lat());
            $('#mw_long').val(get_markers.getPosition().lng());
        });


        var markers = [];
        var getListingLocations = {!! json_encode($categoryProducts) !!};


        var addMarker = function (location, content) {
            var marker = new google.maps.Marker({
                map: map,
                position: location,
                title: 'test',
                icon: {
                    path: 'M10,5c2.762,0,5,2.239,5,5s-2.239,5-5,5c-2.761,0-5-2.239-5-5S7.239,5,10,5z',
                    anchor: new google.maps.Point(10, 10),
                    fillColor: '#FF0000',
                    fillOpacity: 1,
                    strokeWeight: 10,
                    strokeColor: '#000000',
                    strokeOpacity: 0.25
                }
            });

            var infoWindow = new google.maps.InfoWindow({
                content: content
            });

            google.maps.event.addListener(marker, 'click', function() {
                infoWindow.open(map, marker);
            });

            markers.push(marker);
        };
        if (getListingLocations && getListingLocations.data && getListingLocations.data.length > 0) {
            for (var d = 0, dl = getListingLocations.data.length; d < dl; d++) {
                addMarker(new google.maps.LatLng(getListingLocations.data[d].latitude, getListingLocations.data[d].longitude), getListingLocations.data[d].product_name);
                var content = getListingLocations.data[d].product_name;
            }
        } else {
            for (var key in getListingLocations) {
                if (getListingLocations.hasOwnProperty(key)) {
                    var listing = getListingLocations[key];
                    console.log(listing.latitude); // Access latitude property
                    console.log(listing.longitude); // Access longitude property

                    // Add marker using latitude and longitude
                    addMarker(new google.maps.LatLng(listing.latitude, listing.longitude), listing.product_name);
                    var content = listing.product_name;
                }
            }
        }
        var markerClusterOptions = {
            gridSize: 40,
            maxZoom: 15,
            styles: [{
                width: 30,
                height: 30,
                
                url: 'data:image/svg+xml;base64,' + window.btoa('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><path fill="#78c1a3" stroke="#78c1a3" stroke-width="10" stroke-opacity="0.25" d="M15,5c5.524,0,10,4.478,10,10s-4.478,10-10,10S5,20.522,5,15S9.478,5,15,5z"/></svg>'),
                textColor: 'white',
                textSize: 12
            }]
        };
        var markerCluster = new MarkerClusterer(map, markers, markerClusterOptions);
        
        // google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script>
        
        function clearRecord(){
            document.getElementById("product_name").value ="";
            document.getElementById("category_id").value ="";
            // document.getElementById("price_range").value ="";
            // document.getElementById("price").value ="";
            document.getElementById('priceForm').submit();
        }
</script>
@endsection