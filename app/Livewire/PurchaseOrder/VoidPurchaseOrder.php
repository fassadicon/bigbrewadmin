<?php

namespace App\Livewire\PurchaseOrder;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\InventoryLog;
use App\Models\PurchaseOrder;
use Masmerise\Toaster\Toaster;

class VoidPurchaseOrder extends Component
{
    public $remarks = '';
    public $selectedPOToReturn;

    #[On('returning-purchase-order')]
    public function fillEditForm($id)
    {
        $this->selectedPOToReturn = $id;
    }

    public function return()
    {
        $purchaseOrder =  PurchaseOrder::with('purchaseOrderItems')->where('id', $this->selectedPOToReturn)->first();

        foreach ($purchaseOrder->purchaseOrderItems as $purchaseOrderItem) {

            $inventoryItem = $purchaseOrderItem->inventoryItem;
            $currentStock = $inventoryItem->remaining_stocks;
            $returnStock = $purchaseOrderItem->quantity;
            $newStock = $currentStock - $returnStock;
            $inventoryItem->update([
                'remaining_stocks' => $newStock
            ]);

            InventoryLog::create([
                'inventory_item_id' => $inventoryItem->id,
                'user_id' => auth()->id(),
                'type' => 'out',
                'amount' => $returnStock,
                'old_stock' => $currentStock,
                'new_stock' => $newStock,
                'remarks' => "Return " . "$inventoryItem->name ($purchaseOrderItem->quantity $purchaseOrderItem->unit_measurement) - PHP $purchaseOrderItem->amount" . "from PO #" . $purchaseOrder->id
            ]);
        }

        $purchaseOrder->update([
            'status' => 4,
            'remarks' => $this->remarks
        ]);

        $this->selectedPOToReturn = '';
        $this->remarks = '';

        Toaster::info('Purchase order returned');
        $this->dispatch('purchase-order-returned');
        $this->dispatch('close', 'return-purchase-order');
    }
}
