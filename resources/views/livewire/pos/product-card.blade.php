<div class="flex flex-wrap -mx-2">
    @for ($i = 0; $i < count($productDetails); $i++)
        @php
            $productDetail = $productDetails[$i];
            $product = $products[$i];
            $sizes = $productDetail->sizes; // Assuming the sizes relationship is defined in ProductDetail model
        @endphp

        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 px-2 py-2 mb-4 lg:mb-0 flex">
            <div class="bg-white rounded-lg p-2 transform hover:translate-y-1 hover:shadow-xl transition duration-300 shadow-xl flex flex-col flex-1">
                <figure class="mb-2">
                    <img src="{{ $productDetail->image }}" alt="" class="h-16 md:h-24 lg:h-32 ml-auto mr-auto object-cover" />
                </figure>
                <div class="rounded-lg p-2 bg-red-500 flex flex-col flex-1">
                    <div>
                        <h5 class="text-white text-sm md:text-base lg:text-lg font-bold leading-tight">
                            {{ $productDetail->name }}
                        </h5>
                        <span class="text-xs md:text-sm text-gray-100 leading-tight">{{ $productDetail->description }}</span>
                    </div>
                    <div class="flex items-center mt-2">
                        <div class="text-xs md:text-sm text-white font-light">
                            PHP{{ $product->price }}

                            <div class="flex space-x-2">
                                @foreach ($sizes as $size)
                                @php
                                $sizeAlias = '';
                                switch ($size->name) {
                                    case 'small':
                                        $sizeAlias = 'S';
                                        break;
                                    case 'medium':
                                        $sizeAlias = 'M';
                                        break;
                                    case 'large':
                                        $sizeAlias = 'L';
                                        break;
                                    case 'fixed':
                                        $sizeAlias = 'F';
                                        break;
                                    // Add more cases as needed for other sizes
                                    default:
                                        $sizeAlias = $size->name; // Use the actual size name if no alias is defined
                                        break;
                                }
                                @endphp
                                    <button
                                        wire:click="addToCart({{ $productDetail->id }}, '{{ $size->name }}')"
                                        class="rounded-full bg-red-50 text-red-500 hover:bg-red-200 hover:text-white hover:shadow-xl focus:outline-none w-10 h-10 flex ml-auto transition duration-300"
                                    >
                                    <div class="m-auto">
                                    {{ $sizeAlias }}
                                </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>

               
                        

                        {{-- <button wire:click="addToCart({{ $productDetail->id }})" class="rounded-full bg-red-50 text-red-500 hover:bg-red-200 hover:text-white hover:shadow-xl focus:outline-none w-10 h-10 flex ml-auto transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-current m-auto">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    @endfor
</div>
