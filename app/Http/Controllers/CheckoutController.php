<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use App\Helpers\TylHelper;


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
            // Calculate total
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            // Create order with pending payment
            $order = Order::create([
                'user_id'       => Auth::id(),
                'first_name'    => $request->c_fname,
                'last_name'     => $request->c_lname,
                'email'         => $request->c_email_address,
                'phone'         => $request->c_phone,
                'country'       => $request->c_country,
                'state'         => $request->c_state_country,
                'address'       => $request->c_address,
                'zip'           => $request->c_postal_zip,
                'total'         => $total,
                'payment_status'=> 'pending',
                'order_status'  => 'pending',
            ]);

            // Save order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);
            }

            DB::commit();

            // Return the Tyl auto-submit form view
            return $this->initTylPayment($order); // <-- just return the view

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    /**
     * Initialize Tyl payment
     */
    protected function initTylPayment(Order $order)
    {
        $storeId = env('TYL_STORE_ID'); // e.g., 7220542296
        $sharedSecret = env('TYL_SHARED_SECRET'); // your Tyl shared secret
        $timezone = 'Europe/London';
        $txndatetime = now()->format('Y:m:d-H:i:s'); // exact current time
        $txntype = 'sale';
        $checkoutoption = 'combined';
        $currency = '826'; // GBP

        // Parameters to include in hash calculation
        $params = [
            'baddr1' => $order->address,
            'bcity' => $order->state,
            'bcountry' => $order->country,
            'bname' => $order->first_name . ' ' . $order->last_name,
            'bzip' => $order->zip,
            'email' => $order->email,
            'phone' => $order->phone,
            'chargetotal' => number_format($order->total, 2, '.', ''),
            'checkoutoption' => $checkoutoption,
            'currency' => $currency,
            'hash_algorithm' => 'HMACSHA256',
            'oid' => $order->id,
            'responseFailURL' => route('checkout.fail'),
            'responseSuccessURL' => route('checkout.success'),
            'storename' => $storeId,
            'timezone' => $timezone,
            'transactionNotificationURL' => route('checkout.tyl.callback'),
            'txndatetime' => $txndatetime,
            'txntype' => $txntype,
        ];

        // Sort parameters in natural ASCII order (upper-case before lower-case)
        ksort($params, SORT_STRING);

        // Concatenate values with pipe separator for hash
        $hashString = implode('|', $params);

        // Generate HMACSHA256 hash and Base64 encode it
        // $params['hashExtended'] = base64_encode(hash_hmac('sha256', $hashString, $sharedSecret, true));
        $params['hashExtended'] = TylHelper::createExtendedHash($params, env('TYL_SHARED_SECRET'));

        // Pass parameters to a Blade view that posts to Tyl
        return view('tyl.redirect', compact('params'));
    }

    /**
     * Tyl payment callback
     */
    public function tylCallback(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        // Here you verify the payment status from Tyl
        $status = $request->status ?? 'failed'; // e.g., 'paid', 'failed'

        $order->payment_status = $status;
        $order->order_status = ($status === 'paid') ? 'processing' : 'pending';
        $order->save();

        if ($status === 'paid') {
            // Clear cart
            Cart::where('user_id', $order->user_id)->delete();

            // Redirect to thank you page with order_id in query
            return redirect()->route('checkout.success', ['order_id' => $order->id]);
        }

        return redirect()->route('checkout.fail');
    }

    public function thankyou(Request $request)
    {
        $order_id = $request->oid; // get from query string
        // return response($order_id);

        return view('checkout.success', compact('order_id'));
    }
}