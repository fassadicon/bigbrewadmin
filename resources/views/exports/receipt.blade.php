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

        <hr>

        <h2>SALES INVOICE</h2>
        <p>Sold to: {{ $order->customer_name }}</p>
        <p>Date: {{ $date }}</p>

        <hr>

        @foreach ($order->orderItems as $orderItem)
            <p>{{ $orderItem->product->productDetail->name }} x {{ $orderItem->quantity }} -
                {{ $orderItem->amount }}</p>
        @endforeach

        <hr>

        <h2>Total amount: {{ $order->total_amount }}</h2>
    </div>
</body>

</html>
