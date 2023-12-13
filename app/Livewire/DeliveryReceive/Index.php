<?php

namespace App\Livewire\DeliveryReceive;

use App\Models\DeliveryReceive;
use App\Models\PurchaseOrder;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $purchaseOrders = PurchaseOrder::with('purchaseOrderItems')->where('status', 1)->paginate(5);
        $deliveryReceives = DeliveryReceive::paginate(10);
        return view('livewire.delivery-receive.index', [
            'deliveryReceives' => $deliveryReceives,
            'purchaseOrders' => $purchaseOrders
        ]);
    }
}
