<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;

class FrontendController extends Controller
{
    function index(){
        $categories=Category::all();
        $product=Product::where('status',1)->get();
        return view('frontend.index',[
            'categories'=>$categories,
            'product'=>$product,
        ]);
    }
    function product_category($id){
        $products=Product::where('category_id',$id)->get();
        $productsubcategory=Product::where('category_id',$id)->get();
        return view('product.product_category',[
            'products'=>$products
        ]);
    }
    function product_subcategory($id){
        $products_subcategory=Product::where('subcategory_id',$id)->get();
        $productsubcategory=Product::where('category_id',$id)->get();
        return view('product.product_subcategory',[
            'products_subcategory'=>$products_subcategory
        ]);
    }
    function product_details($slug){
        $product_id=Product::where('slug',$slug)->first()->id;
        $product_details=Product::find($product_id);
        $available_color=Inventory::where('product_id',$product_id)->groupBy('color_id')->selectRaw('count(*) as total,color_id')->get();
        $available_size=Inventory::where('product_id',$product_id)->groupBy('size_id')->selectRaw('count(*) as total,size_id')->get();


        return view('frontend.product_details',[
            'product_details'=>$product_details,
            'available_color'=>$available_color,
            'available_size'=>$available_size,
        ]);
    }

}
