{{-- This page is rendered by contact() method inside Front/CmsController.php --}}
@extends('front.layout.layout')


@section('content')
    <!-- Page Introduction Wrapper -->
    <section class="ly-page-top-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Listing Verification</h1>
                    <p>Join top UK hosts who make an average of £6,492 every year for each listing they list</p>
                </div>
            </div>
        </div>
    </section>
   <section class="ly-listing-projects-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md- col-sm-6">
                    <div class="touch-wrapper">
                        <h1 class="contact-h1">Verify your Listing here</h1>
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
        <!-- <div class="u-s-p-t-80">
            <div id="map"></div>
        </div> -->
    </section>
    <!-- Contact-Page /- -->
    <script type="text/javascript">
        function listingVerification() {
            var email = $("#listingId").val();

            $.ajax({
                type: 'POST',
                url: '{{ route('check.listing.verification') }}',
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.success == 1) {
                        var ownerName = response.data.owner_name;
                        var productName = response.data.product_name;
                        var productCode = response.data.product_code;

                        // Update the HTML with the retrieved data
                        $('#productDetails').html('Owner Name: ' + ownerName + '<br>' +
                            'Product Name: ' + productName + '<br>' +
                            'Product Code: ' + productCode);
                    } else {
                        // Clear the product details if no product found
                        $('#productDetails').html('No Product Found!');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);

                    // Display the error message
                    $('#error-text').text(jqXHR.responseJSON.message);
                    $('#error-message').show();

                    // Hide the error message after 5 seconds
                    setTimeout(function() {
                        $('#error-message').fadeOut('slow');
                    }, 5000);
                }
            });
        }

        </script>
@endsection