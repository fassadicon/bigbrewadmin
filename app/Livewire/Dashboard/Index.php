<?php

namespace App\Livewire\Dashboard;

use App\Models\DeliveryReceive;
use App\Models\InventoryItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\PurchaseOrder;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\Carbon;

class Index extends Component
{
    public function render()
    {
        $today = Carbon::now();
        $currentSalesToday = Order::whereDate('created_at', $today)->sum('total_amount');

        $startOfWeek = $today->startOfWeek();
        $endOfWeek = $today->endOfWeek();
        $currentSalesWeek = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');

        $startOfMonth = $today->startOfMonth();
        $endOfMonth = $today->endOfMonth();

        $currentSalesMonth = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_amount');

        $currentYear = $today->year;
        $startOfYear = Carbon::create($currentYear, 1, 1);
        $endOfYear = Carbon::create($currentYear, 12, 31);
        $currentSalesYear = Order::whereBetween('created_at', [$startOfYear, $endOfYear])->sum('total_amount');

        $inventoryItems = InventoryItem::select('name', 'remaining_stocks', 'warning_value')->get();

        $lowInventoryItems = [];
        foreach ($inventoryItems as $inventoryItem) {
            if ($inventoryItem->warning_value >= $inventoryItem->remaining_stocks) {
                $lowInventoryItems[] = $inventoryItem;
            }
        }

        $purchaseOrders = PurchaseOrder::get();
        $pendingPurchaseOrdersAmount = $purchaseOrders->where('status', 'Pending')->sum('total_amount');
        $purchaseOrdersAmount = $purchaseOrders->sum('total_amount');
        $deliveryReceivesAmount = DeliveryReceive::sum('total_amount');

        $mostOrderedProducts = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->limit(5)
            ->get();

        $columnChartModel =
            (new ColumnChartModel())
            ->setTitle('Sales');

        $currentDayOfWeek = Carbon::now()->dayOfWeek;
        foreach (range(1, 7) as $offset) {
            // Calculate the day of the week for the current iteration
            $dayOfWeek = ($currentDayOfWeek + 7 - $offset) % 7 + 1;

            // Get the sales data for the current day of the week
            $salesData = Order::whereDate('created_at', Carbon::now()->startOfWeek()->addDays($dayOfWeek - 1))->sum('total_amount');

            // Add the column to the chart model
            $columnChartModel->addColumn(
                Carbon::now()->startOfWeek()->addDays($dayOfWeek - 1)->format('D'),
                $salesData,
                '#f6ad55'
            );
        }

        return view('livewire.dashboard.index', [
            'columnChartModel' => $columnChartModel,
            'currentSalesToday' => $currentSalesToday,
            'currentSalesWeek' => $currentSalesWeek,
            'currentSalesMonth' => $currentSalesMonth,
            'currentSalesYear' => $currentSalesYear,
            'lowInventoryItems' => $lowInventoryItems,
            'purchaseOrdersAmount' => $purchaseOrdersAmount,
            'pendingPurchaseOrdersAmount' => $pendingPurchaseOrdersAmount,
            'deliveryReceivesAmount' => $deliveryReceivesAmount,
            'mostOrderedProducts' => $mostOrderedProducts,
        ]);
    }
}
