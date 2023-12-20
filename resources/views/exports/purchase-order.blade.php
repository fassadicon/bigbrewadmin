<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
        content="ie=edge">
    <title>Purchase Order</title>

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
    <h1>Big Brew Bayan-Bayanan: Purchase Order</h1>
    <p>PO: {{ $purchaseOrder->id }}</p>
    <p>Date: {{ $purchaseOrder->created_at->format('M d, Y') }}</p>
    <p>Vendor: {{ $purchaseOrder->supplier->name }}</p>
    <p>Prepared by: {{ $purchaseOrder->user->name }}</p>
    <p>Status: {{ $purchaseOrder->status }}</p>

    {{-- Table Proper --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead>
                <th scope="col"
                    class="px-4 py-3">PO Item ID</th>
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
                @forelse ($purchaseOrder->purchaseOrderItems as $purchaseOrderItem)
                    <tr class="border-b dark:border-gray-700">
                        <td>{{ $purchaseOrderItem->id }}</td>
                        <td>{{ $purchaseOrderItem->inventoryItem->id }}</td>
                        <td>{{ $purchaseOrderItem->inventoryItem->name }}</td>
                        <td>{{ $purchaseOrderItem->unit_measurement }}</td>
                        <td>{{ $purchaseOrderItem->quantity }}</td>
                        <td>{{ $purchaseOrderItem->unit_price }}</td>
                        <td>{{ $purchaseOrderItem->amount }}</td>
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

    <h3>Total Amount: {{ $purchaseOrder->total_amount }}</h3>
</body>

</html>
