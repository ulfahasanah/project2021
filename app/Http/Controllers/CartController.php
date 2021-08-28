<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Sale;
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
            ])->increment('qty');
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
        ], 201);
    }

    public function get_cart()
    {
        $data = Cart::with('product', 'user')->where('user_id', Auth::id())->orderBy('id')->get();
        return $data;
    }

    public function update_cart(Request $request, $id)
    {
        if($request->data == 'plus') {
            $result = Cart::
            where('user_id', Auth::id())
            ->where('id', $id)
            ->increment('qty');
        } else if($request->data == 'minus') {
            $result = Cart::
            where('user_id', Auth::id())
            ->where('id', $id)
            ->decrement('qty');
        } else {
            $result = Cart::
            where('user_id', Auth::id())
            ->where('id', $id)
            ->update([
                'qty' => $request->data
            ]);
        }
        return $result;
    }

    public function delete_cart($id)
    {
        $result = Cart::
            where('user_id', Auth::id())
            ->where('id', $id)
            ->delete();
        return $result;
    }

    public function checkout(Request $request)
    {
        $product_id = array();
        $total_price = 0;
        $qty = 0;

        foreach ($request->cart as $value) {

            Cart::
            where('user_id', Auth::id())
            ->where('id', $value['id'])
            ->update([
                'status' => true
            ]);

            Product::where('id', $value['product_id'])
            ->update([
                'qty' => $value['product']['qty'] - $value['qty']
            ]);

            array_push($product_id, $value['product_id']);
            $total_price += ($value['product']['price'] * $value['qty']);
            $qty += $value['qty'];

        }

        $product_id = implode(",", $product_id);

        Sale::create([
            'code' => 'SALE-' . date('y-m-d') . '-' . date('H:i:s'),
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'total_price' => $total_price,
            'qty' => $qty,
            'total_discount' => $request->total_discount,
            'total_paid' => $request->total_paid
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
       
    }

}
