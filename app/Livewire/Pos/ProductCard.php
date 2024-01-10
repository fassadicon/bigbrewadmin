<?php

namespace App\Livewire\Pos;

use App\Models\Product;
use Livewire\Component;
use App\Models\SugarLevel;

use App\Models\ProductDetail;
use App\Models\ProductCategory;
use Masmerise\Toaster\Toaster;

class ProductCard extends Component
{
    public $showModal = false;
    public $modalMessage = '';
    // public $productDetails;
    public $selectedProducts = [];
    public $selectedCategoryId = '';
    public $allCategories;

    public function mount()
    {
        $this->allCategories = ProductCategory::all();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
    }

    public function addToCart($productId)
    {
        $product = Product::with('inventoryItems')->where('id', $productId)->first();
        // dd($product);
        foreach ($product->inventoryItems as $inventoryItem) {
            if ($inventoryItem->remaining_stocks <= $inventoryItem->warning_value) {
                Toaster::warning("{$inventoryItem->name} has {$inventoryItem->remaining_stocks} stocks left and reached its warning level. Please refill the inventory.");
            }
            if ($inventoryItem->remaining_stocks <= 0) {
                Toaster::warning("{$inventoryItem->name} has {$inventoryItem->remaining_stocks} stocks left and cannot proceed ordering. Please refill the inventory immediately.");
            }
        }

        $this->selectedProducts[] = $productId;
        $this->dispatch('productAdded', $productId);

        $this->resetModal();
    }

    public function resetModal()
    {
        $this->showModal = false;
    }


    public function render()
    {
        // dd($this->selectedCategoryId);
        $productDetails = ProductDetail::with([
            'category' => function ($query) {
                $query->withTrashed();
            },
            'sizes.pivot.inventoryItems' => function ($query) {
                $query->withTrashed();
            }
        ])
            ->when($this->selectedCategoryId !== '', function ($query) {
                $query->where('category_id', $this->selectedCategoryId);
            })
            ->get();
        // dd($productDetails);
        return view('livewire.pos.product-card', ['productDetails' => $productDetails]);
    }
}
