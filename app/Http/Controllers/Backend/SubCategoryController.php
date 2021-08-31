<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view',compact('subcategory','categories'));
    } //end method

    public function SubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_hin' => 'required',


        ],[
            'category_id.required' => 'please select any option',
            'subcategory_name_en.required' => 'Input subcategory English Name',
            'subcategory_name_hin.required' => 'Input subcategory Hindi Name',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
            'subcategory_slug_hin' => str_replace(' ', '-',$request->subcategory_name_hin),

        ]);

        $notification = array(
            'message' =>  'SubCategory inserted Sucessyfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } //end method

    public function SubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit',compact('subcategory','categories'));
    } //end method

    public function SubCategoryUpdate(Request $request){

        $subcat_id = $request->id;

        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
            'subcategory_slug_hin' => str_replace(' ', '-',$request->subcategory_name_hin),

        ]);

        $notification = array(
            'message' =>  'SubCategory updated Sucessfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('all.subcategory')->with($notification);
    } //end method

    public function SubCategoryDelete($id){

        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' =>  'Brand delete Sucessyfuly',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    } //end method

    ///////////////////////////////For sub sub category

    public function SubSubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view',compact('subsubcategory','categories'));
    } //end method

    //TO GET SUB CAT
    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    } //end method

    //TO GET sub-sub CAT
    public function GetSubSubCategory($subcategory_id){
        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
    } //end method

    public function SubSubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_hin' => 'required',


        ],[
            'category_id.required' => 'please select any option',
            'subcategory_id.required' => 'please select any option',
            'subsubcategory_name_en.required' => 'Input subsubcategory English Name',
            'subsubcategory_name_hin.required' => 'Input subsubcategory Hindi Name',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => str_replace(' ', '-',$request->subsubcategory_name_hin),

        ]);

        $notification = array(
            'message' =>  'SubSubCategory inserted Sucessyfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } //end method

    public function SubSubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit',compact('categories','subcategories','subsubcategories'));
    } //end method

    public function SubSubCategoryUpdate(Request $request){
        $subsubcat_id = $request->id;
        SubSubCategory::findOrFail($subsubcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => str_replace(' ', '-',$request->subsubcategory_name_hin),

        ]);

        $notification = array(
            'message' =>  'SubSubCategory updated Sucessyfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('all.subsubcategory')->with($notification);
    } //end method

    public function SubSubCategoryDelete($id){
        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' =>  'SubSub delete Sucessyfuly',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    } //end method

}
