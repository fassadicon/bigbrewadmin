<div>
    <div class="bg-white rounded-lg px-4">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $productDetail->name }}
            </h2>
        </x-slot>

        <a href="{{ route('products') }}"
            wire:navigate
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mx-4">
            {{ __('Back to Products List') }}
        </a>
       @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
            <a href="{{ route('products.edit', ['productDetail' => $productDetail]) }}"
                wire:navigate
                type="button"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 ml-6">
                {{ __('Edit this product') }}
            </a>
        @endif
    </div>

    <div class="bg-white rounded-lg p-4 flex flex-col flex-1">
        <div class="flex mx-auto w-full">
            {{-- Product Details and Sizes --}}
            <div class="w-4/12 bg-white rounded-lg p-4 hover:shadow-xl shadow-xl m-4 flex flex-col flex-1">
                <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Details') }}
                </h3>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        @csrf
                        <div class="mb-6">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input value={{ $productDetail->name }}
                                type="text"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                disabled>
                        </div>
                        <div class="mb-6">
                            <label for="category_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <input value={{ $productDetail->category->name }}
                                type="text"
                                id="category_id"
                                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                disabled>
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input value={{ $productDetail->description }}
                                type="text"
                                id="description"
                                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                disabled>
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Image</label>
                            <img src="{{ asset('storage\\' . $productDetail->image) }}"
                                alt="">
                            <div wire:loading
                                wire:target='form.image'>
                                Loading
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Sizes --}}
            <div class="w-3/12 bg-white rounded-lg p-4 hover:shadow-xl shadow-xl m-4 flex flex-col flex-1">
                <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Size and Price') }}
                </h3>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid md:grid-cols-2 md:gap-6">
                        @foreach ($productDetail->sizes as $size)
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="size_{{ $size->id }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                                <input value="{{ $size->name }}"
                                    id="size{{ $size->id }}"
                                    type="text"
                                    disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="price_{{ $size->id }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input value="{{ $size->pivot->price }}"
                                    id="price_{{ $size->id }}"
                                    type="text"
                                    disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- Inventory Item --}}
            <div class="w-5/12 bg-white rounded-lg p-4 hover:shadow-xl shadow-xl m-4 flex flex-col flex-1">
                <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Inventory Consumption') }}
                </h3>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @foreach ($productDetail->sizes as $index => $size)
                            <div class="mb-2">
                                <h4 for=""
                                    class="block text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $size->name }}
                                </h4>
                            </div>
                            <div class="grid md:grid-cols-12 md:gap-6">
                                @foreach ($size->pivot->inventoryItems as $key => $inventoryItem)
                                    <div class="col-span-7 relative z-0 w-full mb-5 group">
                                        <label for="inventory_item_{{ $index }}_{{ $key }}"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inventory
                                            Item</label>
                                        <input value="{{ $inventoryItem->name }}"
                                            id="inventory_item_{{ $index }}_{{ $key }}"
                                            disabled
                                            type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-3 relative z-0 w-full mb-5 group">
                                        <label
                                            for="consumption_value_{{ $index }}_{{ $key }}
                                            class="block
                                            mb-2
                                            text-sm
                                            font-medium
                                            text-gray-900
                                            dark:text-white">
                                            Consumption
                                        </label>
                                        <input value="{{ $inventoryItem->pivot->consumption_value }}"
                                            id="consumption_value_{{ $index }}_{{ $key }}"
                                            disabled
                                            type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-2 relative z-0 w-full mb-5 group">
                                        <label for=""
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-lg p-4 hover:shadow-xl shadow-xl m-4 flex flex-col flex-1">
        <table>
            <thead>
                <th>Log</th>
                <th>Current</th>
                <th>Old</th>
                <th>Date</th>
                <th>Activity by</th>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->description }}</td>
                        <td>
                            @foreach ($log->properties as $key => $value)
                                @if ($key === 'attributes')
                                    @foreach ($value as $key => $data)
                                        {{ "$key: $data\n" }}<br>
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($log->properties as $key => $value)
                                @if ($key === 'old')
                                    @foreach ($value as $key => $data)
                                        {{ "$key: $data" }}<br>
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $log->created_at->format('M d, Y') }}</td>
                        <td>
                            @if ($log->causer)
                                {{ $log->causer->name }}
                            @else
                                System generated
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</div>
