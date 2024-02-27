<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Auth without a namespace here works fine because the Admin.php model extends Authenticatable
use Illuminate\Support\FacadesAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Symfony\Component\VarDumper\VarDumper;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Section;
use App\Models\Category;
use App\Models\UserWallet;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Brand;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use App\Models\VendorsBankDetail;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard() {
        if(Auth::guard('admin')->user()->type == 'vendor'){
            $newProducts   = Product::orderBy('id', 'Desc')->where('vendor_id',Auth::guard('admin')->user()->vendor_id)->where('status', 1)->get();
        }
        else {
            $newProducts   = Product::orderBy('id', 'Desc')->where('status', 1)->get();
        }
        foreach($newProducts as $product){
            $product->category_name = Category::where('id',$product->category_id)->first()['category_name'];
        }
        // Correcting issues in the Skydash Admin Panel Sidebar using Session:
        Session::put('page', 'dashboard');


        $sectionsCount   = Section::count();
        $categoriesCount = Category::count();
        $productsCount   = Product::count();
        $ordersCount     = Order::count();
        $couponsCount    = Coupon::count();
        $brandsCount     = Brand::count();
        $usersCount      = User::count();


        return view('admin/dashboard')->with(compact('newProducts','sectionsCount', 'categoriesCount', 'productsCount', 'ordersCount', 'couponsCount', 'brandsCount', 'usersCount')); // is the same as:    return view('admin.dashboard');
    }
    public function save_role(Request $request){
        // return $request->all();
        if ($request->button == 'buyer'){
            //get the user
            if(Auth::check()){
                User::where('email',Auth::user()->email)->update(['is_role_set'=> '1']);
                return redirect('user/account')->with('success_message', "Role added successfully");
            }
            else{
                $getUser = User::where('email',$request->email)->update(['is_role_set'=> '1']);
                Auth::attempt([ 
                    'email'    => $request->email,   
                    'password' => $request->password 
                ]);
            }
            return redirect('user/account')->with('success_message', "Role added successfully");
        }
        if ($request->button == 'vendor'){
            //get the user
            if(Auth::check()){
                $getUser = User::where('email',Auth::user()->email)->first();
            }
            else{
                $getUser = User::where('email',$request->email)->first();
            }
            $vendor = new Vendor; // Vendor.php model which models (represents) the `vendors` database table

                $vendor->name   = $getUser->name;
                // $vendor->mobile = $data['phoneCode'] . $data['mobile'];
                $vendor->email  = $getUser->email;
                $vendor->status = 1; 
                $vendor->confirm = 'Yes';
                date_default_timezone_set('Africa/Cairo'); 
                $vendor->created_at = date('Y-m-d H:i:s'); 
                $vendor->updated_at = date('Y-m-d H:i:s');
                $vendor->save();

                
                $vendor_id = DB::getPdo()->lastInsertId(); 
                $admin = new Admin;

                $admin->type      = 'vendor';
                $admin->vendor_id = $vendor_id; 
                $admin->name      = $getUser->name;
                $admin->google_id      = $getUser->google_id;
                // $admin->mobile    = $data['phoneCode'] . $data['mobile'];
                $admin->email     = $getUser->email;
                $admin->password  = bcrypt($request->password);
                $admin->status    = 1; 
                    $admin->confirm = 'Yes';
                
                date_default_timezone_set('Africa/Cairo'); 
                $admin->created_at = date('Y-m-d H:i:s'); 
                $admin->updated_at = date('Y-m-d H:i:s'); 
                $admin->save();

                //delete user 
                // Auth::attempt([ 
                //         'email'    => $admin->email,   
                //         'password' => $admin->password 
                // ]);
               
                Auth::guard('admin')->attempt(['email' => $getUser->email, 'password' => $request->password]);
                User::where('email',$getUser->email)->delete();
                return redirect('/admin/update-vendor-details/personal');
        }
    }

    public function login(Request $request) {
            $data = $request->all();
            // dd($data);

            // Validation
            $rules = [
                'email'    => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [ // Specifying A Custom Message For A Given Attribute: https://laravel.com/docs/9.x/validation#specifying-a-custom-message-for-a-given-attribute
                'email.required'    => 'Email Address is required!',
                'email.email'       => 'Valid Email Address is required',
                'password.required' => 'Password is required!',
            ];

            $this->validate($request, $rules, $customMessages); 
            if(User::where('email',$request->email)->exists()){
                if (Auth::validate([ 
                    'email'    => $data['email'],   
                    'password' => $data['password'] 
                ])) {
                    $user_id_new    = User::where('email',$data['email'])->first();
                    // First, check if the user being authenticated/logged in is inactive/disabled/deactivated by an admin (`status` is zero 0 in `users` table), logout the user, then return them back with a message
                    if ($user_id_new->status == 0) {
                        Auth::logout(); // logout the user
                        return redirect()->back()->with('error_message', 'Your account is not activated! Please confirm your account (by clicking on the Activation Link in the Confirmation Mail) to activate your account');
                    }


                    // Update the user's Cart (the `user_id` column in `carts` table) with their `user_id` (because before login, user's orders in the Cart were stored only using the session (and `user_id` is zero 0) (check the cartAdd() method in Front/ProductsController.php))    
                    if (!empty(Session::get('session_id'))) {
                        $user_id    = User::where('email',$data['email'])->first()['id'];
                        $session_id = Session::get('session_id');

                        Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                    }

                    
                    // redirect user to the Cart cart.blade.php page
                    if($user_id_new->is_role_set == '1'){
                        if(Auth::attempt([ 
                            'email'    =>  $data['email'],   
                            'password' => $data['password']  
                        ])){
                    //     return redirect('user/account');user/account
                    return redirect()->route('user.account')->with(['success_message' => 'User Logged In Successfully','show_modal' => 0,'data' => Auth::user(),'vendor' => 0]);
                        }
                    }
                    else{
                            if(Auth::attempt([ 
                                'email'    =>  $data['email'],   
                                'password' => $data['password']  
                            ])){
                            return redirect()->route('index')->with(['success_message'=>'User Logged In Successfully','show_modal'=> 1,'data'=>Auth::user(),'vendor'=>0]);
                        }
                    }
                }
                else{
                    return redirect()->back()->with('error','Invalid Email or Password'); 
                }
            }
            else if(Admin::where('email',$request->email)->exists()){
                if(Auth::guard('admin')->attempt([
                    'email' =>$request->email,
                    'password' => $request->password
                ])){
                    return redirect()->route('admin.dashboard')->with(['success_message' => 'User Logged In Successfully','show_modal' => 0,'data' => Auth::user(),'vendor' => 1]);
                    // return redirect()->back()->with(['success_message'=>'User Logged In Successfully','show_modal'=> 0,'data'=>Auth::user(),'vendor'=>1]);
                }
                else { 
                    return redirect()->back()->with(
                        'error', 'Invalid Email or Password'
                    ); 
                }
            }
            else { 
                return redirect()->back()->with(
                    'error', 'Account doesnt exists'
                );
            }
        // return view('admin/login');
    }

    public function logout() {
        Auth::guard('admin')->logout(); // Logging out using our 'admin' guard that we created in auth.php    // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
        return redirect('/');
    }

    public function updateAdminPassword(Request $request) {
        // Correcting issues in the Skydash Admin Panel Sidebar using Session
        Session::put('page', 'update_admin_password');


        // Handling the update admin password <form> submission (POST request) in update_admin_password.blade.php
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);


            // Check first if the entered admin current password is corret
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) { // ['current_password'] comes from the AJAX call in admin/js/custom.js page from the 'data' object inside $.ajax() method    // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                // Check if the new password is matching with confirm password
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update([ // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                        'password' => bcrypt($data['new_password'])
                    ]); // we persist (update) the hashed password (not the password itself)

                    return redirect()->back()->with('success_message', 'Admin Password has been updated successfully!');

                } else { // If new password and confirm password are not matching each other
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password does not match!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current admin password is Incorrect!');
            }
        }


        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray(); // 'Admin' is the Admin.php model    // Auth::guard('admin') is the authenticated user using the 'admin' guard we created in auth.php    // https://laravel.com/docs/9.x/eloquent#retrieving-models    // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances


        return view('admin/settings/update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request) { // This method is called from the AJAX call in admin/js/custom.js page
        $data = $request->all();
        // dd($data);


        // Hashing Passwords: https://laravel.com/docs/9.x/hashing#hashing-passwords
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) { // ['current_password'] comes from the AJAX call in admin/js/custom.js page from the 'data' object inside $.ajax() method    // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
            return 'true';
        } else {
            return 'false';
        }
    }

    public function updateAdminDetails(Request $request) { // the update_admin_details.blade.php
        // Correcting issues in the Skydash Admin Panel Sidebar using Session
        Session::put('page', 'update_admin_details');


        if ($request->isMethod('post')) { // if the update <form> is submitted
            $data = $request->all();
            // dd($data);

            // Laravel's Validation
            // Customizing Laravel's Validation Error Messages: https://laravel.com/docs/9.x/validation#customizing-the-error-messages    // Customizing Validation Rules: https://laravel.com/docs/9.x/validation#custom-validation-rules
            $rules = [
                'admin_name'   => 'required|regex:/^[\pL\s\-]+$/u', // only alphabetical characters and spaces
                'admin_mobile' => 'required|numeric',
            ];

            $customMessages = [ // Specifying A Custom Message For A Given Attribute: https://laravel.com/docs/9.x/validation#specifying-a-custom-message-for-a-given-attribute
                'admin_name.required'   => 'Name is required',
                'admin_name.regex'      => 'Valid Name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric'  => 'Valid Mobile is required',
            ];

            $this->validate($request, $rules, $customMessages);



            // Uploading Admin Photo    // Using the Intervention package for uploading images
            if ($request->hasFile('admin_image')) { // the HTML name attribute    name="admin_name"    in update_admin_details.blade.php
                $image_tmp = $request->file('admin_image');
                // dd($image_tmp);

                if ($image_tmp->isValid()) {
                    // Get the image extension
                    $extension = $image_tmp->getClientOriginalExtension();

                    // Generate a random name for the uploaded image (to avoid that the image might get overwritten if its name is repeated)
                    $imageName = rand(111, 99999) . '.' . $extension;

                    // Assigning the uploaded images path inside the 'public' folder
                    $imagePath = 'admin/images/photos/' . $imageName;

                    // Upload the image using the Intervention package and save it in our path inside the 'public' folder
                    Image::make($image_tmp)->save($imagePath); // '\Image' is the Intervention package
                }

            } else if (!empty($data['current_admin_image'])) { // In case the admins updates other fields but doesn't update the image itself (doesn't upload a new image), but there's an already existing old image
                $imageName = $data['current_admin_image'];
            } else { // In case the admins updates other fields but doesn't update the image itself (doesn't upload a new image), and originally there wasn't any image uploaded in the first place
                $imageName = '';
            }


            // Update Admin Details
            Admin::where('id', Auth::guard('admin')->user()->id)->update([ // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                'name'   => $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image'  => $imageName
            ]); // Note that the image name is the random image name that we generated

            return redirect()->back()->with('success_message', 'Admin details updated successfully!');
        }


        return view('admin/settings/update_admin_details');
    }

    public function updateVendorDetails($slug, Request $request) { // $slug can only be: 'personal', 'business' or 'bank'
        if ($slug == 'personal') {
            // Correcting issues in the Skydash Admin Panel Sidebar using Session
            Session::put('page', 'update_personal_details');


            // Handling update vendor personal details <form> submission
            if ($request->isMethod('post')) { // if the <form> is submitted
                $data = $request->all();
                // dd($data);

                // Laravel's Validation    // Customizing Laravel's Validation Error Messages: https://laravel.com/docs/9.x/validation#customizing-the-error-messages    // Customizing Validation Rules: https://laravel.com/docs/9.x/validation#custom-validation-rules
                $rules = [
                    'vendor_name'   => 'required|regex:/^[\pL\s\-]+$/u', // only alphabetical characters and spaces
                    'vendor_city'   => 'required|regex:/^[\pL\s\-]+$/u', // only alphabetical characters and spaces
                    'vendor_mobile' => 'required|numeric',
                ];

                $customMessages = [ // Specifying A Custom Message For A Given Attribute: https://laravel.com/docs/9.x/validation#specifying-a-custom-message-for-a-given-attribute
                    'vendor_name.required'   => 'Name is required',
                    'vendor_city.required'   => 'City is required',
                    'vendor_city.regex'      => 'Valid City alphabetical is required',
                    'vendor_name.regex'      => 'Valid Name is required',
                    'vendor_mobile.required' => 'Mobile is required',
                    'vendor_mobile.numeric'  => 'Valid Mobile is required',
                ];

                $this->validate($request, $rules, $customMessages);


                // Uploading Admin Photo

                // Using the Intervention package for uploading images
                if ($request->hasFile('vendor_image')) { // the HTML name attribute    name="admin_name"    in update_admin_details.blade.php
                    $image_tmp = $request->file('vendor_image');

                    if ($image_tmp->isValid()) {
                        // Get the image extension
                        $extension = $image_tmp->getClientOriginalExtension();

                        // Generate a random name for the uploaded image (to avoid that the image might get overwritten if its name is repeated)
                        $imageName = rand(111, 99999) . '.' . $extension;

                        // Assigning the uploaded images path inside the 'public' folder
                        $imagePath = 'admin/images/photos/' . $imageName;

                        // Upload the image using the Intervention package and save it in our path inside the 'public' folder
                        Image::make($image_tmp)->save($imagePath); // '\Image' is the Intervention package
                    }

                } else if (!empty($data['current_vendor_image'])) { // In case the admins updates other fields but doesn't update the image itself (doesn't upload a new image), but there's an already existing old image
                    $imageName = $data['current_vendor_image'];
                } else { // In case the admins updates other fields but doesn't update the image itself (doesn't upload a new image), and originally there wasn't any image uploaded in the first place
                    $imageName = '';
                }


                // Vendor details need to be updated in BOTH `admins` and `vendors` tables:
                // Update Vendor Details in 'admins' table
                Admin::where('id', Auth::guard('admin')->user()->id)->update([ // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                    'name'   => $data['vendor_name'],
                    'mobile' => $data['vendor_mobile'],
                    'image'  => $imageName
                ]); // Note that the image name is the random image name that we generated

                // Update Vendor Details in 'vendors' table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update([ // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                    'name'    => $data['vendor_name'],
                    'mobile'  => $data['vendor_mobile'],
                    'address' => $data['vendor_address'],
                    'city'    => $data['vendor_city'],
                    'state'   => $data['vendor_state'],
                    'country' => $data['vendor_country'],
                    'pincode' => $data['vendor_pincode'],
                ]);


                return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }


            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray(); // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances

        } else if ($slug == 'business') {
            // Correcting issues in the Skydash Admin Panel Sidebar using Session
            Session::put('page', 'update_business_details');


            if ($request->isMethod('post')) { // if the <form> is submitted
                $data = $request->all();
                // dd($data);

                // Laravel's Validation    // Customizing Laravel's Validation Error Messages: https://laravel.com/docs/9.x/validation#customizing-the-error-messages    // Customizing Validation Rules: https://laravel.com/docs/9.x/validation#custom-validation-rules
                $rules = [
                    'shop_name'           => 'required|regex:/^[\pL\s\-]+$/u', // only alphabetical characters and spaces
                    'shop_city'           => 'required|regex:/^[\pL\s\-]+$/u', // only alphabetical characters and spaces
                    'shop_mobile'         => 'required|numeric',
                    'address_proof'       => 'required',
                ];

                $customMessages = [ // Specifying A Custom Message For A Given Attribute: https://laravel.com/docs/9.x/validation#specifying-a-custom-message-for-a-given-attribute
                    'shop_name.required'           => 'Name is required',
                    'shop_city.required'           => 'City is required',
                    'shop_city.regex'              => 'Valid City alphabetical is required',
                    'shop_name.regex'              => 'Valid Shop Name is required',
                    'shop_mobile.required'         => 'Mobile is required',
                    'shop_mobile.numeric'          => 'Valid Mobile is required',
                ];

                $this->validate($request, $rules, $customMessages);


                // Uploading Admin Photo    // Using the Intervention package for uploading images
                if ($request->hasFile('address_proof_image')) { // the HTML name attribute    name="admin_name"    in update_admin_details.blade.php
                    $image_tmp = $request->file('address_proof_image');

                    if ($image_tmp->isValid()) {
                        // Get the image extension
                        $extension = $image_tmp->getClientOriginalExtension();

                        // Generate a random name for the uploaded image (to avoid that the image might get overwritten if its name is repeated)
                        $imageName = rand(111, 99999) . '.' . $extension;

                        // Assigning the uploaded images path inside the 'public' folder
                        $imagePath = 'admin/images/proofs/' . $imageName;

                        // Upload the image using the Intervention package and save it in our path inside the 'public' folder
                        Image::make($image_tmp)->save($imagePath); // '\Image' is the Intervention package
                    }

                } else if (!empty($data['current_address_proof'])) { // In case the admins updates other fields but doesn't update the image itself (doesn't upload a new image), but there's an already existing old image
                    $imageName = $data['current_address_proof'];
                } else { // In case the admins updates other fields but doesn't update the image itself (doesn't upload a new image), and originally there wasn't any image uploaded in the first place
                    $imageName = '';
                }


                $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count(); // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                if ($vendorCount > 0) { // if there's a vendor already existing, them UPDATE
                    // UPDATE `vendors_business_details` table
                    VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([ // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                        'shop_name'               => $data['shop_name'],
                        'shop_mobile'             => $data['shop_mobile'],
                        'shop_website'            => $data['shop_website'],
                        'shop_address'            => $data['shop_address'],
                        'shop_city'               => $data['shop_city'],
                        'shop_state'              => $data['shop_state'],
                        'shop_country'            => $data['shop_country'],
                        'shop_pincode'            => $data['shop_pincode'],
                        'business_license_number' => $data['business_license_number'],
                        'gst_number'              => $data['gst_number'],
                        'pan_number'              => $data['pan_number'],
                        'address_proof'           => $data['address_proof'],
                        'address_proof_image'     => $imageName,
                    ]);

                } else { // if there's no vendor already existing, then INSERT
                    // INSERT INTO `vendors_business_details` table
                    VendorsBusinessDetail::insert([
                        'vendor_id'               => Auth::guard('admin')->user()->vendor_id, // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                        'shop_name'               => $data['shop_name'],
                        'shop_mobile'             => $data['shop_mobile'],
                        'shop_website'            => $data['shop_website'],
                        'shop_address'            => $data['shop_address'],
                        'shop_city'               => $data['shop_city'],
                        'shop_state'              => $data['shop_state'],
                        'shop_country'            => $data['shop_country'],
                        'shop_pincode'            => $data['shop_pincode'],
                        'business_license_number' => $data['business_license_number'],
                        'gst_number'              => $data['gst_number'],
                        'pan_number'              => $data['pan_number'],
                        'address_proof'           => $data['address_proof'],
                        'address_proof_image'     => $imageName,
                    ]);
                }


                return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }


            $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count(); // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances

            if ($vendorCount > 0) {
                $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray(); // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
            } else {
                $vendorDetails = array();
            }

        } else if ($slug == 'bank') {
            // Correcting issues in the Skydash Admin Panel Sidebar using Session
            Session::put('page', 'update_bank_details');


            if ($request->isMethod('post')) { // if the <form> is submitted
                $data = $request->all();
                // dd($data);

                // Laravel's Validation    // Customizing Laravel's Validation Error Messages: https://laravel.com/docs/9.x/validation#customizing-the-error-messages    // Customizing Validation Rules: https://laravel.com/docs/9.x/validation#custom-validation-rules
                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u', // only alphabetical characters and spaces
                    'bank_name'           => 'required', // only alphabetical characters and spaces
                    'account_number'      => 'required|numeric',
                    'bank_ifsc_code'      => 'required',
                ];

                $customMessages = [ // Specifying A Custom Message For A Given Attribute: https://laravel.com/docs/9.x/validation#specifying-a-custom-message-for-a-given-attribute
                    'account_holder_name.required' => 'Account Holder Name is required',
                    'bank_name.required'           => 'Bank Name is required',
                    'account_holder_name.regex'    => 'Valid Account Holder Name is required',
                    'account_number.required'      => 'Account Number is required',
                    'account_number.numeric'       => 'Valid Account Number is required',
                    'bank_ifsc_code.required'      => 'Bank IFSC Code is required',
                ];

                $this->validate($request, $rules, $customMessages);


                $vendorCount = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count(); // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                if ($vendorCount > 0) { // if there's a vendor already existing, them UPDATE
                    // UPDATE `vendors_bank_details` table
                    VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([ // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                        'account_holder_name' => $data['account_holder_name'],
                        'bank_name'           => $data['bank_name'],
                        'account_number'      => $data['account_number'],
                        'bank_ifsc_code'      => $data['bank_ifsc_code'],
                    ]);

                } else { // if there's no vendor already existing, then INSERT
                    // INSERT INTO `vendors_bank_details` table
                    VendorsBankDetail::insert([
                        'vendor_id'           => Auth::guard('admin')->user()->vendor_id, // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances
                        'account_holder_name' => $data['account_holder_name'],
                        'bank_name'           => $data['bank_name'],
                        'account_number'      => $data['account_number'],
                        'bank_ifsc_code'      => $data['bank_ifsc_code'],
                    ]);
                }


                return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }


            $vendorCount = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
            if ($vendorCount > 0) {
                $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            } else {
                $vendorDetails = array();
            }

        }


        // Fetch all of the world countries from the database table `countries`
        $countries = Country::where('status', 1)->get()->toArray(); // get the countries which have `status` = 1 (to ignore the blacklisted countries, in case)
        // dd($countries);


        // The 'GET' request: to show the update_vendor_details.blade.php page
        // We'll create one view (not 3) for the 3 pages, but parts inside it will change depending on the $slug value
        return view('admin/settings/update_vendor_details')->with(compact('slug', 'vendorDetails', 'countries'));
    }

    // Update the vendor's commission percentage (by the Admin) in `vendors` table (for every vendor on their own) in the Admin Panel in admin/admins/view_vendor_details.blade.php (Commissions module: Every vendor must pay a certain commission (that may vary from a vendor to another) for the website owner (admin) on every item sold, and it's defined by the website owner (admin))
    public function updateVendorCommission(Request $request) {
        if ($request->isMethod('post')) { // if the HTML Form is submitted (in admin/admins/view_vendor_details.blade.php)
            $data = $request->all();
            // dd($data);

            // UPDATE the `vendors` table with the `commission` percentage requested by the admin from the vendor
            Vendor::where('id', $data['vendor_id'])->update(['commission' => $data['commission']]);


            return redirect()->back()->with('success_message', 'Vendor commission updated successfully!');
        }
    }

    public function admins($type = null) { // $type is the `type` column in the `admins` which can only be: superadmin, admin, subadmin or vendor    // A default value of null (to allow not passing a {type} slug, and in this case, the page will view ALL of the superadmin, admins, subadmins and vendors at the same time)
        $admins = Admin::query();
        // dd($admins);

        if (!empty($type)) { // in this case, $type can be: superadmin, admin, subadmin or vendor
            $admins = $admins->where('type', $type);
            $title = ucfirst($type) . 's';

            // Correcting issues in the Skydash Admin Panel Sidebar using Session
            Session::put('page', 'view_' . strtolower($title));

        } else { // if there's no $type is passed, show ALL of the admins, subadmins and vendors
            $title = 'All Admins/Subadmins/Vendors';

            // Correcting issues in the Skydash Admin Panel Sidebar using Session
            Session::put('page', 'view_all');
        }

        $admins = $admins->get()->toArray(); // toArray() method converts the Collection object to a plain PHP array
        // dd($admins);

        return view('admin/admins/admins')->with(compact('admins', 'title'));
    }

    public function viewVendorDetails($id) { // View further 'vendor' details inside Admin Management table (if the authenticated user is superadmin, admin or subadmin)
        $vendorDetails = Admin::with('vendorPersonal', 'vendorBusiness','vendorBank')->where('id', $id)->first(); // Using the relationship defined in the Admin.php model to be able to get data from `vendors`, `vendors_business_details` and `vendors_bank_details` tables
        $vendorDetails = json_decode(json_encode($vendorDetails), true); // We used json_decode(json_encode($variable), true) to convert $vendorDetails to an array instead of Laravel's toArray() method
        // dd($vendorDetails);

        return view('admin/admins/view_vendor_details')->with(compact('vendorDetails'));
    }

    public function updateAdminStatus(Request $request) { // Update Admin Status using AJAX in admins.blade.php
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)
            // dd($data);

            if ($data['status'] == 'Active') { // $data['status'] comes from the 'data' object inside the $.ajax() method    // reverse the 'status' from (ative/inactive) 0 to 1 and 1 to 0 (and vice versa)
                $status = 0;
            } else {
                $status = 1;
            }


            // Note: Vendor CONFIRMATION occurs automatically through vendor clicking on the confirmation link sent in the email, but vendor ACTIVATION (active/inactive/disabled) occurs manually where 'superadmin' or 'admin' activates the `status` from the Admin Panel in 'Admin Management' tab, then clicks Status. Also, Vendor CONFIRMATION is related to the `confirm` columns in BOTH `admins` and `vendors` tables, but vendor ACTIVATION (active/inactive/disabled) is related to the `status` columns in BOTH `admins` and `vendors` tables!
            // Note: Vendor receives THREE emails: the first one when they register (please click on the confirmation link mail (in emails/vendor_confirmation.blade.php)), the second one when they click on the confirmation link sent in the first email (telling them that they have been confirmed and asking them to complete filling in their personal, business and bank details to get ACTIVATED/APPROVED (`status gets 1) (in emails/vendor_confirmed.blade.php)), the third email when the 'admin' or 'superadmin' manually activates (`status` becomes 1) the vendor from the Admin Panel from 'Admin Management' tab, then clicks Status (the email tells them they have been approved (activated and `status` became 1) and asks them to add their products on the website (in emails/vendor_approved.blade.php))

            // (!! Database Transaction !!) UPDATE the `status` columns in BOTH `admins` and `vendors` tables (I did the code of `vendors` myself!) (!! Database Transaction !!)
            Admin::where('id', $data['admin_id'])->update(['status' => $status]); // $data['admin_id'] comes from the 'data' object inside the $.ajax() method
            // echo '<pre>', var_dump($data), '</pre>';

            // Send a THIRD Approval Email to the vendor when the superadmin or admin approves their account (`status` column in the `admins` table becomes 1 instead of 0) so that they can add their products on the website now
            $adminDetails = Admin::where('id', $data['admin_id'])->first()->toArray(); // get the admin that his `status` has been approved


            if ($adminDetails['type'] == 'vendor' && $status == 1) { // if the `type` column value (in `admins` table) is 'vendor', and their `status` became 1 (got approved), send them a THIRD confirmation mail
                Vendor::where('id', $adminDetails['vendor_id'])->update(['status' => $status]); // update the `status` of the vendor in `vendors` table

                // Note: Vendor CONFIRMATION occurs automatically through vendor clicking on the confirmation link sent in the email, but vendor ACTIVATION (active/inactive/disabled) occurs manually where 'superadmin' or 'admin' activates the `status` from the Admin Panel in 'Admin Management' tab, then clicks Status. Also, Vendor CONFIRMATION is related to the `confirm` columns in BOTH `admins` and `vendors` tables, but vendor ACTIVATION (active/inactive/disabled) is related to the `status` columns in BOTH `admins` and `vendors` tables!
                // Note: Vendor receives THREE emails: the first one when they register (please click on the confirmation link mail (in emails/vendor_confirmation.blade.php)), the second one when they click on the confirmation link sent in the first email (telling them that they have been confirmed and asking them to complete filling in their personal, business and bank details to get ACTIVATED/APPROVED (`status gets 1) (in emails/vendor_confirmed.blade.php)), the third email when the 'admin' or 'superadmin' manually activates (`status` becomes 1) the vendor from the Admin Panel from 'Admin Management' tab, then clicks Status (the email tells them they have been approved (activated and `status` became 1) and asks them to add their products on the website (in emails/vendor_approved.blade.php))

                // Send the Approval Success Email to the new vendor
                $email = $adminDetails['email']; // the vendor's email

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email'  => $adminDetails['email'],
                    'name'   => $adminDetails['name'],
                    'mobile' => $adminDetails['mobile'],
                ];

                \Illuminate\Support\Facades\Mail::send('emails.vendor_approved', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.vendor_approved' is the vendor_approved.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that vendor_approved.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Vendor Account is Approved');
                });
            }

            $adminType = Auth::guard('admin')->user()->type; // `type` is the column in `admins` table    // Retrieving The Authenticated User and getting their `type`      column in `admins` table    // https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user    // Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances


            return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                'status'   => $status,
                'admin_id' => $data['admin_id']
            ]);
        }
    }
    public function getAllWallets(){
        Session::put('page', 'wallet');
        $getAllWallets = UserWallet::where('is_admin','0')->get();
        foreach($getAllWallets as $wallet){
            if($wallet->is_vendor == '0'){
                $getUser = User::where('id',$wallet->user_id)->first();
                $wallet->userName = $getUser->name;
                $wallet->userEmail = $getUser->email;
                $wallet->userType = 'User';
            }
            else{
                $getUser = Vendor::where('id',$wallet->user_id)->first();
                $wallet->userName = $getUser->name;
                $wallet->userEmail = $getUser->email;
                $wallet->userType = 'Vendor';
            }
        }
        return view('admin.admins.wallet',compact('getAllWallets'));
    }
    public function updateUserWallets(Request $request){
        //this is just a comment
        Session::put('page', 'wallet');
        $updateDispute = UserWallet::where('id',$request->dispute_id)->first();
        $updateDispute->amount = $request->amount;
        $updateDispute->update();
        if($updateDispute){
            return redirect()->back()->with('success_message','Wallet Updated Successfully');
        }
    }

}
