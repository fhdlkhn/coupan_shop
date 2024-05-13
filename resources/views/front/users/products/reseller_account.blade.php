@extends('front.users.layout.layout')
@section('content')
<style>
    form#accountForm input {
    width: 100% !important;
    border: 2px solid #E6E8EC !important;
    border-radius: 12px !important;
    padding: 12px 16px !important;
    background: #fff !important;
}
form#accountForm select {
    width: 100% !important;
    border: 2px solid #E6E8EC !important;
    border-radius: 12px !important;
    padding: 12px 16px !important;
    background: #fff !important;
}
form#passwordForm input {
    width: 100% !important;
    border: 2px solid #E6E8EC !important;
    border-radius: 12px !important;
    padding: 12px 16px !important;
    background: #fff !important;
}

form#passwordForm select {
    width: 100% !important;
    border: 2px solid #E6E8EC !important;
    border-radius: 12px !important;
    padding: 12px 16px !important;
    background: #fff !important;
}
button.button.button-outline-secondary.w-100 {
    color: #FCFCFD;
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    line-height: 16px;
    padding: 16px 24px;
    border: 0;
    border-radius: 90px;
    background: #3B71FE;
}
button.button.button-primary.w-100 {
    color: #FCFCFD;
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    line-height: 16px;
    padding: 16px 24px;
    border: 0;
    border-radius: 90px;
    background: #3B71FE;
}
    </style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Update Account Details</h3>

                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Personal Information</h4>
                                @if (Session::has('success_message')) <!-- Check userRegister() method in Front/UserController.php -->
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success:</strong> {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session::has('error_message')) <!-- Check userRegister() method in Front/UserController.php -->
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error:</strong> {{ Session::get('error_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if ($errors->any()) <!-- Check userRegister() method in Front/UserController.php -->
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error:</strong> @php echo implode('', $errors->all('<div>:message</div>')); @endphp
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="row user_account">
                                    <div class="col-lg-6">
                                        <div class="login-wrapper">
                                            {{-- Note: To show the form's Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend), we create a <p> tag after every <input> field --}} {{-- We structure and use a certain pattern so that the <p> id pattern must be like: delivery-x (e.g. delivery-mobile, delivery-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="delivery-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                            {{-- <p id="account-error" style="color: red"></p> --}} {{-- if the Validation passes / is okay but the login credentials provided by the user are incorrect, this'll be used by jQuery to show a generic 'Wrong Credentials!' message. Or to show a message when the user's account is inactive/disabled/deactivated --}}
                                            <p id="account-error"></p> {{-- if the Validation passes / is okay but the login credentials provided by the user are incorrect, this'll be used by jQuery to show a generic 'Wrong Credentials!' message. Or to show a message when the user's account is inactive/disabled/deactivated --}}


                                            {{-- Update details Success Message using jQuery. Check    $('#accountForm').submit();    in front/js/custom.js --}} 
                                            {{-- <p id="account-success" style="color: green"></p> --}}
                                            <p id="account-success"></p>
                                            <form id="accountForm" action="javascript:;" method="post"> {{-- We need to deactivate the 'action' HTML attribute (using    'javascript:;'    ) as we'r going to submit using an AJAX call. Check front/js/custom.js --}}
                                                @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}


                                                <div class="u-s-m-b-30">
                                                    <label for="user-email">Email
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input class="text-field" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" style="background-color: #e9e9e9" readonly disabled> {{-- Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user --}}
                                                    {{-- <p id="account-email" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="account-email"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="user-name">Name
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input class="text-field" type="text" id="user-name" name="name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}"> {{-- Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user --}}
                                                    {{-- <p id="account-name" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="account-name"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="user-address">Address
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input class="text-field" type="text" id="user-address" name="address" value="{{ \Illuminate\Support\Facades\Auth::user()->address }}"> {{-- Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user --}}
                                                    {{-- <p id="account-address" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="account-address"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="user-city">City
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input class="text-field" type="text" id="user-city" name="city" value="{{ \Illuminate\Support\Facades\Auth::user()->city }}"> {{-- Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user --}}
                                                    {{-- <p id="account-city" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="account-city"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="user-state">State
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input class="text-field" type="text" id="user-state" name="state" value="{{ \Illuminate\Support\Facades\Auth::user()->state }}"> {{-- Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user --}}
                                                    {{-- <p id="account-state" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="account-state"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="user-country">Country
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <select class="text-field" id="user-country" name="country" style="color: #495057">
                                                        <option value="">Select Country</option>

                                                        @foreach ($countries as $country) {{-- $countries was passed from UserController to view using compact() method --}}
                                                            <option value="{{ $country['country_name'] }}"  @if ($country['country_name'] == \Illuminate\Support\Facades\Auth::user()->country) selected @endif>{{ $country['country_name'] }}</option>
                                                        @endforeach

                                                    </select>
                                                    {{-- <p id="account-country" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="account-country"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="user-pincode">Pincode
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input class="text-field" type="text" id="user-pincode" name="pincode" value="{{ \Illuminate\Support\Facades\Auth::user()->pincode }}"> {{-- Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user --}}
                                                    {{-- <p id="account-pincode" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="account-pincode"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="user-mobile">Mobile
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input class="text-field" type="text" id="user-mobile" name="mobile" value="{{ \Illuminate\Support\Facades\Auth::user()->mobile }}"> {{-- Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user --}}
                                                    {{-- <p id="account-mobile" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="account-mobile"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: register-x (e.g. register-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="register-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="m-b-45">
                                                    <button class="button button-outline-secondary w-100">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="reg-wrapper">
                                            <h2 class="account-h2 u-s-m-b-20" style="font-size: 18px">Update Password</h2>


                                            {{-- Registration Success Message using jQuery. Check front/js/custom.js --}} 
                                            {{-- <p id="password-success" style="color: green"></p> --}}
                                            <p id="password-success"></p>


                                            {{-- Show Update User Password Errors --}}
                                            {{-- <p id="account-error" style="color: red"></p> --}} {{-- if the Validation passes / is okay but the login credentials provided by the user are incorrect, this'll be used by jQuery to show a generic 'Wrong Credentials!' message. Or to show a message when the user's account is inactive/disabled/deactivated --}}
                                            <p id="password-error"></p> {{-- if the Validation passes / is okay but the login credentials provided by the user are incorrect, this'll be used by jQuery to show a generic 'Wrong Credentials!' message. Or to show a message when the user's account is inactive/disabled/deactivated --}}


                                            
                                            <form id="passwordForm" action="javascript:;" method="post"> {{-- We need to deactivate the 'action' HTML attribute (using    'javascript:;'    ) as we'r going to submit using an AJAX call. Check front/js/custom.js --}}
                                                @csrf {{-- Preventing CSRF Requests: https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}


                                                <div class="u-s-m-b-30">
                                                    <label for="current-password">Current Password
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input type="password" id="current-password" class="text-field" placeholder="Current Password" name="current_password">
                                                    {{-- <p id="password-current_password" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="password-current_password"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="usermobile">New Password
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input type="password" id="new-password" class="text-field" placeholder="New Password" name="new_password">
                                                    {{-- <p id="password-new_password" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="password-new_password"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-30">
                                                    <label for="useremail">Confirm Password
                                                        <span class="astk">*</span>
                                                    </label>
                                                    <input type="password" id="confirm-password" class="text-field" placeholder="Confirm Password" name="confirm_password">
                                                    {{-- <p id="password-confirm_password" style="color: red"></p> --}} {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                    <p id="password-confirm_password"></p> {{-- this will be used by jQuery to show the Validation Error Messages (Laravel's Validation Error Messages) from the AJAX call response from the server (backend) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}} {{-- The pattern must be like: password-x (e.g. password-mobile, register-email, ... in order for the jQuery loop to work. And x must be identical to the 'name' HTML attributes (e.g. the <input> with the    name='mobile'    HTML attribute must have a <p> with an id HTML attribute    id="password-mobile"    ) so that when the vaildation errors array is sent as a response from backend/server (check $validator->messages()    inside    the method inside the controller) to the AJAX request, they could conveniently/easily be handled by the jQuery $.each() loop. Check front/js/custom.js) --}}
                                                </div>
                                                <div class="u-s-m-b-45">
                                                    <button class="button button-primary w-100">Update</button>
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
    </div>
@endsection
