<div>
    <div class="md:flex space-x-3 flex-1 lg:ml-8">
        <button wire:click="selectCategory('')"
            class="px-3 py-2 text-xs w-16 font-medium leading-5 text-white transition-colors duration-150 bg-amber-600 border border-transparent rounded-lg active:bg-amber-800 hover:bg-amber-600 focus:outline-none focus:shadow-outline-gray focus:border-gray-800">All</button>
        @foreach ($allCategories as $category)
            <button wire:click="selectCategory({{ $category->id }})"
                class="px-3 py-2 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-amber-700 border border-transparent rounded-lg active:bg-amber-800 hover:bg-amber-600 focus:outline-none focus:shadow-outline-gray focus:border-gray-800">
                {{ strtoupper($category->name) }}
            </button>
        @endforeach
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 -mx-2">
        @foreach ($productDetails as $productDetail)
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 px-2 py-2 mb-4 lg:mb-0 flex" wire:loading.delay.long.class='invisible'>
                <div
                    class="bg-white rounded-lg p-2 transform hover:translate-y-1 hover:shadow-xl transition duration-300 shadow-xl flex flex-col flex-1">
                    <figure class="mb-2">
                        <img src="{{ asset('storage\\' . $productDetail->image_path) }}"
                            alt=""
                            class="h-16 w-full md:h-24 lg:h-32 ml-auto mr-auto object-cover" />
                    </figure>
                    <div class="rounded-lg p-2 bg-zinc-800 flex flex-col flex-1">
                        <div>
                            <h5 class="text-white text-xxs md:text-xs lg:text-sm font-bold leading-tight">
                                {{ ucwords($productDetail->name) }}
                            </h5>
                            {{-- <span class="text-xxs md:text-xs text-gray-100 leading-tight">
                                {{ $productDetail->description }}
                            </span> --}}
                        </div>
                        <div class="flex items-center mt-2">
                            <div class="text-xxs md:text-xs text-white font-light">
                                <div class="flex space-x-2">
                                    @foreach ($productDetail->sizes as $size)
                                        @php
                                            $disabled = false;
                                            $warningValue = false;
                                            foreach ($size->pivot->inventoryItems as $inventoryItem) {
                                                if ($inventoryItem->remaining_stocks <= $inventoryItem->warning_value) {
                                                    $warningValue = true;
                                                }
                                                if ($inventoryItem->remaining_stocks <= 0 || $inventoryItem->trashed()) {
                                                    $disabled = true;
                                                }
                                            }
                                        @endphp
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
                        @if ($disabled || $warningValue)
                            <div class="flex items-center mt-2">
                                @if ($disabled)
                                    <div
                                        class="px-3 py-2 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-red-700 border border-transparent rounded-lg active:bg-red-800 hover:bg-red-600 focus:outline-none focus:shadow-outline-gray focus:border-gray-800">
                                        OUT OF STOCK
                                    </div>
                                @endif
                                @if ($warningValue && !$disabled)
                                    <div
                                        class="px-3 py-2 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-amber-700 border border-transparent rounded-lg active:bg-amber-800 hover:bg-amber-600 focus:outline-none focus:shadow-outline-gray focus:border-gray-800">
                                        WARNING
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div role="status" wire:loading>
        <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-500 bg-opacity-50">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-amber-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
        </div>
        <span class="sr-only">Loading...</span>
    </div>
</div>
