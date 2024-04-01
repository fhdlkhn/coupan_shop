<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrdersProduct;

class OrderController extends Controller
{
    // Render User 'My Orders' page    
    public function orders($id = null) { // If the slug {id?} (Optional Parameters) is passed in, this means go to the front/orders/order_details.blade.php page, and if not, this means go to the front/orders/orders.blade.php page    // Optional Parameters: https://laravel.com/docs/9.x/routing#parameters-optional-parameters    
        if (empty($id)) { // if the order id is not passed in in the route (URL) as an Optional Parameter (slug), this means go to front/orders/orders.blade.php page
            // Get all the orders of the currently authenticated/logged-in user
            $orders = Order::with('orders_products')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray(); // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user    // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model
            // dd($orders);

            //    $product->QRdata = "Buyer Name: " . $product->buyer_name . "\n" . 
            //                     "Product Name: " .  $product->product_name . "\n" . 
            //                     "Product Code: " . $product->product_code;
            foreach ($orders as &$order) {
                foreach ($order['orders_products'] as &$product) {
                    $product['QRdata'] = "Buyer Name: " . \Illuminate\Support\Facades\Auth::user()->name . "\n" . 
                                        "Product Name: " .  $product['product_name'] . "\n" . 
                                        "Product Code: " . $product['product_code'];
                }
                unset($product); // Unset the reference to avoid potential issues
            }
            unset($order);


            return view('front.orders.orders')->with(compact('orders'));

        } else { // if the order id is passed in in the route (URL) as an Optional Parameter (slug), this means go to front/orders/order_details.blade.php page
            $orderDetails = Order::with('orders_products')->where('id', $id)->first()->toArray();// Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model
            // dd($orderDetails);


            return view('front.orders.order_details')->with(compact('orderDetails'));
        }

    }
    public function addUserProducts(Request $req){
        //replicate the product with the different vendors detail
        $getOrder = OrdersProduct::where('id',$req->id)->first();
        if($getOrder !=null){
        $getProduct = Product::where('id',$getOrder->product_id)->first();
        $getProduct->original_product_id = $getOrder->product_id;
        $getProduct->vendor_id =  \Illuminate\Support\Facades\Auth::user()->id;
        $getProduct->product_units = $getOrder->product_qty;
        $getProduct->is_resell = '1';
        $getProduct->product_code = rand(1000, 9999);
        $AddProductToUser = $getProduct->replicate();
        $AddProductToUser->save();
        if($AddProductToUser){
            return redirect()->route('edit.user.products', ['id' => $AddProductToUser->id,'order_id' => $getOrder->id])->with('success_message', 'Product has been added');
        }

    }
}

}