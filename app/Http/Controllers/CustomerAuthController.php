<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;

use function Ramsey\Uuid\v1;

class CustomerAuthController extends Controller
{
function customer_register(){
    return view('customer.register');
}
function customer_store(Request $request){
    Customer::insert([
        'fname'=>$request->fname,
        'lname'=>$request->lname,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),



    ]);
    return back();
}
function customer_login(){
    return view('customer.login');
}
function customer_login_store(Request $request){
    if(Customer::where('email',$request->email)->exists()){
        if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('index');
         }
         else{
             return back();

         }

    }
    else{
       return back();
    }
}
function customer_profile(){
    $profiles=Customer::all();
    return view('frontend.profile',[
        'profiles'=>$profiles,
    ]);
}
function customer_logout(){
    Auth::guard('customer')->logout();
    return redirect('/');

}
function customer_update(Request $request){
   if($request->password==''){
    if($request->photo==''){
        Customer::find(Auth::guard('customer')->id())->update([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'country'=>$request->country,
            'zip'=>$request->zip,
            'address'=>$request->address,


        ]);
    }
    else{
        $image=$request->photo;
        $extension=$image->extension();
        $file_name= Auth::guard('customer')->id().'.'.$extension;
        $photo=Image::make($image)->save(public_path('uploads/profile/'.$file_name));
        Customer::find(Auth::guard('customer')->id())->update([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'country'=>$request->country,
            'zip'=>$request->zip,
            'address'=>$request->address,
            'photo'=>$file_name,


        ]);




       }

   }
   else{
    if($request->photo==''){
        Customer::find(Auth::guard('customer')->id())->update([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'phone'=>$request->phone,
            'country'=>$request->country,
            'zip'=>$request->zip,
            'address'=>$request->address,



        ]);

    }
    else{
        $image=$request->photo;
        $extension=$image->extension();
        $file_name= Auth::guard('customer')->id().'.'.$extension;
        $photo=Image::make($image)->save(public_path('uploads/profile/'.$file_name));
        Customer::find(Auth::guard('customer')->id())->update([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'phone'=>$request->phone,
            'country'=>$request->country,
            'zip'=>$request->zip,
            'address'=>$request->address,
            'photo'=>$file_name,


        ]);
    }


   }

}
function orderList(){
    $myorders=Order::where('customer_id',Auth::guard('customer')->id())->get();
    return view('frontend.order_list',[
        'myorders'=>$myorders,
    ]);
}
function orderDownload($id){
    $order_info=Order::find($id);
    $pdf = PDF::loadView('customer.download',[
        'order_info'=>$order_info,
    ]);
    return $pdf->download('pdfview.pdf');

}
}
