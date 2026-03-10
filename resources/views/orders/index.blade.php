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
                        <h1>My Orders</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

<div class="untree_co-section">
    <div class="container">

        @if($orders->isEmpty())
            <p>You have not placed any orders yet.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary">Start Shopping</a>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td>£{{ number_format($order->total, 2) }}</td>
                        <td>{{ ucfirst($order->payment_status) }}</td>
                        <td>{{ ucfirst($order->order_status) }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection