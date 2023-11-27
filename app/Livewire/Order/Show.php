<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Activitylog\Models\Activity;

class Show extends Component
{
    public Order $order;
    public $logs;

    #[On('showing-order')]
    public function fillShow(int $id)
    {
        $this->order = Order::withTrashed()
            ->with('payment', 'orderItems', 'user')
            ->where('id', $id)
            ->first();

        $this->logs = Activity::where('log_name', 'Orders')
            ->where('subject_id', $this->order->id)
            ->orderByDesc('created_at')
            ->get();
    }
}
