<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;

class IndexController extends Controller
{
    public function index() {
        // Get all active (enabled) banners
        $getValue = Session::get('currency');
        // return $getValue;

        $sliderBanners = Banner::where('type', 'Slider')->where('status', 1)->get()->toArray(); 
        $fixBanners    = Banner::where('type', 'Fix')->where('status', 1)->get()->toArray(); 
        $getAllCats = Category::where('status','1')->get();
        $newProducts   = Product::orderBy('id', 'Desc')->where('status', 1)->limit(8)->get()->toArray(); // show the LATEST (DESCendingly) 8 added products (to show the 'New Arrivals' at the home page)    // Ordering, Grouping, Limit & Offset: https://laravel.com/docs/9.x/queries#ordering-grouping-limit-and-offset    
        $bestSellers   = Product::where([
            'is_bestseller' => 'Yes',
            'status'        => 1 // product is enabled (active)
        ])->inRandomOrder()->get()->toArray(); // show the 'BestSeller' products with RANDOM ORDERING: https://laravel.com/docs/9.x/queries#random-ordering    // using the inRandomOder() method    // Only 'superadmin' can mark a product as 'best seller', but 'vendor' can't    
        $discountedProducts = Product::where('product_discount', '>' , 0)->where('status', 1)->limit(6)->inRandomOrder()->get()->toArray(); // show 'Discounted Products' with RANDOM ORDERING    
        $featuredProducts   = Product::where([
            'is_featured' => 'Yes',
            'status'      => 1 // product is enabled (active)
        ])->limit(6)->get()->toArray(); // show 'Featured Products'    


        // Static SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in front/layout/layout.blade.php    
        $meta_title       = 'BOD Exchange - Coupan Marketplace Channel';
        $meta_description = 'Online Shopping Website which deals in Clothing, Electronics & Appliances Products';
        $meta_keywords    = 'eshop website, online shopping, multi vendor e-commerce';


        return view('front.index')->with(compact('getAllCats','sliderBanners', 'fixBanners', 'newProducts', 'bestSellers', 'discountedProducts', 'featuredProducts', 'meta_title', 'meta_description', 'meta_keywords')); // this is the same as:    return view('front/index');
    }
    public function saveUserCurrency(Request $request){
        Session::put('currency', $request->user_currency);

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://v6.exchangerate-api.com/v6/79ba39c6dbcca4ca0c72c610/latest/USD',
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => '',
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => 'GET',
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // $getConversion = json_decode($response,true);
        // $getCurrencies = $getConversion['conversion_rates'];
        return redirect()->back();
    }
    public function contactUsSubmit(Request $req){
        $data = [
            'name' => $req->first_name . " " . $req->last_name,
            'email' => $req->email,
            'subject' => $req->subject,
            'messageContent' => $req->message,
            
        ];

        $email = "arslamoazzam1431@gmail.com";
        $name = "arslamoazzam1431@gmail.com";

        try {
            // Send the email
            Mail::send('front.email', $data, function($message) use ($email, $name) {
                $message->to($email, $name);
                $message->from('arslamoazzam1431@gmail.com', 'Coupan Marketplace'); 
                $message->subject('Contact - Us');
            });

          return redirect('/contact-us')->with('success_message', 'EMail has been sent to Admin');

        } catch (\Exception $e) {
            return redirect('/contact-us')->with('error_message', 'Email sending failed');
        }

        // return response()->json(['message' => 'Email Sent!']);
    }
}