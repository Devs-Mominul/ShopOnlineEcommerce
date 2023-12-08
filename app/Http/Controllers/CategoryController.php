<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function Category(){
        $categories=Category::all();
        return view('category.category',[
            'categories'=>$categories
        ]);

    }
    function Category_store(Request $request){
        $photo=$request->category_img;
        $extension=$photo->extension();
        $file_name=Str::lower(str_replace(' ','-',$request->category_name)).'-'.random_int(100000,900000).'.'.$extension;
        $image = Image::make($photo)->save(public_path('uploads/category/'.$file_name));
       Category::create([
        'category_name'=>$request->category_name,
        'category_img'=>$file_name,


       ]);
       return back();

    }
    function Category_edit($id){
        $category_info=Category::find($id);
        return view('category.category_edit',[
            'category_info'=>$category_info,
        ]);
    }
    function category_edit_store(Request $request){
        $category=Category::find($request->category_id);
        if($request->category_img==null){
            Category::find($request->category_id)->update([
                'category_name'=>$request->category_name,

            ]);


        }
        else{
            $current_img=public_path('uploads/category/'.$category->category_img);
            unlink($current_img);

            $photo=$request->category_img;
            $extension=$photo->extension();
            $file_name=Str::lower(str_replace(' ','-',$request->category_name)).'-'.random_int(100000,900000).'.'.$extension;
           $image = Image::make($photo)->save(public_path('uploads/category/'.$file_name));
            Category::find($request->category_id)->update([
            'category_name'=>$request->category_name,
            'category_img'=>$file_name,
        ]);

        }
    }
}
