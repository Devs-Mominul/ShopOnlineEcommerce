<?php

namespace App\Http\Controllers;

use App\Models\Brand as ModelsBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Brand extends Controller
{
    function brands(){
      $brands=ModelsBrand::all();
        return view('brand.brand',[
            'brands'=>$brands
        ]);
    }
    function brands_store(Request $request){
        $logo=$request->brand_logo;
        $extension=$logo->extension();
        $file_name=Str::lower(str_replace(' ','-',$request->brand_name)).'-'.random_int(100000,900000).'.'.$extension;
        $image = Image::make($logo)->save(public_path('uploads/brand/'.$file_name));
        ModelsBrand::insert([
            'brand_name'=>$request->brand_name,
            'brand_logo'=>$file_name

        ]);
    }
    function brands_edit($id){
        $brands=ModelsBrand::find($id);
        return view('brand.brand_edit',[
            'brands'=>$brands,
        ]);
    }
    function brands_edit_store(Request $request,$id){
        $brands=ModelsBrand::find($id);
        if($request->brand_logo==''){
            ModelsBrand::find($id)->update([
                'brand_name'=>$request->brand_name,

            ]);

        }
        else{
            $current_img=public_path('uploads/brand/'.$brands->brand_logo);
            unlink($current_img);
            $logo=$request->brand_logo;
            $extension=$logo->extension();
            $file_name=Str::lower(str_replace(' ','-',$request->brand_name)).'-'.random_int(100000,900000).'.'.$extension;
            $image = Image::make($logo)->save(public_path('uploads/brand/'.$file_name));


            ModelsBrand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'brand_logo'=>$file_name,

            ]);

        }


    }
    function brands_delete($id){
        ModelsBrand::find($id)->delete();
    }
}
