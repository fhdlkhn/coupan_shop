@extends('front.layout.layout')
@section('content')
<style>
     #mw_map {
          height: 400px;
          display: none;
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
</style>
        <section class="ly-page-top-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Shop</h1>
                    <p>Join top UK hosts who make an average of £6,492 every year for each listing they list</p>
                </div>
            </div>
        </div>
    </section>
    <section class="ly-listing-projects-section">
        <div class="page-shop u-s-p-t-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="fetch-categories">
                             <!-- <h3 class="title-name">Search Location</h3>
                            <div id="locationField">
                                <input type="text" required name="address" id="mw_address" class="form-control" style="border-radius: 12px; border: 2px solid #E6E8EC !important;"></input>
                            </div> -->
                            <h3 class="title-name">Browse Categories</h3>
                            @foreach($fetchAllCategories as $allCats)
                            <h3 class="fetch-mark-category">
                                <a href="{{url('search-products',['cat'=>$allCats])}}">{{$allCats->category_name}}
                                    <span class="total-fetch-items">(5)</span>
                                </a>
                            </h3>
                            <ul>
                                @if($allCats->subCategories != null)
                                    @foreach($allCats->subCategories as $allSubCats)
                                    <li>
                                        <a href="{{url('search-products',['cat'=> $allSubCats])}}">{{$allSubCats->category_name}}
                                            <span class="total-fetch-items">(2)</span>
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                            @endforeach
                        </div>
                            <div class="facet-filter-associates">
                        <h3 class="title-name">Price</h3>
                        <form class="" action="{{url('search-products',['cat'=> null])}}" method="get" id="priceForm">
                            <div class="associate-wrapper">
                                @php
                                    $prices = array('0-1000', '1000-2000', '2000-5000', '5000-10000', '10000-100000');
                                @endphp

                                @foreach ($prices as $key => $price)
                                    <input type="radio" class="check-box price" id="price{{ $key }}" name="price" value="{{ $price }}" @if ($Sprice == $price) checked @endif>
                                    <label class="label-text" for="price{{ $key }}">$ {{ $price }}</label>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="page-bar clearfix">
                            <!-- @if (!isset($_REQUEST['search']))
                                <form name="sortProducts" id="sortProducts"> 
                                    <input type="hidden" name="url" id="url" value="{{ $url }}">

                                    <div class="toolbar-sorter">
                                        <div class="select-box-wrapper">
                                            <label class="sr-only" for="sort-by">Sort By</label>
                                            <select name="sort" id="sort" class="select-box">
                                                <option value="" selected>Select</option>
                                                <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_latest') selected @endif>Sort By: Latest</option>
                                                <option value="price_lowest"   @if(isset($_GET['sort']) && $_GET['sort'] == 'price_lowest')   selected @endif>Sort By: Lowest Price</option>
                                                <option value="price_highest"  @if(isset($_GET['sort']) && $_GET['sort'] == 'price_highest')  selected @endif>Sort By: Highest Price</option>
                                                <option value="name_a_z"       @if(isset($_GET['sort']) && $_GET['sort'] == 'name_a_z')       selected @endif>Sort By: Name A - Z</option>
                                                <option value="name_z_a"       @if(isset($_GET['sort']) && $_GET['sort'] == 'name_z_a')       selected @endif>Sort By: Name Z - A</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            @endif -->
                            <!-- <div class="toolbar-sorter-2">
                                <div class="select-box-wrapper">
                                    <label class="sr-only" for="show-records">Show Records Per Page</label>
                                    <select class="select-box" id="show-records">
                                        <option selected="selected" value="">Showing: {{ count($categoryProducts) }}</option>
                                        <option value="">Showing: All</option>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                        <label class="switch">
                            <input type="checkbox" id="toggleContent" checked>
                            <span class="slider"></span>
                        </label>
                        
                        <div id="mw_map"></div>
                        <div class="filter_products" id="filterProducts">
                            @include('front.products.ajax_products_listing')
                        </div>
                        @if (!isset($_REQUEST['search']))
                            @if (isset($_GET['sort']))
                                <div>
                                    {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                                </div>
                            @else
                                <div>
                                    {{ $categoryProducts->links() }}
                                </div>
                            @endif
                        @endif
                        <div>&nbsp;</div>
                        <div>{{ $categoryDetails != null ? $categoryDetails['categoryDetails']['description'] : ''}}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZIwomjpgXMHZdAmwubQ-0iNghQHfbCKU&libraries=places"></script>
    <script  src="https://googlemaps.github.io/js-marker-clusterer/src/markerclusterer.js"></script>
    <script type="text/javascript">
    var chk_container = document.getElementById('mw_map'); // Corrected map container id
    var markers = [];
    var map_lat = 40.7128
    var map_long = -74.0060;
      
      
      
    var map_center_positionr = new google.maps.LatLng(map_lat, map_long);
    var mapOptions = {
        zoom: 13,
        center: map_center_positionr,
        disableDefaultUI: false
    };
    var map = new google.maps.Map(chk_container, mapOptions);
    var getListingLocations = {!! json_encode($categoryProducts) !!};
    console.log(getListingLocations.data);

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

    for (var d = 0, dl = getListingLocations.data.length; d < dl; d++) {
        console.log()
		addMarker(new google.maps.LatLng(getListingLocations.data[d].latitude, getListingLocations.data[d].longitude), getListingLocations.data[d].product_name);
        var content = getListingLocations.data[d].product_name;
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
    
    var get_markers = new google.maps.Marker({
        position: map_center_positionr,
        map: map,
        labelAnchor: new google.maps.Point(1, 1),
        draggable: true,
    });
    google.maps.event.addDomListener(window, 'load', initialize);
    
    // google.maps.event.addListener(get_markers, "mouseup", function(event) {
    //     var latitude = this.position.lat();
    //     var longitude = this.position.lng();
    //     $('#mw_latt').val(latitude);
    //     $('#mw_long').val(longitude);
    // });
    
    var places_input = document.getElementById('mw_address');
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
        // $('#mw_latt').val(get_markers.getPosition().lat());
        // $('#mw_long').val(get_markers.getPosition().lng());
    });
</script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggleContent = document.getElementById("toggleContent");
            var filterProducts = document.getElementById("filterProducts");
            var filterLocation = document.getElementById("mw_map");
             filterLocation.style.display = "none";

            toggleContent.addEventListener("change", function() {
                if (this.checked) {
                filterProducts.style.display = "block";
                filterLocation.style.display = "none";
                } else {
                filterProducts.style.display = "none";
                filterLocation.style.display = "block";
                }
            });
        });
    document.addEventListener("DOMContentLoaded", function() {
        var radioButtons = document.querySelectorAll('.check-box.price');
        
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('click', function() {
                document.getElementById('priceForm').submit();
            });
        });
    });
</script>
@endsection