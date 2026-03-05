<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">

<table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:auto; background:#ffffff; padding:20px;">
    <tr>
        <td>
            <h2 style="color:#333;">Thank you for your order, {{ $order->first_name }}!</h2>
            <p>Your order <strong>#{{ $order->id }}</strong> has been successfully received and payment confirmed.</p>

            <hr>

            <h3>Order Summary</h3>

            <table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse: collapse;">
                <thead style="background:#f0f0f0;">
                    <tr>
                        <th align="left">Product</th>
                        <th>Qty</th>
                        <th>Price (£)</th>
                        <th>Subtotal (£)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Product' }}</td>
                            <td align="center">{{ $item->quantity }}</td>
                            <td align="center">{{ number_format($item->price, 2) }}</td>
                            <td align="center">{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>

            @php
                $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity);
            @endphp

            <p><strong>Subtotal:</strong> £{{ number_format($subtotal, 2) }}</p>

            @if($order->discount > 0)
                <p><strong>Discount ({{ $order->promo_code }}):</strong> -£{{ number_format($order->discount, 2) }}</p>
            @endif

            <p style="font-size:18px;">
                <strong>Total Paid: £{{ number_format($order->total, 2) }}</strong>
            </p>

            <hr>

            <h3>Shipping Address</h3>
            <p>
                {{ $order->first_name }} {{ $order->last_name }}<br>
                {{ $order->address }}<br>
                {{ $order->state }}, {{ $order->country }}<br>
                {{ $order->zip }}<br>
                Phone: {{ $order->phone }}
            </p>

            <br>

            <p>We’ll notify you when your order ships.</p>

            <p style="margin-top:30px;">
                Thank you for shopping with us! <br>
                <strong>{{ config('app.name') }}</strong>
            </p>
        </td>
    </tr>
</table>

</body>
</html>