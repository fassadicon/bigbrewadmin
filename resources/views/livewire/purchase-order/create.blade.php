<div>
    <div class="flex mx-auto px-4">
        <button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'create-supplier')"
            type="button"
            class="text-white bg-blue-800 hover:bg-blue-950 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Create Supplier
        </button>
    </div>

    <livewire:supplier.create />

    <div class="mx-auto px-4">
        <form wire:submit="store">
            @csrf
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg w-full">
                <div class="flex flex-wrap p-6 text-gray-900 dark:text-gray-100">
                    <div class="w-3/12 mb-6">
                        <label for="supplier_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier<span
                                class="text-red-500"> * </span></label>
                        <select wire:model.live='supplier_id'
                            name="supplier_id"
                            id="supplier_id"
                            class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">-- Please select supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('supplier_id')"
                            class="mt-2" />
                    </div>
                    <div class="w-full flex flex-wrap">
                        @foreach ($purchaseOrderItems as $key => $purchaseOrderItem)
                            <div class="w-4/12 relative z-0 mb-5 group mx-1">
                                <label for="inventory_item_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inventory
                                    Item<span class="text-red-500"> * </span></label>
                                <select wire:model='purchaseOrderItems.{{ $key }}.inventory_item_id'
                                    wire:change='inventoryItemSelected({{ $key }}, $event.target.value)'
                                    name="inventory_item_id"
                                    id="inventory_item_id{{ $key }}"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value=""
                                        selected>-- Please select an Inventory Item --</option>
                                    @foreach ($inventoryItems as $inventoryItem)
                                        <option value="{{ $inventoryItem->id }}">
                                            {{ $inventoryItem->name }}
                                            ({{ $inventoryItem->measurement }})
                                            - {{ $inventoryItem->unit_price }}</option>
                                    @endforeach
                                </select>
                                @error("purchaseOrderItems.$key.inventoryItem")
                                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="w-1/12 relative z-0 mb-5 group mx-1">
                                <label for="quantity_{{ $key }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity<span
                                        class="text-red-500"> * </span></label>
                                <input wire:model="purchaseOrderItems.{{ $key }}.quantity"
                                    wire:change='updateAmount({{ $key }}, $event.target.value)'
                                    wire:keyup='updateAmount({{ $key }}, $event.target.value)'
                                    id="quantity_{{ $key }}"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error("purchaseOrderItems.$key.quantity")
                                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="w-2/12 relative z-0 mb-5 group mx-1">
                                <label for="amount_{{ $key }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                                <input wire:model.live="purchaseOrderItems.{{ $key }}.amount"
                                    id="amount_{{ $key }}"
                                    type="text"
                                    class="bg-gray-50 border border-transparent focus:border-transparent focus:ring-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 "
                                    readonly>
                                @error("purchaseOrderItems.$key.amount")
                                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="w-4/12 relative z-0 mb-5 group mx-1">
                                <label for="description_{{ $key }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <input wire:model="purchaseOrderItems.{{ $key }}.description"
                                    id="description_{{ $key }}"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error("purchaseOrderItems.$key.description")
                                    <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                @if (count($purchaseOrderItems) > 1)
                                    <button wire:click='removePurchaseOrderItem({{ $key }})'
                                        type="button"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">-
                                    </button>
                                @endif
                            </div>
                        @endforeach


                    </div>
                    <div class="w-10/12">
                        <button wire:click='addPurchaseOrderItem'
                            type="button"
                            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+</button>
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create
                            Purchase Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
