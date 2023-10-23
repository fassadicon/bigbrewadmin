<div>
    @csrf
    @empty($sizes)
        <p>Please select sizes to list inventory item consumption</p>
    @else
        @foreach ($sizes as $index => $size)
            <div class="mb-6">
                <label for=""
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                <input type="text"
                    value="{{ $size }}"
                    class="border-none text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    disabled>
            </div>
            <div class="grid md:grid-cols-3 md:gap-6">

                <div class="relative z-0 w-full mb-5 group">
                    <label for=""
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inventory
                        Item</label>
                    <select id=""
                        class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">-- Select Inventory Item --</option>
                        @foreach ($all_inventory_items as $inventory_item)
                            <option value="{{ $inventory_item->id }}">
                                {{ ucwords($inventory_item->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for=""
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consumption</label>
                    <input type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
        @endforeach
    @endempty
</div>


{{-- @foreach ($sizes as $index => $size)
<div class="mb-6">
    <label for=""
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
    <input type="text"
        value="{{ $size[$index] }}"
        class="border-none text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        disabled>
</div>
<div class="grid md:grid-cols-3 md:gap-6">

    <div class="relative z-0 w-full mb-5 group">
        <label for=""
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inventory
            Item</label>
        <select id=""
            class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            <option value="">-- Select Inventory Item --</option>
            @foreach ($all_inventory_items as $inventory_item)
                <option value="{{ $inventory_item->id }}">
                    {{ ucwords($inventory_item->name) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <label for=""
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consumption</label>
        <input type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>
</div>
@endforeach --}}
