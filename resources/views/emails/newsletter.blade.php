<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>{{ $subject }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f1f1f1; margin: 0; padding: 0; }
        .email-container { max-width: 600px; margin: auto; background: #fff; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; }
        th { text-align: left; }
        a { color: #17bebb; text-decoration: none; }
        .btn { display: inline-block; padding: 10px 15px; background: #17bebb; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>
<div class="email-container">
    <h2>Hello {{ $first_name ?? $full_name }},</h2>

    <!-- Display the newsletter message exactly as saved in template -->
    <div style="margin-top: 15px;">
        {!! $message_intro !!}
    </div>

    <!-- Display products table if products exist -->
    @if($products && $products->count())
        <table>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th style="text-align:right">Price</th>
            </tr>
            @foreach($products as $product)
            <tr>
                <!-- Product Image -->
                <td>
                    @if($product->image)
                        <img src="{{ asset('public/uploads/'.$product->image) }}" alt="{{ $product->name }}" style="width:60px; height:auto;">
                    @endif
                </td>

                <!-- Product Name + Description -->
                <td>
                    <a href="{{ url('product/'.$product->id) }}">{{ $product->name }}</a>
                    @if($product->description ?? false)
                        <p>{{ $product->description }}</p>
                    @endif
                </td>

                <!-- Product Price -->
                <td style="text-align:right">
                    ₦{{ number_format($product->price, 2) }}
                </td>
            </tr>
            @endforeach
        </table>
    @endif

    <!-- Promo code if exists -->
    @if(!empty($promo_code))
    <p style="margin-top: 20px;">Use promo code <strong>{{ $promo_code }}</strong> to get a discount!</p>
    @endif

    <p><a href="{{ url('/') }}" class="btn">Visit Store</a></p>
</div>
</body>
</html>