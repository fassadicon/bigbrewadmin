<x-modal name='void-order'>
    <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight p-6">
        {{ __('Void Order') }}
    </h3>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="mb-6">
                <label for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reason for voiding
                    order</label>
                <textarea wire:model="remarks"
                    type="text"
                    id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </textarea>
                <x-input-error :messages="$errors->get('remarks')"
                    class="mt-2" />
            </div>
            <div class="mb-6">
                <button wire:click='voidOrder'
                    type="button"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Complete Void</button>
            </div>
        </div>
    </div>
</x-modal>
