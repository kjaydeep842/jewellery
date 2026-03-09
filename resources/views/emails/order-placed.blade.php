<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #CBA65A;
            padding-bottom: 10px;
        }

        .order-details {
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }

        .button {
            background-color: #CBA65A;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            rounded: 5px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/logo_black.png') }}" alt="Tattsvi" width="150">
            <h2>Order Placed Successfully!</h2>
        </div>
        <p>Dear {{ $order->customer_name }},</p>
        <p>Thank you for your order! We've received it and are now processing it.</p>

        <div class="order-details">
            <h3>Order Summary</h3>
            <p><strong>Order ID:</strong> #{{ $order->id }}</p>
            <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Shipping Address:</strong><br>
                {{ $order->address->address_line_1 }}, {{ $order->address->area }},<br>
                {{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->zip }}
            </p>
        </div>

        <h3>Items Ordered:</h3>
        <table width="100%" style="border-collapse: collapse;">
            <thead>
                <tr style="background: #f9f9f9;">
                    <th style="padding: 10px; border: 1px solid #eee; text-align: left;">Product</th>
                    <th style="padding: 10px; border: 1px solid #eee; text-align: center;">Qty</th>
                    <th style="padding: 10px; border: 1px solid #eee; text-align: right;">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #eee;">{{ $item->product_name }}</td>
                        <td style="padding: 10px; border: 1px solid #eee; text-align: center;">{{ $item->quantity }}</td>
                        <td style="padding: 10px; border: 1px solid #eee; text-align: right;">
                            ₹{{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="text-align: center; margin-top: 30px;">
            <a href="{{ route('home') }}" class="button" style="color: white;">Continue Shopping</a>
        </p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tattsvi Jewellery. All rights reserved.</p>
        </div>
    </div>
</body>

</html>