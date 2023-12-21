<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public Supplier $supplier;
    public $logs;

    #[On('showing-supplier')]
    public function fillShow(int $id)
    {
        $this->supplier = Supplier::withTrashed()
            ->where('id', $id)
            ->first();

        $this->logs = Activity::where('log_name', 'Suppliers')
            ->where('subject_id', $this->supplier->id)
            ->orderByDesc('created_at')
            ->get();
    }
}
