<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Low Stock Alert</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">

    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <tr>
            <td style="background-color: #dc3545; color: #ffffff; padding: 20px; text-align: center;">
                <h2 style="margin: 0; font-size: 24px;">Low Stock Alert</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p style="font-size: 16px; color: #333;">The following products have low stock levels:</p>

                <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="text-align: left; border-bottom: 2px solid #ddd;">Product Name</th>
                            <th style="text-align: right; border-bottom: 2px solid #ddd;">Stock Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td style="border-bottom: 1px solid #ddd;">{{ $product->name }}</td>
                            <td style="border-bottom: 1px solid #ddd; text-align: right;">{{ $product->stock }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <p style="margin-top: 20px; font-size: 16px; color: #333;">Please restock these items as soon as possible to avoid running out of inventory.</p>

                <p style="margin-top: 30px; font-size: 14px; color: #888;">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </td>
        </tr>
    </table>

</body>
</html>