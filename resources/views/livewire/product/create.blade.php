<div>
    <x-slot name="header">
        <h2 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a Product') }}
        </h2>
    </x-slot>
    {{-- max-w-2xl mx-auto sm:px-6 lg:px-8 --}}

    <div class="flex mx-auto">
        {{-- Product Details and Sizes --}}
        <div class="w-1/3">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form wire:submit="save">
                        @csrf
                        <div class="mb-6">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input wire:model="name"
                                type="text"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-input-error :messages="$errors->get('name')"
                                class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <label for="category_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select wire:model="category_id"
                                id="category_id"
                                class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">-- Select Category --</option>
                                @foreach ($all_categories as $category)
                                    <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')"
                                class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input wire:model="description"
                                type="text"
                                id="description"
                                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        </div>
                        {{-- <div class="mb-6">

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Image</label>
                            <input wire:model="image"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help"
                                id="file_input"
                                type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

                        </div> --}}

                        <div class="grid md:grid-cols-3 md:gap-6">
                            @foreach ($prices as $index => $price)
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="size-{{ $index }}"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                                    {{--  name="sizesAndPrices[{{ $index }}][size_id]" --}}
                                    <select wire:model="sizes.{{ $index }}"
                                        wire:change="changeSize($event.target.value)"
                                        id="size-{{ $index }}"
                                        class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="">-- Select Size --</option>
                                        @foreach ($all_sizes as $size)
                                            <option value="{{ $size->id }}"
                                                {{-- {{ in_array($size->id, $sizes) ? 'disabled' : '' }} --}}
                                                {{-- @selected(in_array($size->id, $sizes)) --}}>
                                                {{ ucwords($size->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('sizes.*')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="price-{{ $index }}"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                    <input wire:model="prices.{{ $index }}"
                                        id="price-{{ $index }}"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @error('prices.*')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="relative z-0 w-full mb-2 group">
                                    <button wire:click.prevent="removeSizeAndPrice({{ $index }})"
                                        type="button"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Remove</button>
                                </div>
                            @endforeach
                            @error('prices')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="mb-6">
                            @unless (count($sizes) === $all_sizes->count())
                                <button wire:click="addSizeAndPrice"
                                    type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Add Size
                                </button>
                            @endunless
                        </div>
                        <div class="mb-6">
                            <button type="submit"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
                            <button wire:click='test'
                                type="button"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">TEST</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Inventory Item --}}
        <div class="w-2/3">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form>
                        @livewire('product.sync-inventory-items', ['sizes' => $sizes])
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
