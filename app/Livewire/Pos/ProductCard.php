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

    public function addToCart($productId)
    {
        $product = Product::with('inventoryItems')->where('id', $productId)->first();
        foreach ($product->inventoryItems as $inventoryItem) {
            if ($inventoryItem->remaining_stocks <= $inventoryItem->warning_value) {
                // Rephrase and Palitan to ng pop up lang dapat mag proceed pa rin
                dd("Product succesfully added. However, $inventoryItem->name has $inventoryItem->remaining_stocks stocks left and reached its warning level. Please refill the inventory.");
            }
            if ($inventoryItem->remaining_stocks <= 0) {
                dd("$inventoryItem->name has $inventoryItem->remaining_stocks stocks left and cannot proceed ordering. Please refill the inventory immediately.");
            }
        }
        if (in_array($productId, $this->selectedProducts)) {
            dd('Product Already in Cart');
        }

        $this->selectedProducts[] = $productId;
        $this->dispatch('productAdded', $productId);
    }

    public function render()
    {
        return view('livewire.pos.product-card');
    }
}
