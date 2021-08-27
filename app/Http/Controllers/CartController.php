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
        $data = Cart::create($request->all());
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
