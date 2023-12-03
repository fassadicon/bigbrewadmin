<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Big Brew Bayan-Bayanan: Sales Report</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .col-6 {
            width: 48%;
        }

        .col-12 {
            width: 100%;
            margin-top: 20px;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        img {
            max-width: 50%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <img src="{{ asset('storage/img/bigbrew-logo.png') }}" alt="Company Logo">
    <h1>Big Brew Bayan-Bayanan: Sales Report</h1>
    <p>{{ $date }}</p>
    <div class="row">
        <div class="col-6">
            <h3>Total Cash Payment: ₱{{ $totalCashPayments }}</h3>
            <h3>Total Online Payments: ₱{{ $totalOnlinePayments }}</h3>
        </div>
        <div class="col-6">
            <h3>Number of Completed Orders: {{ $completedOrders }}</h3>
            <h3>Number of Cancelled Orders: {{ $cancelledOrders }}</h3>
        </div>
        <div class="col-12">
            <h2>Total Sales: ₱{{ $totalSales }}</h2>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <th scope="col"
                        class="px-4 py-3">Order #</th>
                    <th scope="col"
                        class="px-4 py-3">Items</th>
                    <th scope="col"
                        class="px-4 py-3">Total Amount</th>
                    <th scope="col"
                        class="px-4 py-3">Payment Method</th>
                    <th scope="col"
                        class="px-4 py-3">Status</th>
                    <th scope="col"
                        class="px-4 py-3">Catered By</th>
                </thead>
                {{-- wire:loading.class="invisible" --}}
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium whitespace-nowrap text-gray-900">
                                {{ $order->id }}
                            </th>
                            <td>
                                @foreach ($order->orderItems as $orderItem)
                                    <div>{{ $orderItem->product->productDetail->name }} x
                                        {{ $orderItem->quantity }}</div>
                                @endforeach
                            </td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ $order->payment->method === 1 ? 'Cash' : 'Online' }}</td>
                            <td>{{ $order->status === 1 ? 'Completed' : 'Cancelled' }}</td>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                    @empty
                        <tr class="border-b dark:border-gray-700">
                            <td colspan="6"
                                class="px-4 py-3 text-center">No results available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </table>
    </div>
</body>
</html>
