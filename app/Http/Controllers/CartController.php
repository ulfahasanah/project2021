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
        $data = Cart::with('product')->where('user_id', Auth::id())->orderBy('id')->get();
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
        $content = $request->getContent();
        $data = json_decode($content, true);

        foreach ($data as $value) {

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

        }

        return response()->json([
            'status' => 'success'
        ], 200);
       
    }

}
