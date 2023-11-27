<?php

namespace App\Livewire\InventoryItem;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\InventoryItem;
use App\Livewire\Forms\EditInventoryItemForm;
use Livewire\Attributes\Reactive;

class Edit extends Component
{
    public EditInventoryItemForm $editForm;

    #[On('editing-inventory-item')]
    public function fillEditForm(InventoryItem $inventoryItem)
    {
        $this->editForm->loadFields($inventoryItem);
    }

    public function update()
    {
        $this->editForm->update();
        $this->dispatch('close', 'edit-inventory-item');
        $this->dispatch('inventory-items-changed');
    }
}
