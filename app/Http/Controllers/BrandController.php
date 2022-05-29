<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class BrandController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function AllBrand() {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request) {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|image'
        ],
        [
            'brand_name.required' => 'Please input brand name',
            'brand_image.min' => 'Brand less then 255 characters',
        ]);

        $brand_image = $request->file('brand_image');
        
        // $destinationPath = 'image/brand';
        // $profileImage = date('YmdHis') . "." . $brand_image->getClientOriginalExtension();
        // $brand_image->move($destinationPath, $profileImage);
        // $input['image'] = "$profileImage";

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location, $img_name);

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Brand is successfully added',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);

    }

    public function EditBrand($id) {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function UpdateBrand(Request $request, $id) {
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        ],
        [
            'brand_name.required' => 'Please input brand name',
            'brand_image.min' => 'Brand less then 255 characters',
        ]);

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');
        
        // $destinationPath = 'image/brand';
        // $profileImage = date('YmdHis') . "." . $brand_image->getClientOriginalExtension();
        // $brand_image->move($destinationPath, $profileImage);
        // $input['image'] = "$profileImage";
        
        if($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Brand is successfully updated',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Brand is successfully updated',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);
        }
        
    }

    public function DeleteBrand($id) {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand successfully deleted');
    }

    // This is for Multipics All Methods

    public function AllMultipics() {
        $images = Multipic::all();
        return view('admin.multipics.index', compact('images'));
    }

    public function StoreMultipics(Request $request) {

        $images = $request->file('image'); // Mengambil data yang dipost dari web

        foreach($images as $multi_pics) { // Untuk posting beberapa file gambar

            $name_gen = hexdec(uniqid()).'.'.$multi_pics->getClientOriginalExtension(); // Untuk mengkonversi nama file gambar
            Image::make($multi_pics)->resize(300,200)->save('image/multipics/'.$name_gen); // Untuk menyimpan gambar ke folder directory

            $last_img = 'image/multipics/'.$name_gen; // Sebagai variabel gambar yang akan disimpan ke database

            Multipic::insert([ // Untuk menyimpan data yang dipost ke database
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }
        // End of Foreach
        return Redirect()->back()->with('success', 'Multiple pics successfully added');

    }

    public function Logout() {
        Auth::logout();
        return Redirect()->route('login')->with('success', 'User has been logout');
    }
}