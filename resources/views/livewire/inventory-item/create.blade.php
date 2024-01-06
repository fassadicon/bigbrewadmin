    {{-- Create Modal --}}
    <x-modal name="create-inventory-item">
        <livewire:supplier.create />

        <form wire:submit="store" class="p-4">
            @csrf
            <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Inventory Item') }}
            </h3>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" wire:loading.class="invisible">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name<span class="text-red-500"> * </span></label>
                        <input wire:model="createForm.name"
                            type="text"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-800 focus:border-amber-800 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.name')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="measurement"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Measurement<span class="text-red-500"> * </span></label>
                        <input wire:model="createForm.measurement"
                            type="text"
                            id="measurement"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-800 focus:border-amber-800 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.measurement')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="remaining_stocks"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Initial Stock
                            Value<span class="text-red-500"> * </span></label>
                        <input wire:model="createForm.remaining_stocks"
                            type="text"
                            id="remaining_stocks"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-800 focus:border-amber-800 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.remaining_stocks')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6 flex space-x-4">
                        <div class="w-1/2">
                            <label for="initial_supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Initial Supplier<span class="text-red-500"> * </span></label>
                            <select wire:model="createForm.initial_supplier" name="supplier_id" id="supplier_id" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-800 focus:border-amber-800 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">-- Please select supplier --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('createForm.initial_supplier')" class="mt-2" />
                        </div>
                        <div class="flex items-end">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-supplier')" type="button" class="text-white bg-amber-800 hover:bg-amber-950 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <i class="fa-solid fa-plus-circle mr-2"></i>
                                Create Supplier
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="warning_value"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Warning Value<span class="text-red-500"> * </span></label>
                        <input wire:model="createForm.warning_value"
                            type="text"
                            id="warning_value"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-800 focus:border-amber-800 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.warning_value')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="unit_price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price<span class="text-red-500"> * </span></label>
                        <input wire:model="createForm.unit_price"
                            type="text"
                            id="unit_price"
                            class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-amber-800 focus:border-amber-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.unit_price')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input wire:model="createForm.description"
                            type="text"
                            id="description"
                            class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-amber-800 focus:border-amber-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('createForm.description')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </x-modal>
