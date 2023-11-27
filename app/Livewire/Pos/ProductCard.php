<?php


namespace App\Livewire\Pos;

use App\Models\Products;

use Livewire\Component;

class ProductCard extends Component
{
    public $products;
    public $selectedProducts = [];
    public $status;

    public function mount($status = 1)
    {
        $this->products = Products::where('status', $status)->get();
    }

    public function render()
    {
        return view('livewire.pos.product-card');
    }

    public function addToCart($productId)
    {
        if (!in_array($productId, $this->selectedProducts)) {
            $this->selectedProducts[] = $productId;
            $this->dispatch('productAdded', $productId);
        }
    }
}
