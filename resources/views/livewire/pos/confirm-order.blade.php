<x-modal name="confirm-order">
    <form wire:submit="completeOrder" >
        @csrf
        <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight p-6">
            {{ __('Complete Purchase') }}
        </h3>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" wire:loading.class='disabled'>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mb-6">
                    <label for="payment.amount"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Amount</label>
                    <input wire:model="payment.amount"
                        type="text"
                        id="total_amount"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        readonly>
                    <x-input-error :messages="$errors->get('payment.amount')"
                        class="mt-2" />
                </div>
                <div class="mb-6">
                    <label for="payment.method"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Method</label>
                    <select wire:model.live='payment.method'
                        name=""
                        id="method">
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
                        id="payment_received"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('payment.payment_received')"
                        class="mt-2" />
                </div>
                <div class="mb-6">
                    <label for="payment.change"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Change</label>
                    <input wire:model.live="payment.change"
                        type="text"
                        id="change"
                        disabled
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('payment.change')"
                        class="mt-2" />
                </div>
                <div class="mb-6">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input wire:model="name"
                        type="text"
                        id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('name')"
                        class="mt-2" />
                </div>
                @if ($payment['method'] == 2)
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
                @endif
                <div class="mb-6">
                    <button type="submit"
                        wire:loading.attr="disabled"
                        class="focus:outline-none text-white bg-amber-800 hover:bg-amber-950 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Complete
                        Order</button>
                </div>
            </div>
        </div>
    </form>
    {{-- <div role="status" wire:loading>
        <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-amber-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
        </div>
        <span class="sr-only">Loading...</span>
    </div> --}}
</x-modal>
