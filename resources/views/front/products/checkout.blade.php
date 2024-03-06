@extends('front.layout.layout')
@section('content')
    <section class="ly-page-top-section">
        <div class="container">
            @if (Session::has('error_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <h1>List Your Product</h1>
                    <p>Join top UK hosts who make an average of £6,492 every year for each car they list on Turo*</p>
                </div>
            </div>
        </div>
    </section>
    <section class="ly-checkout-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ly-car-show-map checkout-content-wrapper">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="ly-confirm-pay-content">
                                    <h2 class="title">Confirm and pay</h2>
                                    <form action="{{ route('stripe.post') }}" method="post"  class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                        @csrf
                                        <div class="pay-with">
                                            <h6>Credit Card</h6>
                                            <ul>
                                                <li>
                                                    <svg width="34" height="12" viewBox="0 0 34 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_237_11822)">
                                                          <path d="M14.896 11.0727H12.2109L13.8904 0.688232H16.5754L14.896 11.0727Z" fill="#00579F"/>
                                                          <path d="M24.6307 0.942109C24.1011 0.731994 23.2611 0.5 22.2224 0.5C19.5708 0.5 17.7035 1.91399 17.6921 3.93556C17.6701 5.42707 19.029 6.25549 20.0454 6.75281C21.0842 7.26099 21.4373 7.59269 21.4373 8.04566C21.4267 8.74135 20.5979 9.06203 19.8248 9.06203C18.7528 9.06203 18.1784 8.8967 17.3055 8.50965L16.9519 8.34373L16.5762 10.6748C17.2059 10.9617 18.3662 11.2163 19.5708 11.2275C22.3882 11.2275 24.2224 9.83539 24.2441 7.68108C24.2549 6.49894 23.5373 5.59314 21.9903 4.85296C21.0511 4.37782 20.476 4.05743 20.476 3.57127C20.487 3.12931 20.9625 2.67663 22.0226 2.67663C22.8955 2.65446 23.5369 2.86428 24.0227 3.07425L24.2656 3.18452L24.6307 0.942109Z" fill="#00579F"/>
                                                          <path d="M28.1992 7.39387C28.4203 6.7973 29.2712 4.48837 29.2712 4.48837C29.2601 4.51055 29.4919 3.88079 29.6245 3.49418L29.8122 4.38897C29.8122 4.38897 30.3206 6.87468 30.4311 7.39387H28.1992ZM31.5136 0.688232H29.4367C28.7962 0.688232 28.3096 0.875883 28.0333 1.54984L24.0449 11.0726H26.8623C26.8623 11.0726 27.3262 9.79089 27.4259 9.51485H30.8733C30.9504 9.87943 31.1937 11.0726 31.1937 11.0726H33.6798L31.5136 0.688232Z" fill="#00579F"/>
                                                          <path d="M9.96913 0.688232L7.33953 7.76947L7.05218 6.33331C6.56602 4.67617 5.04133 2.87573 3.33984 1.98049L5.74846 11.0617H8.58789L12.8084 0.688232H9.96913Z" fill="#00579F"/>
                                                          <path d="M4.89747 0.688232H0.577399L0.533203 0.898054C3.90313 1.75981 6.13496 3.83703 7.05193 6.33375L6.11279 1.56114C5.95818 0.897907 5.48303 0.71011 4.89747 0.688232Z" fill="#FAA61A"/>
                                                        </g>
                                                        <defs>
                                                          <clipPath id="clip0_237_11822">
                                                            <rect width="33.2121" height="10.7275" fill="white" transform="translate(0.5 0.5)"/>
                                                          </clipPath>
                                                        </defs>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg width="64" height="16" viewBox="0 0 64 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M28.4453 1.71094H35.4453V14.2887H28.4453V1.71094Z" fill="#FF5F00"/>
                                                        <path d="M28.8889 8C28.8889 5.44444 30.0889 3.17778 31.9333 1.71111C30.5778 0.644447 28.8667 0 27 0C22.5778 0 19 3.57778 19 8C19 12.4222 22.5778 16 27 16C28.8667 16 30.5778 15.3556 31.9333 14.2889C30.0889 12.8444 28.8889 10.5556 28.8889 8Z" fill="#EB001B"/>
                                                        <path d="M44.8884 8C44.8884 12.4222 41.3106 16 36.8884 16C35.0217 16 33.3106 15.3556 31.9551 14.2889C33.8217 12.8222 34.9995 10.5556 34.9995 8C34.9995 5.44444 33.7995 3.17778 31.9551 1.71111C33.3106 0.644447 35.0217 0 36.8884 0C41.3106 0 44.8884 3.6 44.8884 8Z" fill="#F79E1B"/>
                                                    </svg>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="form-fields-box">
                                            <label for="card-number">Name on Card</label>
                                            <input id="card-number" type="text" placeholder="Enter Name">
                                        </div>
                                        <div class="form-fields-box">
                                            <label for="card-holder">Card Number</label>
                                            <input id="card-holder" class="card-number" type="text" autocomplete='off' placeholder="Enter Number">
                                        </div>
                                        <div class="form-fields-box">
                                            <div class="sub-field-box">
                                                <label for="expiration">CVC</label>
                                                <input id="expiration" class="card-cvc" type="text" placeholder='ex. 311' size='4'>
                                            </div>
                                        <div class="form-fields-box">
                                            <label for="CVC">Expiration Month</label>
                                            <input id="CVC" class="card-expiry-month" type="text" placeholder='MM' size='2'>
                                        </div>
                                        <div class="form-fields-box">
                                            <label for="CVC">Expiration Year</label>
                                            <input id="CVC" class="card-expiry-year" type="text" placeholder='YYYY' size='4'>
                                        </div>
                                        </div>
                                        
                                        <div class="form-fields-box">
                                                    <input type="checkbox" class="check-box" id="accept" name="accept" value="Yes" title="Please agree to T&C">
                                                    <label class="label-text no-color" for="accept">I’ve read and accept the
                                                        <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                                                    </label>
                                                </div>
                                        <div class="form-fields-box checkbox-field">
                                            <div class='col-md-12 error form-group hide'>
                                                <div class='alert-danger alert'>Please add your card details</div>
                                            </div>
                                        </div>
                                        <button class="ly-button-3" type="submit">Pay Now ${{ $total_price - \Illuminate\Support\Facades\Session::get('couponAmount') }}</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="ly-checkout-sidebar">
                                    <h3 class="sibebar-sub-title">Price details</h3>
                                    <div class="discount-code-box">
                                        <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">
                                            @csrf
                                            <div class="order-table">
                                                <table class="u-s-m-b-13">
                                                    <thead>
                                                        <tr>
                                                            <th>Listing</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $total_price = 0 @endphp
                                                        @foreach ($getCartItems as $item) {{-- $getCartItems is passed in from cart() method in Front/ProductsController.php --}}
                                                            @php
                                                                $getDiscountAttributePrice = \App\Models\Product::getDiscountAttributePrice($item['product_id'], $item['size']); // from the `products_attributes` table, not the `products` table
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ url('product/' . $item['product_id']) }}">
                                                                        <img width="50px" src="{{ asset('front/images/product_images/small/' . $item['product']['product_image']) }}" alt="Product">
                                                                        <h6 class="order-h6">{{ $item['product']['product_name'] }}
                                                                        <br>
                                                                        {{ $item['size'] }}/{{ $item['product']['product_color'] }}</h6>
                                                                    </a>
                                                                    <span class="order-span-quantity">x {{ $item['quantity'] }}</span>
                                                                </td>
                                                                <td>
                                                                    <h6 class="order-h6">${{ $getDiscountAttributePrice['final_price'] * $item['quantity'] }}</h6> {{-- price of all products (after discount (if any)) (= price (after discoutn) * no. of products) --}}
                                                                </td>
                                                            </tr>
                                                            @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td>
                                                                <h3 class="order-h3">Grand Total</h3>
                                                            </td>
                                                            <td>
                                                                <h3 class="order-h3">
                                                                    <strong class="grand_total">${{ $total_price - \Illuminate\Support\Facades\Session::get('couponAmount') }}</strong> {{-- We create the 'grand_total' CSS class to use it as a handle for AJAX inside    $('#applyCoupon').submit();    function in front/js/custom.js --}} {{-- We stored the 'couponAmount' a Session Variable inside the applyCoupon() method in Front/ProductsController.php --}}
                                                                </h3>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- <div class="u-s-m-b-13">
                                                    <input type="checkbox" class="check-box" id="accept" name="accept" value="Yes" title="Please agree to T&C">
                                                    <label class="label-text no-color" for="accept">I’ve read and accept the
                                                        <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                                                    </label>
                                                </div>
                                                <button type="submit" id="placeOrder" class="button button-outline-secondary">Place Order</button> {{-- Show our Preloader/Loader/Loading Page/Preloading Screen while the <form> is submitted using the    id="placeOrder"    HTML attribute. Check front/js/custom.js --}} -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ly-footer">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-logo-bar">
                            <a href="#" class="footer-logo">
                                <img src="imgs/Logo.png" alt="footer logo">
                                Company name
                            </a>
                            <div class="meta-box">
                                <span>Ready to get started?</span>
                                <button class="ly-button-2">Get Started</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-newsletter-box">
                            <h5>Subscribe to our newsletter</h5>
                            <form action="">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Email address" aria-label="Email address" aria-describedby="button-addon2">
                                    <button class="btn ly-button-2" type="button" id="button-addon2"><span class="iconify" data-icon="ic:twotone-chevron-right"></span></button>
                                </div>                                  
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="footer-extra-links">
                            <h6>Services</h6>
                            <ul>
                                <li>
                                    <a href="#">Become a host</a>
                                </li>
                                <li>
                                    <a href="#">Rent out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="footer-extra-links">
                            <h6>About</h6>
                            <ul>
                                <li>
                                    <a href="#">Our Story</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-extra-links">
                            <h6>Help</h6>
                            <ul>
                                <li>
                                    <a href="#">FAQs</a>
                                </li>
                                <li>
                                    <a href="#">Support</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="footer-botm-links">
                            <div class="extra-links">
                                <a href="#">Terms & Conditions</a>
                                <a href="#">Privacy Policy</a>
                            </div>
                            <div class="social-links">
                                <a href="#"><span class="iconify" data-icon="ri:facebook-fill"></span></a>
                                <a href="#"><span class="iconify" data-icon="simple-icons:twitter"></span></a>
                                <a href="#"><span class="iconify" data-icon="akar-icons:instagram-fill"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ly-footer-end -->

    <!-- ly-copyright-section-start -->
    <div class="ly-copyright-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="meta-box">
                        <p>© Copyright Company 2023. All rights reserved.</p>
                        <p><span>Cookie preferences</span><span>Do not sell or share my personal information</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ly-copyright-section-end -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
<script type="text/javascript">
  
$(function() {    
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),  
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    
    });
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var TotalAmount = {!! $total_price !!}
            /* token contains id, last4, and card type */
            var token = response['id'];
                 
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.append("<input type='hidden' name='amount' value='" + TotalAmount + "'/>");
            $form.get(0).submit();
        }
    }
     
});
</script>
@endsection