<div>
    <form action="">
        @csrf
        @unless ($purchaseOrders)
            <h1>There are no pending Purchase Orders</h1>
        @else
            <select wire:change='selectPurchaseOrder($event.target.value)'
                name="purchase_order_id"
                id="purchase_order_id">
                <option value="">-- Please select Purchase Order --</option>
                @foreach ($purchaseOrders as $purchaseOrder)
                    <option value="{{ $purchaseOrder->id }}">{{ $purchaseOrder->id }}</option>
                @endforeach
            </select>
            @if ($selectedPurchaseOrder)
                <h1>{{ $selectedPurchaseOrder->id }}</h1>
                <h1>{{ $selectedPurchaseOrder->supplier->name }}</h1>
            @endif
            @endif

        </form>
    </div>
