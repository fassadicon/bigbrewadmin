<?php

namespace App\Livewire\Pos;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\SugarLevel;

use Livewire\Component;


class ProductCard extends Component
{
    public $showModal = false;
    public $modalMessage = '';
    public $productDetails;
    public $selectedProducts = [];

    public function mount()
    {
        $this->productDetails = ProductDetail::with(['category', 'sizes.pivot.inventoryItems'])
            ->get();
    }

    public function addToCart($productId)
{
    $product = Product::with('inventoryItems')->where('id', $productId)->first();

    foreach ($product->inventoryItems as $inventoryItem) {
        if ($inventoryItem->remaining_stocks <= $inventoryItem->warning_value) {
            $this->showModal = true;
            $this->modalMessage = "Product successfully added. However, {$inventoryItem->name} has {$inventoryItem->remaining_stocks} stocks left and reached its warning level. Please refill the inventory.";
            return;
        }
        if ($inventoryItem->remaining_stocks <= 0) {
            $this->showModal = true;
            $this->modalMessage = "{$inventoryItem->name} has {$inventoryItem->remaining_stocks} stocks left and cannot proceed ordering. Please refill the inventory immediately.";
            return;
        }
    }

    // if (in_array($productId, $this->selectedProducts)) {
    //     $this->showModal = true;
    //     $this->modalMessage = 'Product Already in Cart';
    //     return;
    // }

    $this->selectedProducts[] = $productId;
    $this->dispatch('productAdded', $productId);

    // Reset the modal state after processing
    $this->resetModal();
}

public function resetModal()
{
    $this->showModal = false;
}


    public function render()
    {
        return view('livewire.pos.product-card');
    }
}
