<?php

namespace App\Livewire\PurchaseOrder;

use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    public PurchaseOrder $purchaseOrder;
    public $purchaseOrderItems;
    public $suppliers;
    public $inventoryItems;

    public function mount(PurchaseOrder $purchaseOrder) {
        $this->purchaseOrder->load('purchaseOrderItems');
        foreach($purchaseOrder->purchaseOrderItems as $purchaseOrderitem) {
            $this->purchaseOrderItems[] =  [
                'inventory_item_id' => $purchaseOrderitem->inventory_item_id,
                'quantity' => $purchaseOrderitem->quantity,
                'unit_measurement' => $purchaseOrderitem->unit_measurement,
                'unit_price' => $purchaseOrderitem->unit_price,
                'amount' => $purchaseOrderitem->amount,
                'description' => $purchaseOrderitem->description
            ];
        }

        $this->suppliers = Supplier::all();
        $this->inventoryItems = InventoryItem::all();
    }

    public function render()
    {
        return view('livewire.purchase-order.edit');
    }
}
