<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;

class VoidOrder extends Component
{
    public $selectedOrderToVoid;
    public $remarks;

    #[On('voiding-order')]
    public function fillEditForm($id)
    {
        $this->selectedOrderToVoid = $id;
    }

    public function voidOrder()
    {
        Order::where('id', $this->selectedOrderToVoid)->update([
            'status' => 2,
            'remarks' => $this->remarks
        ]);
        Toaster::warning('Order voided!');
        $this->selectedOrderToVoid = '';
        $this->remarks = '';
        $this->dispatch('order-voided');
        $this->dispatch('close', 'void-order');
    }
}
