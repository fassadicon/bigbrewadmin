<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Sidebar extends Component
{
    public $activePage;

    // Livewire lifecycle hooks
    public function mount()
    {
        // Set the initial active page based on the current route
        $this->setActivePage();
    }

    public function render()
    {
        return view('livewire.layout.sidebar');
    }

    private function setActivePage()
    {
        $currentRoute = request()->route()->getName();

        // You may need to adjust this logic based on your route naming conventions
        switch ($currentRoute) {
            case 'dashboard':
                $this->activePage = 'dashboard';
                break;
            case 'pos':
                $this->activePage = 'pos';
                break;
            case 'orders':
                $this->activePage = 'orders';
                break;
            case 'products':
                $this->activePage = 'products';
                break;
            case 'product-categories':
                $this->activePage = 'product-categories';
                break;
            case 'sizes':
                $this->activePage = 'sizes';
                break;
            case 'sugar-levels':
                $this->activePage = 'sugar-levels';
                break;
            case 'inventory-items':
                $this->activePage = 'inventory-items';
                break;
            case 'inventory-movements':
                $this->activePage = 'inventory-movements';
                break;
            case 'purchase-orders':
                $this->activePage = 'purchase-orders';
                break;
            case 'suppliers':
                $this->activePage = 'suppliers';
                break;
            case 'delivery-receives':
                $this->activePage = 'delivery-receives';
                break;
            case 'users':
                $this->activePage = 'users';
                break;
            case 'discounts':
                $this->activePage = 'discounts';
                break;
            // Add more cases for other routes
        }
    }
}
