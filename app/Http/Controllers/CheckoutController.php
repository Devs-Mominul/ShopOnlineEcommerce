<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Billing;
use App\Models\card;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    function checkout(){
        $countries=Country::all();


        $carts=card::where('customer_id',Auth::guard('customer')->id())->get();
        return view('frontend.checkout',[
            'carts'=>$carts,
            'countries'=>$countries,
        ]);
    }
    function getsCity(Request $request){
        $cities=City::where('country_id',$request->country_id)->get();
        $str='<option >City*</option>';

        foreach($cities as $city){
            $str.='<option value="'.$city->id.'">'.$city->name.'</option>';

        }
        echo $str;
    }
    function order_store(Request $request){
        if($request->payment==1){
            $order_id='#'.uniqid().'-'.Carbon::now()->format('Y-m-d');
            Order::insert([
                'order_id'=>$order_id,
                'customer_id'=>Auth::guard('customer')->id(),
                'discount'=>$request->discount,
                'charge'=>$request->charge,
                'payment_method'=>$request->payment,
                'sub_total'=>$request->sub_total,
                'total'=>$request->total+$request->charge,
                'created_at'=>Carbon::now(),






            ]);


            Billing::insert([
                'order_id'=>$order_id,
                'customer_id'=>Auth::guard('customer')->id(),
                'fname'=>$request->fname,
                'lname'=>$request->lname,
                'country_id'=>$request->country,
                'city_id'=>$request->city,
                'zip'=>$request->zip,
                'company'=>$request->company,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'message'=>$request->message,
                'created_at'=>Carbon::now(),



            ]);
            if($request->ship_check==1){
                Shipping::insert([
                    'order_id'=>$order_id,
                    'customer_id'=>Auth::guard('customer')->id(),
                    'ship_fname'=>$request->ship_fname,
                    'ship_lname'=>$request->ship_lname,
                    'ship_country_id'=>$request->ship_country,
                    'ship_city_id'=>$request->ship_city,
                    'ship_zip'=>$request->ship_zip,
                    'ship_company'=>$request->ship_company,
                    'ship_email'=>$request->ship_email,
                    'ship_phone'=>$request->ship_phone,
                    'ship_address'=>$request->ship_adress,
                    'ship_message'=>$request->ship_message,
                    'created_at'=>Carbon::now(),



                ]);
            }
            else{
                Billing::insert([
                    'order_id'=>$order_id,
                    'customer_id'=>Auth::guard('customer')->id(),
                    'fname'=>$request->fname,
                    'lname'=>$request->lname,
                    'country_id'=>$request->country,
                    'city_id'=>$request->city,
                    'zip'=>$request->zip,
                    'company'=>$request->company,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    'address'=>$request->address,
                    'message'=>$request->message,
                    'created_at'=>Carbon::now(),



                ]);
            }
            $carts=card::where('customer_id',Auth::guard('customer')->id())->get();
            foreach($carts as $cart){
                OrderProduct::insert([
                    'order_id'=>$order_id,
                    'customer_id'=>Auth::guard('customer')->id(),
                    'product_id'=>$cart->product_id,
                    'price'=>$cart->rel_to_product->after_discount,
                    'color_id'=>$cart->color_id,
                    'size_id'=>$cart->size_id,
                    'quantity'=>$cart->quantity,
                    'created_at'=>Carbon::now(),


                ]);
                Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity',$cart->quantity);
                card::find($cart->id)->delete();


            }
            Mail::to($request->email)->send(new InvoiceMail($order_id));

            return redirect()->route('order.success');




        }
        elseif($request->payment==2){

        }
        elseif($request->payment==3){

        }

    }
    function order_success(){
        return view('frontend.success');
    }
}
