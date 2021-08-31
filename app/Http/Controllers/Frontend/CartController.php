<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;


class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,

                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);

        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,

                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']); //response e data json akare joma hoy

        }
    }//end method

    //mini cart section
    public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count(); //count how many cart i have
        $cartTotal = Cart::total(); //cart er price auto niea nibe ei total method er maddhome
        //all things pass by json array
        return response()->json(array( //response thke json data array hisebe pass korteci
            'carts' => $carts,
            'cartQty' => $cartQty, //how much cart added
            'cartTotal' => round($cartTotal), //for tatla amount
        ));

    }//end method

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'product Remove from Cart']);
    }//end method

    //add to wishlist method
    public function AddToWishlist(Request $request, $product_id){
        //checking user login or not
        if(Auth::check()){
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first(); //auth user id r requested user id mille data anbe and oi data exist e rakhbe
            //if product not exist in database then insert//$exist check product is aviable or not
            if(!$exists){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);

                return response()->json(['success' => 'Wishlist Added Successfully']);
            }else{
                return response()->json(['error' => 'This Product has Already on Your Wishlist']);
            }


        }else{
            return response()->json(['error' => 'At First Login Your Account']);
        }

    }




}
