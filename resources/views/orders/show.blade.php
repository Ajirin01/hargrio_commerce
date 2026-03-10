@extends('layouts.site')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero position-relative overflow-hidden">
        {{-- Background Image (bokeh grains) --}}
        <img src="{{ asset('site/images/hero-grains-bokeh.png') }}" class="hero-bg-img" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;filter:brightness(0.35);">
        {{-- Layered Gradient Overlay --}}
        <div class="hero-overlay-gradient" style="position:absolute;inset:0;z-index:1;background:linear-gradient(135deg, rgba(27, 24, 23, 0.95) 0%, rgba(44, 34, 31, 0.65) 40%, rgba(92,71,66,0.55) 65%, rgba(30,18,14,0.85) 100%);"></div>
        {{-- Noise grain --}}
        <div style="position:absolute;inset:0;z-index:1;background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;);opacity:0.04;pointer-events:none;"></div>
        <div class="container position-relative" style="z-index:3;">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="intro-excerpt">
                        <h1>Order #{{ $order->id }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

<div class="untree_co-section">
    <div class="container">

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