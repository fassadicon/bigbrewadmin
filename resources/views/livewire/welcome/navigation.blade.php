{{-- <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
    @auth
        <a href=""
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Dashboard</a>
    @else
        <a href=""
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            wire:navigate>Log in</a> --}}

        {{-- @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Register</a>
        @endif --}}
    {{-- @endauth --}}
{{-- </div> --}}

<div x-data="{ navOpen: false }">
    <button @click="navOpen = true">
      <svg class="cursor-pointer text-gray-700 hover:text-gray-900 w-6 md:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
      </svg>
    </button>
    <div :class="{'hidden': !navOpen}" class="md:block fixed top-0 inset-x-0 bg-white p-8 m-4 z-30 rounded-lg shadow md:rounded-none md:shadow-none md:p-0 md:m-0 md:relative md:bg-transparent">
      <button @click="navOpen = false" class="absolute top-0 right-0 mr-5 mt-5 md:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
          <path d="M18 6L6 18M6 6l12 12"/>
        </svg>
      </button>
      <div class="flex flex-col items-center justify-center md:block">
        @auth
        <a href="{{ url('/dashboard') }}" class="transition-all duration-100 ease-in-out pb-1 border-b-2 text-amber-500 border-transparent hover:border-indigo-300
        hover:text-amber-600 md:mr-8 text-lg md:text-sm font-bold tracking-wide my-4 md:my-0" wire:navigate>
          Dashboard
        </a>
        @else
        <a href ="{{ route('login') }}" class="border border-transparent rounded font-semibold tracking-wide text-lg md:text-sm px-5 py-3 md:py-2
        focus:outline-none focus:shadow-outline bg-amber-600 text-gray-100 hover:bg-amber-800
        hover:text-gray-200 transition-all duration-300 ease-in-out my-4 md:my-0 w-full md:w-auto" wire:navigate>
          Log In
        </a>
        @endauth

      </div>
    </div>
  </div>
