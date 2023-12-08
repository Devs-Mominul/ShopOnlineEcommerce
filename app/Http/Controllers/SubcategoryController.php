<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    function Subcategory(){
        $categories=Category::all();

        return view('category.subcategory',[
            'categories'=>$categories,

        ]);
    }
    function Subcategory_store(Request $request){
        Subcategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,

        ]);
        return back();

    }
    function Subcategory_edit($id){
        $categories=Category::all();
        $subcategory=Subcategory::find($id);
        return view('category.subcategory_edit',[
            'categories'=>$categories,
            'subcategory'=>$subcategory
        ]);
    }
    function Subcategory_edit_store(Request $request,$id){

        Subcategory::find($id)->update([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,

        ]);

    }
    function Subcategory_delete($id){
        Subcategory::find($id)->delete();
    }

}
