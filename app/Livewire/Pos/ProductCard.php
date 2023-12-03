<?php

namespace App\Livewire\Pos;

use App\Models\Product;
use Livewire\Component;
use App\Models\SugarLevel;

use App\Models\ProductDetail;
use App\Models\ProductCategory;

class ProductCard extends Component
{
    public $showModal = false;
    public $modalMessage = '';
    // public $productDetails;
    public $selectedProducts = [];
    public $selectedCategoryId = '';
    public $allCategories;

    public function mount() {
        $this->allCategories = ProductCategory::all();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
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
        // dd($this->selectedCategoryId);
        $productDetails = ProductDetail::with(['category', 'sizes.pivot.inventoryItems'])
            ->when($this->selectedCategoryId !== '', function ($query) {
                $query->where('category_id', $this->selectedCategoryId);
            })
            ->get();
        // dd($productDetails);
        return view('livewire.pos.product-card', ['productDetails' => $productDetails]);
    }
}
