<?php

namespace App\Livewire\Pos;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Discount;
use App\Models\InventoryItem;
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
        $all_discounts = Discount::all();
        foreach ($all_discounts as $discount) {
            if ($discount->end_date !== null) {
                if (Carbon::parse($discount->end_date)->lt(Carbon::today())) {
                    $discount->update(['status' => 2]);
                }
            }
        }

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
