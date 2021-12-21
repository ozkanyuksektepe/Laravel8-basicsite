<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    public function ChangePassword(){
       return view('admin.body.change_password');
    }
    public function UpdatePassword(Request $request){
        $validateData = $request->validate([
           'oldpassword'=> 'required',
            'password'=> 'required|confirmed'
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
           $user = User::find(Auth::id());
           $user->password = Hash::make($request->password);
           $user->save();
           Auth::logout();
           return Redirect()->route('login')->with('success','Password is Change Successfully');
        }else{
            return Redirect()->back()->with('error','Current Password is Invalid');
        }
    }
}
