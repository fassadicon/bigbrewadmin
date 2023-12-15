<div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
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
                    placeholder="Search name or description"
                    required="">
            </div>
        </div>
        <div class="flex space-x-3">
            <div class="flex space-x-3 items-center">
                <label class="w-40 text-sm font-medium text-gray-900">Category:</label>
                <select wire:model.live="category"
                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">All</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex space-x-3">
            <div class="flex space-x-3 items-center">
                <label class="w-40 text-sm font-medium text-gray-900">Sizes:</label>
                <select wire:model.live="size"
                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="">All</option>
                    @foreach ($sizes as $size)
                        <option value="{{ $size->name }}">{{ ucwords($size->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex space-x-3">
            <div class="flex space-x-3 items-center">
                <label class="w-40 text-sm font-medium text-gray-900">Status:</label>
                <select wire:model.live="status"
                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="">All</option>
                </select>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead>
                @include('includes.table.sortable-th', [
                    'displayName' => 'name',
                    'columnName' => 'name',
                ])
                {{-- @include('includes.sortable-th', [
                                    'displayName' => 'name',
                                    'columnName' => 'name',
                                ]) --}}
                @include('includes.table.sortable-th', [
                    'displayName' => 'category',
                    'columnName' => 'category_id',
                ])
                <th scope="col"
                    class="px-4 py-3">Sizes</th>
                @include('includes.table.sortable-th', [
                    'displayName' => 'description',
                    'columnName' => 'description',
                ])
                <th scope="col"
                    class="px-4 py-3">Status</th>
                <th scope="col"
                    class="px-4 py-3">
                    Actions
                    {{-- <span class="sr-only">Actions</span> --}}
                </th>
            </thead>
            <tbody wire:loading.class="invisible">
                @if (count($productDetails) < 1)
                    <tr class="border-b dark:border-gray-700">
                        <td colspan="6"
                            class="px-4 py-3 text-center">No results available</td>
                    </tr>
                @else
                    @foreach ($productDetails as $productDetail)
                        <tr wire:key="{{ $productDetail->id }}"
                            class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium whitespace-nowrap text-gray-900">
                                {{ ucwords($productDetail->name) }}
                            </th>
                            <td class="px-4 py-3">
                                {{ ucwords($productDetail->category->name) }}
                            </td>
                            <td class="px-4 py-3">
                                {{ ucwords($productDetail->sizes->pluck('name')->implode(', ')) }}
                            </td>
                            <td class="px-4 py-3">{{ ucfirst($productDetail->description) }}</td>
                            <td>
                                @include('includes.table.deleted_at-td', [
                                    'deleted_at' => $productDetail->deleted_at,
                                ])
                            </td>
                            <td class="px-4 py-3 flex items-center justify-center">
                                {{-- <x-nav-link :href="route('createProduct')"
                            :active="request()->routeIs('product-create')"
                            wire:navigate>
                            {{ __('Create Product') }}
                        </x-nav-link> --}}
                        @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                            <a href="{{ route('products.edit', ['productDetail' => $productDetail]) }}" wire:navigate class="p-2 mx-1 bg-green-500 text-white rounded">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        @endif
                    
                        <a href="{{ route('products.show', ['productDetailId' => $productDetail->id]) }}" wire:navigate class="p-2 mx-1 bg-blue-500 text-white rounded">
                            <i class="fas fa-edit"></i>
                        </a>
                    
                        @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                            @unless ($productDetail->trashed())
                            <button wire:click='delete({{ $productDetail }})' class="p-2 mx-1 bg-orange-500 text-white rounded">
                                <i class="fas fa-archive"></i>
                            </button>
                        @else
                            <button wire:click='restore({{ $productDetail->id }})' class="p-2 mx-1 bg-green-500 text-white rounded">
                                <i class="fas fa-undo"></i>
                            </button>
                            @endunless
                        @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div wire:loading.class="invisible"
        class="py-4 px-3">
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
            {{ $productDetails->links() }}
        </div>

    </div>
</div>
