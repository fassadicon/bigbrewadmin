<div>
    <form wire:submit="store">
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

                @foreach ($deliveryReceiveItems as $key => $deliveryReceiveItem)
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="inventory_item_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inventory
                            Item</label>
                        <select wire:model='deliveryReceiveItems.{{ $key }}.inventory_item_id'
                            wire:change='inventoryItemSelected({{ $key }}, $event.target.value)'
                            name="inventory_item_id"
                            id="inventory_item_id{{ $key }}">
                            <option value=""
                                selected>-- Please select an Inventory Item --</option>
                            @foreach ($inventoryItems as $inventoryItem)
                                <option value="{{ $inventoryItem->id }}">
                                    {{ $inventoryItem->name }}
                                    ({{ $inventoryItem->measurement }})
                                    - {{ $inventoryItem->unit_price }}</option>
                            @endforeach
                        </select>
                        @error("deliveryReceiveItems.$key.inventoryItem")
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="expected_quantity_{{ $key }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expected Quantity to be
                            Received</label>
                        <input wire:model="deliveryReceiveItems.{{ $key }}.expected_quantity"
                            wire:change='updateAmount({{ $key }}, $event.target.value)'
                            wire:keyup='updateAmount({{ $key }}, $event.target.value)'
                            id="quantity_{{ $key }}"
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error("deliveryReceiveItems.$key.expected_quantity")
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="quantity_{{ $key }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Received</label>
                        <input wire:model="deliveryReceiveItems.{{ $key }}.quantity"
                            wire:change='updateReceived({{ $key }}, $event.target.value)'
                            wire:keyup='updateReceived({{ $key }}, $event.target.value)'
                            id="quantity_{{ $key }}"
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error("deliveryReceiveItems.$key.quantity")
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="pending_{{ $key }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pending</label>
                        <input wire:model="deliveryReceiveItems.{{ $key }}.pending"
                            id="pending_{{ $key }}"
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error("deliveryReceiveItems.$key.pending")
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="amount_{{ $key }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input wire:model.live="deliveryReceiveItems.{{ $key }}.amount"
                            id="amount_{{ $key }}"
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error("deliveryReceiveItems.$key.amount")
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="description_{{ $key }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input wire:model="deliveryReceiveItems.{{ $key }}.description"
                            id="description_{{ $key }}"
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error("deliveryReceiveItems.$key.description")
                            <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                @endforeach
                <div class="mb-6">
                    <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create
                        Order Receive</button>
                </div>
            @endif
        @endunless
    </form>
</div>
