<?php

namespace App\Livewire\Pos;

use Livewire\Component;

class OrderSummary extends Component
{
    public $selectedProducts = [];

    protected $listeners = ['productAdded'];

    public function productAdded($productId)
    {
        if (!in_array($productId, $this->selectedProducts)) {
            $this->selectedProducts[] = $productId;
        }
    }

    public function removeItem($index)
    {
        unset($this->selectedProducts[$index]);
        $this->selectedProducts = array_values($this->selectedProducts);
    }

    public function render()
    {
        $total = $this->calculateTotal();

        return view('livewire.pos.order-summary', compact('total'));
    }

    public function calculateTotal()
{
    $total = collect($this->selectedProducts)->sum('price');
    info('Total Calculated: ' . $total);
    return $total;
}

}