<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Invoice</title>

    <style>
        @page {
            margin: 5px;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            padding: 10px;
            background-color: #fff;
            color: #000;
        }

        div {
            padding: 0;
        }

        p {
            margin: 0;
            line-height: 1.2;
        }

        h1 {
            color: #e07a5f;
            margin-bottom: 10px;
            font-size: 1.5em;
        }

        h2 {
            color: #e07a5f;
            margin-top: 10px;
            margin-bottom: 5px;
            font-size: 1.2em;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        hr {
            border: 1px dashed #000;
        }
    </style>
</head>

<body>
    <div>
        <h1>DACBA FOOD AND BEVERAGE HOUSE</h1>
        <p>24 Bayan-Bayanan Avenue, Concepcion Uno, Marikina City</p>
        <p>DEBORAH ANN B. ARQUIZA - Prop.</p>
        <p>Non VAT Reg TIN: 260-829-571-00001</p>
        <p>Contact Number: 0945829023</p>

        <hr>

        <h2>SALES INVOICE</h2>
        <p>Sold to: {{ $order->customer_name }}</p>
        <p>Cashier: {{ $order->user->name }}</p>
        <p>Order Date: {{ $order->created_at->format('M d, Y') }}</p>
        <p>Print Date: {{ $date }}</p>

        <hr>

        @php
            $totalAmount = 0;
        @endphp
        @foreach ($order->orderItems as $orderItem)
            <p>{{ $orderItem->product->productDetail->name }} x {{ $orderItem->quantity }} -
                {{ $orderItem->amount }}</p>
            @php
                $totalAmount += $orderItem->amount;
            @endphp
        @endforeach

        <hr>
        <p>Subtotal: {{ $totalAmount }}</p>
        <p>Payment Received: {{ $order->payment->payment_received }}</p>
        @php
            $discountUsed = 'None';
            if ($order->discount_id != null) {
                $discountUsed = $order->discount->name . ' ';
                if (($order->discount->type === 2)) {
                    $discountUsed .= ' - less ' . intval($order->discount->value) . '%';
                } else {
                    $discountUsed .= ' - less PHP ' . intval($order->discount->value) ;
                }
            }
        @endphp
        <p>Discount Used: {{ $discountUsed }}</p>
        <p>Change: {{ $order->payment->change }}</p>
        <h2>Total amount: {{ $order->total_amount }}</h2>
    </div>
</body>

</html>
