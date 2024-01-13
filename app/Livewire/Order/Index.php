<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Masmerise\Toaster\Toaster;
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

    public function changeStartDate($value) {
        $this->start = $value;
    }

    public function changeEndDate($value) {
        $this->end = $value;
    }

    public function show(int $id)
    {
        $this->dispatch('showing-order', id: $id);
        $this->dispatch('open-modal', 'show-order');
    }

    public function delete(Order $size)
    {
        $size->delete();
        Toaster::warning('Order archived!');
    }

    public function restore(int $id)
    {
        Order::withTrashed()->where('id', $id)->first()->restore();
        Toaster::success('Order restored!');
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
                $query->when($this->start == $this->end, function ($query) {
                    return $query->whereDate('created_at', Carbon::parse($this->end)->endOfDay()->format('Y-m-d'));
                })->when($this->start != $this->end, function ($query) {
                    $query->whereBetween('created_at', [
                        Carbon::parse($this->start)->subDay()->startOfDay()->format('Y-m-d'),
                        Carbon::parse($this->end)->addDay()->endOfDay()->format('Y-m-d')
                    ]);
                });
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->get();

        $totalSales = $orders->where('status', 1)->sum('total_amount');
        $completedOrders = $orders->where('status', 1)->count();
        $cancelledOrders = $orders->where('status', 2)->count();

        $totalCashPayments = $orders->where('status', 1)
            ->where('payment.method', 'cash')
            ->sum('total_amount');
        $totalOnlinePayments = $orders->where('status', 1)
            ->where('payment.method', 'gcash')
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

    public function downloadReceipt($orderId)
    {
        $order = Order::with('orderItems', 'payment')->where('id', $orderId)->first();

        $pdf = Pdf::setPaper(array(0, 0, 200, 500))
            ->loadView('exports.receipt', [
                'order' => $order,
                'date' => $order->created_at
            ]);

        $page_count = $pdf->get_canvas()->get_page_number();

        $printPDF =  Pdf::setPaper(array(0, 0, 200, 500 * $page_count))
            ->loadView('exports.receipt', [
                'order' => $order->load('payment', 'orderItems', 'orderItems.product', 'orderItems.product.productDetail', 'user'),
                'date' => Carbon::now()->format('M d, Y')
            ])
            ->output();

        return response()->streamDownload(
            fn () => print($printPDF),
            "receipt.pdf"
        );
    }

    public function remarksForVoidOrder($orderId)
    {
        $this->dispatch('voiding-order', id: $orderId);
        $this->dispatch('open-modal', 'void-order');
    }

    #[On('order-voided')]
    public function refresh()
    {
    }

    public function render()
    {
        // dd($this->status);
        $orders = Order::withTrashed()
            ->with('payment', 'user', 'orderItems.product.productDetail')
            ->search($this->search)
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->start && $this->end, function ($query) {
                $query->when($this->start == $this->end, function ($query) {
                    return $query->whereDate('created_at', Carbon::parse($this->end)->endOfDay()->format('Y-m-d'));
                })->when($this->start != $this->end, function ($query) {
                    $query->whereBetween('created_at', [
                        Carbon::parse($this->start)->subDay()->startOfDay()->format('Y-m-d'),
                        Carbon::parse($this->end)->addDay()->endOfDay()->format('Y-m-d')
                    ]);
                });
            })
            ->orderBy($this->sortBy, $this->sortDir)
            // ->get();
            ->paginate($this->perPage);

        // dd($orders->toSql());
        // dd($orders);
        return view('livewire.order.index', ['orders' => $orders]);
    }
}
