<?php

namespace App\Livewire\InventoryItem;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use App\Livewire\Forms\CreateInventoryItemForm;

class Create extends Component
{
    public CreateInventoryItemForm $createForm;

    public $suppliers;

    public function mount() {
        $this->suppliers = Supplier::select('id', 'name')->get();
    }

    #[On('supplier-created')]
    public function loadSuppliers()
    {
        $this->dispatch('close', 'create-inventory-item');
        $this->suppliers = Supplier::select('id', 'name')->get();
        $this->dispatch('open-modal', 'create-inventory-item');

    }


    public function store()
    {
        $this->createForm->store();

        $this->dispatch('close', 'edit-inventory-item');
        $this->dispatch('inventory-items-changed');
    }
}
