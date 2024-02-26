<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Payout;
use App\Models\User;
use App\Models\Vendor;
use App\Models\UserWallet;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class PayoutController extends Controller
{
    public function payout(){
        Session::put('page', 'payout');
        if( Auth::guard('admin')->user() != null && Auth::guard('admin')->user()->type == 'vendor'){
            $getWallet = UserWallet::where('user_id',Auth::guard('admin')->user()->id)->where('is_vendor','1')->first();
            $getUserWallet = Payout::where('user_id',Auth::guard('admin')->user()->id)->where('is_vendor','1')->get();
            return view('admin.payout.payout',compact('getUserWallet','getWallet'));
        }
        else if(Auth::guard('admin')->user() != null && Auth::guard('admin')->user()->type == 'superadmin'){
            $getWallet = UserWallet::where('user_id',Auth::guard('admin')->user()->id)->where('is_vendor','1')->where('is_admin','1')->first();
            $getUserWallet = Payout::orderBy('created_at','DESC')->get();
            foreach($getUserWallet as $payout){
                if($payout->is_vendor == '1'){
                    $payout->userName = Vendor::where('id',$payout->user_id)->first()['name'];
                }
                else{
                    $payout->userName = User::where('id',$payout->user_id)->first()['name'];
                }
            }
            return view('admin.payout.admin_payout',compact('getUserWallet','getWallet'));
        }
        else{
            $getWallet = UserWallet::where('user_id',Auth::user()->id)->where('is_vendor','0')->first();
            $getUserWallet = Payout::where('user_id',Auth::user()->id)->where('is_vendor','0')->get();
             return view('front.users.products.payout',compact('getUserWallet','getWallet'));
        }
        
    }
    public function savePayout(Request $request){
       Session::put('page', 'payout');
       if ( $request->amount == NULL || $request->amount == "") {
            return redirect()->back()->with('error_message','Payout amount can not be null');
       }
            $newPayout = new Payout();
            $newPayout->amount =  $request->amount;
            $newPayout->user_id =  (Auth::guard('admin')->user() != null && Auth::guard('admin')->user()->type == 'vendor') ? Auth::guard('admin')->user()->id : Auth::user()->id;
            $newPayout->is_vendor =   (Auth::guard('admin')->user() != null && Auth::guard('admin')->user()->type == 'vendor') ? '1' : '0';
            $newPayout->status =  'Pending';
            $newPayout->save();
        return redirect()->back()->with('success_message','Payout Generated Successfully!');
    }
    public function updatePayout(Request $request){
        $getPayout = Payout::find($request->payout_id);
        $getPayout->status = $request->status;
        $getPayout->save();

        //deduct amount from the admin
        if($request->status == 'Processed'){
            if($getPayout->is_vendor == '1'){
                //vendor working
                $getWallet = UserWallet::where('user_id',$getPayout->user_id)->where('is_vendor','1')->first();
                $getWallet->amount = $getWallet->amount -  $getPayout->amount;
                $getWallet->save();
            }
            else{
                //user working
                $getWallet = UserWallet::where('user_id',$getPayout->user_id)->where('is_vendor','0')->first();
                $getWallet->amount = $getWallet->amount -  $getPayout->amount;
                $getWallet->save();        
            }
            //update admin account
            $getAdminWallet = UserWallet::where('user_id',Auth::guard('admin')->user()->id)->where('is_vendor','1')->where('is_admin','1')->first();
            $getAdminWallet->amount = $getAdminWallet->amount - $getPayout->amount;
            $getAdminWallet->save();
        }
        return redirect()->back()->with('success_message', 'Payout request has been set to '. $request->status);

    }
}
