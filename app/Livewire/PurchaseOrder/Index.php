<?php

namespace App\Livewire\PurchaseOrder;

use App\Models\PurchaseOrder;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $purchaseOrders = PurchaseOrder::paginate(10);
        return view('livewire.purchase-order.index', ['purchaseOrders' => $purchaseOrders]);
    }
}
