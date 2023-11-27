<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';
    public $status = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function show(int $id)
    {
        $this->dispatch('showing-order', id: $id);
        $this->dispatch('open-modal', 'show-order');
    }

    public function render()
    {
        // dd($this->status);
        $orders = Order::withTrashed()
            ->with('payment', 'orderItems', 'user')
            ->search($this->search)
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->orderBy($this->sortBy, $this->sortDir)
            // ->get();
            ->paginate($this->perPage);
        // dd($orders);
        return view('livewire.order.index', ['orders' => $orders]);
    }
}
