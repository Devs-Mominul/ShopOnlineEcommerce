<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function Photo_update(Request $request){
      if(Auth::user()->photo==null){
        $photo=$request->photo;
        $extension=$photo->extension();
        $file_name=Auth::id().'.'.$extension;
        $image = Image::make($photo)->resize(300, 200)->save(public_path('uploads/user/'.$file_name));
        User::find(Auth::id())->update([
            'photo'=>$file_name,

        ]);

      }
      else{
        $current_image=public_path('uploads/user/'.Auth::user()->photo);
        unlink($current_image);

        $photo=$request->photo;
        $extension=$photo->extension();
        $file_name=Auth::id().'.'.$extension;
        $image = Image::make($photo)->resize(300, 200)->save(public_path('uploads/user/'.$file_name));
        User::find(Auth::id())->update([
            'photo'=>$file_name,

        ]);

      }


    }
    public function  User_list(){
        $user_list=User::all();
        return view('user.user',[
            'user_list'=>$user_list,
        ]);
    }
    public function  User_remove($id){
        User::find($id)->delete();


    }
}
