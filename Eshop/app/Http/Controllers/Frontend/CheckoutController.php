<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Auth\User;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitems = Cart::where('user_id', Auth::id())->get();

        foreach ($old_cartitems as $item) {
            if (!Product::where('id', $item->prod_id)->where('qty', '>=', $item->prod_qty)->exists()) {
                $remveitme = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $remveitme->delete();
            }
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.checkout', compact('cartitems'));
    }
    public function placeorder(Request $request)

    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->Address1 = $request->input('Address1');
        $order->Address2 = $request->input('Address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->county = $request->input('county');
        $order->pincode = $request->input('pincode');
      
        $total = 0;
        $cartitems_total = Cart::where('user_id', Auth::id())->get();

        foreach ($cartitems_total as $prod) {

            $total +=$prod->products->selling_price * $prod->prod_qty ;
        };

        $order->total_price = $total;
        $order->tracking_no = 'Mustafa' . rand(1111, 9999);
        $order->save();



        $cartitems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price,


            ]);
            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }

        if (Auth::user()->address1 == NULL) {

            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->Address1 = $request->input('Address1');
            $user->Address2 = $request->input('Address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->county = $request->input('county');
            $user->pincode = $request->input('pincode');
            $user->update();
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartitems);

        return redirect('/')->with('status', 'Plasce Order Successful');
    }
}
