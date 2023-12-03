<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
    <link rel="preconnect"
    href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
    rel="stylesheet" />

<!-- Flowbite CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css"
    rel="stylesheet" />

    {{-- Fontawesome --}}
    <script src="https://kit.fontawesome.com/3266042309.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="fixed top-0 w-full z-50 bg-white shadow-md">
                <livewire:layout.navigation />
            </div>

            <!-- Page Heading -->

            <main class="flex-1 flex flex-row">

            <div class="flex bg-gray-50 h-auto" x-data="{ isSidebarExpanded: true }">
                {{-- Collapsible Sidebar --}}
                @livewire('layout.sidebar')

                <div x-bind:class="{ 'ml-64': isSidebarExpanded, 'ml-24': !isSidebarExpanded }" class="flex-1 flex flex-col transition-all duration-300 ease-in-out">
                    <div class="flex-1 flex flex-col p-4 mt-16">
                        @livewire('layout.sidebar-collapse')
                    </div>

                    {{ $slot }}
                </div>
                
                
                      
            
                </div>
            </div>

            </main>
            
            
            
        </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/datepicker.min.js"></script>
    </body>
</html>
