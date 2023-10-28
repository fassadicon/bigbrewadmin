<div>
    <x-slot name="header">
        <h2 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit a Product') }}
        </h2>
    </x-slot>

    <div class="flex mx-auto">
        {{-- EditProduct Form --}}
        <form wire:submit="save"
            class="w-full">
            <div class="flex mx-auto">
                {{-- Product Details and Sizes --}}
                <div class="w-4/12">
                    <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Details') }}
                    </h3>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            @csrf
                            <div class="mb-6">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input wire:model="form.name"
                                    type="text"
                                    id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <x-input-error :messages="$errors->get('form.name')"
                                    class="mt-2" />
                            </div>
                            <div class="mb-6">
                                <label for="category_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select wire:model="form.category_id"
                                    id="category_id"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($all_categories as $category)
                                        <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('form.category_id')"
                                    class="mt-2" />
                            </div>
                            <div class="mb-6">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <input wire:model="form.description"
                                    type="text"
                                    id="description"
                                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <x-input-error :messages="$errors->get('form.description')"
                                    class="mt-2" />
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="file_input">Image</label>
                                <input wire:model="form.image"
                                    accept="image/png, image/jpg, image/jpeg, image/svg, image/gif"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help"
                                    id="file_input"
                                    type="file">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                    id="file_input_help">SVG, PNG, JPG or GIF (MAX: 1MB)</p>
                                <img src="{{ is_string($form->image) ? asset('storage\\' . $form->image) : $form->image->temporaryUrl() }}"
                                    alt="">
                                <div wire:loading
                                    wire:target='form.image'>
                                    Uploading
                                </div>
                                <x-input-error :messages="$errors->get('form.image')"
                                    class="mt-2" />
                            </div>


                            <div class="mb-6">
                                <button type="submit"
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- Sizes --}}
                <div class="w-3/12">
                    <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Size and Price') }}
                    </h3>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="grid md:grid-cols-3 md:gap-6">
                            @foreach ($form->product as $key => $data)
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="size_{{ $key }}"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                                    <select wire:model="form.product.{{ $key }}.size_id"
                                        wire:change="changeSizeOrInventoryItem()"
                                        id="size_{{ $key }}"
                                        class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="">-- Select Size --</option>
                                        @foreach ($all_sizes as $size)
                                            <option value="{{ $size->id }}">
                                                {{ ucwords($size->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error("form.product.$key.size_id")
                                        <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    @error('initialBlank')
                                        <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="price_{{ $key }}"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                    <input wire:model="form.product.{{ $key }}.price"
                                        id="price_{{ $key }}"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @error("form.product.$key.price")
                                        <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="relative z-0 w-full mb-2 group">
                                    <button wire:click.prevent="removeSizeAndPrice({{ $key }})"
                                        type="button"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        - </button>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-6">
                            <button wire:click="addSizeAndPrice"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Add Size
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Inventory Item --}}
                <div class="w-5/12">
                    <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Inventory Consumption') }}
                    </h3>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            @csrf
                            @if (empty($form->product) || $form->product[0]['size_id'] === '')
                                <p>Please select sizes to list inventory item consumption</p>
                            @else
                                @foreach ($form->product as $index => $data)
                                    @unless ($data['size_id'] === '')
                                        <div class="mb-2">
                                            <h4 for=""
                                                class="block text-sm font-medium text-gray-900 dark:text-white">
                                                {{ ucwords($all_sizes[$data['size_id'] - 1]->name) }}
                                            </h4>
                                            <button wire:click.prevent="addInventoryItem({{ $index }})"
                                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">+</button>
                                        </div>
                                        <div class="grid md:grid-cols-12 md:gap-6">
                                            @foreach ($data['inventory_consumption'] as $key => $data)
                                                <div class="col-span-7 relative z-0 w-full mb-5 group">
                                                    <label for="inventory_item_{{ $index }}_{{ $key }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inventory
                                                        Item</label>
                                                    <select
                                                        wire:model="form.product.{{ $index }}.inventory_consumption.{{ $key }}.inventory_item_id"
                                                        wire:change="changeSizeOrInventoryItem()"
                                                        id="inventory_item_{{ $index }}_{{ $key }}"
                                                        class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                                        <option value="">-- Select Inventory Item --</option>
                                                        @foreach ($all_inventory_items as $inventory_item)
                                                            <option value="{{ $inventory_item->id }}">
                                                                {{ ucwords($inventory_item->name) . ' (' . ucfirst($inventory_item->measurement) . ')' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error("form.product.$index.inventory_consumption.$key.inventory_item_id")
                                                        <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-span-3 relative z-0 w-full mb-5 group">
                                                    <label for=""
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Consumption
                                                    </label>
                                                    <input
                                                        wire:model="form.product.{{ $index }}.inventory_consumption.{{ $key }}.consumption_value"
                                                        type="text"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    @error("form.product.$index.inventory_consumption.$key.consumption_value")
                                                        <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-span-2 relative z-0 w-full mb-5 group">
                                                    <label for=""
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    </label>
                                                    <button
                                                        wire:click.prevent="removeInventoryItem({{ $index }}, {{ $key }})"
                                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                        - </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endunless
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
