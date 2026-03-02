@extends('layouts.site')

@section('content')
<div class="untree_co-section">
    <div class="container">
        <h2 class="mb-4">My Orders</h2>

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