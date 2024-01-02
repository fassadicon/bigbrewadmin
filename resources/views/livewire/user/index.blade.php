<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <livewire:user.edit />
    <livewire:user.show />

    @if (auth()->user()->hasRole('Owner'))
    <a href="{{ route('users.create') }}" wire:navigate type="button"
        class="text-white bg-amber-800 hover:bg-amber-950 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ml-8 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        {{ __('Create User') }}
    </a>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    {{-- Search Filters --}}
                    <div class="flex items-center justify-between d p-4">
                        <div class="flex">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live.debounce.300ms='search' type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                    placeholder="Search name, measurement, or description" required="">
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="flex space-x-3 items-center">
                                <label class="w-40 text-sm font-medium text-gray-900">Role:</label>
                                <select
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="">All</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">SuperAdmin</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="flex space-x-3 items-center">
                                <label class="w-40 text-sm font-medium text-gray-900">Status:</label>
                                <select wire:model.live="status"
                                    class="bg-dark border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="">All</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- Table Proper --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead>
                                <th scope="col" class="px-4 py-3">Name</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Role</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">
                                    Actions
                                    {{-- <span class="sr-only">Actions</span> --}}
                                </th>
                            </thead>
                            {{-- wire:loading.class="invisible" --}}
                            <tbody>
                                @forelse ($users as $user)
                                <tr wire:key="{{ $user->id }}" class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium whitespace-nowrap text-gray-900">
                                        {{ $user->name }}
                                    </th>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles->pluck('name')[0] }}</td>
                                    <td>
                                        @include('includes.table.deleted_at-td', [
                                        'deleted_at' => $user->deleted_at,
                                        ])
                                    </td>
                                    <td class="px-4 py-3 flex items-center justify-center">
                                        <button wire:click.prevent="show({{ $user->id }})"
                                            class="p-2 m-1 px-3 py-1 bg-blue-500 text-white rounded">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        @if (auth()->user()->hasRole('Owner'))
                                            @unless ($user->trashed())
                                                <button wire:click.prevent="edit({{ $user }})"
                                                    class="p-2 m-1 px-3 py-1 bg-green-500 text-white rounded">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                        
                                                <button wire:click='delete({{ $user }})'
                                                    class="p-2 m-1 px-3 py-1 bg-orange-500 text-white rounded">
                                                    <i class="fas fa-archive"></i>
                                                </button>
                                            @else
                                                <button wire:click='restore({{ $user->id }})'
                                                    class="p-2 m-1 px-3 py-1 bg-green-500 text-white rounded">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            @endunless
                                        
                                            <button wire:click='resetPassword({{ $user }})'
                                                class="p-2 m-1 px-3 py-1 bg-yellow-500 text-white rounded">
                                                <i class="fas fa-key"></i>
                                            </button>
                                        @endif
                                        
                                    </td>
                                </tr>
                                @empty
                                <tr class="border-b dark:border-gray-700">
                                    <td colspan="6" class="px-4 py-3 text-center">No results available</td>
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
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>