<?php

namespace App\Livewire\DeliveryReceive;

use App\Models\PurchaseOrder;
use Livewire\Component;

class Create extends Component
{
    public $selectedPurchaseOrder;
    public $purchaseOrders;

    public function mount() {
        $this->purchaseOrders = PurchaseOrder::whereIn('status', [1, 2])->get();
    }

    public function selectPurchaseOrder($purchaseOrderId) {
        $this->selectedPurchaseOrder = PurchaseOrder::with('purchaseOrderItems', 'supplier', 'user')
        ->where('id', $purchaseOrderId)
        ->first();
    }

    public function render()
    {
        return view('livewire.delivery-receive.create');
    }
}
