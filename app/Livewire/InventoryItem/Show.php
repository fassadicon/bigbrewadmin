<?php

namespace App\Livewire\InventoryItem;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\InventoryItem;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public InventoryItem $inventoryItem;
    public $logs;
    public $products;

    #[On('showing-inventory-item')]
    public function fillShow(int $id)
    {
        $this->inventoryItem = InventoryItem::withTrashed()
            ->with('products')
            ->where('id', $id)
            ->first();

        $this->products = Product::with('size', 'productDetail.category')
            ->whereIn(
                'id',
                $this->inventoryItem->products->pluck('product_id')
            )
            ->get();

        $this->logs = Activity::where('log_name', 'Inventory Items')
            ->where('subject_id', $this->inventoryItem->id)
            ->orderByDesc('created_at')
            ->get();
    }
}
