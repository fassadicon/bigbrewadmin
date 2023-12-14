<div>
    <div class="md:flex space-x-3 flex-1 my-4">
        @foreach ($allCategories as $category)
            <button 
                wire:click="selectCategory({{ $category->id }})"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-amber-700 border border-transparent rounded-lg active:bg-amber-800 hover:bg-amber-600 focus:outline-none focus:shadow-outline-gray focus:border-gray-800">
                {{ strtoupper($category->name) }}
            </button>
        @endforeach
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 -mx-2"> 
        {{-- Add this for larger screens: md:grid-cols-3 xl:grid-cols-5 --}}
    @foreach ($productDetails as $productDetail)
        <div class="w-full min-w-max sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 px-2 py-2 mb-4 lg:mb-0 flex">
            <div
                class="bg-white rounded-lg p-2 transform hover:translate-y-1 hover:shadow-xl transition duration-300 shadow-xl flex flex-col flex-1">
                <figure class="mb-2">
                    <img src="{{ $productDetail->image }}"
                        alt=""
                        class="h-16 md:h-24 lg:h-32 ml-auto mr-auto object-cover" />
                </figure>
                <div class="rounded-lg p-2 bg-zinc-800 flex flex-col flex-1">
                    <div>
                        <h5 class="text-white text-sm md:text-base lg:text-lg font-bold leading-tight">
                            {{ $productDetail->name }}
                        </h5>
                        <span
                            class="text-xs md:text-sm text-gray-100 leading-tight">{{ $productDetail->description }}</span>
                    </div>
                    <div class="flex items-center mt-2">
                        <div class="text-xs md:text-sm text-white font-light">

                            <div class="flex space-x-2">
                                @foreach ($productDetail->sizes as $size)
                                    @php
                                        $disabled = false;
                                        $warningValue = false;
                                        foreach ($size->pivot->inventoryItems as $inventoryItem) {
                                            if ($inventoryItem->remaining_stocks <= $inventoryItem->warning_value) {
                                                $warningValue = true;
                                            }
                                            if ($inventoryItem->remaining_stocks <= 0) {
                                                $disabled = true;
                                            }
                                        }
                                    @endphp
                                    {{-- Palagyan conditional styles for warning value and disabled, prio disabled styles if true. Use $warningValue --}}
                                    <button wire:click="addToCart({{ $size->pivot->id }})"
                                        class="rounded-full h-8 w-8 bg-red-50 text-amber-950 hover:bg-amber-50 hover:text-amber-800 hover:shadow-xl focus:outline-none flex ml-auto transition duration-300"
                                        @disabled($disabled)>
                                        <div class="m-auto">
                                            {{ $size->alias }}
                                        </div>
                                    </button>
                                    ₱{{ $size->pivot->price }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- <div x-data="{ showModal: @entangle('showModal') }">
        <div x-show="showModal"
            class="fixed inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- overlay -->
                <div class="fixed inset-0 transition-opacity"
                    aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- modal -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true">&#8203;</span>
                <div x-show="showModal"
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-amber-950"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6-6h12a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8a2 2 0 012-2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900"
                                    id="modal-title">
                                    Oops!
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        {{ $modalMessage }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @click="showModal = false"
                            type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-amber-800 text-base font-medium text-white hover:bg-amber-950 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
</div>
