<?php

namespace App\Livewire\ProductCategory;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductCategory;

class Show extends Component
{
    public ProductCategory $category;

    #[On('showing-product-category')]
    public function fillShow(int $id)
    {
        $this->category = ProductCategory::withTrashed()
            ->with('productDetails')
            ->where('id', $id)
            ->first();
    }
}
