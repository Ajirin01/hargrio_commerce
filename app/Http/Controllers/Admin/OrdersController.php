<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Earning;
use Session;

use App\Mail\OrderUpdateMail;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function getOrdersByType($type){
        if($type == 'all'){
            $orders = Order::all();
        }else if($type == 'pending'){
            $orders = Order::where('order_status', 'pending')->get();
        }
        else if($type == 'shipped'){
            $orders = Order::where('order_status', 'shipped')->get();
        }else if($type == 'cancelled'){
            $orders = Order::where('order_status', 'cancelled')->get();
        }else if($type == 'completed'){
            $orders = Order::where('order_status', 'completed')->get();
        }else{
            $orders = Order::all();
        }
        // return response()->json($orders);
        return view('Admin.Orders.orders_list',['orders'=> $orders, 'type'=> $type]);
    }

    public function orderDetails($id)
    {
        // Load order with items and products
        $order = Order::with('items.product')->findOrFail($id);

        // Shipping address (you already have it stored in fields like address, state, zip, country)
        $shippingAddress = [
            'name'    => $order->first_name . ' ' . $order->last_name,
            'phone'   => $order->phone,
            'email'   => $order->email,
            'address' => $order->address,
            'state'   => $order->state,
            'zip'     => $order->zip,
            'country' => $order->country,
        ];

        // Return view with Eloquent collections
        return view('Admin.Orders.order_details', [
            'order'            => $order,
            'orderItems'       => $order->items, // collection of OrderItem models
            'shippingAddress'  => $shippingAddress,
        ]);
    }

    public function updateOrderStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $order = Order::findOrFail($id);

        // Update order status
        $order->order_status = $request->status;
        $order->save();

        // Send email to customer
        Mail::to($order->email)
            ->send(new OrderUpdateMail($order, $request->status));

        return redirect()->back()
            ->with('success', 'Order status updated and customer notified.');
    }
}
