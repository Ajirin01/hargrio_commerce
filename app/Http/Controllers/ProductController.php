<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show product details
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    // Add product to cart (session-based)
    public function addToCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'variation' => 'nullable|string',
        ]);

        $weight = $request->input('variation'); // e.g., "0.5" or "1"
        $quantity = $request->input('quantity', 1);

        // Determine price
        if ($weight && isset($product->variations[$weight])) {
            $price = $product->variations[$weight]; // price for selected variation
        } else {
            $price = $product->price; // default product price
            $weight = null;
        }

        // Add to session/cart (example using session)
        $cart = session()->get('cart', []);

        $cartKey = $product->id . ($weight ? "-$weight" : '');

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'weight' => $weight,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}
