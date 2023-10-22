<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form wire:submit="updateProduct">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input wire:model.defer="name"
                                type="text"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-input-error :messages="$errors->get('name')"
                                class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select wire:model.defer="category"
                                id="category"
                                class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">-- Select Category --</option>
                                @foreach ($all_categories as $productCategory)
                                    <option value="{{ $productCategory->id }}"
                                        {{ $productCategory->id === $category ? 'selected' : '' }}>
                                        {{ ucwords($productCategory->name) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')"
                                class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input wire:model.defer="description"
                                type="text"
                                id="description"
                                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="grid md:grid-cols-3 md:gap-6">
                            @foreach ($prices as $index => $price)
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="size-{{ $index }}"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                                    <select wire:model="sizes.{{ $index }}"
                                        id="size-{{ $index }}"
                                        class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="">-- Select Size --</option>
                                        @foreach ($all_sizes as $size)
                                            @if ($sizes[$index])
                                                <option value="{{ $size->id }}"
                                                    @selected($sizes[$index] && $size->id == $sizes[$index])>
                                                    {{ ucwords($size->name) }}
                                                </option>
                                            @else
                                                <option value="{{ $size->id }}">
                                                    {{ ucwords($size->name) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($error = $this->getErrorMessageForIndex('sizes', $index))
                                        <span class="text-red-500 text-sm">{{ $error }}</span>
                                    @endif
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="price-{{ $index }}"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                    <input wire:model="prices.{{ $index }}"
                                        value="{{ $price }}"
                                        id="price-{{ $index }}"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @if ($error = $this->getErrorMessageForIndex('prices', $index))
                                        <span class="text-red-500 text-sm">{{ $error }}</span>
                                    @endif

                                </div>
                                <div class="relative z-0 w-full mb-2 group">
                                    <button wire:click.prevent="removeSizeAndPrice({{ $index }})"
                                        type="button"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Remove</button>
                                </div>
                            @endforeach
                            {{-- @error
                                {{ $errors->all }}
                            @enderror --}}
                            {{-- @if ($errors->any())
                            {!! dd($errors) !!}
                        @endif --}}
                        </div>
                        <div class="mb-6">
                            <button wire:click="addSizeAndPrice"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Add Size
                            </button>
                        </div>
                        <div class="mb-6">
                            <button type="submit"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
