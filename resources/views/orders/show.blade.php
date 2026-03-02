@extends('layouts.site')

@section('content')
<div class="untree_co-section">
    <div class="container">
        <h2 class="mb-4">Order #{{ $order->id }}</h2>

        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
        <p><strong>Order Status:</strong> {{ ucfirst($order->order_status) }}</p>
        <p><strong>Total:</strong> £{{ number_format($order->total, 2) }}</p>

        <h4 class="mt-4">Billing Info</h4>
        <p>
            {{ $order->first_name }} {{ $order->last_name }} <br>
            {{ $order->address }}, {{ $order->state }}, {{ $order->country }} <br>
            {{ $order->zip }} <br>
            Email: {{ $order->email }} <br>
            Phone: {{ $order->phone }}
        </p>

        <h4 class="mt-4">Items</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                    <td>£{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>£{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary mt-3">Back to Orders</a>
    </div>
</div>
@endsection