<?php

namespace App\Livewire\Layout;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class SidebarCollapse extends Component
{
    public $currentRoute;

    public function mount()
    {
        $this->currentRoute = strtoupper($this->getCurrentRoute());
    }

    public function render()
    {
        return view('livewire.layout.sidebar-collapse');
    }

    private function getCurrentRoute()
    {
        return Route::current()->uri();
    }
}
