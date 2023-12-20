<div>
    <a href="{{ route('purchase-orders.create') }}"
        wire:navigate
        type="button"
        class="text-white bg-amber-800 hover:bg-amber-950 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 ml-8 mb-2 dark:bg-red-500 dark:hover:bg-red-200 focus:outline-none dark:focus:ring-blue-800">
        {{ __('Create Purchase Order') }}
    </a>
    {{-- Table --}}
    <div class="pb-12 pt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    {{-- Search Filters --}}
                    <div class="flex items-center justify-between d p-4">
                        <div class="flex space-x-3">
                            <div class="flex space-x-3 items-center">
                                <label class="w-40 text-sm font-medium text-gray-900">Status:</label>
                                <select wire:model.live="type"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="">All</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Returned">Returned</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="flex space-x-3 items-center">
                                <label class="w-40 text-sm font-medium text-gray-900">Type:</label>
                                <select wire:model.live="status"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">All</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Archived</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- Table Proper --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead>
                                <th scope="col"
                                    class="px-4 py-3">Id</th>
                                <th scope="col"
                                    class="px-4 py-3">Items</th>
                                <th scope="col"
                                    class="px-4 py-3">Supplier</th>
                                <th scope="col"
                                    class="px-4 py-3">Created by</th>
                                <th scope="col"
                                    class="px-4 py-3">Total Amount</th>
                                <th scope="col"
                                    class="px-4 py-3">Status</th>
                                <th scope="col"
                                    class="px-4 py-3">Remarks</th>
                                <th scope="col"
                                    class="px-4 py-3">
                                    Actions
                                    {{-- <span class="sr-only">Actions</span> --}}
                                </th>
                            </thead>
                            {{-- wire:loading.class="invisible" --}}
                            <tbody>
                                @forelse ($purchaseOrders as $purchaseOrder)
                                    <tr wire:key="{{ $purchaseOrder->id }}"
                                        class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium whitespace-nowrap text-gray-900">
                                            {{ $purchaseOrder->id }}
                                        </th>
                                        <td>
                                            @foreach ($purchaseOrder->purchaseOrderItems as $item)
                                                {{ $item->inventoryItem->name }} ({{ $item->quantity }}
                                                {{ $item->unit_measurement }}) - PHP {{ $item->amount }}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ $purchaseOrder->supplier->name }}</td>
                                        <td>{{ $purchaseOrder->user->name }}</td>
                                        <td>{{ $purchaseOrder->total_amount }}</td>
                                        <td>{{ $purchaseOrder->status }}</td>
                                        <td>{{ $purchaseOrder->remarks }}</td>
                                        <td>{{ $purchaseOrder->description }}</td>
                                        <td class="px-4 py-3 flex items-center justify-center">
                                            {{-- <button wire:click.prevent="show({{ $inventoryItem->id }})"
                                            class="px-3 py-1 bg-blue-500 text-white rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                            </svg>
                                        </button> --}}
                                            @unless ($purchaseOrder->trashed())
                                                @if ($purchaseOrder->status == 'Completed')
                                                    <button wire:click='return({{ $purchaseOrder->id }})'
                                                        class="p-2 m-1 px-3 py-1 bg-green-500 text-white rounded">
                                                        Return
                                                    </button>
                                                @endif
                                                @if ($purchaseOrder->status == 'Pending')
                                                    <a href="{{ route('purchase-orders.edit', ['purchaseOrder' => $purchaseOrder]) }}"
                                                        wire:navigate
                                                        class="px-3 py-1 bg-green-500 text-white rounded">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="1.5"
                                                            stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </a>
                                                    <button wire:click='cancel({{ $purchaseOrder->id }})'
                                                        class="p-2 m-1 px-3 py-1 bg-green-500 text-white rounded">
                                                        Cancel
                                                    </button>
                                                    <button wire:click='delete({{ $purchaseOrder }})'
                                                        class="p-2 m-1 px-3 py-1 bg-orange-500 text-white rounded">
                                                        Delete
                                                    </button>
                                                @endif
                                                <button wire:click='printPO({{ $purchaseOrder->id }})'
                                                    class="p-2 m-1 px-3 py-1 bg-yellow-500 text-white rounded">
                                                    Print
                                                </button>
                                            @else
                                                <button wire:click='restore({{ $purchaseOrder->id }})'
                                                    class="p-2 m-1 px-3 py-1 bg-green-500 text-white rounded">
                                                    Restore
                                                </button>
                                            @endunless
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
                            {{ $purchaseOrders->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
