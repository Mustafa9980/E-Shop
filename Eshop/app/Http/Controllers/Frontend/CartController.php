<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{

    public function addproduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if (Auth::check()) {

            $product_check = Product::where('id', $product_id)->first();

            if ($product_check) {

                if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $product_check->name . " Already Add to Cart"]);
                } else {

                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();

                    return response()->json(['status' => $product_check->name . " Add to Cart"]);
                }
            }
        } else {

            return response()->json(['status' => " Login to continue"]);
        }
    }

    public function viewcart()
    {

        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart', compact('cartitems'));
    }

    public function delete(Request $request)
    {

        if (Auth::check()) {

            $prod_id=$request->input('prod_id');

            if(Cart::where('prod_id',$prod_id)->where('user_id', Auth::id())->exists()){

                $cartiIems=Cart::where('prod_id',$prod_id)->where('user_id', Auth::id())->first();

                $cartiIems->delete();
                return response()->json(['status' => "delete item successfully"]);



            }
        } else {

            return response()->json(['status' => " Login to continue"]);
        }
    }

    public function updatecart(Request $request)
    {
        
        
        if (Auth::check()) {

            $prod_id=$request->input('prod_id');
            $product_qty=$request->input('product_qty');



            if(Cart::where('prod_id',$prod_id)->where('user_id', Auth::id())->exists()){

                $cart=Cart::where('prod_id',$prod_id)->where('user_id', Auth::id())->first();
                $cart->prod_qty=$product_qty;
                $cart->update();

                return response()->json(['status' => "Quantity Update"]);



            }
        } else {

            return response()->json(['status' => " Login to continue"]);
        }
    }
}
