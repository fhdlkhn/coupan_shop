{{-- This page is rendered by contact() method inside Front/CmsController.php --}}
@extends('front.layout.layout')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Contact Us</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="contact.html">Listing Verification</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Contact-Page -->
    <div class="page-contact u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="touch-wrapper">
                        <h1 class="contact-h1">Get In Touch With Us</h1>
                        <div display="none" id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none; position: fixed; top: 10px; right: 10px; width: 500px; z-index: 999;">
                        <strong>Error:</strong> <span id="error-text"></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                        @if (Session::has('success_message')) <!-- Check vendorRegister() method in Front/VendorController.php -->
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                            <div class="group-inline u-s-m-b-30">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="contact-name">Enter Listing Code
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="listingId" class="text-field" placeholder="Enter Listing Code" name="name" required> {{-- Retrieving Old Input: https://laravel.com/docs/9.x/requests#retrieving-old-input --}}
                                </div>
                            </div>
                            <div class="u-s-m-b-30">
                                <button type="submit" class="button button-outline-secondary" onclick="listingVerification()">Verify Listing</button>
                            </div>
                            <div id="productDetails">
                                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="u-s-p-t-80">
            <div id="map"></div>
        </div>
    </div>
    <!-- Contact-Page /- -->
    <script type="text/javascript">
        function listingVerification(){
                var email = $("#listingId").val();

            $.ajax({
                type: 'POST',
                url: '{{ route('check.listing.verification') }}',
                data: {
                    email: email, 
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    if(response.success == 1){
                        var ownerName = response.data.owner_name;
                        var productName = response.data.product_name;
                        var productCode = response.data.product_code;

            // Update the HTML with the retrieved data
            $('#productDetails').html('Owner Name: ' + ownerName + '<br>' +
                                      'Product Name: ' + productName + '<br>' +
                                      'Product Code: ' + productCode);
                    }
                    else{
                        $('#productDetails').html();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown)
                    $('#error-text').text(jqXHR.responseJSON.message);
                    $('#error-message').show();
                    setTimeout(function () {
                    $('#error-message').fadeOut('slow');
                }, 5000);
                }
            });
        }
        </script>
@endsection