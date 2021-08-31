<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();//jeikhne status==1 sei id nibe desc order e
        $products = Product::where('status',1)->orderBy('id','DESC')->get();//jeikhne status==1 sei id nibe desc order e
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get(); //featured jodi 1 hoy tahle data nibe
        $hotdeals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();

        $skip_category_0 = Category::skip(0)->first(); //cat er index 0 er cat select korbe 0 mane 1st cat
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();//skip e jei cat id ,product er cat id er sathe mille tar por oi cat id related product niea aste hobe

        $skip_category_1 = Category::skip(1)->first(); //cat er index 1 er cat select korbe 1 mane 2nd cat
        $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();

        $skip_brand_2 = Brand::skip(4)->first(); //brand er index 2 er brand select korbe 2 mane 3rd brand
        $skip_brand_product_2 = Product::where('status',1)->where('brand_id',$skip_brand_2->id)->orderBy('id','DESC')->get(); //skip brand id er sathe  product table er brand_id milabe
        // return $skip_category->id;
        // die();

        return view('frontend.index',compact('categories','sliders','products','featured','hotdeals','special_offer','special_deals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_2','skip_brand_product_2'));
    }
    public function UserLogout(){
        Auth::logout();
        return Redirect()->route('login');
    } //end method
    public function UserProfile(){
       $id = Auth::user()->id; //jei user login lora tar id nibe
       $user = User::find($id);
       return view('frontend.profile.user_profile',compact('user'));
    } //end method
    public function UserProfileStore(Request $request){
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path'); //
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path']= $filename;
        }
        $data->save();
        $notification = array(
            'message' =>  'user Profie Update Sucessyfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    } //end method
    public function UserChangePassword(){
        $id = Auth::user()->id; //jei user login lora tar id nibe
       $user = User::find($id);
        return view('frontend.profile.change_password',compact('user'));
    } //end method
    public function UserPasswordUpdate(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required' ,
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');

        }else{
            return redirect()->back();
        }


    } //end method
    //product details
    public function ProductDetails($id,$slug){
        $product = Product::findOrFail($id);

        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en); // explode for remove ','
        $color_hin = $product->product_color_hin;
        $product_color_hin = explode(',', $color_hin); // explode for remove ','

        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en); // explode for remove ','
        $size_hin = $product->product_size_hin;
        $product_size_hin = explode(',', $size_hin); // explode for remove ','

        $cat_id = $product->category_id;// ei id peoduct table er sb cat id er sathe match korabe
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();//jei id er product show kortec oita bade oi id related sb product show korbe tar jonno id != $id dawa hoice

        $multiImg = MultiImg::where('product_id',$id)->get(); //multiImg table er jei jei product Id er sathe requested $id milbe sei sei id er image niea asbe er jonno product r multi img table er vitor relation thaka lagbe
        return view('frontend.product.product_details',compact('product','multiImg','product_color_en','product_color_hin','product_size_en','product_size_hin','relatedProduct'));
    }

    //Tag wise Product show
    public function TagWiseProduct($tag){
        $products = Product::where('status',1)->where('product_tags_en',$tag)->where('product_tags_hin',$tag)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.tags.tags_view',compact('products','categories'));
    }

    //subcat wise data
    public function SubCatWiseProduct($subcat_id,$slug){
        $products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.product.subcategory_view',compact('products','categories'));
    }

    //subsubcat wise data
    public function SubSubCatWiseProduct($subsubcat_id,$slug){
        $products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.product.sub_subcategory_view',compact('products','categories'));
    }

    public function ProductViewAjax($id){
        $product = Product::with('category','brand')->findOrFail($id);

        $color = $product->product_color_en;
        $product_color = explode(',', $color); // explode for remove ','

        $size = $product->product_size_en;
        $product_size = explode(',', $size); // explode for remove ','
        //ei data gulo json type e pass korte hobe
        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }//end method







}
