<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
        content="ie=edge">
    <title>Document</title>

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
    <h1>Big Brew Bayan-Bayanan: Wastage Report</h1>
    <p>From: {{ $start_date }}</p>
    <p>End: {{ $end_date }}</p>
    <p>Inventory Items Affected: {{ $wasteInventoryItemsCount }}</p>
    <p>Total Amount: {{ $totalAmount }}</p>

    {{-- Table Proper --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead>
                <th scope="col"
                    class="px-4 py-3">Inventory Item</th>
                <th scope="col"
                    class="px-4 py-3">Amount</th>
                <th scope="col"
                    class="px-4 py-3">Log by</th>
                <th scope="col"
                    class="px-4 py-3">Remarks</th>
                <th scope="col"
                    class="px-4 py-3">Date</th>
            </thead>
            {{-- wire:loading.class="invisible" --}}
            <tbody>
                @forelse ($inventoryLogs as $inventoryLog)
                    <tr class="border-b dark:border-gray-700">
                        <td>{{ $inventoryLog->inventoryItem->name }}</td>
                        <td>{{ $inventoryLog->amount }}</td>
                        <td>{{ $inventoryLog->user->name }}</td>
                        <td>{{ $inventoryLog->remarks }}</td>
                        <td>{{ $inventoryLog->created_at }}</td>
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
</body>

</html>
