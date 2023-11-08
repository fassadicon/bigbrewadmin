<?php

namespace App\Livewire\ProductCategory;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductCategory;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public ProductCategory $category;
    public $logs;

    #[On('showing-product-category')]
    public function fillShow(int $id)
    {
        $this->category = ProductCategory::withTrashed()
            ->with('productDetails')
            ->where('id', $id)
            ->first();

        $this->logs = Activity::where('log_name', 'Product Categories')
            ->where('subject_id', $this->category->id)
            ->orderByDesc('created_at')
            ->get();
    }
}
