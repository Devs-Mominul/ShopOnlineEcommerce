<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function products_index(){
        $categories=Category::all();
        $subcategories=Subcategory::all();
        $brands=Brand::all();

       return view('product.index',[
        'categories'=>$categories,
        'subcategories'=>$subcategories,
        'brands'=>$brands
       ]);
    }
    function getsubcategory(Request $request){
        $str='<option value="">select subcategory</option>';
        $subcategories=Subcategory::where('category_id',$request->category_id)->get();
        foreach($subcategories as $subcategory){
            $str.='<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str;


    }
    function product_store(Request $request){

        $after_implode=implode(' ',$request->tags);
        $preview=$request->preview;
            $extension=$preview->extension();
            $file_name=Str::lower(str_replace(' ','-',$request->product_name)).'-'.random_int(100000,900000).'.'.$extension;
            $image = Image::make($preview)->save(public_path('uploads/product/preview/'.$file_name));
            $product_id=Product::insertGetId([
                'category_id'=>$request->category,
                'subcategory_id'=>$request->subcategory,
                'brand_id'=>$request->brand,
                'price'=>$request->price,
                'product_name'=>$request->product_name,
                'discount'=>$request->discount,
                'after_discount'=>$request->price - ($request->price*$request->discount/100),
                'tags'=>$after_implode,
                'short_desp'=>$request->short_desp,
                'long_desp'=>$request->long_desp,
                'addi_info'=>$request->addi_info,
                'preview'=>$file_name,
                'slug'=>Str::lower(str_replace(' ','-',$request->product_name)).'-'.random_int(1000000,9000000),

            ]);
            $gallery=$request->gallery;

            foreach($gallery as $gal){


                $extension=$gal->extension();
                $file_name=Str::lower(str_replace(' ','-',$request->product_name)).'-'.random_int(100000,900000).'.'.$extension;
                $image = Image::make($gallery)->save(public_path('uploads/product/gallery/'.$file_name));
                ProductGallery::insert([
                    'product_id'=>$product_id,
                    'gallery'=>$file_name,
                ]);
            }


    }
    function product_list(){
        $product=Product::all();
        return view('product.product_list',[
            'product'=>$product,
        ]);
    }
    function product_remove($id){
        $product=Product::find($id);
        $preview=public_path('uploads/product/preview/'.$product->preview);
        unlink($preview);

        $gallery=ProductGallery::where('product_id', $id)->get();
        foreach($gallery as $gal){
            $gal_img=public_path('uploads/product/gallery/'.$gal->gallery);
            unlink($gal_img);
            ProductGallery::find($gal->id)->delete();
        }
        Product::find($id)->delete();
        return back();
    }
    function product_show($id){
        $product=Product::find($id);
        $gallery=ProductGallery::where('product_id',$id)->get();
        return view('product.product_show',[
            'product'=>$product,
            'gallery'=>$gallery,
        ]);
    }
    function changestatus(Request $request){
       Product::find(  $request->product_id)->update([
        'status'=>$request->status

       ]);
    }
}
