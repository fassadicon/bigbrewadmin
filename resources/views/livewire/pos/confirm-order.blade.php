<x-modal name="confirm-order">
    <form wire:submit="completeOrder">
        @csrf
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
            wire:loading.class='disabled'>
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mb-2">
                    <label for="currentTotalAmount"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Amount</label>
                    <input wire:model="currentTotalAmount"
                        type="text"
                        id="currentTotalAmount"
                        class="bg-gray-50 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 selection:dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 border-transparent focus:border-transparent focus:ring-0"
                        readonly
                        disabled>
                </div>
                <div class="mb-2">
                    <label for="payment.amount"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Final Amount</label>
                    <input wire:model="payment.amount"
                        type="text"
                        id="total_amount"
                        class="bg-gray-50 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 selection:dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 border-transparent focus:border-transparent focus:ring-0"
                        readonly>
                    <x-input-error :messages="$errors->get('payment.amount')"
                        class="mt-2" />
                </div>
                <div class="mb-2">
                    <label for="payment.method"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Payment Method
                        <span class="text-red-500"> * </span>
                    </label>
                    <select wire:model.live='payment.method'
                        name="payment.method"
                        id="method"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-800 focus:border-amber-800 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1"
                            selected>Cash</option>
                        <option value="2">GCash</option>
                    </select>
                    <x-input-error :messages="$errors->get('payment.method')"
                        class="mt-2" />
                </div>
                <div class="mb-2">
                    <label for="payment.payment_received"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment
                        Received<span class="text-red-500"> * </span></label>
                    <input wire:model.live="payment.payment_received"
                        wire:change='updateChange'
                        wire:keyup='updateChange'
                        type="text"
                        id="payment_received"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('payment.payment_received')"
                        class="mt-2" />
                </div>
                <div class="mb-2">
                    <label for="payment.change"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Change</label>
                    <input wire:model.live="payment.change"
                        type="text"
                        id="change"
                        disabled
                        class="bg-gray-50 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 border-transparent focus:border-transparent focus:ring-0">
                    <x-input-error :messages="$errors->get('payment.change')"
                        class="mt-2" />
                </div>
                <div class="mb-2">
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
                    <div class="mb-2">
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
                <div class="mb-4">
                    <label for="discount_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Discount
                    </label>
                    <select wire:model.live='discount_id'
                        wire:change='updateDiscount'
                        name="discount_id"
                        id="method"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-800 focus:border-amber-800 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>No Discount</option>
                        @foreach ($discounts as $discount)
                            <option value="{{ $discount->id }}">
                                {{ $discount->name }}
                                (-{{ $discount->type === 2 ? intval($discount->value) . '%' : '₱' . intval($discount->value) }})
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('discount_id')"
                        class="mt-2" />
                </div>
                <div>
                    <button type="submit"
                        wire:loading.attr="disabled"
                        class="w-full focus:outline-none text-white bg-amber-800 hover:bg-amber-950 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">COMPLETE
                        ORDER</button>
                </div>
            </div>
        </div>
    </form>
</x-modal>
