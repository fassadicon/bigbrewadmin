<div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Sales Summary Card -->
    @if (auth()->user()->hasRole('Owner'))
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg mb-4">Sales Summary:</h2>
        <p>Current Sales Today: {{ $currentSalesToday }}</p>
        <p>Pending Purchase Orders Amount: {{ $pendingPurchaseOrdersAmount }}</p>
        <p>Purchase Orders Amount: {{ $purchaseOrdersAmount }}</p>
        <p>Delivery Receives Amount: {{ $deliveryReceivesAmount }}</p>
    </div>
    @endif

    <!-- Low Inventory Items Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg mb-4">Low Inventory Items:</h2>
        @foreach ($lowInventoryItems as $lowInventoryItem)
        <p class="text-sm mb-2">{{ $lowInventoryItem->name }} - Remaining Stocks: {{ $lowInventoryItem->remaining_stocks
            }}</p>
        @endforeach
    </div>

    <!-- Top Sales Products Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg mb-4">Top Sales Products:</h2>
        @foreach ($mostOrderedProducts as $mostOrderedProduct)
        <p class="text-sm mb-2">{{ $mostOrderedProduct->productDetail->name }} - Order Items Count: {{
            $mostOrderedProduct->order_items_count }}</p>
        @endforeach
    </div>

    <!-- Livewire Column Chart Card -->
    <div class="bg-white rounded-lg shadow-md p-6 col-span-3 md:col-span-2">
        <h2 class="text-lg mb-4">Sales in this week</h2>
        <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />
    </div>

</div>