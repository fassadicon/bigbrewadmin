<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
    <a href="{{ route('products.create') }}" wire:navigate type="button"
        class="text-white bg-amber-800 hover:bg-amber-950 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 ml-8 mb-2 dark:bg-red-500 dark:hover:bg-red-200 focus:outline-none dark:focus:ring-blue-800">
        {{ __('Create Product') }}
    </a>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:product.table />
            </div>
        </div>
    </div>


</div>