<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Dispute;
use App\Models\Product;
use App\Models\OrdersProduct;
use Illuminate\Http\Request;

class DisputeController extends Controller
{
    public function addDispute(Request $request){
        // return $request->all();
        // return public_path('front/images/dispute/');
        $validator = Validator::make($request->all(), [
            'dispute_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($validator->fails()) {
    // Handle validation errors
            return redirect()->back()->with('error_message','Image file type is not allowed');
        }
        $addDispute = new Dispute();
        $addDispute->user_id = Auth::user() ? Auth::user()->id : Auth::guard('admin')->user()->id; 
        $addDispute->is_vendor = Auth::user() ? '0' : '1'; 
        $addDispute->product_id = $request->product_id;
        $addDispute->dispute_title = $request->title;
        $addDispute->dispute_description = $request->dispute_description;
        if ($request->hasFile('dispute_image')) {
            $dispute_image = $request->file('dispute_image');
            $dispute_image_name = $dispute_image->getClientOriginalName();
            $dispute_image->move(public_path('front/images/dispute/'), $dispute_image_name);
            $addDispute->dispute_image = $dispute_image_name;
        }
        $addDispute->save();
        return redirect()->back()->with('success_message','Dispute Created Successfully!');
    }
    public function getDispute(){
        Session::put('page', 'dispute');
        if(Auth::user() && Auth::user()->id){
            $getDispute = Dispute::where('user_id',Auth::user()->id)->orderBy('id','ASC')->get();
        }
        // else{
        //     // return Auth::guard('admin')->user() != null  && Auth::guard('admin')->user()->type == 'vendor';
        //     $getDispute = Dispute::pluck('order_id');
        //     $getProducts = OrdersProduct::whereIn('order_id',$getDispute)->pluck('product_id');
        //     foreach($getProducts as $product){
        //         if(Product::where('id',$product)->where('vendor_id',Auth::guard('admin')->user()->id)->exists()){}
        //         $getProduct = Product::where('id',$product)->first();
        //         return $getProduct;
        //     }

        // }
       return view('front.users.products.dispute',compact('getDispute'));
    }
    public function receivedDispute(){
        //get all the received disputes
        Session::put('page', 'received_dispute');
        if(Auth::user() && Auth::user()->id){
            $getProducts = Product::where('is_resell','1')->where('vendor_id',Auth::user()->id)->pluck('id');
            $getDispute = Dispute::whereIn('product_id',$getProducts)->get();
            return view('front.users.products.received_dispute',compact('getDispute'));
        }
        if(Auth::guard('admin')->user() != null  && Auth::guard('admin')->user()->type == 'vendor'){
            $getProducts = Product::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->pluck('id');
            $getDispute = Dispute::whereIn('product_id',$getProducts)->get();
            return view('admin.dispute.dispute',compact('getDispute'));
        }
        if(Auth::guard('admin')->user() != null  && Auth::guard('admin')->user()->type == 'superadmin'){
            $getDispute = Dispute::orderBy('created_at','DESC')->get();
            return view('admin.dispute.dispute',compact('getDispute'));
        }   

    }
    public function addDisputeResponse(Request $request){
        $validator = Validator::make($request->all(), [
            'dispute_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($validator->fails()) {
    // Handle validation errors
            return redirect()->back()->with('error_message','Image file type is not allowed');
        }
        $getDispute = Dispute::where('id',$request->dispute_id)->first();
        if(Auth::guard('admin')->user() != null  && Auth::guard('admin')->user()->type == 'vendor'){
            $getDispute->vendor_response = $request->dispute_description;
        }
        elseif(Auth::guard('admin')->user() != null  && Auth::guard('admin')->user()->type == 'superadmin'){
            $getDispute->admin_response = $request->dispute_description;
            $getDispute->dispute_winner = $request->dispute_winner;
        }
        
        $getDispute->status = 'Closed';
        $getDispute->save();
        return redirect()->back()->with('success_message','Your response has been recorded');
    }
}
