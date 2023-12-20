<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
        content="ie=edge">
    <title>Delivery Receive</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Big Brew Bayan-Bayanan: Delivery Receive</h1>
    <p>DR: {{ $deliveryReceive->id }}</p>
    <p>PO: {{ $deliveryReceive->purchaseOrder->id }}</p>
    <p>Date: {{ $deliveryReceive->created_at->format('M d, Y') }}</p>
    <p>Vendor: {{ $deliveryReceive->purchaseOrder->supplier->name }}</p>
    <p>Received by: {{ $deliveryReceive->user->name }}</p>

    {{-- Table Proper --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead>
                <th scope="col"
                    class="px-4 py-3">DO Item ID</th>
                <th scope="col"
                    class="px-4 py-3">Inv Item ID</th>
                <th scope="col"
                    class="px-4 py-3">Name</th>
                <th scope="col"
                    class="px-4 py-3">Unit</th>
                <th scope="col"
                    class="px-4 py-3">Qty</th>
                <th scope="col"
                    class="px-4 py-3">Price</th>
                <th scope="col"
                    class="px-4 py-3">Total</th>
            </thead>
            {{-- wire:loading.class="invisible" --}}
            <tbody>
                @forelse ($deliveryReceive->deliveryReceiveItems as $deliveryReceiveItem)
                    <tr class="border-b dark:border-gray-700">
                        <td>{{ $deliveryReceiveItem->id }}</td>
                        <td>{{ $deliveryReceiveItem->inventoryItem->id }}</td>
                        <td>{{ $deliveryReceiveItem->inventoryItem->name }}</td>
                        <td>{{ $deliveryReceiveItem->unit_measurement }}</td>
                        <td>{{ $deliveryReceiveItem->quantity }}</td>
                        <td>{{ $deliveryReceiveItem->unit_price }}</td>
                        <td>{{ $deliveryReceiveItem->amount }}</td>
                    </tr>
                @empty
                    <tr class="border-b dark:border-gray-700">
                        <td colspan="6"
                            class="px-4 py-3 text-center">No results available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h3>Total Amount: {{ $deliveryReceive->total_amount }}</h3>
</body>

</html>
