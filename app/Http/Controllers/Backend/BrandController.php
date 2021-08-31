<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function BrandView(){

        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view',compact('brands'));

    } //end method

    public function BrandStore(Request $request){

        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_hin' => 'required',
            'brand_image' => 'required',

        ],[
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_name_hin.required' => 'Input Brand Hindi Name',
        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_hin' => $request->brand_name_hin,
            'brand_slug_en' => strtolower(str_replace(' ', '-',$request->brand_name_en)),
            'brand_slug_hin' => str_replace(' ', '-',$request->brand_name_hin),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' =>  'Brand inserted Sucessyfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } //end method
    public function BrandEdit($id){
        $brand = Brand::findOrfail($id);  //specific id dhore tar data $brand e nilam
        return view('backend.brand.brand_edit',compact('brand'));
    } //end method
    public function BrandUpdate(Request $request){
        $brand_id = $request->id; //jei id te edit korlam oitar just id ta ei variable e aca
        $old_img = $request->old_image; //existing image nilam

        if($request->file('brand_image')){
        unlink($old_img);
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brand::findOrFail($brand_id)->update([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_hin' => $request->brand_name_hin,
            'brand_slug_en' => strtolower(str_replace(' ', '-',$request->brand_name_en)),
            'brand_slug_hin' => str_replace(' ', '-',$request->brand_name_hin),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' =>  'Brand updated Sucessyfuly',
            'alert-type' => 'info'
        );
        return redirect()->route('all.brand')->with($notification);

        }else{
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_hin' => $request->brand_name_hin,
                'brand_slug_en' => strtolower(str_replace(' ', '-',$request->brand_name_en)),
                'brand_slug_hin' => str_replace(' ', '-',$request->brand_name_hin),

            ]);

            $notification = array(
                'message' =>  'Brand updated Sucessyfuly',
                'alert-type' => 'info'
            );
            return redirect()->route('all.brand')->with($notification);

        }
    } //end method
    public function BrandDelete($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img); //folder theke img delete korar jonno

        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' =>  'Brand delete Sucessyfuly',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    } //end method
}
