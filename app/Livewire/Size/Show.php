<?php

namespace App\Livewire\Size;

use App\Models\Size;
use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public Size $size;
    public $logs;

    #[On('showing-product-size')]
    public function fillShow(int $id)
    {
        $this->size = Size::withTrashed()
            ->with('productDetails')
            ->where('id', $id)
            ->first();

        $this->logs = Activity::where('log_name', 'Product Sizes')
            ->where('subject_id', $this->size->id)
            ->orderByDesc('created_at')
            ->get();
    }
}
