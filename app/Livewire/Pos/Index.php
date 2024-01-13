<?php

namespace App\Livewire\Pos;

use App\Models\InventoryItem;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
    public $inventoryItems;

    public function mount()
    {
        $this->inventoryItems = InventoryItem::select('name', 'warning_value', 'remaining_stocks')->get();
    }

    public function render()
    {
        foreach ($this->inventoryItems as $inventoryItem) {
            if ($inventoryItem->warning_value >= $inventoryItem->remaining_stocks) {
                Toaster::warning('Warning! ' . $inventoryItem->name . ' is running low on stocks!');
            }
            if ($inventoryItem->remaining_stocks <= 0) {
                Toaster::error('Error! ' . $inventoryItem->name . ' is out of stocks!');
            }
        }

        return view('livewire.pos.index');
    }
}
