<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-4">

    <div class="bg-white rounded-lg shadow-md p-4 hover:transform hover:scale-101 transition-transform duration-300 ease-in-out">
        <h2 class="text-lg font-semibold mb-2">Current Sales Today</h2>
        <p class="text-sm">{{ $currentSalesToday }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 hover:transform hover:scale-101 transition-transform duration-300 ease-in-out">
        <h2 class="text-lg font-semibold mb-2">Pending Purchase Orders Amount</h2>
        <p class="text-sm">{{ $pendingPurchaseOrdersAmount }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 hover:transform hover:scale-101 transition-transform duration-300 ease-in-out">
        <h2 class="text-lg font-semibold mb-2">Purchase Orders Amount</h2>
        <p class="text-sm">{{ $purchaseOrdersAmount }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 hover:transform hover:scale-101 transition-transform duration-300 ease-in-out">
        <h2 class="text-lg font-semibold mb-2">Delivery Receives Amount</h2>
        <p class="text-sm">{{ $deliveryReceivesAmount }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 hover:transform hover:scale-101 transition-transform duration-300 ease-in-out">
        <h2 class="text-lg font-semibold mb-2">Low Inventory Items</h2>
        @foreach ($lowInventoryItems as $lowInventoryItem)
            <p class="text-sm">{{ $lowInventoryItem->name }} {{ $lowInventoryItem->remaining_stocks }}</p>
        @endforeach
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 hover:transform hover:scale-101 transition-transform duration-300 ease-in-out">
        <h2 class="text-lg font-semibold mb-2">Top Sales Products</h2>
        @foreach ($mostOrderedProducts as $mostOrderedProduct)
            <p class="text-sm">{{ $mostOrderedProduct->productDetail->name }} {{ $mostOrderedProduct->order_items_count }}</p>
        @endforeach
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 hover:transform hover:scale-101 transition-transform duration-300 ease-in-out">
        <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />
    </div>
</div>
