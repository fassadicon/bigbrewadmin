<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
    <a href="{{ route('products.create') }}" wire:navigate type="button"
        class="text-white bg-green-800 hover:bg-green-950 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 ml-4 mb-2 dark:bg-green-500 dark:hover:bg-green-200 focus:outline-none dark:focus:ring-green-800">
        {{ __('Create Product') }}
    </a>
    @endif
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:product.table />
            </div>
        </div>
    </div>


</div>
