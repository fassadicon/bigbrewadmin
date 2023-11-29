<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <livewire:order.show />

    {{-- <a href="{{ route('users.create') }}"
        wire:navigate
        type="button"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        {{ __('Create User') }}
    </a> --}}

    <div class="py-12">
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
                                    placeholder="Search order number, admin"
                                    required="">
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="flex space-x-3 items-center">
                                <label class="w-40 text-sm font-medium text-gray-900">Status:</label>
                                <select wire:model.live="status"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="">All</option>
                                    <option value="1">Completed</option>
                                    <option value="2">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- Table Proper --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead>
                                <th scope="col"
                                    class="px-4 py-3">Order #</th>
                                <th scope="col"
                                    class="px-4 py-3">Items</th>
                                <th scope="col"
                                    class="px-4 py-3">Total Amount</th>
                                <th scope="col"
                                    class="px-4 py-3">Payment Method</th>
                                <th scope="col"
                                    class="px-4 py-3">Status</th>
                                <th scope="col"
                                    class="px-4 py-3">Catered By</th>
                                <th scope="col"
                                    class="px-4 py-3">
                                    Actions
                                    {{-- <span class="sr-only">Actions</span> --}}
                                </th>
                            </thead>
                            {{-- wire:loading.class="invisible" --}}
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr wire:key="{{ $order->id }}"
                                        class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium whitespace-nowrap text-gray-900">
                                            {{ $order->id }}
                                        </th>
                                        <td>
                                            @foreach ($order->orderItems as $orderItem)
                                                <div>{{ $orderItem->product->productDetail->name }} x
                                                    {{ $orderItem->quantity }}</div>
                                            @endforeach
                                        </td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{ $order->payment->method === 1 ? 'Cash' : 'Online' }}</td>
                                        <td>{{ $order->status === 1 ? 'Completed' : 'Cancelled' }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        {{-- <td>
                                            @include('includes.table.deleted_at-td', [
                                                'deleted_at' => $order->deleted_at,
                                            ])
                                        </td> --}}
                                        <td class="px-4 py-3 flex items-center justify-center">
                                            <button wire:click.prevent="show({{ $order->id }})"
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
                                            </button>
                                            @unless ($order->trashed())
                                                <button wire:click='delete({{ $order }})'
                                                    class="px-3 py-1 bg-orange-500 text-white rounded">Archive</button>
                                            @else
                                                <button wire:click='restore({{ $order->id }})'
                                                    class="px-3 py-1 bg-green-500 text-white rounded">Restore</button>
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
                            {{ $orders->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
