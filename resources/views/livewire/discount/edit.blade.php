<x-modal name="edit-discount">
    <form wire:submit="update">
        @csrf
        @method('PATCH')
        <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight p-4">
            {{ __('Edit Discount') }}
        </h3>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
            wire:loading.class="invisible">
            <div class="p-2 text-gray-900 dark:text-gray-100">
                <div class="mb-2">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name<span
                            class="text-red-500"> * </span></label>
                    <input wire:model="form.name"
                        type="text"
                        id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('form.name')"
                        class="mt-1" />
                </div>
                <div class="mb-2">
                    <label for="type"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type<span
                            class="text-red-500"> * </span></label>
                    <select wire:model="form.type"
                        id="type"
                        class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">-- Select Type --</option>
                        <option value="1">Fixed</option>
                        <option value="2">Percentage</option>
                    </select>
                    <x-input-error :messages="$errors->get('form.type')"
                        class="mt-1" />
                </div>
                <div class="mb-2">
                    <label for="value"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Value<span
                            class="text-red-500"> * </span></label>
                    <input wire:model="form.value"
                        type="text"
                        id="value"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('form.value')"
                        class="mt-1" />
                </div>
                <div class="mb-2">
                    <label for="start_date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date<span class="text-red-500 font-xs"> (Changing is prohibited to prevent discrepancies)</span></label>
                    <input wire:model="form.start_date"
                        type="date"
                        id="start_date"
                        class="block w-full p-4 text-gray-900 border border-red-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:red-blue-500 dark:bg-gray-700 dark:border-red-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-red-500" disabled>
                    <x-input-error :messages="$errors->get('form.start_date')"
                        class="mt-1" />
                </div>
                <div class="mb-2">
                    <label for="end_date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                    <input wire:model="form.end_date"
                        type="date"
                        id="end_date"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('form.end_date')"
                        class="mt-1" />
                </div>
                <div>
                    <button type="submit"
                        class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Update</button>
                </div>
            </div>
        </div>
        <div wire:loading>
            Loading discount...
        </div>
    </form>
</x-modal>
