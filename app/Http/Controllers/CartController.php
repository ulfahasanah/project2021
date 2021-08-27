<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Cart;
use Auth;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {
        $available = Cart::with('product')->where([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'status' => false
        ])->get()->first();
        if(!empty($available)) {
            Cart::where([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'status' => false
            ])->update([
                'qty' => $available->qty + 1
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'status' => false,
                'qty' => 1
            ]);
        }
        return response()->json([
            'status' => 1
        ]);
    }

    public function get_cart()
    {
        $data = Cart::where('user_id', Auth::id())->get();
        return $data;
    }


}
