<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\DeliveryAddress;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\UserWallet;
use GuzzleHttp\Client;
use App\Models\Admin;
use App\Models\ProductsAttribute;
use App\Models\Rating;
use App\Models\Setting;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\ProductsFilter;
use App\Models\Vendor;
use App\Models\User;
use Stripe;
use Stripe\StripeClient;
use App\Models\Country;
use App\Models\ShippingCharge;
use App\Models\OrdersProduct;

class ProductsController extends Controller
{
    public function listing(Request $request, $cat = null) { 
        // return $request->all();   
        $url = \Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri();
        $fetchAllCategories = Category::with('subCategories')->where('parent_id',0)->get();
        $categoryCount = 0;
        if($cat != null){
            $categoryCount = Category::where([
                'id'    => $cat,
                'status' => 1
            ])->count();
        $categoryDetails = Category::categoryDetails($cat,$url);
        }
        else if($request->category_id != null){
            $categoryCount = Category::where([
                'id'    => $request->category_id,
                'status' => 1
            ])->count();
            $categoryDetails = Category::categoryDetails($request->category_id,$url);
        }
        $categoryProducts = Product::with('brand')->where('status', 1);
        if ($categoryCount > 0) {
            $Sprice = null;
            $categoryProducts = $categoryProducts->where('category_id', $categoryDetails['categoryDetails']['id']);
            if($request->product_name != null){
                $categoryProducts = $categoryProducts->where('product_name', 'like', '%' . $request->product_name . '%');
            }
            if($request->discount != null){
                $Sprice = $request->discount;
                $getPrice = explode("-",$request->discount);
                $categoryProducts = $categoryProducts->whereBetween('product_discount', $getPrice);
            }
            if($request->price_range != null){
                $categoryProducts = $categoryProducts->whereBetween('product_price', $request->price_range);
            }
            // if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            //     if ($_GET['sort'] == 'product_latest') {
            //         $categoryProducts->orderBy('products.id', 'Desc');
            //     } elseif ($_GET['sort'] == 'price_lowest') {
            //         $categoryProducts->orderBy('products.product_price', 'Asc');
            //     } elseif ($_GET['sort'] == 'price_highest') {
            //         $categoryProducts->orderBy('products.product_price', 'Desc');
            //     } elseif ($_GET['sort'] == 'name_z_a') {
            //         $categoryProducts->orderBy('products.product_name', 'Desc');
            //     } elseif ($_GET['sort'] == 'name_a_z') {
            //         $categoryProducts->orderBy('products.product_name', 'Asc');
            //     }
            // }
            $categoryProducts = $categoryProducts->paginate(30);   
            $meta_title       = $categoryDetails['categoryDetails']['meta_title'];
            $meta_description = $categoryDetails['categoryDetails']['meta_description'];
            $meta_keywords    = $categoryDetails['categoryDetails']['meta_keywords'];


            return view('front.products.listing')->with(compact('Sprice','fetchAllCategories','categoryDetails', 'categoryProducts', 'url', 'meta_title', 'meta_description', 'meta_keywords'));

        } else {
            // return $request->all();
            $url = \Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri(); 
            $categoryDetails = [];
            $Sprice = null;
            $fetchAllCategories = Category::with('subCategories')->where('parent_id',0)->get();
            $categoryProducts = Product::with(['section' => function($query) { 
                                $query->select('id', 'name');},
                                'category' => function($query) { 
                                    $query->select('id', 'category_name');
                                }
                            ]);
            
            if($request->discount != null){
                $Sprice = $request->discount;
                $getPrice = explode("-",$request->discount);
                $categoryProducts = $categoryProducts->whereBetween('product_discount', $getPrice);
            }
            if($request->product_name != null){
                $categoryProducts = $categoryProducts->where('product_name', 'like', '%' . $request->product_name . '%');
            }
            // if($request->discount != null){
            //     $Sprice = $request->discount;
            //     $getPrice = explode("-",$request->discount);
            //     $categoryProducts =  $categoryProducts->where('product_name', $request->product_name)->whereBetween('product_discount', $getPrice)->where('status', 1);
            // }
            $showMap = false;
            $address = $request->address;
            $radius = $request->radius;
            if ($request->address != null) {
                $showMap = true;
                $latitude = $request->lat;
                $longitude = $request->long;
                // $radius = $request->radius;
                $radiusInKm = $request->radius; // Assuming a 5km radius, you can adjust this as needed

                
                // $categoryProductsFilter =  Product::with(['section' => function($query) { 
                //                 $query->select('id', 'name');},
                //                 'category' => function($query) { 
                //                     $query->select('id', 'category_name');
                //                 }
                //             ])->get();
                $categoryProducts = $categoryProducts->orderBy('products.id', 'Desc')->paginate(30);
                $categoryProducts = $categoryProducts->filter(function ($product) use ($latitude, $longitude, $radiusInKm) {
                    return $product->distance($latitude, $longitude) <= $radiusInKm;
                });
            }
            else{
                $categoryProducts = $categoryProducts->orderBy('products.id', 'Desc')->paginate(5);
            }
            
            $selectedCurrencyRate = $this->getExchnagedRate();
            $getAllProducts = $categoryProducts;
            // Pagination (after the Sorting Filter)
            // $categoryProducts = $categoryProducts->orderBy('products.id', 'Desc')->paginate(30); // Moved the pagination after checking for the sorting filter <form>


            // Dynamic SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in front/layout/layout.blade.php    
            $meta_title       = '';
            $meta_description = '';
            $meta_keywords    = '';
            return view('front.products.listing')->with(compact('selectedCurrencyRate','radius','address','showMap','getAllProducts','Sprice','fetchAllCategories','categoryDetails', 'categoryProducts', 'url', 'meta_title', 'meta_description', 'meta_keywords'));
        }
        
    }
        public function distance($lat2, $lon2)
        {
            $lat1 = $this->latitude;
            $lon1 = $this->longitude;

            $earthRadius = 6371; // in kilometers

            $dLat = deg2rad($lat2 - $lat1);
            $dLon = deg2rad($lon2 - $lon1);

            $a = sin($dLat / 2) * sin($dLat / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($dLon / 2) * sin($dLon / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            $distance = $earthRadius * $c;

            return $distance; // in kilometers
        }
 public function createCheckoutSession(Request $request)
    {
        $getCartItems = Cart::getCartItems(); 
        if (empty($getCartItems)) {
            $message = 'Shopping Cart is empty! Please add listing to your Cart to checkout';

            return redirect('cart')->with('error_message', $message); // redirect user to the cart.blade.php page, and show an error message in cart.blade.php
        }
        $currency = strtolower(Session::get('currency', 'usd'));
        $amount = $request->input('amount');
        if (!is_numeric($amount) || $amount <= 0) {
            return response()->json(['error' => 'Invalid amount specified'], 400);
        } 
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $unitAmount = $amount * 100;
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        //get the comission from the admin
        $comission = Setting::where('name','commission')->first();
        $getComission = $comission->value;
        $getAmountAfterComission = ($getComission/100) * $unitAmount;
        $amountAfterComission = $unitAmount - $getAmountAfterComission;

        $product = $stripe->products->create([
            'name' => 'Listing Fee',
            'default_price_data' => [
                'unit_amount' => $amountAfterComission,
                'currency' => 'usd',
            ],
            'expand' => ['default_price'],
        ]);
        
        //get the stripe account id
        $getUser = Product::where('id',$getCartItems->product_id)->first();
        if($getUser->is_resell == '1'){
            //take the id from the user
            $getLIstingUser = User::where('id',$getUser->vendor_id)->first()['stripe_account_id'];
        }
        else{
            // take the id from the vendor
            $getLIstingUser = Vendor::where('id',$getUser->vendor_id)->first()['stripe_account_id'];
        }
        if($getLIstingUser == null){
            //send amount to the admin
            $session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price' => $product->default_price->id,
                        'quantity' => '1',
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('new.thank.you') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout'),
            ]);
            $successUrl = route('new.thank.you') . '?session_id=' . $session->id;
            return response()->json(['id' => $session->id, 'success_url' => $successUrl]);
        }
        else{
            //send it to vendor
            try  {
                // return ['hello',$stripe->accounts->retrieve($getLIstingUser, [])];
                $account = \Stripe\Account::update(
                    $getLIstingUser,
                    [
                        'capabilities' => [
                            'transfers' => ['requested' => true],
                            'card_payments' => ['requested' => true],
                            'crypto_transfers' => ['requested' => true],
                            'legacy_payments' => ['requested' => true],
                        ],
                    ]
                );
                $session = Stripe\Checkout\Session::create([
                    // 'payment_method_types' => ['card'],
                    // 'line_items' => [[
                    //     'price_data' => [
                    //         'currency' => $currency,
                    //         'product_data' => [
                    //             'name' => 'Total Amount',
                    //         ],
                    //         'unit_amount' => $unitAmount,
                    //     ],
                    //     'quantity' => 1,
                    // ]],
                    'line_items' => [
                    [
                        'price' => $product->default_price->id,
                        'quantity' => $getCartItems->quantity,
                    ],
                    ],
                    'payment_intent_data' => [
                        'application_fee_amount' => $getAmountAfterComission,
                        'transfer_data' => [
                            'destination' => $getLIstingUser
                        ],
                    ],
                    'mode' => 'payment',
                    'success_url' => route('new.thank.you') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('checkout'),
                ]);
                return response()->json(['id' => $session->id]);

            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function webhook(Request $request)
    {
        // Handle the webhook logic here
        // Retrieve the event by verifying the signature
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the checkout.session.completed event
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            // Fulfill the purchase
            // e.g., update database, send email, etc.
        }

        return response()->json(['status' => 'success']);
    }


    // Render Single Product Detail Page in front/products/detail.blade.php    
    public function detail($id) { 
        $productDetails = Product::with([
            'section', 'category', 'brand', 'attributes' => function($query) { 
                $query->where('stock', '>', 0)->where('status', 1); 
            }, 'images', 'vendor'
        ])->find($id)->toArray(); 

        // convert price
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://v6.exchangerate-api.com/v6/79ba39c6dbcca4ca0c72c610/latest/USD',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $getConversion = json_decode($response,true);
        $getCurrencies = $getConversion['conversion_rates'];

        $getCurrentValue = Session::get('currency');
        if($getCurrentValue == null){
            $getCurrentValue = 'USD';
        }
        $productDetails['product_price'] = $productDetails['product_price'] * $getCurrencies[$getCurrentValue];


// return $productDetails;
        $categoryDetails = Category::categoryDetails(null, $productDetails['category']['url']);    
        $similarProducts = Product::with('brand')->where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(4)->inRandomOrder()->get()->toArray();
        if (empty(Session::get('session_id'))) { 
            $session_id = md5(uniqid(rand(), true));
        } else {
            $session_id = Session::get('session_id');
        }
        Session::put('session_id', $session_id); 
        $countRecentlyViewedProducts = DB::table('recently_viewed_products')->where([ 
            'product_id' => $id,
            'session_id' => $session_id 
        ])->count(); 
        if ($countRecentlyViewedProducts == 0) { 
            DB::table('recently_viewed_products')->INSERT([ 
                'product_id' => $id,
                'session_id' => $session_id 
            ]);
        }
        $recentProductsIds = DB::table('recently_viewed_products')->select('product_id')->where('product_id', '!=', $id)->where('session_id', $session_id)->inRandomOrder()->get()->take(4)->pluck('product_id');
        $recentlyViewedProducts = Product::with('brand')->whereIn('id', $recentProductsIds)->get()->toArray(); 
        $groupProducts = array();
        if (!empty($productDetails['group_code'])) { 
            $groupProducts = Product::select('id', 'product_image')->where('id', '!=', $id)->where([ // where('id', '!=', $id)    means exclude (EXCEPT) the currently viewed product (to not be repeated (to prevent repetition))
                'group_code' => $productDetails['group_code'],
                'status'     => 1
            ])->get()->toArray();
        }


        // Show Ratings & Reviews in front/products/detail.blade.php    
        $ratings = Rating::with('user')->where([ // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'user' is the relationship method name in Rating.php model
            'product_id' => $id,
            'status'     => 1
        ])->get()->toArray();

        // Calculate Average Rating (for a product):
        $ratingSum = Rating::where([
            'product_id' => $id,
            'status'     => 1
        ])->sum('rating');

        // Number of times a product has been rated by users
        $ratingCount = Rating::where([
            'product_id' => $id,
            'status'     => 1
        ])->count();

        if ($ratingCount > 0) { // if there's at least one rating for a product (if a product has been rated at least once)
            $avgRating     = round($ratingSum / $ratingCount, 2);
            $avgStarRating = round($ratingSum / $ratingCount); // for showing the "Stars" in HTML
        } else {
            $avgRating     = 0;
            $avgStarRating = 0;
        }

        // Calculate the count of Star Ratings for 1 Star, 2 Stars, 3 Stars, 4 Stars, and 5 Stars ratings (Each on its own)
        $ratingOneStarCount = Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 1
        ])->count();

        $ratingTwoStarCount = Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 2
        ])->count();

        $ratingThreeStarCount = Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 3
        ])->count();

        $ratingFourStarCount = Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 4
        ])->count();

        $ratingFiveStarCount = Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 5
        ])->count();
        $getProduct = Product::find($id);
        if($getProduct->is_resell == '1'){
            //get details from the User Table
            $getUser = User::where('id',$getProduct->vendor_id)->first();
        }
        else{
            $getUser = Admin::where('id',$getProduct->vendor_id)->first();
        }


        $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock'); // sum() the `stock` column of the `products_attributes` table    // sum(): https://laravel.com/docs/9.x/collections#method-sum


        // Dynamic SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in front/layout/layout.blade.php    
        $meta_title       = $productDetails['meta_title'];
        $meta_description = $productDetails['meta_description'];
        $meta_keywords    = $productDetails['meta_keywords'];
        return view('front.products.detail')->with(compact('getUser','productDetails', 'categoryDetails', 'totalStock', 'similarProducts', 'recentlyViewedProducts', 'groupProducts', 'meta_title', 'meta_description', 'meta_keywords', 'ratings', 'avgRating', 'avgStarRating', 'ratingOneStarCount', 'ratingTwoStarCount', 'ratingThreeStarCount', 'ratingFourStarCount', 'ratingFiveStarCount'));
    }



    // The AJAX call from front/js/custom.js file, to show the the correct related `price` and `stock` depending on the selected `size` (from the `products_attributes` table)) by clicking the size <select> box in front/products/detail.blade.php    
    public function getProductPrice(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)
            
            $getDiscountAttributePrice = Product::getDiscountAttributePrice($data['product_id'], null); // $data['product_id'] and $data['size'] come from the 'data' object inside the $.ajax() method in front/js/custom.js file


            return $getDiscountAttributePrice;
        }
    }



    // Show all Vendor products in front/products/vendor_listing.blade.php    // This route is accessed from the <a> HTML element in front/products/vendor_listing.blade.php    
    public function vendorListing($vendorid) { // Required Parameters: https://laravel.com/docs/9.x/routing#required-parameters
        // Get vendor shop name
        $getVendorShop = Vendor::getVendorShop($vendorid);

        // Get all vendor products
        $vendorProducts = Product::with('brand')->where('vendor_id', $vendorid)->where('status', 1); // Eager Loading (using with() method): https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'brand' is the relationship method name in Product.php model that is being Eager Loaded

        // $vendorProducts Pagination
        $vendorProducts = $vendorProducts->paginate(30); // Paginating Eloquent Results: https://laravel.com/docs/9.x/pagination#paginating-eloquent-results


        return view('front.products.vendor_listing')->with(compact('getVendorShop', 'vendorProducts'));
    }



    // Add to Cart <form> submission in front/products/detail.blade.php    
    public function cartAdd(Request $request) {
        if ($request->isMethod('post')) { // if the Add to Cart <form> is submitted
            $data = $request->all();

            // Correcting an issue with Coupon Codes when adding an item to the Cart which already has items in it (added before)
            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data


            // Prevent the ability to add an item to the Cart with 0 zero quantity
            if ($data['quantity'] <= 0) { // if the ordered quantity is 0, convert it to at least 1
                $data['quantity'] = 1;
            }
            $getproduct = Product::where('id',$data['product_id'])->first();
            if($getproduct->is_resell == '1'){
                if(Auth::user() && $getproduct->vendor_id == Auth::user()->id){
                    return redirect()->back()->with('error_message', 'A user can not buy his own product');
                }
            }


            // Check if the selected product `product_id` with that selected `size` have available `stock` in `products_attributes` table
            $getProductStock = Product::where('id',$data['product_id'])->first()['product_units'];

            if ($getProductStock < $data['quantity']) { // if the `stock` available (in `products_attributes` table) is less than the ordered quantity by user (the quantity that the user desires)
                return redirect()->back()->with('error_message', 'Required Quantity is not available!');
            }
            $session_id = Session::get('session_id'); // if the $session_id already exists
            if (empty($session_id)) { // if the session is empty (user is not logged in), create a random session id (for the 'Guest' user)    // https://laravel.com/docs/9.x/authentication#ecosystem-overview    // Determining If An Item Exists In The Session: https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session
                $session_id = Session::getId(); // Get the current session ID    // https://laravel.com/api/9.x/Illuminate/Contracts/Session/Session.html
                Session::put('session_id', $session_id);  // Store the current $session_id in the Session of the user    // Storing Data: https://laravel.com/docs/9.x/session#storing-data    
            }

            
            if (Auth::check()) { // Here we're using the default 'web' Authentication Guard    // if the user is authenticated/logged in (using the default Laravel Authentication Guard 'web' Guard (check config/auth.php file) whose 'Provider' is the User.php Model i.e. `users` table)    // Determining If The Current User Is Authenticated: https://laravel.com/docs/9.x/authentication#determining-if-the-current-user-is-authenticated
                $user_id = Auth::user()->id; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user

                // Check if that authenticated/logged in user has already THE SAME product `product_id` with THE SAME `size` (in `carts` table) in the Cart i.e. the `carts` table
                $countProducts = Cart::where([
                    'user_id'    => $user_id, // THAT EXACT authenticated/logged in user (using their `user_id` because they're authenticated/logged in)
                    'product_id' => $data['product_id'],
                    'size'       => $data['size'] ?? NULL
                ])->count();

            } else { // if the user is NOT logged in (guest)
                // Check if that guest or NOT logged in user has already THE SAME products `product_id` with THE SAME `size` (in `carts` table) in the Cart i.e. the `carts` table    // When user logins, their `user_id` gets updated (check userLogin() method in UserController.php)
                $user_id = 0; // is the same as    $user_id = null;    // When user logins, their `user_id` gets updated (check userLogin() method in UserController.php)    // this is because that the use is NOT authenticated / NOT logged in i.e. guest 
                $countProducts = Cart::where([ // We get the count (number) of that specific product `product_id` with that specific `size` to prevent repetition in the `carts` table 
                    'session_id' => $session_id, // THAT EXACT NON-authenticated/NOT logged or Guest user (using their `session_id` because they're NOT authenticated/NOT logged in or Guest)
                    'product_id' => $data['product_id'],
                    'size'       => $data['size'] ?? NULL
                ])->count();
            }



            // To prevent repetition of the ordered products `product_id` with the same sizes `size` for a certain user (`session_id` or `user_id` depending on whether the user is authenticated/logged in or not) in the `carts` table:
            if ($countProducts > 0) { // if that specific user (`session_id` or `user_id` i.e. depending on the user is authenticated/logged or not (guest)) ALREADY ordered that specific product `product_id` with that same exact `size`, we're going to just UPDATE the `quantity` in the `carts` table to prevent repetition of the ordered products inside the table (and won't create a new record)    // In other words, if the same product with the same size ALREADY EXISTS (ordered with the SAME user) in the `carts` table
                Cart::where([
                    'session_id' => $session_id, // THAT EXACT NON-authenticated/NOT logged or Guest user (using their `session_id` because they're NOT authenticated/NOT logged in or Guest)
                    'user_id'    => $user_id ?? 0, // if the user is authenticated/logged in, take its $user_id. If not, make it zero 0    // When user logins, their `user_id` gets updated (check userLogin() method in UserController.php)
                    'product_id' => $data['product_id'],
                    'size'       => $data['size'] ?? NULL
                ])->increment('quantity', $data['quantity']); // Add the new added quantity (    $data['quantity']    ) to the already existing `quantity` in the `carts` table    // Update Statements: Increment & Decrement: https://laravel.com/docs/9.x/queries#increment-and-decrement
            } else { // if that `product_id` with that `size` was never ordered by that user `session_id` or `user_id` (i.e. that product with that size for that user doesn't exist in the `carts` table), INSERT it into the `carts` table for the first time
                // INSERT the ordered product `product_id`, the user's session ID `session_id`, `size` and `quantity` in the `carts` table
                $item = new Cart; // the `carts` table

                $item->session_id = $session_id; // $session_id will be stored whether the user is authenticated/logged in or NOT
                $item->user_id    = $user_id; // depending on the last if statement (whether user is authenticated/logged in or NOT (guest))    // $user_id will be always zero 0 if the user is NOT authenticated/logged in    // When user logins, their `user_id` gets updated (check userLogin() method in UserController.php)
                $item->product_id = $data['product_id'];
                $item->size       = $data['size'] ?? NULL;
                $item->quantity   = $data['quantity'];

                $item->save();
            }


            return redirect()->back()->with('success_messages', 'Product has been added in Cart!');
        }
    }
    public function connect()
    {
        $url = "https://connect.stripe.com/oauth/authorize?response_type=code&client_id=" . env('STRIPE_CLIENT_ID') . "&scope=read_write";
        return redirect($url);
    }
    public function callback(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $code = $request->code;

        $response = Stripe\OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => $code,
        ]);

        // Save the connected account ID in your database
        $stripeUserId = $response->stripe_user_id;

        // Handle storing the account ID and other details as needed.
        // Example: User::where('id', Auth::id())->update(['stripe_account_id' => $stripeUserId]);

        return redirect('/dashboard')->with('success', 'Stripe account connected successfully');
    }
    public function createStripeConnect(){
        Session::put('page', 'stripe');
        return view('front.users.products.create-stripe');
    }
    public function createConnect(Request $request){
        $userEMail = Auth::user()->email;
        $stripe = new \Stripe\StripeClient([
        "api_key" => env('STRIPE_SECRET'),
        ]);
        // return $userEMail;

        $client = new Client();

        $response = $client->post('https://api.stripe.com/v1/accounts', [
            'headers' => [
                'Authorization' => 'Bearer sk_test_51Oi205KjzMnkYmNBjDHDcTkMZupd2w4wKVLVoNEbuID2dR3b6IepMFNjEcHny3AuLqu7pdDiCWEXnd2zZxnN1qzc00SGCDGIG4',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'country' => 'US',
                'email' => $userEMail,
                'capabilities[card_payments][requested]' => 'true',
                'capabilities[transfers][requested]' => 'true',
                'controller' => [
                    'fees' => [
                        'payer' => 'application',
                    ],
                    // 'capabilities' => [
                    //     'transfers' => ['requested' => true],
                    // ],
                    'losses' => [
                        'payments' => 'application',
                    ],
                    'stripe_dashboard' => [
                        'type' => 'express',
                    ],
                ],
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);
        if(!empty($data['id'])){
            $account_link = $stripe->accountLinks->create([
                'account' => $data['id'],
                'refresh_url' => url('/'), //'https://example.com/reauth',
                'return_url' => url('/'), //'https://example.com/return',
                'type' => 'account_onboarding',
            ]);
            //get user to save the stripe id
            if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->type == 'vendor'){
                $getUser = Vendor::where('email',$userEMail)->first();
            $getUser->stripe_account_id =  $data['id'];
            $getUser->save();
            }
            else{
                $getUser = User::where('email',$userEMail)->first();
                $getUser->stripe_account_id =  $data['id'];
                $getUser->save();
            }
             return redirect($account_link->url);
        }

        return redirect()->back()->with('success_message', 'The stripe connect id has been created');
    
    
    }
    public function createConnectLink(Request $request){
         $stripe = new \Stripe\StripeClient([
        // This is your test secret API key.
        "api_key" => env('STRIPE_SECRET'),
        ]);
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $connectedAccountId = $data->account;

            $account_link = $stripe->accountLinks->create([
                'account' => $connectedAccountId,
                'return_url' => sprintf("http://localhost:4242/return/%s", $connectedAccountId),
                'refresh_url' => sprintf("http://localhost:4242/refresh/%s", $connectedAccountId),
                'type' => 'account_onboarding',
            ]);

            echo json_encode(array(
                'url' => $account_link->url
            ));
            } catch (Exception $e) {
            error_log("An error occurred when calling the Stripe API to create an account link: {$e->getMessage()}");
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
            }
    }
    public function getExchnagedRate(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://v6.exchangerate-api.com/v6/79ba39c6dbcca4ca0c72c610/latest/USD',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $getConversion = json_decode($response,true);
        $getCurrencies = $getConversion['conversion_rates'];

        $getCurrentValue = Session::get('currency');
        if($getCurrentValue == null){
            $getCurrentValue = 'USD';
        }
        return $getCurrencies[$getCurrentValue];
    }

    // Render Cart page (front/products/cart.blade.php)    
    public function cart() {
        
        // Get the Cart Items of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))    
        $getCartItems = Cart::getCartItems();
        if (empty($getCartItems)) {
            $message = 'Shopping Cart is empty! Please add listing to your Cart to checkout';

            return redirect()->back()->with('error', $message); // redirect user to the cart.blade.php page, and show an error message in cart.blade.php
        }
        $getCurrencyRate = $this->getExchnagedRate();
// return $getCartItems;

        // Static SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in front/layout/layout.blade.php    
        $meta_title       = 'Shopping Cart - BOD Exchange - Coupan Marketplace Channel';
        $meta_keywords    = 'shopping cart, multi vendor';


        return view('front.products.cart')->with(compact('getCurrencyRate','getCartItems', 'meta_title', /* 'meta_description', */ 'meta_keywords'));
    }

    // Update Cart Item Quantity AJAX call in front/products/cart_items.blade.php. Check front/js/custom.js
    public function cartUpdate(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)


            // Correcting an issue with Coupon Codes when adding an item to the Cart which already has items in it (added before)
            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');
            $getCurrencyRate = $this->getExchnagedRate();// Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
        


            // Apply some conditions (and showing them in the view!) before Update-ing the Cart Item Quantity (making sure that the desired quantity is not more than (doesn't exceed) the available `stock` in `products_attributes` table, and that the desired product `size` is not disabled/inactive (`status` is not zero 0) in `products_attributes` table)    
            // Get user's Cart details
            $cartDetails = Cart::find($data['cartid']); // $data['cartid'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file

            
            $getProductsStock = Product::where('id',$cartDetails['product_id'])->first()['product_units'];
            // $availableStock = ProductsAttribute::select('stock')->where([
            //     'product_id' => $cartDetails['product_id'],
            //     'size'       => $cartDetails['size']
            // ])->first()->toArray();

            if ($data['qty'] > $getProductsStock) { // if the user's desired quantity exceeds the available `stack` in `products_attributes` table    // $data['cartid'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                // Get the Cart Items (after UPDATE-ing the Cart Item Quantity) of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))
                $getCartItems = Cart::getCartItems();

                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'status'     => false,
                    'message'    => 'Product Stock is not available',
                    // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                    'view'       => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems','getCurrencyRate')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    

                    // We added this view later (Mini Cart Widget) (separate file)
                    'headerview' => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                ]);
            }

            // The 2nd condition: Make sure that the desired product `size` is not disabled/inactive (`status` is not zero 0) in `products_attributes` table)
            // Get product `status` from `products_attributes` table
            // $availableSize =  ProductsAttribute::where([
            //     'product_id' => $cartDetails['product_id'],
            //     'size'       => $cartDetails['size'],
            //     'status'     => 1 // making sure that product size is active/enabled
            // ])->count();

            // if ($availableSize == 0) { // if the desired product's `status` in `products_attributes` table is zero 0 (inactive/disabled)
            //     // Get the Cart Items (after UPDATE-ing the Cart Item Quantity) of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))
            //     $getCartItems = Cart::getCartItems();


            //     return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
            //         'status'  => false,
            //         'message' => 'Product Size is not available. Please remove this Product and choose another one!', // that size's `status` is zero 0 (inactive/disabled)
            //         // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
            //         'view'    => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
            //         'headerview' => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
            //     ]);
            // }


            // Update the `quantity` in `carts` table (after passing the last conditions and checks)
            Cart::where('id', $data['cartid'])->update([ // $data['cartid'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                'quantity' => $data['qty'] // $data['qty'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
            ]);


            // Get the Cart Items (after UPDATE-ing the Cart Item Quantity) of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))
            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems(); // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred



            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data



            return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                'status'         => true,
                'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                'view'           => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems','getCurrencyRate')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                'headerview' => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems','getCurrencyRate')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
            ]);
        }
    }

    // Delete a Cart Item AJAX call in front/products/cart_items.blade.php. Check front/js/custom.js    
    public function cartDelete(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data


            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)


            // Delete the Cart Item
            Cart::where('id', $data['cartid'])->delete(); // $data['cartid'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file


            // Get the Cart Items (after DELETE-ing the Cart Item Quantity) of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))
            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems(); // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred


            return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                // 'status' => true,
                'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                'view'   => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                'headerview' => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
            ]);
        }
    }



    // Note: For Coupons module, user must be logged in (authenticated) to be able to redeem them. Both 'admins' and 'vendors' can add Coupons. Coupons added by 'vendor' will be available for their products ONLY, but ones added by 'admins' will be available for ALL products.
    // Coupon Code redemption (Apply coupon) / Coupon Code HTML Form submission via AJAX in front/products/cart_items.blade.php, check front/js/custom.js    
    public function applyCoupon(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call) (through the 'data' object)


            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data


            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems(); // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred


            // Check the validity of the Coupon Code
            $couponCount = Coupon::where('coupon_code', $data['code'])->count(); // $data['code'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file

            if ($couponCount == 0) { // if the submitted coupon is wrong, send error message
                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'status'         => false,
                    'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                    'message'        => 'The coupon is invalid!',
                    // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                    'view'           => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                    'headerview'     => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                ]);

            } else { // if the submitted coupon is valid, check some conditions (do some validation)
                // SUBMITTED COUPON CODE VALIDATION:

                // Get the coupon submitted (via AJAX) details
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first(); // $data['code'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file


                // Check if the submitted coupon code is active/inactive (enabled/disabled/activated/deactivated)
                if ($couponDetails->status == 0) {
                    $message = 'The coupon is inactive!';
                }


                // Check if the submitted coupon code is expired
                $expiry_date  = $couponDetails->expiry_date;
                $current_date = date('Y-m-d'); // this date format is understandable by MySQL
                
                if ($expiry_date < $current_date) {
                    $message = 'The coupon is expired!';
                }


                // Managing coupon types in `coupons` table: 'Single Time' or 'Multiple Times'
                if ($couponDetails->coupon_type == 'Single Time') { // if the `coupon_type` in `coupons` table is 'Single Time'
                    // Check in the `orders` table if the currently authenticated/logged-in user really used this Coupon Code with their order
                    $couponCount = Order::where([
                        'coupon_code' => $data['code'],
                        'user_id'     => Auth::user()->id // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                    ])->count();

                    if ($couponCount >= 1) { // if this 'Single Time' coupon code has been used/redeemed more than one single time by this user (this authenticated/logged-in user) (i.e. meaning that if that coupon code is already existing in the `orders` table and has been used/redeemed by this authenticated/logged-in user)
                        $message = 'This coupon code is already availed by you!';
                    }
                }


                // Check if the submitted coupon code belongs to the correct relevant selected categories and subcategories of the coupon in the Admin Panel (for example, if the coupon is for Smartphones Category, user can't use it while buying T-shirts)
                // Get the coupon's categories and subcategories (if any)
                $catArr = explode(',', $couponDetails->categories);
                
                $total_amount = 0;

                foreach ($getCartItems as $key => $item) {
                    if (!in_array($item['product']['category_id'], $catArr)) { // if the category of one of the products in the Cart doesn't belong to the Coupon's categories (the categories of the coupon selected by 'vendor' or 'admin' in the Admin Panel for the coupon)
                        $message = 'This coupon code selected categories is not for one of the selected products category!';
                    }

                    
                    $attrPrice = Product::getDiscountAttributePrice($item['product_id'], null);
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                }


                // Check if the coupon code submitted by user is not available for that user (in case the coupon is already selected for certain specific users selected by 'admin' or 'vendor' in the Coupons tab in Admin Panel, and it's not available for all users)
                // Get the coupon's selected users
                if (isset($couponDetails->users) && !empty($couponDetails->users)) {
                    $usersArr = explode(',', $couponDetails->users);    
                    // Check if the submitted coupon code is available ONLY for some specific users (from the Coupons tab in Admin Panel in 'Select User (by email):') and check if the coupon is available or not for the user submitting the coupon code
                    if (count($usersArr)) { // if there's at least a one specific selected user for the coupon
                        // Get user ids of all the selected users that the coupon code are available for them
                        foreach ($usersArr as $key => $user) {
                            $getUserId = User::select('id')->where('email', $user)->first()->toArray();
                            $usersId[] = $getUserId['id'];
                        }
    
                        foreach ($getCartItems as $item) {
                            if (!in_array($item['user_id'], $usersId)) { // if the user id of one of the products in the Cart doesn't belong to the Coupon's specifically selected users (to check if the submitted coupon code is available to the user submitting it or not)
                                $message = 'This coupon code is not available for you! Try again with a valid coupon code! (The coupon code is available only for certain selected users!)';
                            }
                        }
                    }
                }


                // Check if the submitted Coupon code belongs to the Vendor of that product (in case that a vendor (not an 'admin') added that coupon code, because vendor coupon codes are available ONLY for the products of that vendor, and not available for all other products. In contrast, 'Admin' coupon codes are available for ALL products)
                // Vendor's Coupons are eligible only for that vendor's products
                if ($couponDetails->vendor_id > 0) { // Check if submitted coupon code belongs to a 'vendor' (becasue a vendor' coupon is available ONLY for that vendor's products (not all products), whereas admin's coupons are available for all products)
                    // Get all the products ids of that very vendor
                    $productIds = Product::select('id')->where('vendor_id', $couponDetails->vendor_id)->pluck('id')->toArray();

                    foreach ($getCartItems as $item) {
                        if (!in_array($item['product']['id'], $productIds)) { // if the user id of one of the products in the Cart doesn't belong to the products ids of that vendor (to check if the submitted coupon code pertains to that specific/very vendor or not)
                            $message = 'This coupon code is not available for you! Try again with a valid coupon code! (vendor validation)!. The coupon code exists but one of the products in the Cart doesn\'t belong to that specific vendor who created/owns that Coupon!';
                        }
                    }
                }


                // If there's an error message with the submitted coupon code, send this response to the AJAX call
                if (isset($message)) {
                    return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                        'status'         => false,
                        'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                        'message'        => $message,
                        // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                        'view'           => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                        
                        'headerview'     => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                    ]);

                } else { // if the submitted coupon code is correct and passes the previous coupon code validation and passes all the previous if conditions (free of errors)
                    

                    // Check if the submitted Coupon code Amount Type is 'Fixed' or 'Percentage'
                    if ($couponDetails->amount_type == 'Fixed') { // if the submitted coupon code Amount Type is 'Fixed'
                        $couponAmount = $couponDetails->amount; // As is
                    } else { // if the submitted coupon code Amount Type is 'Percentage'
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }


                    $grand_total = $total_amount - $couponAmount;


                    // Assign the Coupon Code and $couponAmount to Session Variables
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode'  , $data['code']); // $data['code'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file

                    $message = 'Coupon Code successfully applied. You are availing discount!';


                    return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                        'status'         => true,
                        'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                        'couponAmount'   => $couponAmount,
                        'grand_total'    => $grand_total,
                        'message'        => $message,
                        // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                        'view'           => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                        'headerview'     => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                    ]);
                }
            }
        }
    }



    public function checkout(Request $request) {
        $countries = Country::where('status', 1)->get()->toArray(); // get the countries which have status = 1 (to ignore the blacklisted countries, in case)
        // $getCartItems = Cart::getCartItems();
        // $getCartItems = Cart::getCartItems();

        // If the Cart is empty (If there're no Cart Items), don't allow opening/accessing the Checkout page (checkout.blade.php)    
        $getCartItems = Cart::getCartItems(); 
        // If the Cart is empty (If there're no Cart Items), don't allow opening/accessing the Checkout page (checkout.blade.php)    
        if (empty($getCartItems)) {
            $message = 'Shopping Cart is empty! Please add listing to your Cart to checkout';

            return redirect('cart')->with('error_message', $message); // redirect user to the cart.blade.php page, and show an error message in cart.blade.php
        }


        // Calculate the total price    
        $total_price  = 0;
        $total_weight = 0;
        $getCurrencyRate = $this->getExchnagedRate();

        // foreach ($getCartItems as $item) {
            $attrPrice = Product::getDiscountAttributePrice($getCartItems['product_id'], null);
            $total_price = $total_price + ($attrPrice['final_price'] * $getCartItems['quantity']);

            
            $product_weight = $getCartItems['product']['product_weight'];
            $total_weight = $total_weight + $product_weight;
        // }
        // $total_price = $total_price * $getCurrencyRate;
        $deliveryAddresses = DeliveryAddress::deliveryAddresses(); 
        foreach ($deliveryAddresses as $key => $value) {
            $shippingCharges = ShippingCharge::getShippingCharges($total_weight, $value['country']);
            $deliveryAddresses[$key]['shipping_charges'] = $shippingCharges;

            $deliveryAddresses[$key]['codpincodeCount'] = DB::table('cod_pincodes')->where('pincode', $value['pincode'])->count();   
            $deliveryAddresses[$key]['prepaidpincodeCount'] = DB::table('prepaid_pincodes')->where('pincode', $value['pincode'])->count(); 
        }


        
        if ($request->isMethod('post')) { // if the <form> in front/products/checkout.blade.php is submitted (the HTML Form that the user submits to submit their Delivery Address and Payment Method)
            $data = $request->all();
            // foreach ($getCartItems as $item) {
                $product_status = Product::getProductStatus($getCartItems['product_id'],null);
                if ($product_status == 0) { // if the product is disabled (`status` = 0)
                    $message = $getCartItems['product']['product_name'] . ' with ' . $getCartItems['size'] . ' size is not available. Please remove it from the Cart and choose another product.';
                    return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
                }
            // }
            $getProductStock = Product::where('id',$getCartItems['product_id'])->first()['product_units']; // A product (`product_id`) with a certain `size`
            if ($getProductStock == 0) { // if the product's `stock` is 0 zero
                $message = $getCartItems['product']['product_name'] . ' is not available. Please remove it from the Cart and choose another product.';
                return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
            }
            $getCategoryStatus = Category::getCategoryStatus($getCartItems['product']['category_id'], null);
            if ($getCategoryStatus == 0) { // if the Category is disabled (`status` = 0)
                $message = $getCartItems['product']['product_name'] . ' with ' . ' is not available. Please remove it from the Cart and choose another product.';
                return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
            }
            if (empty($data['accept'])) { // if the user doesn't select a Delivery Address
                $message = 'Please agree to T&C!';

                return redirect()->back()->with('error_message', $message);
            }
            // if ($data['payment_gateway'] == 'COD') {
                $payment_method = 'COD';
                $order_status   = 'New';

            // } else { 
            //     $payment_method = 'Prepaid';
            //     $order_status   = 'Pending';
            // }
            DB::beginTransaction();
            $total_price = 0;
            // foreach ($getCartItems as $item) {
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($getCartItems['product_id'], null);
                $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $getCartItems['quantity']);
            // }
            $shipping_charges = 0;
            $grand_total = $total_price ;
            Session::put('grand_total', $grand_total);
            $order = new Order; 
            // Assign the $order data to be INSERT-ed INTO the `orders` table
            $order->user_id          = Auth::user()->id; 
            $order->email            = Auth::user()->email;
            $order->shipping_charges = NULL;
            $order->coupon_code      = NULL;   // it was set inside applyCoupon() method
            $order->coupon_amount    = NULL; // it was set inside applyCoupon() method
            $order->order_status     = $order_status;
            $order->payment_method   = $payment_method;
            $order->payment_gateway  = 'COD';
            $order->grand_total      = $grand_total;

            $order->save();

            //insert data into wallet
            $getAdmin = Admin::where('type','superadmin')->first()['id'];
            if(UserWallet::where('user_id',$getAdmin)->where('is_vendor','1')->where('is_admin','1')->exists()){
                $getwallet = UserWallet::where('user_id',$getAdmin)->first();
                $updatedAmount = $grand_total + $getwallet->amount;
                $getwallet->amount = $updatedAmount;
            }
            else{
                $getwallet = new UserWallet();
                $getwallet->amount = $grand_total;
                $getwallet->is_vendor = '1';
                $getwallet->is_admin = '1';
                $getwallet->user_id = $getAdmin;
            }
            $getwallet->save();
            $order_id = $order->id;
            // foreach ($getCartItems as $item) {
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id  = Auth::user()->id;
                $getProductDetails = Product::select('product_code', 'product_name', 'product_color', 'admin_id', 'vendor_id')->where('id', $getCartItems['product_id'])->first()->toArray();
                $cartItem->admin_id        = $getProductDetails['admin_id'];
                $cartItem->vendor_id       = $getProductDetails['vendor_id'];

                $cartItem->product_id      = $getCartItems['product_id'];
                $cartItem->product_code    = $getProductDetails['product_code'];
                $cartItem->product_name    = $getProductDetails['product_name'];
                $cartItem->product_color   = $getProductDetails['product_color'];
                $cartItem->product_size    = $getCartItems['size'];

                $getDiscountAttributePrice = Product::getDiscountAttributePrice($getCartItems['product_id'], null); // from the `products_attributes` table, not the `products` table
                $cartItem->product_price   = $getDiscountAttributePrice['final_price'];


                
                $getProductStock = Product::where('id',$getCartItems['product_id'])->first()['product_units'];
                if ($getCartItems['quantity'] > $getProductStock) { // if the ordered quantity is greater than the existing stock, cancel the order/opertation
                    $message = $getProductDetails['product_name'] . '  stock is not available/enough for your order. Please reduce its quantity and try again!';

                    return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
                }


                $cartItem->product_qty     = $getCartItems['quantity'];

                $cartItem->save(); // INSERT data INTO the `orders_products` table


                
                $getProductStock = Product::where('id',$getCartItems['product_id'])->first()['product_units']; // Get the `stock` of that product `product_id` with that specific `size` from `products_attributes` table
                $newStock = $getProductStock - $getCartItems['quantity'];
                Product::where([ // Update the new `quantity` in the `products_attributes` table
                    'id' => $getCartItems['product_id'],
                ])->update(['product_units' => $newStock]);
                //update respective user wallet

                $getProduct = Product::where('id',$getCartItems['product_id'])->first();
                if($getProduct->is_resell == '1'){
                    //user account
                    $getUserDetails = User::where('id',$getProduct->vendor_id)->first();
                    $getAfterCommision = $getDiscountAttributePrice['final_price'] - (($getDiscountAttributePrice['final_price'] * 5) / 100);
                    $updatedAmount = $getAfterCommision;
                    if(UserWallet::where('user_id',$getUserDetails->id)->exists()){
                        $getwallet = UserWallet::where('user_id',$getUserDetails->id)->first();
                        $getwallet->amount = $updatedAmount + $getwallet->amount;;
                    }
                    else{
                        $getwallet = new UserWallet();
                        $getwallet->amount = $updatedAmount;
                        $getwallet->is_vendor = '0';
                        $getwallet->user_id = $getUserDetails->id;
                    }
                    $getwallet->save();
                }
                else{
                    // vendor side
                    $getUserDetails = $getProduct->vendor_id;
                    $getAfterCommision = $getDiscountAttributePrice['final_price'] - (($getDiscountAttributePrice['final_price'] * 5) / 100);
                    $updatedAmount = $getAfterCommision;
                    if(UserWallet::where('user_id',$getUserDetails)->exists()){
                        $getwallet = UserWallet::where('user_id',$getUserDetails)->first();
                        $getwallet->amount = $updatedAmount + $getwallet->amount;;
                    }
                    else{
                        $getwallet = new UserWallet();
                        $getwallet->amount = $updatedAmount;
                        $getwallet->is_vendor = '1';
                        $getwallet->is_admin = '0';
                        $getwallet->user_id = $getUserDetails;
                    }
                    $getwallet->save();
                }
            // }


            // Store the `order_id` in Session so that we can use it in front/products/thanks.blade.php, thanks() method, paypal() method in Front/PayPalController.php and pay() method in Front/IyzipayController.php
            Session::put('order_id', $order_id); // Storing Data: https://laravel.com/docs/9.x/session#storing-data


            DB::commit(); 
            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray(); // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model

            if ($payment_method == 'COD') { // if the `payment_gateway` selected by the user is 'COD' (in front/products/checkout.blade.php), we send the placing the order confirmation email and SMS immediately
                // Sending the Order confirmation email
                $email = Auth::user()->email; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email'        => $email,
                    'name'         => Auth::user()->name, // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                    'order_id'     => $order_id,
                    'orderDetails' => $orderDetails
                ];

                \Illuminate\Support\Facades\Mail::send('emails.order', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.order' is the order.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that order.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Order Placed - MultiVendorEcommerceApplication.com.eg');
                });

                /*
                // Sending the Order confirmation SMS
                // Send an SMS using an SMS API and cURL    
                $message = 'Dear Customer, your order ' . $order_id . ' has been placed successfully with MultiVendorEcommerceApplication.com.eg. We will inform you once your order is shipped';
                // $mobile = $data['mobile']; // the user's mobile that they entered while submitting the registration form
                $mobile = Auth::user()->moblie; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                \App\Models\Sms::sendSms($message, $mobile); // Send the SMS
                */


                // PayPal payment gateway integration in Laravel
            } elseif ($data['payment_gateway'] == 'Paypal') {
                // redirect the user to the PayPalController.php (after saving the order details in `orders` and `orders_products` tables)
                return redirect('/paypal');

                // iyzico Payment Gateway integration in/with Laravel    
            } elseif ($data['payment_gateway'] == 'iyzipay') {
                // redirect the user to the IyzipayController.php (after saving the order details in `orders` and `orders_products` tables)
                return redirect('/iyzipay');

            } else { // if the `payment_gateway` selected by the user is not 'COD', meaning it's like PayPal, Prepaid, ... (in front/products/checkout.blade.php), we send the placing the order confirmation email and SMS after the user makes the payment
                echo 'Other Prepaid payment methods coming soon';
            }


            return redirect('thanks'); // redirect to front/products/thanks.blade.php page
        }


        return view('front.products.checkout')->with(compact('getCurrencyRate','deliveryAddresses', 'countries', 'getCartItems', 'total_price'));
    }
    public function newThanks(Request $request) {
        $getCartItems = Cart::getCartItems(); 
        // Calculate the total price    
        $total_price  = 0;
        $total_weight = 0;
        $getSelectedCurrency = Session::get('currency');
        // foreach ($getCartItems as $item) {
            $attrPrice = Product::getDiscountAttributePrice($getCartItems['product_id'], null);
            $total_price = round(floatval($attrPrice['final_price']) * intval($getCartItems['quantity']), 2);
            
            $product_weight = $getCartItems['product']['product_weight'];
            $total_weight = $total_weight + $product_weight;
        // }
        $deliveryAddresses = DeliveryAddress::deliveryAddresses(); 
        foreach ($deliveryAddresses as $key => $value) {
            $shippingCharges = ShippingCharge::getShippingCharges($total_weight, $value['country']);
            $deliveryAddresses[$key]['shipping_charges'] = $shippingCharges;

            $deliveryAddresses[$key]['codpincodeCount'] = DB::table('cod_pincodes')->where('pincode', $value['pincode'])->count();   
            $deliveryAddresses[$key]['prepaidpincodeCount'] = DB::table('prepaid_pincodes')->where('pincode', $value['pincode'])->count(); 
        }
        // foreach ($getCartItems as $item) {
            $product_status = Product::getProductStatus($getCartItems['product_id'],null);
            if ($product_status == 0) { // if the product is disabled (`status` = 0)
                $message = $getCartItems['product']['product_name'] . ' with ' . $getCartItems['size'] . ' size is not available. Please remove it from the Cart and choose another product.';
                return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
            }
        // }
        $getProductStock = Product::where('id',$getCartItems['product_id'])->first()['product_units']; // A product (`product_id`) with a certain `size`
        if ($getProductStock == 0) { // if the product's `stock` is 0 zero
            $message = $getCartItems['product']['product_name'] . ' is not available. Please remove it from the Cart and choose another product.';
            return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
        }
        $getCategoryStatus = Category::getCategoryStatus($getCartItems['product']['category_id'], null);
        if ($getCategoryStatus == 0) { // if the Category is disabled (`status` = 0)
            $message = $item['product']['product_name'] . ' with ' . ' is not available. Please remove it from the Cart and choose another product.';
            return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
        }  
        $payment_method = 'COD';
        $order_status   = 'New';
        DB::beginTransaction();
            
            // foreach ($getCartItems as $item) {
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($getCartItems['product_id'], null);
                $total_price = round(floatval($attrPrice['final_price']) * intval($getCartItems['quantity']), 2);
            // }
            $shipping_charges = 0;
            $grand_total = $total_price ;
            Session::put('grand_total', $grand_total);
            $order = new Order; 
            // Assign the $order data to be INSERT-ed INTO the `orders` table
            $order->user_id          = Auth::user()->id; 
            $order->email            = Auth::user()->email;
            $order->shipping_charges = NULL;
            $order->coupon_code      = NULL;   // it was set inside applyCoupon() method
            $order->coupon_amount    = NULL; // it was set inside applyCoupon() method
            $order->order_status     = $order_status;
            $order->payment_method   = $payment_method;
            $order->payment_gateway  = 'COD';
            $order->grand_total      = $grand_total;

            $order->save();

            //insert data into wallet
            $getAdmin = Admin::where('type','superadmin')->first()['id'];
            if(UserWallet::where('user_id',$getAdmin)->where('is_vendor','1')->where('is_admin','1')->exists()){
                $getwallet = UserWallet::where('user_id',$getAdmin)->first();
                $updatedAmount = $grand_total + $getwallet->amount;
                $getwallet->amount = $updatedAmount;
            }
            else{
                $getwallet = new UserWallet();
                $getwallet->amount = $grand_total;
                $getwallet->is_vendor = '1';
                $getwallet->is_admin = '1';
                $getwallet->user_id = $getAdmin;
            }
            $getwallet->save();
            $order_id = $order->id;
            // foreach ($getCartItems as $item) {
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id  = Auth::user()->id;
                $getProductDetails = Product::select('product_code', 'product_name', 'product_color', 'admin_id', 'vendor_id')->where('id', $getCartItems['product_id'])->first()->toArray();
                $cartItem->admin_id        = $getProductDetails['admin_id'];
                $cartItem->vendor_id       = $getProductDetails['vendor_id'];

                $cartItem->product_id      = $getCartItems['product_id'];
                $cartItem->product_code    = $getProductDetails['product_code'];
                $cartItem->product_name    = $getProductDetails['product_name'];
                $cartItem->product_color   = $getProductDetails['product_color'];
                $cartItem->product_size    = $getCartItems['size'];

                $getDiscountAttributePrice = Product::getDiscountAttributePrice($getCartItems['product_id'], null); 
                $cartItem->product_price   = (float)$getDiscountAttributePrice['final_price'] * $getSelectedCurrency;


                
                $getProductStock = Product::where('id',$getCartItems['product_id'])->first()['product_units'];
                if ($getCartItems['quantity'] > $getProductStock) { 
                    $message = $getProductDetails['product_name'] . '  stock is not available/enough for your order. Please reduce its quantity and try again!';

                    return redirect('/cart')->with('error_message', $message); 
                }


                $cartItem->product_qty     = $getCartItems['quantity'];
                $cartItem->remaining_qty     = $getCartItems['quantity'];

                $cartItem->save();


                
                $getProductStock = Product::where('id',$getCartItems['product_id'])->first()['product_units']; 
                $newStock = (int)$getProductStock - $getCartItems['quantity'];
                Product::where([ 
                    'id' => $getCartItems['product_id'],
                ])->update(['product_units' => $newStock]);
                //update respective user wallet

                $getProduct = Product::where('id',$getCartItems['product_id'])->first();
                if($getProduct->is_resell == '1'){
                    //user account
                    $getUserDetails = User::where('id',$getProduct->vendor_id)->first();
                    $getAfterCommision = $getDiscountAttributePrice['final_price'] - (($getDiscountAttributePrice['final_price'] * 5) / 100);
                    $updatedAmount = $getAfterCommision;
                    if(UserWallet::where('user_id',$getUserDetails->id)->exists()){
                        $getwallet = UserWallet::where('user_id',$getUserDetails->id)->first();
                        $getwallet->amount = $updatedAmount + $getwallet->amount;;
                    }
                    else{
                        $getwallet = new UserWallet();
                        $getwallet->amount = $updatedAmount;
                        $getwallet->is_vendor = '0';
                        $getwallet->user_id = $getUserDetails->id;
                    }
                    $getwallet->save();
                }
                else{
                    // vendor side
                    $getUserDetails = $getProduct->vendor_id;
                    $getAfterCommision = $getDiscountAttributePrice['final_price'] - (($getDiscountAttributePrice['final_price'] * 5) / 100);
                    $updatedAmount = $getAfterCommision;
                    if(UserWallet::where('user_id',$getUserDetails)->exists()){
                        $getwallet = UserWallet::where('user_id',$getUserDetails)->first();
                        $getwallet->amount = $updatedAmount + $getwallet->amount;;
                    }
                    else{
                        $getwallet = new UserWallet();
                        $getwallet->amount = $updatedAmount;
                        $getwallet->is_vendor = '1';
                        $getwallet->is_admin = '0';
                        $getwallet->user_id = $getUserDetails;
                    }
                    $getwallet->save();
                }
            // }
            // Store the `order_id` in Session so that we can use it in front/products/thanks.blade.php, thanks() method, paypal() method in Front/PayPalController.php and pay() method in Front/IyzipayController.php
            Session::put('order_id', $order_id); // Storing Data: https://laravel.com/docs/9.x/session#storing-data


            DB::commit(); 
            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray(); // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model

            if ($payment_method == 'COD') { // if the `payment_gateway` selected by the user is 'COD' (in front/products/checkout.blade.php), we send the placing the order confirmation email and SMS immediately
                // Sending the Order confirmation email
                $email = Auth::user()->email; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email'        => $email,
                    'name'         => Auth::user()->name, // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                    'order_id'     => $order_id,
                    'orderDetails' => $orderDetails
                ];

                \Illuminate\Support\Facades\Mail::send('emails.order', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.order' is the order.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that order.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Order Placed - MultiVendorEcommerceApplication.com.eg');
                });

                /*  
                $message = 'Dear Customer, your order ' . $order_id . ' has been placed successfully with MultiVendorEcommerceApplication.com.eg. We will inform you once your order is shipped';
                // $mobile = $data['mobile']; // the user's mobile that they entered while submitting the registration form
                $mobile = Auth::user()->moblie; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                \App\Models\Sms::sendSms($message, $mobile); // Send the SMS
                */


                // PayPal payment gateway integration in Laravel
            }


        if (Session::has('order_id')) { 
            Cart::where('user_id', Auth::user()->id)->delete();

            return view('front.products.thanks');
        } else { 
            return redirect('cart'); 
        }
    }  
    public function thanks(Request $request) {
        $session_id = $request->query('session_id');

        if (Session::has('order_id')) { // if there's an order has been placed, empty the Cart (remove the order (the cart items/products) from `carts`table)    // 'user_id' was stored in Session inside checkout() method in Front/ProductsController.php
            // We empty the Cart after placing the order
            Cart::where('user_id', Auth::user()->id)->delete(); // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user


            return view('front.products.thanks');
        } else { // if there's no order has been placed
            return redirect('cart'); // redirect user to cart.blade.php page
        }
    }



    // PIN code Availability Check: check if the PIN code of the user's Delivery Address exists in our database (in both `cod_pincodes` and `prepaid_pincodes`) or not in front/products/detail.blade.php via AJAX. Check front/js/custom.js    
    public function checkPincode(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)


            // Checking PIN code availability of BOTH COD and Prepaid PIN codes in BOTH `cod_pincodes` and `prepaid_pincodes` tables    
            // Check if the COD PIN code of that Delivery Address of the user exists in `cod_pincodes` table    
            $codPincodeCount = DB::table('cod_pincodes')->where('pincode', $data['pincode'])->count(); // $data['pincode'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
    
            // Check if the Prepaid PIN code of that Delivery Address of the user exists in `prepaid_pincodes` table    
            $prepaidPincodeCount = DB::table('prepaid_pincodes')->where('pincode', $data['pincode'])->count(); // $data['pincode'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file

            // Check if the entered PIN code exists in BOTH `cod_pincodes` and `prepaid_pincodes` tables
            if ($codPincodeCount == 0 && $prepaidPincodeCount == 0) {
                echo 'This pincode is not available for delivery';
            } else {
                echo 'This pincode is available for delivery';
            }
        }
    }
    public function userResellProducts() {
     // render products.blade.php in the Admin Panel
        Session::put('page', 'products');

        // Get ALL products ($products)
        $products = Product::with([ // Constraining Eager Loads: https://laravel.com/docs/9.x/eloquent-relationships#constraining-eager-loads    // Subquery Where Clauses: https://laravel.com/docs/9.x/queries#subquery-where-clauses    // Advanced Subqueries: https://laravel.com/docs/9.x/eloquent#advanced-subqueries
            'section' => function($query) { // the 'section' relationship method in Product.php Model
                $query->select('id', 'name'); // Important Note: It's a MUST to select 'id' even if you don't need it, because the relationship Foreign Key `product_id` depends on it, or else the `product` relationship would give you 'null'!
            },
            'category' => function($query) { // the 'category' relationship method in Product.php Model
                $query->select('id', 'category_name'); // Important Note: It's a MUST to select 'id' even if you don't need it, because the relationship Foreign Key `product_id` depends on it, or else the `product` relationship would give you 'null'!
            }
        ]);
        $produtcs = $products->where('vendor_id', \Illuminate\Support\Facades\Auth::user()->id);

        $products = $products->get()->toArray(); 

        return view('front.users.products.products')->with(compact('products')); // render products.blade.php page, and pass $products variable to the view
    }
    public function allListings() {
     // render products.blade.php in the Admin Panel
        Session::put('page', 'products');

        // Get ALL products ($products)
        $products = Product::with([ // Constraining Eager Loads: https://laravel.com/docs/9.x/eloquent-relationships#constraining-eager-loads    // Subquery Where Clauses: https://laravel.com/docs/9.x/queries#subquery-where-clauses    // Advanced Subqueries: https://laravel.com/docs/9.x/eloquent#advanced-subqueries
            'section' => function($query) { // the 'section' relationship method in Product.php Model
                $query->select('id', 'name'); // Important Note: It's a MUST to select 'id' even if you don't need it, because the relationship Foreign Key `product_id` depends on it, or else the `product` relationship would give you 'null'!
            },
            'category' => function($query) { // the 'category' relationship method in Product.php Model
                $query->select('id', 'category_name'); // Important Note: It's a MUST to select 'id' even if you don't need it, because the relationship Foreign Key `product_id` depends on it, or else the `product` relationship would give you 'null'!
            }
        ]);
        $products = $products->get()->toArray(); 

        return view('front.products.products')->with(compact('products')); // render products.blade.php page, and pass $products variable to the view
    }
    public function userResellEdit(Request $request, $id = null, $order_id = null) { 
        Session::put('page', 'products');
            $title = 'Edit Product';
            $product = Product::find($id);
            $getProductImages = ProductsImage::where('product_id',$product->original_product_id)->pluck('image');
            if($order_id != null){
                $getAvailableResell = OrdersProduct::where('id',$order_id)->first()['remaining_qty'];
            }
            else{
                $getAvailableResell = 0;
            }
            // dd($product);
            $message = 'Product updated for resell successfully!';

        // Get ALL the Sections with their Categories and Subcategories (Get all sections with its categories and subcategories)    // $categories are ALL the `sections` with their (parent) categories (if any (if exist)) and subcategories (if any (if exist))    
        $categories = \App\Models\Section::with('categories')->get()->toArray(); // with('categories') is the relationship method name in the Section.php Model
        // dd($categories);

        // Get all brands
        $brands = \App\Models\Brand::where('status', 1)->get()->toArray();
        // dd($brands);


        // return view('admin.products.add_edit_product')->with(compact('title', 'product'));
        return view('front.users.products.add_edit_product')->with(compact('getProductImages','title', 'product', 'categories', 'brands','order_id','getAvailableResell'));
    }
    
    public function updateResellProduct(Request $request){
        //get PRoduct
        // return $request->all();
        $getOrderDetails = OrdersProduct::where('id',$request->order_product)->first();
        $getProduct = Product::find($request->product_id);
        if($request->product_units > $getOrderDetails->remaining_qty){
            return redirect()->back()->with('error', "You have ". $getOrderDetails->remaining_qty. " quantity to resell");
        }
        $getOrderDetails->remaining_qty = $getOrderDetails->remaining_qty - $request->product_units;
        $getOrderDetails->save();
        $getProduct->product_price = $request->product_price;
        $getProduct->product_units = $request->product_units;
        $getProduct->address = $request->address;
        $getProduct->latitude = $request->lat;
        $getProduct->longitude = $request->long;
        $getProduct->save();
        if($getProduct){
            return redirect()->route('get.user.products')->with('success_message', "Product updated successfully!");
        }

    }
    public function orduserResellOrdersers() {
        Session::put('page', 'orders');


        // if ($adminType == 'vendor') { // If the authenticated/logged-in user is 'vendor', we show ONLY the orders of the products added by that specific 'vendor' ONLY
            $user_id = \Illuminate\Support\Facades\Auth::user()->id;
            $orders = Order::with([ // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model    // Constraining Eager Loads: https://laravel.com/docs/9.x/eloquent-relationships#constraining-eager-loads    // Subquery Where Clauses: https://laravel.com/docs/9.x/queries#subquery-where-clauses    // Advanced Subqueries: https://laravel.com/docs/9.x/eloquent#advanced-subqueries
                'orders_products' => function($query) use ($user_id) { // function () use ()     syntax: https://www.php.net/manual/en/functions.anonymous.php#:~:text=the%20use%20language%20construct     // 'orders_products' is the Relationship method name in Order.php model
                    $query->where('vendor_id',$user_id); // `vendor_id` in `orders_products` table
                }
            ])->orderBy('id', 'Desc')->get()->toArray();
            // dd($orders);

        // } else { // if the authenticated/logged-in user is 'admin', we show ALL orders
        //     $orders = Order::with('orders_products')->orderBy('id', 'Desc')->get()->toArray(); // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model
        //     // dd($orders);
        // }


        return view('front.users.products.orders')->with(compact('orders'));
    }
    public function userOrderedListing(){
        Session::put('page', 'ordered_listing');
        $products = OrdersProduct::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();
        foreach($products as $order){
            $getproduct = Product::where('id',$order->product_id)->first();
            $order->product = $getproduct;
            $order->buyer_name = \Illuminate\Support\Facades\Auth::user()->name;
            $order->QRdata = "Buyer Name: " . $order->buyer_name . "\n" . 
                                "Product Name: " .  isset($getproduct) ? $getproduct->product_name : '' . "\n" . 
                                "Product Code: " . $getproduct->product_code;
             $order->is_resell = true;                  
            if($order->remaining_qty <= 0){
                $order->is_resell = false;
            }
            
        }
        // $products = Product::whereIn('id',$getProducts)->get();
        // foreach($products as $product){
        //     $product->buyer_name = \Illuminate\Support\Facades\Auth::user()->name;
        //     $product->QRdata = "Buyer Name: " . $product->buyer_name . "\n" . 
        //                         "Product Name: " .  $product->product_name . "\n" . 
        //                         "Product Code: " . $product->product_code; 
        // }
        // return $products;
            return view('front.users.products.ordered_listing',compact('products'));
    }
    public function listingVerification(){
        return view ('front.verification.verification');
    }
    public function checkListingVerification(Request $req){
        if(Product::where('product_code',$req->email)->exists()){
            $getDetails = Product::where('product_code',$req->email)->first();
            $data = [
                'owner_name' => Vendor::where('id',$getDetails->vendor_id)->first()['name'],
                'product_name' => $getDetails->product_name,
                'product_code' => $req->email
            ];
            return response()->json(['success'=> 1, 'data'=>$data, 'message' =>'Product Found']);
        }
        else{
            return response()->json(['error'=> 1, 'data'=>[], 'message' =>'No Product Found']);
        }
    }
    public function stripePost(Request $request){
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $request->amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Listing Amount" 
        ]);
        
        $countries = Country::where('status', 1)->get()->toArray(); // get the countries which have status = 1 (to ignore the blacklisted countries, in case)
        $getCartItems = Cart::getCartItems();   
        if (count($getCartItems) == 0) {
            $message = 'Shopping Cart is empty! Please add listing to your Cart to checkout';

            return redirect('cart')->with('error_message', $message); // redirect user to the cart.blade.php page, and show an error message in cart.blade.php
        }


        // Calculate the total price    
        $total_price  = 0;
        $total_weight = 0;

        foreach ($getCartItems as $item) {
            $attrPrice = Product::getDiscountAttributePrice($item['product_id'], null);
            $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']);

            
            $product_weight = $item['product']['product_weight'];
            $total_weight = $total_weight + $product_weight;
        }
        $deliveryAddresses = DeliveryAddress::deliveryAddresses(); 
        foreach ($deliveryAddresses as $key => $value) {
            $shippingCharges = ShippingCharge::getShippingCharges($total_weight, $value['country']);
            $deliveryAddresses[$key]['shipping_charges'] = $shippingCharges;

            $deliveryAddresses[$key]['codpincodeCount'] = DB::table('cod_pincodes')->where('pincode', $value['pincode'])->count();   
            $deliveryAddresses[$key]['prepaidpincodeCount'] = DB::table('prepaid_pincodes')->where('pincode', $value['pincode'])->count(); 
        }


        
        if ($request->isMethod('post')) { // if the <form> in front/products/checkout.blade.php is submitted (the HTML Form that the user submits to submit their Delivery Address and Payment Method)
            $data = $request->all();
            foreach ($getCartItems as $item) {
                $product_status = Product::getProductStatus($item['product_id'],null);
                if ($product_status == 0) { // if the product is disabled (`status` = 0)
                    $message = $item['product']['product_name'] . ' with ' . $item['size'] . ' size is not available. Please remove it from the Cart and choose another product.';
                    return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
                }
            }
            $getProductStock = Product::where('id',$item['product_id'])->first()['product_units']; // A product (`product_id`) with a certain `size`
            if ($getProductStock == 0) { // if the product's `stock` is 0 zero
                $message = $item['product']['product_name'] . ' is not available. Please remove it from the Cart and choose another product.';
                return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
            }
            $getCategoryStatus = Category::getCategoryStatus($item['product']['category_id'], null);
            if ($getCategoryStatus == 0) { // if the Category is disabled (`status` = 0)
                $message = $item['product']['product_name'] . ' with ' . ' is not available. Please remove it from the Cart and choose another product.';
                return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
            }
            if (empty($data['accept'])) { // if the user doesn't select a Delivery Address
                $message = 'Please agree to T&C!';

                return redirect()->back()->with('error_message', $message);
            }
            // if ($data['payment_gateway'] == 'COD') {
                $payment_method = 'COD';
                $order_status   = 'New';

            // } else { 
            //     $payment_method = 'Prepaid';
            //     $order_status   = 'Pending';
            // }
            DB::beginTransaction();
            $total_price = 0;
            foreach ($getCartItems as $item) {
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], null);
                $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']);
            }
            $shipping_charges = 0;
            $grand_total = $total_price ;
            Session::put('grand_total', $grand_total);
            $order = new Order; 
            // Assign the $order data to be INSERT-ed INTO the `orders` table
            $order->user_id          = Auth::user()->id; 
            $order->email            = Auth::user()->email;
            $order->shipping_charges = NULL;
            $order->coupon_code      = NULL;   // it was set inside applyCoupon() method
            $order->coupon_amount    = NULL; // it was set inside applyCoupon() method
            $order->order_status     = $order_status;
            $order->payment_method   = $payment_method;
            $order->payment_gateway  = 'COD';
            $order->grand_total      = $grand_total;

            $order->save();

            //insert data into wallet
            $getAdmin = Admin::where('type','superadmin')->first()['id'];
            if(UserWallet::where('user_id',$getAdmin)->where('is_vendor','1')->where('is_admin','1')->exists()){
                $getwallet = UserWallet::where('user_id',$getAdmin)->first();
                $updatedAmount = $grand_total + $getwallet->amount;
                $getwallet->amount = $updatedAmount;
            }
            else{
                $getwallet = new UserWallet();
                $getwallet->amount = $grand_total;
                $getwallet->is_vendor = '1';
                $getwallet->is_admin = '1';
                $getwallet->user_id = $getAdmin;
            }
            $getwallet->save();
            $order_id = $order->id;
            foreach ($getCartItems as $item) {
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id  = Auth::user()->id;
                $getProductDetails = Product::select('product_code', 'product_name', 'product_color', 'admin_id', 'vendor_id')->where('id', $item['product_id'])->first()->toArray();
                $cartItem->admin_id        = $getProductDetails['admin_id'];
                $cartItem->vendor_id       = $getProductDetails['vendor_id'];

                $cartItem->product_id      = $item['product_id'];
                $cartItem->product_code    = $getProductDetails['product_code'];
                $cartItem->product_name    = $getProductDetails['product_name'];
                $cartItem->product_color   = $getProductDetails['product_color'];
                $cartItem->product_size    = $item['size'];

                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], null); // from the `products_attributes` table, not the `products` table
                $cartItem->product_price   = $getDiscountAttributePrice['final_price'];


                
                $getProductStock = Product::where('id',$item['product_id'])->first()['product_units'];
                if ($item['quantity'] > $getProductStock) { // if the ordered quantity is greater than the existing stock, cancel the order/opertation
                    $message = $getProductDetails['product_name'] . '  stock is not available/enough for your order. Please reduce its quantity and try again!';

                    return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
                }


                $cartItem->product_qty     = $item['quantity'];
                $cartItem->remaining_qty     = $item['quantity'];

                $cartItem->save(); // INSERT data INTO the `orders_products` table


                
                $getProductStock = Product::where('id',$item['product_id'])->first()['product_units']; // Get the `stock` of that product `product_id` with that specific `size` from `products_attributes` table
                $newStock = $getProductStock - $item['quantity'];
                Product::where([ // Update the new `quantity` in the `products_attributes` table
                    'id' => $item['product_id'],
                ])->update(['product_units' => $newStock]);
                //update respective user wallet

                $getProduct = Product::where('id',$item['product_id'])->first();
                if($getProduct->is_resell == '1'){
                    //user account
                    $getUserDetails = User::where('id',$getProduct->vendor_id)->first();
                    $getAfterCommision = $getDiscountAttributePrice['final_price'] - (($getDiscountAttributePrice['final_price'] * 5) / 100);
                    $updatedAmount = $getAfterCommision;
                    if(UserWallet::where('user_id',$getUserDetails->id)->exists()){
                        $getwallet = UserWallet::where('user_id',$getUserDetails->id)->first();
                        $getwallet->amount = $updatedAmount + $getwallet->amount;;
                    }
                    else{
                        $getwallet = new UserWallet();
                        $getwallet->amount = $updatedAmount;
                        $getwallet->is_vendor = '0';
                        $getwallet->user_id = $getUserDetails->id;
                    }
                    $getwallet->save();
                }
                else{
                    // vendor side
                    $getUserDetails = $getProduct->vendor_id;
                    $getAfterCommision = $getDiscountAttributePrice['final_price'] - (($getDiscountAttributePrice['final_price'] * 5) / 100);
                    $updatedAmount = $getAfterCommision;
                    if(UserWallet::where('user_id',$getUserDetails)->exists()){
                        $getwallet = UserWallet::where('user_id',$getUserDetails)->first();
                        $getwallet->amount = $updatedAmount + $getwallet->amount;;
                    }
                    else{
                        $getwallet = new UserWallet();
                        $getwallet->amount = $updatedAmount;
                        $getwallet->is_vendor = '1';
                        $getwallet->is_admin = '0';
                        $getwallet->user_id = $getUserDetails;
                    }
                    $getwallet->save();
                }
            }


            // Store the `order_id` in Session so that we can use it in front/products/thanks.blade.php, thanks() method, paypal() method in Front/PayPalController.php and pay() method in Front/IyzipayController.php
            Session::put('order_id', $order_id); // Storing Data: https://laravel.com/docs/9.x/session#storing-data


            DB::commit(); 
            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray(); // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model

            if ($payment_method == 'COD') { // if the `payment_gateway` selected by the user is 'COD' (in front/products/checkout.blade.php), we send the placing the order confirmation email and SMS immediately
                // Sending the Order confirmation email
                $email = Auth::user()->email; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email'        => $email,
                    'name'         => Auth::user()->name, // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                    'order_id'     => $order_id,
                    'orderDetails' => $orderDetails
                ];

                \Illuminate\Support\Facades\Mail::send('emails.order', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.order' is the order.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that order.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Order Placed - MultiVendorEcommerceApplication.com.eg');
                });

                /*
                // Sending the Order confirmation SMS
                // Send an SMS using an SMS API and cURL    
                $message = 'Dear Customer, your order ' . $order_id . ' has been placed successfully with MultiVendorEcommerceApplication.com.eg. We will inform you once your order is shipped';
                // $mobile = $data['mobile']; // the user's mobile that they entered while submitting the registration form
                $mobile = Auth::user()->moblie; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                \App\Models\Sms::sendSms($message, $mobile); // Send the SMS
                */


                // PayPal payment gateway integration in Laravel
            } elseif ($data['payment_gateway'] == 'Paypal') {
                // redirect the user to the PayPalController.php (after saving the order details in `orders` and `orders_products` tables)
                return redirect('/paypal');

                // iyzico Payment Gateway integration in/with Laravel    
            } elseif ($data['payment_gateway'] == 'iyzipay') {
                // redirect the user to the IyzipayController.php (after saving the order details in `orders` and `orders_products` tables)
                return redirect('/iyzipay');

            } else { // if the `payment_gateway` selected by the user is not 'COD', meaning it's like PayPal, Prepaid, ... (in front/products/checkout.blade.php), we send the placing the order confirmation email and SMS after the user makes the payment
                echo 'Other Prepaid payment methods coming soon';
            }


            return redirect('thanks'); // redirect to front/products/thanks.blade.php page
        }


        return view('front.products.checkout')->with(compact('deliveryAddresses', 'countries', 'getCartItems', 'total_price'));
    
    }


}