<?php

namespace App\Livewire\Pos;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\SugarLevel;

use Livewire\Component;


class ProductCard extends Component
{
    public $products;
    public $productDetails;
    public $selectedProducts = [];
    public $selectedSizes = [];
    public $status;
    public $selectedSugarLevels = [];
    public $sugarLevels; 
    public $sizeAlias;


    public function mount($status = 1)
    {
        $this->productDetails = ProductDetail::where('status', $status)->get();
        $this->products = Product::all();
        $this->sugarLevels = SugarLevel::all();
    }

    public function render()
    {
        return view('livewire.pos.product-card');
    }

    public function addToCart($productDetailId, $size = null, $sugarLevel = null)
    {
        $key = $productDetailId . '-' . $size;

        if (!in_array($key, $this->selectedProducts)) {
            $this->selectedProducts[] = $key;
            $this->dispatch('productAdded', $productDetailId, $size, $sugarLevel);
        }
    }
}
