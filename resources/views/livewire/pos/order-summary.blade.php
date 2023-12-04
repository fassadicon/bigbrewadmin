<div class="mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Confirm Order Modal --}}
    <x-modal name="confirm-order">
        <form wire:submit="completeOrder">
            @csrf
            <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight p-6">
                {{ __('Complete Purchase') }}
            </h3>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <label for="payment.amount"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Amount</label>
                        <input wire:model="payment.amount"
                            type="text"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('payment.amount')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="payment.method"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                        <select wire:model='payment.method'
                            name=""
                            id="">
                            <option value="1"
                                selected>Cash</option>
                            <option value="2">GCash</option>
                        </select>
                        <x-input-error :messages="$errors->get('payment.method')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="payment.payment_received"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment
                            Received</label>
                        <input wire:model.live="payment.payment_received"
                            wire:change='updateChange'
                            wire:keyup='updateChange'
                            type="text"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('payment.payment_received')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="payment.change"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Change</label>
                        <input wire:model.live="payment.change"
                            type="text"
                            id="name"
                            disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('payment.change')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="payment.details"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Details/Reference
                            Number (if any)</label>
                        <input wire:model="payment.details"
                            type="text"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('payment.details')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <button type="submit"
                            wire:loading.attr="disabled"
                            class="focus:outline-none text-white bg-amber-800 hover:bg-amber-950 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Complete
                            Order</button>
                    </div>
                </div>
            </div>
            {{-- <div wire:loading>
                Loading product size...
            </div> --}}
        </form>
    </x-modal>

    <div class="mx-auto w-80 md:mt-12">
        <div class="rounded-3xl bg-white shadow-lg">
            <div class="px-4 py-6 sm:px-8 sm:py-10">
                <div class="flow-root">
                    <ul class="-my-8">
                        @foreach ($selectedProducts as $key => $selectedProduct)
                            <li class="flex flex-col space-y-3 py-4 text-left sm:flex-row sm:space-x-5 sm:space-y-0">
                                <div class="shrink-0 relative">
                                    <span
                                        class="absolute top-1 left-1 flex h-6 w-6 items-center justify-center rounded-full border bg-white text-sm font-medium text-gray-500 shadow sm:-top-2 sm:-right-2">{{ $loop->index + 1 }}</span>
                                    <img class="h-24 w-24 max-w-full rounded-lg object-cover"
                                        src="{{ $selectedProduct['product']->productDetail->image }}"
                                        alt="{{ $selectedProduct['product']->productDetail->name }}" />
                                </div>

                                <div class="flex-1">
                                    <div class="relative flex flex-1 flex-col justify-between">
                                        <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
                                            <div class="pr-8 sm:pr-5">
                                                <p class="text-sm font-semibold text-gray-900">
                                                    {{ $selectedProduct['product']->productDetail->name }}
                                                </p>
                                                <p class="mx-0 mt-1 mb-0 text-xs text-gray-400">
                                                    {{ $selectedProduct['product']->productDetail->description }}
                                                </p>
                                                <p class="text-xs font-semibold text-gray-900">Size:
                                                    {{ $selectedProduct['product']->size->name }}
                                                </p>
                                                <p class="text-xs font-semibold text-gray-900">
                                                    ₱{{ $selectedProduct['product']->price }}
                                                </p>
                                            </div>
                                        </div>
                                
                                        <div class="mt-4 grid grid-cols-3 gap-4">
                                            <div class="flex items-center">
                                                <button wire:click='subtractQuantity({{ $key }})'
                                                    class="bg-amber-600 hover:bg-amber-800 text-white text-sm font-bold py-2 px-4 h-6 w-6 rounded">-</button>
                                            
                                                <p class="text-base px-6">{{ $selectedProduct['quantity'] }}</p>
                                            
                                                <button wire:click='addQuantity({{ $key }})'
                                                    class="bg-amber-600 hover:bg-amber-800 text-white text-sm font-bold py-2 px-4 h-6 w-6 rounded">+</button>
                                            </div>
                                            
                                        </div>
                                
                                        <div class="mt-4">
                                         <div class="mt-6 flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900">Sugar Level</p>
                                            @php
                                                $sizeSugarLevels = \App\Models\SizeSugarLevel::where('size_id', $selectedProduct['product']->size->id)
                                                    ->orderByDesc('id')
                                                    ->get();
                                            @endphp
                                            <select wire:model.live="selectedProducts.{{ $key }}.sugarLevelId" name="sugarLevelId" id="sugarLevelId_{{ $key }}" class="block w-32 p-2 border rounded-md">
                                                @foreach ($sizeSugarLevels as $sizeSugarLevel)
                                                    <option value="{{ $sizeSugarLevel->id }}" @selected($sizeSugarLevel->id == $selectedProduct['sugarLevelId'])>
                                                        {{ $sizeSugarLevel->sugarlevel->percentage }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="ml-auto">
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
                    {{-- <input wire:model='currentTotalAmount'
                        type="text"
                        class="text-2xl font-semibold text-gray-900"
                        disabled
                        readonly> --}}
                </div>

                {{-- Pa blur if walang laman cart --}}
                <div class="mt-6 text-center">
                    <button wire:click='placeOrder'
                        type="button"
                        class="group inline-flex w-full items-center justify-center rounded-md bg-amber-800 px-6 py-4 text-lg font-semibold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-amber-50 hover:text-amber-950"
                        @disabled(empty($selectedProducts))>
                        Place Order
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="group-hover:ml-8 ml-4 h-6 w-6 transition-all"
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
