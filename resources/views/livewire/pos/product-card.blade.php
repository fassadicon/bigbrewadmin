<div class="flex flex-wrap -mx-2">
    @foreach ($productDetails as $productDetail)
        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 px-2 py-2 mb-4 lg:mb-0 flex">
            <div
                class="bg-white rounded-lg p-2 transform hover:translate-y-1 hover:shadow-xl transition duration-300 shadow-xl flex flex-col flex-1">
                <figure class="mb-2">
                    <img src="{{ $productDetail->image }}"
                        alt=""
                        class="h-16 md:h-24 lg:h-32 ml-auto mr-auto object-cover" />
                </figure>
                <div class="rounded-lg p-2 bg-red-500 flex flex-col flex-1">
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
                                        class="rounded-full bg-red-50 text-red-500 hover:bg-red-200 hover:text-white hover:shadow-xl focus:outline-none w-10 h-10 flex ml-auto transition duration-300"
                                        @disabled($disabled)>
                                        <div class="m-auto">
                                            {{ $size->alias }}
                                        </div>
                                    </button>
                                    PHP {{ $size->pivot->price }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
