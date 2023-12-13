<x-modal name="create-product-category">
    <form wire:submit="store">
        @csrf
        <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight p-6">
            {{ __('Create Product Category') }}
        </h3>
        <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg rounded-lg p-4 shadow-sm m-4 flex flex-col flex-1"
            wire:loading.class="invisible">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mb-6">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input wire:model="form.name"
                        type="text"
                        id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('form.name')"
                        class="mt-2" />
                </div>
                <div class="mb-6">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <input wire:model="form.description"
                        type="text"
                        id="description"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <x-input-error :messages="$errors->get('form.description')"
                        class="mt-2" />
                </div>
                <div class="">
                    <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>
                    <a href="{{ route('product-categories') }}"
                        class="flex items-center h-10 px-3 hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="fa-solid fa-list flex-shrink-0 w-6"></i>
                        <span class="ml-2 duration-300 ease-in-out"
                            :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Go to Product Categories</span>
                    </a>
                </div>
            </div>
        </div>
    </form>


</x-modal>
