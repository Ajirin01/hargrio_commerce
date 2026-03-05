<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Order Received</title>
</head>
<body style="font-family: Arial, sans-serif; padding:20px; background:#f9f9f9;">

<table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:auto; background:#ffffff; padding:20px;">
    <tr>
        <td>
            <h2 style="color:#d9534f;">New Order Received</h2>

            <p><strong>Order ID:</strong> #{{ $order->id }}</p>
            <p><strong>Status:</strong> {{ strtoupper($order->payment_status) }}</p>
            <p><strong>Total:</strong> £{{ number_format($order->total, 2) }}</p>

            <hr>

            <h3>Customer Details</h3>
            <p>
                {{ $order->first_name }} {{ $order->last_name }}<br>
                Email: {{ $order->email }}<br>
                Phone: {{ $order->phone }}
            </p>

            <hr>

            <h3>Products Ordered</h3>

            <table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse: collapse;">
                <thead style="background:#f0f0f0;">
                    <tr>
                        <th align="left">Product</th>
                        <th>Qty</th>
                        <th>Price (£)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Product' }}</td>
                            <td align="center">{{ $item->quantity }}</td>
                            <td align="center">{{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>

            <p>
                <a href="{{ url('/admin/orders/'.$order->id) }}"
                   style="background:#007bff; color:#fff; padding:10px 15px; text-decoration:none;">
                   View Order
                </a>
            </p>
        </td>
    </tr>
</table>

</body>
</html>