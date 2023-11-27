<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="fixed top-0 w-full z-50 bg-white shadow-md">
                <livewire:layout.navigation />
            </div>

            <!-- Page Heading -->

            <div class="flex bg-gray-300 h-auto" x-data="{ isSidebarExpanded: false }">
                {{-- Collapsible Sidebar --}}
                @livewire('layout.sidebar')
            
                <div x-bind:class="{ 'ml-64': isSidebarExpanded, 'ml-24': !isSidebarExpanded }" class="flex-1 flex flex-col transition-all duration-300 ease-in-out">
            
                    <div class="flex-1 flex flex-col p-4 mt-16">
                        @livewire('layout.sidebar-collapse')
                    </div>
            
                    <main class="flex-1 flex flex-row">
                        <div class="flex-1 p-4">
                            {{ $slot }}
                        </div>
            
                        @livewire('pos.order-summary', [], ['order' => 2]) 
                    </main>
                </div>
            </div>
            
            
            
        </div>
    </body>
</html>
