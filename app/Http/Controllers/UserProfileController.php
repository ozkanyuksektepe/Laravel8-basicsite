<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserProfileController extends Controller
{
    public function ProfileUpdate(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }
    public function UserProfileUpdate(Request $request){
       $user = User::find(Auth::user()->id);
       if($user){
         $user->name = $request['name'];
         $user->email = $request['email'];
         $user->save();
         return Redirect()->back()->with('success','User Profile is Updated Successfully');
       }else{
         return Redirect()->back();
       }
    }
}
