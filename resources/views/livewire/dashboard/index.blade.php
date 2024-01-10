<div class="px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Sales Summary Card -->
    @if (auth()->user()->hasRole('Owner'))
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="bg-orange-300 text-center rounded-lg font-bold">
                <h2 class="text-lg mb-4">SUMMARY</h2>
            </div>
            <p>Current Sales Today: ₱ {{ $currentSalesToday }}</p>
            <p>Current Sales this Week: ₱ {{ $currentSalesWeek }}</p>
            <p>Current Sales this Month: ₱ {{ $currentSalesMonth }}</p>
            <p>Current Sales this Year: ₱ {{ $currentSalesYear }}</p>
            <p>Pending Purchase Orders Amount: ₱ {{ $pendingPurchaseOrdersAmount }}</p>
            <p>Purchase Orders Amount: ₱ {{ $purchaseOrdersAmount }}</p>
            <p>Delivery Receives Amount: ₱ {{ $deliveryReceivesAmount }}</p>
        </div>
    @endif

    <!-- Low Inventory Items Card -->
    <div class="bg-white rounded-lg shadow-md p-6 ">
        <div class="bg-orange-300 text-center rounded-lg font-bold">
            <h2 class="text-lg mb-4">LOW INVENTORY ITEMS</h2>
        </div>
        <table class="table-auto w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th>Item</th>
                <th>Unit</th>
                <th>Warning</th>
                <th>Remaining</th>
            </thead>
            <tbody>
                @foreach ($lowInventoryItems as $lowInventoryItem)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td>{{ ucwords($lowInventoryItem->name) }}</td>
                        <td>{{ $lowInventoryItem->measurement }}</td>
                        <td class="text-orange-500">{{ intval($lowInventoryItem->warning_value) }}</td>
                        <td class="text-red-500">{{ intval($lowInventoryItem->remaining_stocks) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Top Sales Products Card -->
    <div class="bg-white rounded-lg shadow-md p-4 grid grid-cols-2 gap-2">
        <div class="bg-orange-300 text-center rounded-lg font-bold col-span-2 h-7 mt-2">
            <h2 class="text-lg">TOP SELLING PRODUCTS</h2>
        </div>
        @foreach ($mostOrderedProducts as $mostOrderedProduct)
            <div class="flex items-center mb-1">
                <img src="{{ asset('storage\\' . $mostOrderedProduct['product']->productDetail->image_path) }}"
                    class="h-8 w-8 rounded-full mr-2">
                <p class="text-sm">{{ ucwords($mostOrderedProduct['product']->productDetail->name) }} {{ $mostOrderedProduct['product']->size->alias }} -
                    {{ $mostOrderedProduct->total_quantity }}</p>
            </div>
        @endforeach
    </div>



    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="bg-orange-300 text-center rounded-lg font-bold">
            <h2 class="text-lg mb-4">INVENTORY WASTAGE</h2>
        </div>
        <p>Loss amount: {{ $totalAmountWastage }}</p>
        <p>No of items: {{ $wasteItemsCount }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="bg-orange-300 text-center rounded-lg font-bold">
            <h2 class="text-lg mb-4">FASTEST MOVING INVENTORY ITEMS</h2>
        </div>
        <table class="table-auto w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th>Item</th>
                <th>Times Used</th>
            </thead>
            <tbody>
                @foreach ($fastestMovingItems as $key => $fastestMovingItem)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td>{{ ucwords($key) }}</td>
                        <td class="text-blue-800">{{ $fastestMovingItem }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Livewire Column Chart Card -->
    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Owner') )
    <div class="bg-white rounded-lg shadow-md px-4 pt-6">
        <div class="bg-orange-300 text-center rounded-lg font-bold mt-2>
            <h2 class="text-lg mb-4">SALES</h2>
        </div>
        <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />
    </div>
    @endif

</div>
