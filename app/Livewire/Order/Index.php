<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';
    public $status = '';
    public $start;
    public $end;


    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function show(int $id)
    {
        $this->dispatch('showing-order', id: $id);
        $this->dispatch('open-modal', 'show-order');
    }

    public function export()
    {
        $orders = Order::withTrashed()
            ->with('payment', 'orderItems', 'user')
            ->search($this->search)
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->start && $this->end, function ($query) {
                $query->where(function ($query) {
                    $query->whereBetween('created_at', [
                        Carbon::parse($this->start)->format('Y-m-d'),
                        Carbon::parse($this->end)->format('Y-m-d')
                    ])
                        ->orWhere(function ($query) {
                            $query->where('created_at', '<=', Carbon::parse($this->start)->format('Y-m-d'))
                                ->where('created_at', '>=', Carbon::parse($this->end)->format('Y-m-d'));
                        });
                });
            })
            ->when($this->start && !$this->end, function ($query) {
                $query->whereDate("created_at", ">=", Carbon::parse($this->start)->format('Y-m-d'));
            })
            ->when(!$this->start && $this->end, function ($query) {
                $query->where("created_at", "<=", Carbon::parse($this->end)->format('Y-m-d'));
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->get();

        $totalSales = $orders->where('status', 1)->sum('total_amount');
        $completedOrders = $orders->where('status', 1)->count();
        $cancelledOrders = $orders->where('status', 2)->count();

        $totalCashPayments = $orders->where('status', 1)
            ->where('payment.method', 1)
            ->sum('total_amount');
        $totalOnlinePayments = $orders->where('status', 1)
            ->where('payment.method', 2)
            ->sum('total_amount');

        $pdf = Pdf::loadView('exports.sales', [
            'orders' => $orders,
            'totalSales' => $totalSales,
            'totalCashPayments' => $totalCashPayments,
            'totalOnlinePayments' => $totalOnlinePayments,
            'completedOrders' => $completedOrders,
            'cancelledOrders' => $cancelledOrders,
            'start_date' => Carbon::parse($this->start)->format('F j, Y'),
            'end_date' => Carbon::parse($this->end)->format('F j, Y'),
        ])->output();

        return response()->streamDownload(
            fn () => print($pdf),
            "sales.pdf"
        );
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
            ->when($this->start && $this->end, function ($query) {
                $query->where(function ($query) {
                    $query->whereBetween('created_at', [
                        Carbon::parse($this->start)->format('Y-m-d'),
                        Carbon::parse($this->end)->format('Y-m-d')
                    ])
                        ->orWhere(function ($query) {
                            $query->where('created_at', '<=', Carbon::parse($this->start)->format('Y-m-d'))
                                ->where('created_at', '>=', Carbon::parse($this->end)->format('Y-m-d'));
                        });
                });
            })
            ->when($this->start && !$this->end, function ($query) {
                $query->whereDate("created_at", ">=", Carbon::parse($this->start)->format('Y-m-d'));
            })
            ->when(!$this->start && $this->end, function ($query) {
                $query->where("created_at", "<=", Carbon::parse($this->end)->format('Y-m-d'));
            })
            ->orderBy($this->sortBy, $this->sortDir)
            // ->get();
            ->paginate($this->perPage);

        // dd($orders->toSql());
        // dd($orders);
        return view('livewire.order.index', ['orders' => $orders]);
    }
}
