<?php

namespace App\Livewire\DeliveryReceive;

use App\Models\DeliveryReceive;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $deliveryReceives = DeliveryReceive::paginate(10);
        return view('livewire.delivery-receive.index', ['deliveryReceives' => $deliveryReceives]);
    }
}
