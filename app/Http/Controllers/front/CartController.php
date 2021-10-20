<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function cart()
    {

        return view('cart');
    }


    public function addToCart($id ,Request $request)
    {

        $product = Product::where('id',$id)->with('discount')->first();
        $cart = session()->get('cart', []);
       // $quantity = intval($request->product_quantity);

        if (isset($cart[$id])) {
            $cart[$id]['available_in_stock']++;
        } else {
            $cart[$id] = [
                "title" => $product->title,
                "available_in_stock" => $request->quantity,
                "price" => $product->price,
                 "product_discount_id" =>$product->discount == null ?0 :$product->discount->value,
                "cover_image" => $product->cover_image
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['status' => 200, 'success' => 'تمت الإضافة إلى السلة بنجاح']);

    }
    public function updateCart(){
        return view('front_layout.cart_content')->render();
    }
    public function update(Request $request)
    {
        if ($request->id && $request->available_in_stock) {
            $cart = session()->get('cart');
            $cart[$request->id]["available_in_stock"] = $request->available_in_stock;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
