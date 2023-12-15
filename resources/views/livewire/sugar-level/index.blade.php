<div class="flex w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sugar Levels') }}
        </h2>
    </x-slot>

    {{-- <livewire:sugar-level.show /> --}}
    <livewire:sugar-level.edit />

    <div class="flex-1/3 h-fit bg-white rounded-lg p-4 hover:shadow-xl shadow-xl m-4">
        <form wire:submit="store">
            @csrf
            <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight ml-6">
                {{ __('Create Sugar Level') }}
            </h3>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                wire:loading.class="invisible">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <label for="size_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <select wire:model="form.size_id"
                            id="size_id"
                            class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="">-- Select Size --</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ ucwords($size->name) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('form.size')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="sugar_level_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Measurement</label>
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
                            Value</label>
                        <input wire:model="form.consumption_value"
                            type="text"
                            id="consumption_value"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <x-input-error :messages="$errors->get('form.consumption_value')"
                            class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <button type="submit"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="flex-2/3 w-full bg-white rounded-lg p-4 hover:shadow-xl shadow-xl m-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    {{-- Search Filters --}}
                    <div class="flex items-center justify-between d p-4">
                        <div class="flex">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true"
                                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor"
                                        viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live.debounce.300ms='search'
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                    placeholder="Search name, measurement, or description"
                                    required="">
                            </div>
                        </div>
                        {{-- <div class="flex space-x-3">
                            <div class="flex space-x-3 items-center">
                                <label class="w-40 text-sm font-medium text-gray-900">Status:</label>
                                <select wire:model.live="status"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="">All</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    {{-- Table Proper --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead>
                                {{-- @include('includes.table.sortable-th', [
                                    'displayName' => 'name',
                                    'columnName' => 'name',
                                ])
                                @include('includes.table.sortable-th', [
                                    'displayName' => 'measurement',
                                    'columnName' => 'measurement',
                                ]) --}}
                                <th scope="col"
                                    class="px-4 py-3">Size</th>
                                <th scope="col"
                                    class="px-4 py-3">Percentage</th>
                                <th scope="col"
                                    class="px-4 py-3">Consumption Value</th>
                                <th scope="col"
                                    class="px-4 py-3">
                                    Actions
                                    {{-- <span class="sr-only">Actions</span> --}}
                                </th>
                            </thead>
                            {{-- wire:loading.class="invisible" --}}
                            <tbody>
                                @forelse ($sizeSugarLevels as $sizeSugarLevel)
                                    <tr wire:key="{{ $sizeSugarLevel->id }}"
                                        class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium whitespace-nowrap text-gray-900">
                                            {{ ucwords($sizeSugarLevel->size->name) }}
                                        </th>
                                        <td>{{ $sizeSugarLevel->sugarLevel->percentage }}</td>
                                        <td>{{ $sizeSugarLevel->consumption_value }}</td>
                                        <td class="px-4 py-3 flex items-center justify-center">
                                            {{-- <button wire:click.prevent="show({{ $sizeSugarLevel->id }})"
                                                class="px-3 py-1 bg-blue-500 text-white rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                                </svg>
                                            </button> --}}
                                            {{-- @unless ($sugarLevel->trashed()) --}}
                                            <button wire:click.prevent="edit({{ $sizeSugarLevel }})" class="p-2 m-1 bg-green-500 text-white rounded">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            <button wire:click='delete({{ $sizeSugarLevel }})' class="p-2 m-1 bg-orange-500 text-white rounded">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            
                                            {{-- @else --}}
                                            {{-- <button wire:click='restore({{ $sizeSugarLevel->id }})'
                                                class="px-3 py-1 bg-green-500 text-white rounded">Restore</button> --}}
                                            {{-- @endunless --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="border-b dark:border-gray-700">
                                        <td colspan="6"
                                            class="px-4 py-3 text-center">No results available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="py-4 px-3">
                        <div class="flex ">
                            <div class="flex space-x-4 items-center mb-3">
                                <label class="w-32 text-sm font-medium text-gray-900">Show</label>
                                <select wire:model.live='perPage'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            {{ $sizeSugarLevels->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
