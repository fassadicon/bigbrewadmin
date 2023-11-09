<?php

namespace App\Livewire\InventoryItem;

use Livewire\Component;
use App\Livewire\Forms\CreateInventoryItemForm;

class Create extends Component
{
    public CreateInventoryItemForm $createForm;

    public function store()
    {
        $this->createForm->store();

        $this->dispatch('close', 'edit-inventory-item');
        $this->dispatch('inventory-items-changed');
    }
}
