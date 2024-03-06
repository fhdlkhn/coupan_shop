<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;
use App\Models\User;
use Socialite;
use Exception;
use App\Models\Admin;
use App\Models\PhoneCodes;

class VendorController extends Controller
{
    public function loginRegister() { // render vendor login_register.blade.php page    
        return view('front.vendors.login_register');
    }
    public function genericLoginRegister() { 
        $country_lists = PhoneCodes::all();    
        return view('front.login',compact('country_lists'));
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();
    
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/')->with('success_message', 'User Logged in successfully')->with('data','1234');
            }
            else if(Admin::where('google_id', $user->id)->exists()){
                $finduser = Admin::where('google_id', $user->id)->first();
                Auth::guard('admin')->login($finduser);
                return redirect('/admin/update-vendor-details/personal')->with('success_message', 'User Logged in successfully')->with('data','1234');
            }
             else {
                $newUser = new User;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->password = bcrypt('1234');
                $newUser->status = 1;
                $newUser->is_role_set = '0';
                $newUser->save();
    
                // Auth::login($newUser);
                // return redirect('/')->with('success_message', 'Thanks for registering. Please select a role to continue!')->with('data','1234');
           try {
            Auth::login($newUser);
            return redirect('/')->with('success_message', 'Thanks for registering. Please select a role to continue!')->with('data','1234');
            } catch (Exception $e) {
            return $e->getMessage();
                return redirect('/')->with('error_message', 'Login failed: ' . $e->getMessage());
            }
            }
        } catch (Exception $e) {
            return redirect('/')->with('error_message', $e->getMessage());
        }
    }
    public function handleFacebookCallback()
    {
        try {
        
            $user = Socialite::driver('facebook')->user();
         
            $finduser = User::where('facebook_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
       
                return redirect()->intended('dashboard');
         
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'facebook_id'=> $user->id,
                        'password' => bcrypt('123456dummy')
                    ]);
        
                Auth::login($newUser);
        
                return redirect()->intended('dashboard');
            }
       
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function vendorRegister(Request $request) {  
        if ($request->isMethod('post')) { 
            $data = $request->all();
            
            $rules = [
               
                'name'          => 'required',
                'email'         => 'required|email|unique:admins|unique:vendors|unique:users', 
                'password'       => 'required',
                'password_confirmation' => 'required_with:password|same:password'
                            
            ];

            $customMessages = [ 
                'name.required'             => 'Name is required',
                'email.required'            => 'Email is required',
                'email.unique'              => 'Email alreay exists',
            ];

            $validator = Validator::make($data, $rules, $customMessages); // Manually Creating Validators: https://laravel.com/docs/9.x/validation#manually-creating-validators
            if ($validator->fails()) { // Manually Creating Validators: https://laravel.com/docs/9.x/validation#manually-creating-validators
                // return \Illuminate\Support\Facades\Redirect::back()->withErrors($validator);
                // return $validator->messages();
                return redirect()->back()->with('error',$validator->errors()->first()); // Manually Creating Validators: https://laravel.com/docs/9.x/validation#manually-creating-validators
            }


            // Create Vendor Account (Save the submitted data in BOTH `vendors` and `admins` tables)

            // Note: !!DATABASE TRANSACTION!! Firstly, we'll save the vendor in the `vendors` table, then take the newly generated vendor `id` to use it as a `vendor_id` column value to save the vendor in `admins` table, then we send the Confirmation Mail to the vendor using Mailtrap    
            // Database Transactions: https://laravel.com/docs/9.x/database#database-transactions
            DB::beginTransaction();
            if($request->user_type == 'seller'){

                $vendor = new Vendor; // Vendor.php model which models (represents) the `vendors` database table

                $vendor->name   = $data['name'];
                $vendor->mobile = $data['phoneCode'] . $data['mobile'];
                $vendor->email  = $data['email'];
                $vendor->status = 1; // Note: After a new vendor registers a new account, they will remain inactive/disabled (`status` is 0), untill the confirmation email arrives for them and they click the link, and they complete filling their vendor details, then the admin APPROVES them (then status becomes 1)
                $vendor->confirm = 'Yes';
                // Set Laravel's default timezone to Egypt's (to enter correct `created_at` and `updated_at` records in the database tables) instead of UTC
                date_default_timezone_set('Africa/Cairo'); // https://www.php.net/manual/en/timezones.php and https://www.php.net/manual/en/timezones.africa.php
                $vendor->created_at = date('Y-m-d H:i:s'); // enter `created_at` MANUALLY!    // Formatting the date for MySQL: https://www.php.net/manual/en/function.date.php
                $vendor->updated_at = date('Y-m-d H:i:s'); // enter `updated_at` MANUALLY!

                $vendor->save();

                // Get the `id` of the new vendor that we have just saved in the `vendors` table to use it as a value for the `vendor_id` column of the `admins` table to store the new vendor in the `admins` table too
                $vendor_id = DB::getPdo()->lastInsertId(); // get the vendor `id` of the `vendors` table (which has just been inserted) to insert it in the `vendor_id` column of the `admins` table    

                // Secondly, use the vendor `id` of the `vendors` table to serve a value of the `vendor_id` column in the `admins` table and save the new vendor in the `admins` table
                $admin = new Admin; // Admin.php model which models (represents) the `admins` database table

                $admin->type      = 'vendor';
                $admin->vendor_id = $vendor_id; // take the generated `id` of the `vendors` table to store it a `vendor_id` in the `admins` table
                $admin->name      = $data['name'];
                $admin->mobile    = $data['phoneCode'] . $data['mobile'];
                $admin->email     = $data['email'];
                $admin->password  = bcrypt($data['password']); // hashing the password to store the hashed password in the table (NOT THE PASSWORD ITSELF!!)
                $admin->status    = 1; // Note: After a new vendor registers a new account, they will remain inactive/disabled (`status` is 0), untill the confirmation email arrives for them and they click the link, and they complete filling their vendor details, then the admin APPROVES them (then status becomes 1)
                    $admin->confirm = 'Yes';
                // Set Laravel's default timezone to Egypt's (to enter correct `created_at` and `updated_at` records in the database tables) instead of UTC
                date_default_timezone_set('Africa/Cairo'); // https://www.php.net/manual/en/timezones.php and https://www.php.net/manual/en/timezones.africa.php
                $admin->created_at = date('Y-m-d H:i:s'); // enter `created_at` MANUALLY!    // Formatting the date for MySQL: https://www.php.net/manual/en/function.date.php
                $admin->updated_at = date('Y-m-d H:i:s'); // enter `updated_at` MANUALLY!

                $admin->save();


                // Send the Confirmation Email to the new vendor who has just registered    
                $email = $data['email']; // the vendor's email

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email' => $data['email'],
                    'name'  => $data['name'],
                    'code'  => base64_encode($data['email']) // We base64 code the vendor $email and send it as a Route Parameter from vendor_confirmation.blade.php to the 'vendor/confirm/{code}' route in web.php, then it gets base64 decoded again in confirmVendor() method in Front/VendorController.php    // we will use the opposite: base64_decode() in the confirmVendor() method (encode X decode)
                ];

                \Illuminate\Support\Facades\Mail::send('emails.vendor_confirmation', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.vendor_confirmation' is the vendor_confirmation.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that vendor_confirmation.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Confirm your Vendor Account');
                });
            }
            elseif($request->user_type == 'buyer'){
                $user = new User;

                $user->name     = $data['name'];   // $data['name']   comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->mobile   = $data['phoneCode'] . $data['mobile']; // $data['mobile'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->email    = $data['email'];  // $data['email']  comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->password = bcrypt($data['password']); // storing the HASH-ed password (not the original password) in the database    // bcrypt(): https://laravel.com/docs/9.x/helpers#method-bcrypt    // $data['password'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->status   = 1; // 0 means that the user is inactive/disabled/deactivated. After they click on the link in the 'Confirmation Email' sent to them, they become active/enabled/activated i.e. `status` is one 1    

                $user->save();
                $email = $data['email']; // the user's email that they entered while submitting the registration form

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'name'   => $data['name'],   // the user's name that they entered while submitting the registration form
                    'email'  => $data['email'],  // the user's email that they entered while submitting the registration form
                    'code'   => base64_encode($data['email']) // We base64 code the user's $email and send it as a Route Parameter from resources/views/emails/confirmation.blade.php to the 'user/confirm/{code}' route in web.php, then it gets base64 de-coded again in confirmUser() method in Front/UserController.php    // We will use the opposite: base64_decode() in the confirmUser() method to decode the encoded string (encode X decode)
                ];
                \Illuminate\Support\Facades\Mail::send('emails.confirmation', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.confirmation' is the resources/views/emails/confirmation.blade.php file that will be sent as an email    // We pass in all the variables that confirmation.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Confirm your Multi-vendor E-commerce Application Account');
                });

                // Redirect user back with a success message
                $redirectTo = url('login'); // redirect user to the front/users/login_register.blade.php    // Check that route in web.php

                // Here, we return a JSON response because the request is ORIGINALLY submitting an HTML <form> data using an AJAX request
                // return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                //     'type'    => 'success',
                //     'url'     => $redirectTo, // redirect user to the Cart cart.blade.php page
                //     'message' => 'Please confirm your email to activate your account!'
                // ]);
            }
            else{
                $user = new User;

                $user->name     = $data['name'];   
                $user->email    = $data['email'];  
                $user->password = bcrypt($data['password']); 
                $user->status   = 1; 
                $user->is_role_set = '0';
                $user->save();
                $email = $data['email']; 

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'name'   => $data['name'],   // the user's name that they entered while submitting the registration form
                    'email'  => $data['email'],  // the user's email that they entered while submitting the registration form
                    'code'   => base64_encode($data['email']) // We base64 code the user's $email and send it as a Route Parameter from resources/views/emails/confirmation.blade.php to the 'user/confirm/{code}' route in web.php, then it gets base64 de-coded again in confirmUser() method in Front/UserController.php    // We will use the opposite: base64_decode() in the confirmUser() method to decode the encoded string (encode X decode)
                ];
                \Illuminate\Support\Facades\Mail::send('emails.confirmation', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.confirmation' is the resources/views/emails/confirmation.blade.php file that will be sent as an email    // We pass in all the variables that confirmation.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Confirm your Multi-vendor E-commerce Application Account');
                });

            }


            DB::commit(); // commit the Database Transaction


            // Redirect the vendor back with a success message
            // $message = 'Thanks for registering. Please confirm your email to activate your account.';
            $message = 'Thanks for registering. Please log in into your account.';
            if(Auth::attempt([ 
                'email'    => $data['email'],   
                'password' => $data['password']
            ])){
                $message = 'Thanks for registering. Please select a role to continue!';
            }
            else{
                $message = 'Thanks for registering. Please log in into your account.';
            }
            return redirect()->route('index')->with(['success_message'=>'User Registered Successfully. Please select a role to proceed!','show_modal'=> 1,'data'=>Auth::user(),'vendor'=>0]);
            // return redirect()->back()->with('success_message', $message)->with('data',$request->password);
        }
    }

    public function confirmVendor($email) { // Confirm Vendor Account (the confirmation mail sent from 'vendor_confirmation.blade.php) from the mail by Mailtrap         // {code} $code is the base64 encoded vendor email with which they have registered which is a Route Parameters/URL Paramters which we received from the route: https://laravel.com/docs/9.x/routing#required-parameters    // this route is requested (accessed/opened) from inside the mail sent to vendor (vendor_confirmation.blade.php)
        // Note: Vendor CONFIRMATION occurs automatically through vendor clicking on the confirmation link sent in the email, but vendor ACTIVATION (active/inactive/disabled) occurs manually where 'superadmin' or 'admin' activates the `status` from the Admin Panel in 'Admin Management' tab, then clicks Status. Also, Vendor CONFIRMATION is related to the `confirm` columns in BOTH `admins` and `vendors` tables, but vendor ACTIVATION (active/inactive/disabled) is related to the `status` columns in BOTH `admins` and `vendors` tables!
        // Note: Vendor receives THREE emails: the first one when they register (please click on the confirmation link mail (in emails/vendor_confirmation.blade.php)), the second one when they click on the confirmation link sent in the first email (telling them that they have been confirmed and asking them to complete filling in their personal, business and bank details to get ACTIVATED/APPROVED (`status gets 1) (in emails/vendor_confirmed.blade.php)), the third email when the 'admin' or 'superadmin' manually activates (`status` becomes 1) the vendor from the Admin Panel from 'Admin Management' tab, then clicks Status (the email tells them they have been approved (activated and `status` became 1) and asks them to add their products on the website (in emails/vendor_approved.blade.php))

        $email = base64_decode($email); // we use the opposite (decode()) of what we used in the vendorRegister() (encode) 

        // For Security Reasons, check if the vendor email exists first (after the vendor has entered their mail while registering)
        $vendorCount = Vendor::where('email', $email)->count();
        if ($vendorCount > 0) { // if the vendor email exists
            // Check if the vendor is alreay active
            $vendorDetails = Vendor::where('email', $email)->first();
            if ($vendorDetails->confirm == 'Yes') { // if the vendor is already confirmed

                // Redirect vendor to vendor Login/Register page with an 'error' message
                $message = 'Your Vendor Account is already confirmed. You can login';
                return redirect('login')->with('error_message', $message);

            } else { // (!! DATABASE TRANSACTION !!) if the vendor account is not confirmed, then confirm it (by updating the `confirm` column to 'Yes' in BOTH `vendors` and `admins` tables) (!! DATABASE TRANSACTION !!)
                // Note: Vendor CONFIRMATION occurs automatically through vendor clicking on the confirmation link sent in the email, but vendor ACTIVATION (active/inactive/disabled) occurs manually where 'superadmin' or 'admin' activates the `status` from the Admin Panel in 'Admin Management' tab, then clicks Status. Also, Vendor CONFIRMATION is related to the `confirm` columns in BOTH `admins` and `vendors` tables, but vendor ACTIVATION (active/inactive/disabled) is related to the `status` columns in BOTH `admins` and `vendors` tables!
                // Note: Vendor receives THREE emails: the first one when they register (please click on the confirmation link mail (in emails/vendor_confirmation.blade.php)), the second one when they click on the confirmation link sent in the first email (telling them that they have been confirmed and asking them to complete filling in their personal, business and bank details to get ACTIVATED/APPROVED (`status gets 1) (in emails/vendor_confirmed.blade.php)), the third email when the 'admin' or 'superadmin' manually activates (`status` becomes 1) the vendor from the Admin Panel from 'Admin Management' tab, then clicks Status (the email tells them they have been approved (activated and `status` became 1) and asks them to add their products on the website (in emails/vendor_approved.blade.php))

                Admin::where( 'email', $email)->update(['confirm' => 'Yes']);
                Vendor::where('email', $email)->update(['confirm' => 'Yes']);


                // Send ANOTHER email to the vendor (The Registration Success email)
                // Send the Registration Success Email to the new vendor who has just registered    

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email'  => $email,
                    'name'   => $vendorDetails->name,
                    'mobile' => $vendorDetails->mobile
                ];
                \Illuminate\Support\Facades\Mail::send('emails.vendor_confirmed', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.vendor_confirmed' is the vendor_confirmed.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that vendor_confirmed.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('You Vendor Account Confirmed');
                });


                // Redirect vendor to vendor Login/Register page with a 'success' message
                $message = 'Your Vendor Email account is confirmed. You can login and add your personal, business and bank details to activate your Vendor Account to add products';
                return redirect('login')->with('success_message', $message);
            }
        } else { // if the vendor email doesn't exist (hacking or cyber attack!!)
            abort(404);
        }
    }
}