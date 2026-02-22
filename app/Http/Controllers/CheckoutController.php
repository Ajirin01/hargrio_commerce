<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('checkout', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        DB::beginTransaction();

        try {

            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $order = Order::create([
                'user_id'   => Auth::id(),
                'first_name'=> $request->c_fname,
                'last_name' => $request->c_lname,
                'email'     => $request->c_email_address,
                'phone'     => $request->c_phone,
                'country'   => $request->c_country,
                'state'     => $request->c_state_country,
                'address'   => $request->c_address,
                'zip'       => $request->c_postal_zip,
                'total'     => $total,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();
            session()->forget('cart');

            DB::commit();

            return redirect()->route('checkout.thankyou');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function thankyou()
    {
        return view('thankyou');
    }
}
