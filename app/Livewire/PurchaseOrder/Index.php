<?php

namespace App\Livewire\PurchaseOrder;

use Livewire\Component;
use App\Models\InventoryLog;
use Livewire\WithPagination;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
    use WithPagination;

    public function cancel($id)
    {
        PurchaseOrder::where('id', $id)->update([
            'status' => 3
        ]);
        Toaster::warning('Purchase Order cancelled');
    }

    public function return($id)
    {
        $purchaseOrder =  PurchaseOrder::with('purchaseOrderItems')->where('id', $id)->first();

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
            'status' => 4
        ]);

        Toaster::info('Purchase order returned');
    }

    public function delete(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        Toaster::warning('Size archived!');
    }

    public function restore(int $id)
    {
        PurchaseOrder::withTrashed()->where('id', $id)->first()->restore();
        Toaster::success('Size restored!');
    }

    public function render()
    {
        $purchaseOrders = PurchaseOrder::paginate(10);
        return view('livewire.purchase-order.index', ['purchaseOrders' => $purchaseOrders]);
    }
}
