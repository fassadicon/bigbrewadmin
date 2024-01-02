<div class="mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Confirm Order Modal --}}
    <livewire:pos.confirm-order />

    <div class="mx-auto w-96 md:mt-12">
        <div class="rounded-3xl bg-white shadow-lg">
            <div class="px-4 py-6 sm:px-8 sm:py-10">
                <div class="flow-root">
                    <ul class="-my-8">
                        <div class="flex flex-col items-center space-y-4">
                            @foreach ($selectedProducts as $key => $selectedProduct)
                                <li class="flex items-stretch space-x-4 py-3 text-left border-b border-gray-300">
                                    <!-- Product Information Container -->
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ ucwords($selectedProduct['product']->productDetail->name) }} -
                                            {{ $selectedProduct['product']->size->alias }}
                                        </p>
                                        {{-- <p class="text-xs text-gray-400">
                                        {{ $selectedProduct['product']->productDetail->description }}
                                    </p> --}}
                                        {{-- <p class="text-xs font-semibold text-gray-400">Size:
                                        {{ $selectedProduct['product']->size->name }}
                                    </p> --}}
                                        <p class="text-xs font-semibold text-gray-400">
                                            ₱{{ $selectedProduct['product']->price }}
                                        </p>
                                    </div>

                                    <!-- Add/Remove Quantity Container -->
                                    <div class="flex items-center">
                                        <button wire:click='subtractQuantity({{ $key }})'
                                            class="bg-amber-600 hover:bg-amber-800 text-white text-sm font-bold py-1 px-2 h-5 w-5 rounded flex items-center justify-center">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input wire:model='selectedProducts.{{ $key }}.quantity'
                                            wire:change='updateQuantity'
                                            wire:keyup='updateQuantity'
                                            type="text"
                                            class="text-sm px-2 py-1 w-8 border rounded-md">

                                        <button wire:click='addQuantity({{ $key }})'
                                            class="bg-amber-600 hover:bg-amber-800 text-white text-sm font-bold py-1 px-2 h-5 w-5 rounded flex items-center justify-center">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    <!-- Sugar Level Container -->
                                    <div class="flex items-center">
                                        @php
                                            $sizeSugarLevels = \App\Models\SizeSugarLevel::where('size_id', $selectedProduct['product']->size->id)
                                                ->orderByDesc('id')
                                                ->get();
                                        @endphp
                                        @if ($sizeSugarLevels->count() > 0)
                                            <p class="text-sm font-medium text-gray-900 mr-2">Sugar Level</p>
                                            <select wire:model.live="selectedProducts.{{ $key }}.sugarLevelId"
                                                name="sugarLevelId"
                                                id="sugarLevelId_{{ $key }}"
                                                class="block w-16 p-1 border rounded-md text-sm">
                                                @foreach ($sizeSugarLevels as $sizeSugarLevel)
                                                    <option value="{{ $sizeSugarLevel->id }}"
                                                        @selected($sizeSugarLevel->id == $selectedProduct['sugarLevelId'])>
                                                        {{ $sizeSugarLevel->sugarlevel->percentage }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <!-- Remove Item Container -->
                                    <div class="ml-auto mt-auto">
                                        <button wire:click="removeItem({{ $loop->index }})"
                                            type="button"
                                            class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900">
                                            <svg class="h-5 w-5"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"
                                                    class=""></path>
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </div>





                    </ul>
                </div>

                <!-- <hr class="mx-0 mt-6 mb-0 h-0 border-r-0 border-b-0 border-l-0 border-t border-solid border-gray-300" /> -->

                {{-- <div class="mt-6 space-y-3 border-t border-b py-8">

                    <div class="flex items-center justify-between">
                        <p class="text-gray-400">Subtotal</p>
                        <p class="text-lg font-semibold text-gray-900"></p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-gray-400">Discount</p>
                        <p class="text-lg font-semibold text-gray-900"></p>
                    </div>
                </div> --}}

                <div class="mt-6 flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">Total</p>
                    <span class="text-xs font-normal text-gray-400">PHP</span>
                    {{ number_format($currentTotalAmount, 2) }}
                    {{-- <input wire:model='currentTotalAmount' type="text" class="text-2xl font-semibold text-gray-900"
                        disabled readonly> --}}
                </div>

                <div class="mt-6 text-center">
                    <button wire:click='placeOrder'
                        type="button"
                        class="group inline-flex w-full h-8 items-center justify-center rounded-md bg-amber-700 px-4 py-2 text-sm font-semibold text-white transition-all duration-200 ease-in-out
                        @if (empty($selectedProducts)) opacity-50 cursor-not-allowed @endif"
                        @disabled(empty($selectedProducts))>
                        Place Order
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="group-hover:ml-6 ml-2 h-4 w-4 transition-all"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
