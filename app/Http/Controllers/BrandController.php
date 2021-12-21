<?php

namespace App\Http\Controllers;

use App\Models\Multipicture;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Image;
use Illuminate\Support\Facades\Auth;



class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function AllBrand(){
       $brands = Brand::latest()->paginate(5);
       return view('admin.brand.index', compact('brands'));
    }
    public function StoreBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:3',
            'brand_image' => 'required|mimes:jpg.jpeg,png',
        ],[
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min' => 'Brand Longer then 3 Characters',
        ]);
        $brand_image = $request->file('brand_image');

        //$name_gen = hexdec(uniqid());
        //$img_ext = strtolower($brand_image->getClientOriginalExtension());
        //$img_name = $name_gen.'.'.$img_ext;
        //$up_location = 'image/brand/';
        //$last_img = $up_location.$img_name;
        //$brand_image->move($up_location,$img_name);

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
           'brand_name' => $request->brand_name,
            'brand_image'=> $last_img,
            'created_at'=> Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }
    public function Update(Request $request, $id){
        $validated = $request->validate([
            'brand_name' => 'required|min:3',
        ],[
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min' => 'Brand Longer then 3 Characters',
        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image'=> $last_img,
                'created_at'=> Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'success',
            );
            return Redirect()->back()->with($notification);
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at'=> Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'success',
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function Delete($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }
    public function Multipicture(){
        $images = Multipicture::all();
        return view('admin.multipicture.index', compact('images'));
    }
    public function StoreImage(Request $request){
        $image = $request->file('image');

        foreach($image as $multi_picture) {

            $name_gen = hexdec(uniqid()).'.'.$multi_picture->getClientOriginalExtension();
            Image::make($multi_picture)->resize(300,300)->save('image/multi/'.$name_gen);

            $last_img = 'image/multi/'.$name_gen;

            Multipicture::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Brand Inserted Successfull',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function Logout(){
       Auth::logout();
        $notification = array(
            'message' => 'User Logout',
            'alert-type' => 'success',
        );
        return Redirect()->route('login')->with($notification);
    }
}
