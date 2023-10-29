<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\ProductDetail;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public $productDetailId;
    public $productDetail;
    public $logs;
    public function mount()
    {

        $this->productDetail = ProductDetail::where('id', $this->productDetailId)->with(['category', 'sizes.pivot.inventoryItems'])->first();
        $this->logs = Activity::where('log_name', 'Products')
            ->where('subject_id', $this->productDetail->id)
            ->orWhere('properties->attributes->product_id', $this->productDetail->id)
            ->orderByDesc('created_at')
            ->get();
        // dd($this->logs);
    }

    public function render()
    {
        return view('livewire.product.show');
    }
}
