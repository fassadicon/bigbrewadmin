<?php

namespace App\Livewire\Pos;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\SugarLevel;

use Livewire\Component;


class ProductCard extends Component
{
    public $productDetails;
    public $selectedProducts = [];

    public function mount()
    {
        $this->productDetails = ProductDetail::with(['category', 'sizes.pivot.inventoryItems'])
        ->get();
    }

    public function render()
    {
        return view('livewire.pos.product-card');
    }

    public function addToCart($productId)
    {
        if (in_array($productId, $this->selectedProducts)) {
            dd('Product Already in Cart');
        }

        $this->selectedProducts[] = $productId;
        $this->dispatch('productAdded', $productId);
    }
}
