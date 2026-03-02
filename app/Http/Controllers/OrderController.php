<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    // List all orders for the logged-in user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Show details for a single order
    public function show(Order $order)
    {
        // Ensure the order belongs to the logged-in user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Load order items
        $order->load('items.product');

        return view('orders.show', compact('order'));
    }
}