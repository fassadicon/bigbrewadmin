<?php

namespace App\Livewire\DeliveryReceive;

use Livewire\Component;
use App\Models\PurchaseOrder;
use App\Models\DeliveryReceive;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    public function printDR(int $id)
    {
        $dr = DeliveryReceive::with('deliveryReceiveItems.inventoryItem', 'purchaseOrder.supplier', 'user')->where('id', $id)->first();

        $pdf = Pdf::loadView('exports.delivery-receive', [
            'deliveryReceive' => $dr,
        ])->output();

        return response()->streamDownload(
            fn () => print($pdf),
            "DR-$dr->id.pdf"
        );
    }

    public function render()
    {
        $purchaseOrders = PurchaseOrder::with('purchaseOrderItems')->where('status', 1)->paginate(5);
        $deliveryReceives = DeliveryReceive::with('purchaseOrder', 'deliveryReceiveItems')
            ->paginate(5);
        return view('livewire.delivery-receive.index', [
            'deliveryReceives' => $deliveryReceives,
            'purchaseOrders' => $purchaseOrders
        ]);
    }
}
