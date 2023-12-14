<div>
    <h1>Dashboard</h1>
    @if(auth()->user()->hasRole('Super Admin'))
        <h1>currentSalesToday: {{ $currentSalesToday }}</h1>
        <h1>pendingPurchaseOrdersAmount: {{ $pendingPurchaseOrdersAmount }}</h1>
        <h1>purchaseOrdersAmount: {{ $purchaseOrdersAmount }}</h1>
        <h1>deliveryReceivesAmount : {{ $deliveryReceivesAmount }}</h1>
    @endif
    <h1>Low inventory items:</h1>
    @foreach ($lowInventoryItems as $lowInventoryItem)
        <h2>{{ $lowInventoryItem->name }} {{ $lowInventoryItem->remaining_stocks }}</h2>
    @endforeach
    <h1>Top sales products:</h1>
    @foreach ($mostOrderedProducts as $mostOrderedProduct)
        <h2>{{ $mostOrderedProduct->productDetail->name }} {{ $mostOrderedProduct->order_items_count }}</h2>
    @endforeach
    <livewire:livewire-column-chart {{-- key="{{ $columnChartModel->reactiveKey() }}" --}}
        :column-chart-model="$columnChartModel" />
</div>
