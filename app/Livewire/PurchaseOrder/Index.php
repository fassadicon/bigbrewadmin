<?php

namespace App\Livewire\PurchaseOrder;

use Livewire\Component;
use Livewire\Attributes\On;
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

    public function printPO(int $id)
    {
        $po = PurchaseOrder::with('purchaseOrderItems.inventoryItem', 'supplier', 'user')->where('id', $id)->first();

        $pdf = Pdf::loadView('exports.purchase-order', [
            'purchaseOrder' => $po,
        ])->output();

        return response()->streamDownload(
            fn () => print($pdf),
            "PO-$po->id.pdf"
        );
    }

    public function remarksForReturnPO($id)
    {
        $this->dispatch('returning-purchase-order', id: $id);
        $this->dispatch('open-modal', 'return-purchase-order');
    }

    #[On('purchase-order-returned')]
    public function refresh()
    {
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
