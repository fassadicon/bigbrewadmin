
    <header class="h-20 flex items-center px-4 bg-white">
      <button class="p-2 -ml-2 mr-2" @click="isSidebarExpanded = !isSidebarExpanded">
        <svg viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 transform" :class="isSidebarExpanded ? 'rotate-180' : 'rotate-0'">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <line x1="4" y1="6" x2="14" y2="6" />
          <line x1="4" y1="18" x2="14" y2="18" />
          <path d="M4 12h17l-3 -3m0 6l3 -3" />
        </svg>
      </button>
      <span class="font-medium">BigBrew Menu</span>
      @livewire('pos.category')
    </header>
  