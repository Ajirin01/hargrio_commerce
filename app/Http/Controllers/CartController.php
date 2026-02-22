<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show the user's cart
    public function index()
    {
        $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();

        return view('cart', compact('cartItems'));
    }

    // Add a product to the cart
    public function add(Request $request, Product $product)
    {
        $quantity = $request->quantity ?? 1;

        // 1️⃣ Save or update in database
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
        }

        // 2️⃣ Refresh session from database
        $this->syncCartToSession();

        return response()->json([
            'message' => "{$product->name} added to cart!",
            'cart_count' => session('cart_count')
        ]);
    }

    // Update quantity
    public function update(Request $request)
    {
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $request->id)
                        ->first();

        if ($cartItem) {

            if ($request->action == 'increase') {
                $cartItem->quantity++;
            }

            if ($request->action == 'decrease' && $cartItem->quantity > 1) {
                $cartItem->quantity--;
            }

            $cartItem->save();
        }

        $this->syncCartToSession();

        return redirect()->back();
    }

    // Remove item
    public function remove(Request $request)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $request->id)
            ->delete();

        $this->syncCartToSession();

        return redirect()->back();
    }

    private function syncCartToSession()
    {
        $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();

        $cart = [];
        $count = 0;

        foreach ($cartItems as $item) {

            $cart[$item->product_id] = [
                "name" => $item->product->name,
                "quantity" => $item->quantity,
                "price" => $item->product->price,
                "image" => $item->product->image
            ];

            $count += $item->quantity;
        }

        session()->put('cart', $cart);
        session()->put('cart_count', $count);
    }
}

