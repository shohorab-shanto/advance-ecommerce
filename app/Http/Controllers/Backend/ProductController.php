<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

use App\Models\Product;
use Carbon\Carbon;
use Image;
use App\Models\MultiImg;

class ProductController extends Controller
{
    public function AddProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add',compact('categories','brands'));
    }

    public function StoreProduct(Request $request){

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;

        $product_id = Product::insertGetId([
            'brand_id' =>$request->brand_id,
            'category_id' =>$request->category_id,
            'subcategory_id' =>$request->subcategory_id,
            'subsubcategory_id' =>$request->subsubcategory_id,
            'product_name_en' =>$request->product_name_en,
            'product_name_hin' =>$request->product_name_hin,
            'product_slug_en' =>strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_hin' =>str_replace(' ','-',$request->product_name_hin),
            'product_code' =>$request->product_code,

            'product_qty' =>$request->product_qty,
            'product_tags_en' =>$request->product_tags_en,
            'product_tags_hin' =>$request->product_tags_hin,
            'product_size_en' =>$request->product_size_en,
            'product_size_hin' =>$request->product_size_hin,
            'product_color_en' =>$request->product_color_en,
            'product_color_hin' =>$request->product_color_hin,

            'selling_price' =>$request->selling_price,
            'discount_price' =>$request->discount_price,
            'short_descp_en' =>$request->short_descp_en,
            'short_descp_hin' =>$request->short_descp_hin,
            'long_descp_en' =>$request->long_descp_en,
            'long_descp_hin' =>$request->long_descp_hin,

            'hot_deals' =>$request->hot_deals,
            'featured' =>$request->featured,
            'special_offer' =>$request->special_offer,
            'special_deals' =>$request->special_deals,

            'product_thambnail' =>$save_url,
            'status' => 1,
            'created_at' =>Carbon::now(),

        ]);

        // multi Img upload start

        $images = $request->file('multi_img');
        foreach ($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
        $uploadPath = 'upload/products/multi-image/'.$make_name;

        MultiImg::insert([
            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' =>Carbon::now(),
        ]);

        }// multi Img upload end and foreach


        $notification = array(
            'message' =>  'Product inserted Sucessyfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('manage-product')->with($notification);

    } //end method

    public function ManageProduct(){

        $products = Product::latest()->get();
        return view('backend.product.product_view',compact('products'));

    } //end method

    public function EditProduct($id){

        $multiImgs = MultiImg::where('product_id',$id)->get();

        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit',compact('categories','subcategories','subsubcategories','brands','products','multiImgs'));
    }

    public function ProductDataUpdate(Request $request){

        $product_id = $request->id; //edit form thke jei id te edit korci seta akhne hidden form er maddhome pass korci and variable $product_id er vitor rakci

           Product::findOrFail($product_id)->update([
            'brand_id' =>$request->brand_id,
            'category_id' =>$request->category_id,
            'subcategory_id' =>$request->subcategory_id,
            'subsubcategory_id' =>$request->subsubcategory_id,
            'product_name_en' =>$request->product_name_en,
            'product_name_hin' =>$request->product_name_hin,
            'product_slug_en' =>strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_hin' =>str_replace(' ','-',$request->product_name_hin),
            'product_code' =>$request->product_code,

            'product_qty' =>$request->product_qty,
            'product_tags_en' =>$request->product_tags_en,
            'product_tags_hin' =>$request->product_tags_hin,
            'product_size_en' =>$request->product_size_en,
            'product_size_hin' =>$request->product_size_hin,
            'product_color_en' =>$request->product_color_en,
            'product_color_hin' =>$request->product_color_hin,

            'selling_price' =>$request->selling_price,
            'discount_price' =>$request->discount_price,
            'short_descp_en' =>$request->short_descp_en,
            'short_descp_hin' =>$request->short_descp_hin,
            'long_descp_en' =>$request->long_descp_en,
            'long_descp_hin' =>$request->long_descp_hin,

            'hot_deals' =>$request->hot_deals,
            'featured' =>$request->featured,
            'special_offer' =>$request->special_offer,
            'special_deals' =>$request->special_deals,

            // 'product_thambnail' =>$save_url,
            'status' => 1,
            'created_at' =>Carbon::now(),

        ]);

        $notification = array(
            'message' =>  'Product inserted Sucessyfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('manage-product')->with($notification);
    } //end method

    // multiple image Update
    public function MultiImageUpdate(Request $request){

        $imgs = $request->multi_img; //requested id data variable e rakhlm

        foreach ($imgs as $id => $img){ //multi_img field er id ke anlm
        $imgDel = MultiImg::findOrFail($id); //multi img table er id ke dhorlm jekhne update korbo
        unlink($imgDel->photo_name); //ager pic ke unlink korlam
        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();//uniq id generate korlam
        Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name); //img resize kore path e rekhe dilam
        $uploadPath = 'upload/products/multi-image/'.$make_name; //path ta ke akta variable er vitor niea save korlam

        MultiImg::where('id',$id)->update([
            'photo_name' => $uploadPath,
            'updated_at' => Carbon::now(),
        ]);

        }//end for each
        $notification = array(
            'message' =>  'Image Updated Sucessfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end method

    // product main thambnail update
    public function ThambnailImageUpdate(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        unlink($oldImage);

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;

        Product::findOrFail($pro_id)->update([
            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' =>  'Image Thambnail Updated Sucessfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }//end method

    public function MultiImageDelete($id){

        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name); //jei field unlink korbe
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' =>  'Product Image Delete Sucessfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end method

    public function ProductInactive($id){
        Product::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' =>  'Product Inactive',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } //end method

    public function ProductActive($id){
        Product::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' =>  'Product Active',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method

    public function ProductDelete($id){

        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id',$id)->get(); //product_id match with our $id
        foreach ($images as $img){
            unlink('$img->photo_name');
            MultiImg::where('product_id',$id)->delete();
        }

        $notification = array(
            'message' =>  'Product Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }//end method


}
