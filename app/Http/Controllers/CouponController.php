<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    function coupon(){
        $coupons=Coupon::all();
        return view('coupon.coupon',[
            'coupons'=>$coupons,
        ]);
    }
    function coupon_store(Request $request){
        Coupon::insert([
            'coupon_name'=>$request->coupon_name,
            'type'=>$request->type,
            'amount'=>$request->amount,
            'limit'=>$request->limit,
            'validity'=>$request->validity,
            'created_at'=>Carbon::now(),

        ]);
        return back();
    }
    function ChangeCoupon(Request $request){

        Coupon::find($request->coupon_id)->update([
            'status'=>$request->status
        ]);
    }
    function coupon_remove($id){
        Coupon::find($id)->delete();
    }
}
