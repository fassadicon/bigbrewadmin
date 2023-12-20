<?php

namespace App\Livewire\PurchaseOrder;

use Livewire\Component;
use App\Models\InventoryLog;
use Livewire\WithPagination;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use Masmerise\Toaster\Toaster;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $status = '';
    public $type = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

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

    public function printPO(int $id) {
        $po = PurchaseOrder::with('purchaseOrderItems.inventoryItem', 'supplier', 'user')->where('id', $id)->first();

        $pdf = Pdf::loadView('exports.purchase-order', [
            'purchaseOrder' => $po,
        ])->output();

        return response()->streamDownload(
            fn () => print($pdf),
            "PO-$po->id.pdf"
        );
    }
    public function render()
    {
        $purchaseOrders = PurchaseOrder::withTrashed()
        ->with('purchaseOrderItems.inventoryItem', 'supplier')
        ->when($this->type !== '', function ($query) {
            $query->where('status', $this->type);
        })
        ->when($this->status !== '', function ($query) {
            $query->when($this->status === 'active', function ($query) {
                $query->whereNull('deleted_at');
            })->when($this->status === 'inactive', function ($query) {
                $query->whereNotNull('deleted_at');
            });
        })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.purchase-order.index', ['purchaseOrders' => $purchaseOrders]);
    }
}
