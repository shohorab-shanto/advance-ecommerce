<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    public function MyCart(){
        return view('frontend.wishlist.view_mycart');
    }

    public function GetCartProduct(){
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

    public function RemoveCartProduct($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully cart Remove']);

    }// end method

    public function CartIncrement($rowId){
        $row = Cart::get($rowId); //rowId dhore oi id er cart ene row te rakhlam
        Cart::update($rowId, $row->qty + 1); //oi cart er qty field e 1 add kore update korlam
        return response()->json('increment');
    }//end method

    public function CartDecrement($rowId){
        $row = Cart::get($rowId); //rowId dhore oi id er cart ene row te rakhlam
        Cart::update($rowId, $row->qty - 1); //oi cart er qty field e 1 add kore update korlam
        return response()->json('decrement');
    }//end method



}
