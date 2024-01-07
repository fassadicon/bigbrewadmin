<div class="mx-4">
    {{-- Confirm Order Modal --}}
    <livewire:pos.confirm-order />
    <div role="status"
        wire:loading>
        <div class="fixed top-550 bottom-20 right-10 w-full h-full flex items-center justify-center">
            <svg aria-hidden="true"
                class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-amber-600"
                viewBox="0 0 100 101"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
        </div>
        <span class="sr-only">Loading...</span>
    </div>
    <div class="mx-auto w-96 md:mt-2">
        <div class="rounded-3xl bg-white shadow-lg">
            <div class="px-2 py-6">
                <div class="text-center">
                    <p class="text-m text-blue-900 font-bold">CART</p>
                </div>

                <div class="flow-root">
                    <ul class="-my-2">
                        <div class="flex flex-col items-center space-y-2 pt-2">
                            @foreach ($selectedProducts as $key => $selectedProduct)
                                <li class="flex items-stretch space-x-4 py-1 text-left border-b border-gray-300 mt-0">

                                    <!-- Product Information Container -->
                                    <div class="flex-none">
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ ucwords($selectedProduct['product']->productDetail->name) }}
                                        </p>
                                        {{-- <p class="text-xs text-gray-400">
                                        {{ $selectedProduct['product']->productDetail->description }}
                                    </p> --}}
                                        {{-- <p class="text-xs font-semibold text-gray-400">Size:
                                        {{ $selectedProduct['product']->size->name }}
                                    </p> --}}
                                        <p class="text-xs font-semibold text-gray-600">
                                            {{ $selectedProduct['product']->size->name }}
                                        </p>
                                        <p class="text-xs font-semibold text-gray-600">
                                            ₱{{ $selectedProduct['product']->price }}
                                        </p>
                                    </div>

                                    <!-- Add/Remove Quantity Container -->
                                    <div class="flex items-center">
                                        <button wire:click='subtractQuantity({{ $key }})'
                                            class="mr-1 bg-amber-600 hover:bg-amber-800 text-white text-sm font-bold py-1 px-2 h-5 w-5 rounded flex items-center justify-center">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <style>
                                            input::-webkit-outer-spin-button,
                                            input::-webkit-inner-spin-button {
                                                -webkit-appearance: none;
                                                margin: 0;
                                            }
                                        </style>
                                        <input wire:model='selectedProducts.{{ $key }}.quantity'
                                            wire:change='updateQuantity'
                                            wire:keyup='updateQuantity'
                                            type="number"
                                            class="w-10 p-1 border rounded-md text-xs font-semibold text-gray-600"
                                            min="1"
                                            {{-- oninput="this.value = !this.value && Math.abs(this.value) >= 1 ?
                                            Math.abs(this.value) : null" --}}>

                                        <button wire:click='addQuantity({{ $key }})'
                                            class="ml-1 bg-amber-600 hover:bg-amber-800 text-white text-sm font-bold py-1 px-2 h-5 w-5 rounded flex items-center justify-center">
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
                                            <p class="text-xs font-semibold text-gray-600">
                                                Sugar
                                            </p>
                                            {{-- <p class="text-sm font-medium text-gray-900 mr-2">Sugar</p> --}}
                                            <select wire:model.live="selectedProducts.{{ $key }}.sugarLevelId"
                                                name="sugarLevelId"
                                                id="sugarLevelId_{{ $key }}"
                                                class="block w-16 p-1 border rounded-md text-xs font-semibold text-gray-600 ml-2">
                                                @foreach ($sizeSugarLevels as $sizeSugarLevel)
                                                    <option value="{{ $sizeSugarLevel->id }}"
                                                        @selected($sizeSugarLevel->id == $selectedProduct['sugarLevelId'])>
                                                        {{ $sizeSugarLevel->sugarlevel->percentage }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button wire:click="removeItem({{ $loop->index }})"
                                                type="button"
                                                class="flex rounded p-2 text-center text-red-500 transition-all duration-200 ease-in-out focus:shadow hover:text-red-900">
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
                                        @endif
                                    </div>

                                    <!-- Remove Item Container -->
                                    {{-- <div class="ml-1">
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
                                    </div> --}}
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

                <div class="flex-none mt-8 flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">Total</p>
                    <span class="text-xs font-normal text-gray-400">PHP</span>
                    {{ number_format($currentTotalAmount, 2) }}
                    {{-- <input wire:model='currentTotalAmount' type="text" class="text-2xl font-semibold text-gray-900"
                        disabled readonly> --}}
                </div>

                <div class="mt-4 text-center">
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
