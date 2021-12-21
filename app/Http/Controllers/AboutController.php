<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function HomeAbout(){
        $home_abouts = HomeAbout::latest()->get();
        return view('admin.about.index', compact('home_abouts'));
    }
    public function AddAbout(){
        return view('admin.about.create');
    }
    public function StoreAbout(Request $request){
        HomeAbout::insert([
            'title' => $request->title,
            'short_desc'=> $request->short_desc,
            'long_desc'=> $request->long_desc,
            'created_at'=> Carbon::now(),
        ]);
        return Redirect()->route('home.about')->with('success','About Inserted Successfull');
    }
    public function EditAbout($id){
        $home_abouts = HomeAbout::find($id);
        return view('admin.about.edit', compact('home_abouts'));
    }
    public function UpdateAbout(Request $request, $id){
        $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_desc'=> $request->short_desc,
            'long_desc'=> $request->long_desc,
            'created_at'=> Carbon::now(),
        ]);
        return Redirect()->route('home.about')->with('success','About Updated Successfull');
    }
    public function DeleteAbout($id){
        $delete = HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success','Deleted Successfull');
    }
}
