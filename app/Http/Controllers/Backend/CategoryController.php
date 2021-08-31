<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryView(){
        $category = Category::latest()->get();
        return view('backend.category.category_view',compact('category'));
    } //end method
    public function CategoryStore(Request $request){
        $request->validate([
            'category_name_en' => 'required',
            'category_name_hin' => 'required',
            'category_icon' => 'required',

        ],[
            'category_name_en.required' => 'Input category English Name',
            'category_name_hin.required' => 'Input category Hindi Name',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_hin' => $request->category_name_hin,
            'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
            'category_slug_hin' => str_replace(' ', '-',$request->category_name_hin),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' =>  'Category inserted Sucessyfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } //end method
    public function CategoryEdit($id){
        $category = Category::findOrfail($id);  //specific id dhore tar data $brand e nilam
        return view('backend.category.category_edit',compact('category'));
    } //end method
    public function CategoryUpdate(Request $request){
        $cat_id = $request->id; //jei id te edit korlam oitar just id ta ei variable e aca

        Category::findOrFail($cat_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_hin' => $request->category_name_hin,
            'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
            'category_slug_hin' => str_replace(' ', '-',$request->category_name_hin),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' =>  'Category updated Sucessfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('all.category')->with($notification);

    } //end method
    public function CategoryDelete($id){
        $category = Category::findOrFail($id);


        Category::findOrFail($id)->delete();
        $notification = array(
            'message' =>  'Brand delete Sucessyfuly',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    } //end method
}
