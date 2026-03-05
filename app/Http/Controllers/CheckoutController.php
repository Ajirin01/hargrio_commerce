<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderNotificationMail;


use App\Models\PromoCode;
use Carbon\Carbon;

use App\Helpers\TylHelper;

use App\Models\UsedPromo;


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
        // Validate inputs
        $request->validate([
            'c_country'       => 'required|string|max:255',
            'c_fname'         => 'required|string|max:255',
            'c_lname'         => 'required|string|max:255',
            'c_companyname'   => 'nullable|string|max:255',
            'c_address'       => 'required|string|max:500',
            'c_state_country' => 'required|string|max:255',
            'c_postal_zip'    => 'required|string|max:20',
            'c_email_address' => 'required|email|max:255',
            'c_phone'         => 'required|string|max:20',
            'promo_code'      => 'nullable|string|max:50',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            // Subtotal calculation
            $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

            // Discount from session
            $discountAmount = session('promo_discount_amount', 0);
            $payable = max($subtotal - $discountAmount, 0);

            // Create order
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
                'total'         => $payable,
                'payment_status'=> 'pending',
                'order_status'  => 'pending',
                'discount'      => $discountAmount,
                'promo_code'    => session('promo_code', null),
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

            // Notify Admin about new order (before payment)
            try {
                $adminEmail = env('ADMIN_EMAIL');
                Mail::to($adminEmail)->queue(new OrderNotificationMail($order));
            } catch (\Exception $e) {
                \Log::error("Admin notification failed: ".$e->getMessage());
            }

            // Redirect to Tyl payment
            return $this->initTylPayment($order);

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
        $storeId = env('TYL_STORE_ID');
        $sharedSecret = env('TYL_SHARED_SECRET');
        $timezone = 'Europe/London';
        $txndatetime = now()->format('Y:m:d-H:i:s');
        $txntype = 'sale';
        $checkoutoption = 'combined';
        $currency = '826'; // GBP

        // Use order->total which already contains discount
        $params = [
            'baddr1' => $order->address,
            'bcity' => $order->state,
            'bcountry' => $order->country,
            'bname' => $order->first_name . ' ' . $order->last_name,
            'bzip' => $order->zip,
            'email' => $order->email,
            'phone' => $order->phone,
            'chargetotal' => number_format($order->total, 2, '.', ''), // discounted total
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

        ksort($params, SORT_STRING);

        $params['hashExtended'] = TylHelper::createExtendedHash($params, $sharedSecret);

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
        $order_id = $request->oid;
        $order = Order::with('items.product')->find($order_id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Only process if payment is approved
        if (isset($request->status) && $request->status === 'APPROVED') {

            // Prevent duplicate processing if already paid
            if ($order->payment_status !== 'paid') {

                DB::beginTransaction();

                try {

                    // Clear user's cart
                    Cart::where('user_id', $order->user_id)->delete();

                    // Record used promo if any
                    if ($order->promo_code) {
                        $promo = PromoCode::where('code', $order->promo_code)->first();
                        if ($promo) {
                            $promo->increment('used_count');

                            UsedPromo::create([
                                'user_id' => $order->user_id,
                                'promo_code_id' => $promo->id,
                            ]);
                        }
                    }

                    // Update order status
                    $order->payment_status = 'paid';
                    $order->order_status = 'processing';
                    $order->save();

                    DB::commit();

                    /*
                    |--------------------------------------------------------------------------
                    | SEND EMAILS AFTER SUCCESSFUL PAYMENT
                    |--------------------------------------------------------------------------
                    */

                    // 1️⃣ Send confirmation to customer
                    try {
                        Mail::to($order->email)->queue(new OrderConfirmationMail($order));
                    } catch (\Exception $e) {
                        \Log::error("Customer confirmation email failed: " . $e->getMessage());
                    }

                    // 2️⃣ Notify admin after payment success
                    try {
                        $adminEmail = env('ADMIN_EMAIL');
                        Mail::to($adminEmail)->queue(new OrderNotificationMail($order));
                    } catch (\Exception $e) {
                        \Log::error("Admin notification after payment failed: " . $e->getMessage());
                    }

                } catch (\Exception $e) {
                    DB::rollBack();
                    \Log::error("Payment processing failed: " . $e->getMessage());
                }
            }
        }

        return view('checkout.success', compact('order_id'));
    }

    public function applyPromo(Request $request)
    {
        $promoCode = $request->input('promo_code');

        // Example: hardcoded valid promo codes
        $validCodes = [
            'NEWYEAR5OFF' => 0.05, // 5% discount
            'WELCOME10' => 0.10,   // 10% discount
        ];

        if(isset($validCodes[$promoCode])) {
            // store promo info in session
            session([
                'promo_code' => $promoCode,
                'promo_discount' => $validCodes[$promoCode]
            ]);
            return back()->with('promo_success', "Promo code applied! You get ".($validCodes[$promoCode]*100)."% off.");
        } else {
            // invalid code
            session()->forget(['promo_code','promo_discount']);
            return back()->with('promo_error', 'Invalid promo code.');
        }
    }

    public function applyPromoAjax(Request $request)
    {
        $promoCodeInput = $request->input('promo_code');

        // Fetch active promo code
        $promo = PromoCode::where('code', $promoCodeInput)
                    ->where('status', 'active')
                    ->first();

        if (!$promo) {
            session()->forget(['promo_code', 'promo_discount', 'promo_type', 'promo_value']);
            return response()->json([
                'success' => false,
                'message' => "Invalid promo code."
            ]);
        }

        // Check expiration
        if ($promo->expires_at && Carbon::now()->gt($promo->expires_at)) {
            return response()->json([
                'success' => false,
                'message' => "Promo code has expired."
            ]);
        }

        // Check global usage limit
        if ($promo->usage_limit && $promo->used_count >= $promo->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => "Promo code usage limit reached."
            ]);
        }

        // Check per-user usage
        $userUsedCount = UsedPromo::where('user_id', auth()->id())
                                ->where('promo_code_id', $promo->id)
                                ->count();
        if ($promo->usage_limit && $userUsedCount >= $promo->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => "You have already used this promo code the maximum number of times."
            ]);
        }

        // Calculate subtotal
        $cartItems = auth()->user()->cartItems ?? collect([]);
        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Calculate discount
        if ($promo->type === 'percentage') {
            $discountAmount = $subtotal * ($promo->value / 100);
        } else { // fixed
            $discountAmount = $promo->value;
        }

        $total = max($subtotal - $discountAmount, 0);

        // Save promo info to session
        session([
            'promo_code' => $promo->code,
            'promo_type' => $promo->type,
            'promo_value' => $promo->value,
            'promo_discount_amount' => $discountAmount,
            'promo_id' => $promo->id
        ]);

        return response()->json([
            'success' => true,
            'message' => "Promo code applied! Discount: £" . number_format($discountAmount, 2),
            'total' => $total
        ]);
    }
}