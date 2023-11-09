    {{-- Create Modal --}}
    <x-modal name="create-inventory-item">
        <form wire:submit="store">
            @csrf
            <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Inventory Item') }}
            </h3>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                wire:loading.class="invisible">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input wire:model="createForm.name"
                            type="text"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.name')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="measurement"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Measurement</label>
                        <input wire:model="createForm.measurement"
                            type="text"
                            id="measurement"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.measurement')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="remaining_stocks"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Initial Stock
                            Value</label>
                        <input wire:model="createForm.remaining_stocks"
                            type="text"
                            id="remaining_stocks"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.remaining_stocks')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="initial_supplier"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Initial
                            Supplier</label>
                        <input wire:model="createForm.initial_supplier"
                            value="BigBrew"
                            type="text"
                            id="initial_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.initial_supplier')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="warning_value"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Warning Value</label>
                        <input wire:model="createForm.warning_value"
                            type="text"
                            id="warning_value"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.warning_value')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input wire:model="createForm.description"
                            type="text"
                            id="description"
                            class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.description')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <button type="submit"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </x-modal>
