<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function varition(){
        $colors=Color::all();
        $categories=Category::all();
        return view('product.varition',[
            'colors'=>$colors,
            'categories'=>$categories
        ]);
    }
    function varition_post(Request $request){
        Color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,

        ]);
        return back();
    }
    function size_post(Request $request){
        Size::insert([
            'size_name'=>$request->size_name,
            'category_id'=>$request->category_id,


        ]);
        return back();
    }
    function inventory($id){
        $product=Product::find($id);
        $color=Color::all();
        $inventory=Inventory::where('product_id',$id)->get();

        return view('product.inventory',[
            'product'=>$product,
            'color'=>$color,
            'inventory'=>$inventory,
        ]);
    }
    function inventory_store(Request $request,$id){
        Inventory::insert([
            'product_id'=>$id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,

        ]);
        return back();
    }
}
