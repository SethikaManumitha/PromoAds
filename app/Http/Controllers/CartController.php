<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Promotion::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();

            if ($cartItem) {
                $cartItem->quantity += $request->input('quantity', 1);
            } else {
                $cartItem = new Cart([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $request->input('quantity', 1),
                ]);
            }

            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $request->input('quantity', 1);
            } else {
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->input('quantity', 1),
                    'dis_price' => $product->dis_price,
                    'image' => $product->image
                ];
            }

            session()->put('cart', $cart);
        }

        return $this->getCart();
    }


    public function getCart()
    {
        $cartItems = [];

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->with('promotion')->get();
        } else {
            $cart = session()->get('cart', []);

            foreach ($cart as $productId => $item) {
                $promotion = Promotion::find($productId);

                if ($promotion) {
                    $item['promotion'] = $promotion;
                    $cartItems[] = $item;
                }
            }
        }

        return view('cart', compact('cartItems'));
    }
}
