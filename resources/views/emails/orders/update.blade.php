<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Update</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">

<table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:auto; background:#ffffff; padding:20px;">
    <tr>
        <td>
            <h2>Order Update - #{{ $order->id }}</h2>

            <p>Hi {{ $order->first_name }},</p>

            <p>Your order status has been updated to:</p>

            <p style="font-size:18px; font-weight:bold; color:#28a745;">
                {{ strtoupper($statusUpdate) }}
            </p>

            <p>
                You can contact us if you have any questions.
            </p>

            <br>

            <p>Thank you for shopping with {{ config('app.name') }}.</p>
        </td>
    </tr>
</table>

</body>
</html>