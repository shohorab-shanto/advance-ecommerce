<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function ViewWishlist(){
        return view('frontend.wishlist.view_wishlist');
    }

    public function GetWishlistProduct(){//by product method we can get all data from product table
        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return response()->json($wishlist); //wishlist product data sending by json
    }//end method

    public function RemoveWishlistProduct($id){
        //first check which user is removing data then match requested id to wishlist id to remove data from wish list
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully product Remove']);
    }//end method



}
