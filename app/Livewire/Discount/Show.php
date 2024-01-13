<?php

namespace App\Livewire\Discount;

use Livewire\Component;
use App\Models\Discount;
use Livewire\Attributes\On;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public Discount $discount;
    public $logs;

    #[On('showing-discount')]
    public function fillShow(int $id)
    {
        $this->discount = Discount::withTrashed()
            ->where('id', $id)
            ->first();

        $this->logs = Activity::where('log_name', 'Discounts')
            ->where('subject_id', $this->discount->id)
            ->orderByDesc('created_at')
            ->get();
    }
}
