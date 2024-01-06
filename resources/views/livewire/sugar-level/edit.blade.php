<x-modal name="edit-sugar-level">
    <form wire:submit="update">
        @csrf
        @method('PATCH')
        <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight p-4">
            {{ __('Edit Sugar Level') }}
        </h3>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
            wire:loading.class="invisible">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mb-6">
                    <label for="size_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size<span class="text-red-500"> * </span></label>
                    <select wire:model="form.size_id"
                        id="size_id"
                        class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">-- Select Size --</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ ucwords($size->name) }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('form.size_id')"
                        class="mt-2" />
                </div>
                <div class="mb-6">
                    <label for="sugar_level_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Measurement<span class="text-red-500"> * </span></label>
                    <select wire:model="form.sugar_level_id"
                        id="sugar_level_id"
                        class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="">-- Select Sugar Level --</option>
                        @foreach ($sugarLevels as $sugarLevel)
                            <option value="{{ $sugarLevel->id }}">{{ ucwords($sugarLevel->percentage) }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('form.sugar_level_id')"
                        class="mt-2" />
                </div>
                <div class="mb-6">
                    <label for="consumption_value"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consumption
                        Value<span class="text-red-500"> * </span></label>
                    <input wire:model="form.consumption_value"
                        type="text"
                        id="consumption_value"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('form.consumption_value')"
                        class="mt-2" />
                </div>
                <div class="mb-6">
                    <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Update</button>
                </div>
            </div>
        </div>
    </form>
</x-modal>
