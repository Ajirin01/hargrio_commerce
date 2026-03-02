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
        $variation = $request->variation ?? null;

        // Determine price based on variation
        $price = $variation && isset($product->variations[$variation])
                 ? $product->variations[$variation]
                 : $product->price;

        // Check if same product + variation already exists
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->where('variation', $variation)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'variation' => $variation,
                'price' => $price,
                'quantity' => $quantity
            ]);
        }

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
                        ->where('id', $request->id) // cart row id
                        ->first();

        if ($cartItem) {
            if ($request->action === 'increase') {
                $cartItem->quantity++;
            } elseif ($request->action === 'decrease' && $cartItem->quantity > 1) {
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
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('id', $request->id) // cart row id
                        ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        $this->syncCartToSession();

        return redirect()->back();
    }

    // Sync cart to session
    private function syncCartToSession()
    {
        $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();

        $cart = [];
        $count = 0;

        foreach ($cartItems as $item) {
            $cart[$item->id] = [
                "product_id" => $item->product_id,
                "name" => $item->product->name,
                "variation" => $item->variation,
                "quantity" => $item->quantity,
                "price" => $item->price,
                "total" => $item->price * $item->quantity,
                "image" => $item->product->image,
            ];

            // Instead of adding quantity, just count each row as 1
            $count += 1;
        }

        session()->put('cart', $cart);
        session()->put('cart_count', $count);
    }
}