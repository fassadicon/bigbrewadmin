<div class="flex flex-wrap -mx-2">
  @foreach ($products as $product)
      <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 px-2 py-2 mb-4 lg:mb-0 flex">
          <div class="bg-white rounded-lg p-2 transform hover:translate-y-2 hover:shadow-xl transition duration-300 flex flex-col flex-1">
              <figure class="mb-2">
                  <img src="{{ $product->image }}" alt="" class="h-16 md:h-24 lg:h-32 ml-auto mr-auto object-cover" />
              </figure>
              <div class="rounded-lg p-2 bg-orange-950 flex flex-col flex-1">
                  <div>
                      <h5 class="text-white text-base md:text-lg lg:text-xl font-bold leading-tight">
                          {{ $product->name }}
                      </h5>
                      <span class="text-xs md:text-sm text-gray-400 leading-tight">{{ $product->description }}</span>
                  </div>
                  <div class="flex items-center mt-2">
                      <div class="text-sm md:text-base text-white font-light">
                          PHP{{ $product->price }}
                      </div>
                      <button wire:click="addToCart({{ $product->id }})" class="rounded-full bg-orange-300 text-orange-950 hover:bg-white hover:text-purple-900 hover:shadow-xl focus:outline-none w-10 h-10 flex ml-auto transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-current m-auto">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button>
                  </div>
              </div>
          </div>
      </div>
  @endforeach
</div>
