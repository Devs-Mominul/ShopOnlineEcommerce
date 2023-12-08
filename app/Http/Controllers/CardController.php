<?php

namespace App\Http\Controllers;

use App\Models\card;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    function card_store(Request $request){
       card::insert([
        'customer_id'=>Auth::guard('customer')->id(),
        'product_id'=>$request->product_id,
        'color_id'=>$request->color_id,
        'size_id'=>$request->size_id,
        'quantity'=>$request->quantity,

       ]);
       return back()->with('card_success','Card Added Successfully');
    }
    function card_show(Request $request){
        $coupon=$request->coupon;
        $msg='';
        $type='';
        $discount=0;
        if(isset($coupon)){
            if(Coupon::where('coupon_name',$coupon)->exists()){
                if(Carbon::now()->format('Y-m-d') >= Coupon::where('coupon_name',$coupon)->first()->validity){
                    if(Coupon::where('coupon_name',$coupon)->first()->limit !=0){
                        $type=Coupon::where('coupon_name',$coupon)->first()->type;
                        $discount=Coupon::where('coupon_name',$coupon)->first()->amount;

                    }
                    else{
                        $msg='coupon code limit exists';

                    }


                }
                else{
                    $msg='coupon code expored!';
                    $discount=0;


                }


            }
            else{
                $msg='Invalid Coupon Code!';
                $discount=0;

            }
        }





        $card=card::where('customer_id',Auth::guard('customer')->id())->get();
        $products = Product::latest()->paginate(8);
        return view('frontend.card',[
            'card'=>$card,
            'products'=>$products,
            'msg'=>$msg,
            'discount'=>$discount,
            'type'=>$type,
        ]);
    }
    function card_remove($id){
        card::find($id)->delete();
    }
    function card_update(Request $request){
        foreach($request->quantity as $cart_id=>$quantity){
            card::find($cart_id)->update([
                'quantity'=>$quantity,
            ]);
        }


    }
}
