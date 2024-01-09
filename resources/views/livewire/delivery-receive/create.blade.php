<div class="mx-auto px-4">
    <form wire:submit="store">
        @csrf
        <h1>Purchase Order ID: {{ $selectedPurchaseOrder->id }}</h1>
        <h1>Supplier: {{ $selectedPurchaseOrder->supplier->name }}</h1>
        <div class="flex flex-wrap p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg w-full">
             @foreach ($deliveryReceiveItems as $key => $deliveryReceiveItem)
            <div class="relative z-0 w-full mb-5 group">
                <input wire:model='deliveryReceiveItems.{{ $key }}.inventory_item_id'
                    type="text"
                    readonly
                    hidden>
                @php
                    $inventoryItemName = \App\Models\InventoryItem::where('id', $deliveryReceiveItem['inventory_item_id'])
                        ->pluck('name')
                        ->first();
                @endphp
                <p>Inventory Item: {{ $inventoryItemName }}</p>
                @error("deliveryReceiveItems.$key.inventoryItem")
                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="relative z-0 w-2/12 mb-5 group mx-1">
                <label for="expected_quantity_{{ $key }}"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expected Quantity</label>
                {{-- wire:change='updateAmount({{ $key }},
                    $event.target.value)' --}}
                <input wire:model="deliveryReceiveItems.{{ $key }}.expected_quantity"
                    wire:keyup='updateAmount({{ $key }}, $event.target.value)'
                    id="quantity_{{ $key }}"
                    type="text"
                    class="bg-gray-50 border border-transparent focus:border-transparent focus:ring-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500"
                    readonly>
                @error("deliveryReceiveItems.$key.expected_quantity")
                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="relative z-0 w-2/12 mb-5 group mx-1">
                <label for="quantity_{{ $key }}"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Received<span
                        class="text-red-500"> * </span></label>
                {{--  wire:change='updateReceived({{ $key }}, $event.target.value)' --}}
                <input wire:model="deliveryReceiveItems.{{ $key }}.quantity"
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
            <div class="relative z-0 w-2/12 mb-5 group mx-1">
                <label for="pending_{{ $key }}"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pending</label>
                <input wire:model="deliveryReceiveItems.{{ $key }}.pending"
                    id="pending_{{ $key }}"
                    type="text"
                    class="bg-gray-50 border border-transparent focus:border-transparent focus:ring-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500"
                    readonly>
                @error("deliveryReceiveItems.$key.pending")
                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="relative z-0 w-2/12 mb-5 group mx-1">
                <label for="amount_{{ $key }}"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                <input wire:model.live="deliveryReceiveItems.{{ $key }}.amount"
                    id="amount_{{ $key }}"
                    type="text"
                    class="bg-gray-50 border border-transparent focus:border-transparent focus:ring-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 "
                    readonly>
                @error("deliveryReceiveItems.$key.amount")
                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="relative z-0 w-3/12 mb-5 group mx-1">
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
        </div>


    </form>
</div>
