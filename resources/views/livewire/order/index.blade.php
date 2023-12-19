<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <x-modal name='void-order'>
        <h1>Reason for voiding order:</h1>
        <textarea wire:model='remarks'
            name=""
            id=""
            cols="30"
            rows="10"></textarea>
        <button type="button" wire:click='voidOrder'>Complete Void</button>
    </x-modal>

    {{-- <a href="{{ route('users.create') }}" wire:navigate type="button"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        {{ __('Create User') }}
    </a> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    @if (auth()->user()->hasRole('Owner'))
                        <button wire:click='export'
                            class="p-2 bg-amber-800 hover:bg-amber-950 text-white rounded ml-8 mt-8">Export</button>
                        <livewire:order.show />
                    @endif
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

                        <div class="flex items-center">
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="date_start"
                                    datepicker
                                    datepicker-autohide
                                    datepicker-buttons
                                    name="start"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date start">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="date_end"
                                    datepicker
                                    datepicker-autohide
                                    datepicker-buttons
                                    name="end"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date end">
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
                                @if (auth()->user()->hasRole('Owner'))
                                    <th scope="col"
                                        class="px-4 py-3">Total Amount</th>
                                @endif
                                <th scope="col"
                                    class="px-4 py-3">Method</th>
                                <th scope="col"
                                    class="px-4 py-3">Status</th>
                                <th scope="col"
                                    class="px-4 py-3">Date</th>
                                <th scope="col"
                                    class="px-4 py-3">Customer</th>
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
                                            {{-- @dump($order->orderItems) --}}
                                            @foreach ($order->orderItems as $orderItem)
                                                <div>
                                                    {{ $orderItem->product->productDetail->name }} {{ $orderItem->product->size->alias }} x
                                                    {{ $orderItem->quantity }}
                                                </div>
                                            @endforeach
                                        </td>
                                        @if (auth()->user()->hasRole('Owner'))
                                            <td>{{ $order->total_amount }}</td>
                                        @endif
                                        <td>{{ $order->payment->method }}</td>
                                        <td>{{ $order->status === 1 ? 'Completed' : 'Cancelled' }}</td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        {{-- <td>
                                        @include('includes.table.deleted_at-td', [
                                        'deleted_at' => $order->deleted_at,
                                        ])
                                    </td> --}}
                                        <td class="px-4 py-3 flex items-center justify-center">
                                            <button wire:click.prevent="show({{ $order->id }})"
                                                class="p-2 m-1 bg-blue-500 text-white rounded">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <button wire:click.prevent="downloadReceipt({{ $order->id }})"
                                                class="p-2 m-1 bg-blue-500 text-white rounded">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @if (auth()->user()->hasRole('Owner') ||
                                                    auth()->user()->hasRole('Admin') ||
                                                    auth()->user()->hasRole('Employee'))
                                                @if ($order->status === 1)
                                                    <button
                                                        wire:click.prevent="remarksForVoidOrder({{ $order->id }})"
                                                        class="p-2 m-1 bg-red-500 text-white rounded">
                                                        Void
                                                    </button>
                                                @endif
                                            @endif

                                            @if (auth()->user()->hasRole('Owner') ||
                                                    auth()->user()->hasRole('Admin'))
                                                @unless ($order->trashed())
                                                    <button wire:click='delete({{ $order }})'
                                                        class="p-2 m-1 bg-orange-500 text-white rounded">
                                                        <i class="fas fa-archive"></i>
                                                    </button>
                                                @else
                                                    <button wire:click='restore({{ $order->id }})'
                                                        class="p-2 m-1 bg-green-500 text-white rounded">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                @endunless
                                            @endif

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
<script>
    window.addEventListener("load", function() {
        const elStart = document.getElementById("date_start");
        elStart.addEventListener("change", (event) => {
            @this.set('start', event.target.value);
        });
        elStart.addEventListener("click", (event) => {
            @this.set('start', event.target.value);
        });
        elStart.addEventListener("blur", (event) => {
            @this.set('start', event.target.value);
        });

        const elEnd = document.getElementById("date_end");
        elEnd.addEventListener("change", (event) => {
            @this.set('end', event.target.value);
        });
        elEnd.addEventListener("click", (event) => {
            @this.set('end', event.target.value);
        });
        elEnd.addEventListener("blur", (event) => {
            @this.set('end', event.target.value);
        });
    });
</script>
