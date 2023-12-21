<div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Sales Summary Card -->
    @if (auth()->user()->hasRole('Owner'))
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg mb-4">Sales Summary:</h2>
        <div class="flex flex-col">
            <div class="text-sm mb-2 flex items-center hover:text-amber-800">
                <i class="fas fa-calendar-day mr-2 text-amber-700"></i>
                <span class="font-semibold">Current Sales Today:</span> {{ $currentSalesToday }}
            </div>
            <div class="text-sm mb-2 flex items-center hover:text-amber-800">
                <i class="fas fa-calendar-week mr-2 text-amber-700"></i>
                <span class="font-semibold">Current Sales this Week:</span> {{ $currentSalesWeek }}
            </div>
            <div class="text-sm mb-2 flex items-center hover:text-amber-800">
                <i class="fas fa-calendar-alt mr-2 text-amber-700"></i>
                <span class="font-semibold">Current Sales this Month:</span> {{ $currentSalesMonth }}
            </div>
            <div class="text-sm mb-2 flex items-center hover:text-amber-800">
                <i class="fas fa-calendar-alt mr-2 text-amber-700"></i>
                <span class="font-semibold">Current Sales this Year:</span> {{ $currentSalesYear }}
            </div>
            <div class="text-sm mb-2 flex items-center hover:text-amber-800">
                <i class="fas fa-file-invoice-dollar mr-2 text-amber-700"></i>
                <span class="font-semibold">Pending Purchase Orders Amount:</span> {{ $pendingPurchaseOrdersAmount }}
            </div>
            <div class="text-sm mb-2 flex items-center hover:text-amber-800">
                <i class="fas fa-file-invoice-dollar mr-2 text-amber-700"></i>
                <span class="font-semibold">Purchase Orders Amount:</span> {{ $purchaseOrdersAmount }}
            </div>
            <div class="text-sm mb-2 flex items-center hover:text-amber-800">
                <i class="fas fa-truck mr-2 text-amber-700"></i>
                <span class="font-semibold">Delivery Receives Amount:</span> {{ $deliveryReceivesAmount }}
            </div>
        </div>
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
    <div class="bg-white rounded-lg shadow-md p-6 grid grid-cols-2 gap-4">
        <h2 class="text-lg mb-4 col-span-2">Top Sales Products:</h2>
        @foreach ($mostOrderedProducts as $mostOrderedProduct)
            <div class="text-xs mb-2 flex items-center hover:text-amber-800">
                <img src="{{ $mostOrderedProduct->productDetail->image }}" alt="{{ $mostOrderedProduct->productDetail->name }}" class="w-8 h-8 mr-2">
                <span class="font-semibold">{{ $mostOrderedProduct->productDetail->name }} - Order Items Count:</span> {{ $mostOrderedProduct->order_items_count }}
            </div>
        @endforeach
    </div>
    


    <!-- Livewire Column Chart Card -->
    <div class="bg-white rounded-lg shadow-md p-6 col-span-3 md:col-span-2">
        <h2 class="text-lg mb-4">Sales in this week</h2>
        <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />
    </div>

</div>
