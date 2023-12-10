    <aside
        class="fixed h-screen marker:flex flex-col text-gray-900 bg-red-50 transition-all duration-300 ease-in-out shadow-lg"
        :class="isSidebarExpanded ? 'w-64' : 'w-20'">
        <a href="#"
            class="h-20 flex items-center px-4 bg-red-50 hover:text-gray-800 hover:bg-opacity-50 focus:outline-none focus:text-gray-100 focus:bg-opacity-50 overflow-hidden"
            wire:navigate>
            <span class="ml-2 text-xl font-medium duration-300 ease-in-out"
                :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Big Brew</span>
        </a>
        <nav class="p-4 space-y-2 font-medium">
            <a href="{{ route('dashboard') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'dashboard' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-house flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Dashboard</span>
            </a>
            <a href="{{ route('pos') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'pos' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-house flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">POS</span>
            </a>
            <a href="{{ route('orders') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'orders' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-utensils flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Orders</span>
            </a>
            <a href="{{ route('products') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'products' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-brands fa-product-hunt flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Products</span>
            </a>
            <a href="{{ route('product-categories') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'product-categories' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-list flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Categories</span>
            </a>
            <a href="{{ route('sizes') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'sizes' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-bars flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Sizes</span>
            </a>
            <a href="{{ route('sugar-levels') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'sugar-levels' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-turn-up flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Sugar Levels</span>
            </a>
            <a href="{{ route('inventory-items') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'inventory-items' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-warehouse flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Inventory Items</span>
            </a>
            <a href="{{ route('inventory-movements') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'inventory-movements' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-truck flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Inventory Movements</span>
            </a>
            <a href="{{ route('purchase-orders') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'purchase-orders' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-tags flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Purchase Orders</span>
            </a>
            <a href="{{ route('delivery-receives') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'delivery-receives' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                <i class="fa-solid fa-truck-ramp-box flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Delivery Receiving</span>
            </a>
            @can('view-user')
            <a href="{{ route('users') }}"
            class="flex items-center h-10 px-3 {{ $activePage == 'users' ? 'text-white bg-amber-800' : 'hover:bg-amber-800 hover:text-amber-950 hover:bg-opacity-25' }} rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
            wire:navigate>
                    <i class="fa-solid fa-user flex-shrink-0 w-6"></i>
                    <span class="ml-2 duration-300 ease-in-out"
                        :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Users</span>
                </a>
            @endcan



        </nav>
        <div class="border-t border-gray-700 p-4 font-medium mt-auto">
            <a href="#"
                class="flex items-center h-10 px-3 hover:text-amber-950 hover:bg-amber-800 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline"
                wire:navigate>
                <i class="fa-solid fa-gear flex-shrink-0 w-6"></i>
                <span class="ml-2 duration-300 ease-in-out"
                    :class="isSidebarExpanded ? 'opacity-100' : 'opacity-0'">Settings</span>
            </a>
        </div>
    </aside>
