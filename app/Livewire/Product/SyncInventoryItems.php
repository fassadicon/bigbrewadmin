<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\InventoryItem;

class SyncInventoryItems extends Component
{
    public $sizes;
    public $all_inventory_items;

    // protected $listeners = ['change-sizes' => '$refresh'];

    #[On('change-sizes')]
    public function updateInventoryItemList($sizes)
    {
        $this->sizes = is_array($sizes) ? $sizes : [];
    }

    public function mount()
    {
        $this->all_inventory_items = InventoryItem::all();
    }

    public function render()
    {
        // dump($this->sizes);
        return view('livewire.product.sync-inventory-items');
    }
}
