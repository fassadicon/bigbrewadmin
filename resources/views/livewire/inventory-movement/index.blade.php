<div class="p-4 max-w-screen">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventory Movement') }}
        </h2>
    </x-slot>

    <livewire:supplier.create />

    @if (auth()->user()->hasRole('Super Admin') ||
            auth()->user()->hasRole('Admin') ||
            auth()->user()->hasRole('Owner'))
        <button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'create-supplier')"
            type="button"
            class="p-2 m-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fas fa-plus-circle mr-2"></i>Create Supplier
        </button>
    @endif

    <button wire:click='generateWastage'
        class="p-2 m-1 px-3 py-1 bg-amber-800 bg-amber-950 text-white rounded ml-8">
        <i class="fas fa-download mr-2"></i>Export Wastage
    </button>



    <div class="flex space-x-6">
        <div class="w-1/2 w-fit">
            <div class="py-12">
                <form wire:submit.prevent="store">
                    @csrf
                    <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight ml-6">
                        {{ __('Add Entry') }}
                    </h3>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                            <div class="flex flex-col">
                                <label for="form_type"
                                    class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                <select wire:model.live="form.type"
                                    id="form_type"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">-- Select type --</option>
                                    <option value="1">In</option>
                                    <option value="2">Out</option>
                                    <option value="3">Waste</option>
                                </select>
                                <x-input-error :messages="$errors->get('form.type')"
                                    class="mt-2" />
                            </div>

                            <div class="flex flex-col">
                                <label for="form_inventory_item"
                                    class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Inventory
                                    Item</label>
                                <select wire:model.live="form.inventory_item_id"
                                    id="form_inventory_item"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value=""></option>
                                    @foreach ($inventoryItems as $inventoryItem)
                                        <option value="{{ $inventoryItem->id }}">{{ $inventoryItem->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('form.inventory_item_id')"
                                    class="mt-2" />
                            </div>

                            <div class="flex flex-col">
                                <label for="form_amount"
                                    class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                <input wire:model="form.amount"
                                    type="text"
                                    id="form_amount"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <x-input-error :messages="$errors->get('form.amount')"
                                    class="mt-2" />
                            </div>

                            <div class="flex flex-col">
                                <label for="form_supplier"
                                    class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                <select wire:model='form.supplier_id'
                                    name="supplier_id"
                                    id="supplier_id"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">--Select Supplier--</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('form.supplier_id')"
                                    class="mt-2" />
                            </div>

                            <div class="flex flex-col">
                                <label for="form_remarks"
                                    class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                <input wire:model="form.remarks"
                                    type="text"
                                    id="form_remarks"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <x-input-error :messages="$errors->get('form.remarks')"
                                    class="mt-2" />
                            </div>

                            <div class="flex">
                                <button type="submit"
                                    class="focus:outline-none text-white bg-red-500 hover:bg-red-200 focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        {{-- Table --}}
        <div class="w-1/2 w-fit">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <h3 class="font-semibold text-m text-gray-800 dark:text-gray-200 leading-tight ml-6">
                            {{ __('Inventory Movements') }}
                        </h3>
                        <button wire:click='export'
                            class="p-2 m-1 px-3 py-1 bg-amber-800 hover:bg-amber-950 text-white rounded ml-8">
                            <i class="fas fa-download mr-2"></i>Export
                        </button>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                            {{-- Search Filters --}}
                            <div class="flex items-center justify-between d p-4">
                                <div class="flex">
                                    <div class="relative w-full">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
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
                                        <input wire:model.live.debounce.500ms='search'
                                            type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                            placeholder="Search product, admin, supplier, message, or remarks"
                                            required="">
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="relative">
                                        <input wire:model='start'
                                            wire:change='changeStartDate($event.target.value)'
                                            id="date_start"
                                            {{-- datepicker datepicker-autohide datepicker-buttons --}}
                                            name="start"
                                            type="date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Select date start">
                                    </div>
                                    <span class="mx-4 text-gray-500">to</span>
                                    <div class="relative">
                                        <input wire:model='end'
                                            wire:change='changeEndDate($event.target.value)'
                                            id="date_end"
                                            {{-- datepicker datepicker-autohide datepicker-buttons --}}
                                            name="end"
                                            type="date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Select date end">
                                    </div>
                                </div>
                                <div class="flex space-x-3">
                                    <div class="flex space-x-3 items-center">
                                        <label class="w-40 text-sm font-medium text-gray-900">type:</label>
                                        <select wire:model.live="type"
                                            class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option value="">All</option>
                                            <option value="In">In</option>
                                            <option value="Out">Out</option>
                                            <option value="Waste">Waste</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- Table Proper --}}
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead>
                                        <th scope="col"
                                            class="px-4 py-3">Inventory Item</th>
                                        <th scope="col"
                                            class="px-4 py-3">Type</th>
                                        <th scope="col"
                                            class="px-4 py-3">Amount</th>
                                        <th scope="col"
                                            class="px-4 py-3">Old Stock</th>
                                        <th scope="col"
                                            class="px-4 py-3">New Stock</th>
                                        <th scope="col"
                                            class="px-4 py-3">Supplier</th>
                                        <th scope="col"
                                            class="px-4 py-3">Action by</th>
                                        <th scope="col"
                                            class="px-4 py-3">Date</th>
                                        <th scope="col"
                                            class="px-4 py-3">
                                            Remarks
                                            {{-- <span class="sr-only">Actions</span> --}}
                                        </th>
                                    </thead>
                                    {{-- wire:loading.class="invisible" --}}
                                    <tbody>
                                        @forelse ($inventoryLogs as $inventoryLog)
                                            <tr wire:key="{{ $inventoryLog->id }}"
                                                class="border-b dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium whitespace-nowrap text-gray-900">
                                                    {{ $inventoryLog->inventoryItem->name }}
                                                    ({{ $inventoryLog->inventoryItem->measurement }})
                                                </th>
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium whitespace-nowrap text-gray-900">
                                                    {{ $inventoryLog->type }}
                                                </th>
                                                <td>{{ $inventoryLog->amount }} </td>
                                                <td>{{ $inventoryLog->old_stock }}</td>
                                                <td>{{ $inventoryLog->new_stock }}</td>
                                                <td>{{ $inventoryLog->supplier->name }}</td>
                                                <td>{{ $inventoryLog->user->name }}</td>
                                                <td>{{ $inventoryLog->created_at }}</td>
                                                <td>{{ $inventoryLog->remarks }}</td>

                                                {{-- <td>
                                                @include('includes.table.deleted_at-td', [
                                                'deleted_at' => $inventoryLog->deleted_at,
                                                ])
                                            </td> --}}
                                                {{-- <td class="px-4 py-3 flex items-center justify-center">
                                                <button wire:click.prevent="show({{ $inventoryItem->id }})"
                                                    class="px-3 py-1 bg-blue-500 text-white rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                                    </svg>
                                                </button>
                                                @unless ($inventoryItem->trashed())
                                                <button wire:click.prevent="edit({{ $inventoryItem }})"
                                                    class="px-3 py-1 bg-green-500 text-white rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </button>
                                                <button wire:click='delete({{ $inventoryItem }})'
                                                    class="px-3 py-1 bg-orange-500 text-white rounded">Archive</button>
                                                @else
                                                <button wire:click='restore({{ $inventoryItem->id }})'
                                                    class="px-3 py-1 bg-green-500 text-white rounded">Restore</button>
                                                @endunless
                                            </td> --}}
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
                                    {{ $inventoryLogs->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    // window.addEventListener("load", function() {
    //     const elStart = document.getElementById("date_start");
    //     elStart.addEventListener("change", (event) => {
    //         @this.set('start', event.target.value);
    //     });
    //     elStart.addEventListener("click", (event) => {
    //         @this.set('start', event.target.value);
    //     });
    //     elStart.addEventListener("blur", (event) => {
    //         @this.set('start', event.target.value);
    //     });

    //     const elEnd = document.getElementById("date_end");
    //     elEnd.addEventListener("change", (event) => {
    //         @this.set('end', event.target.value);
    //     });
    //     elEnd.addEventListener("click", (event) => {
    //         @this.set('end', event.target.value);
    //     });
    //     elEnd.addEventListener("blur", (event) => {
    //         @this.set('end', event.target.value);
    //     });
    // });
</script>
