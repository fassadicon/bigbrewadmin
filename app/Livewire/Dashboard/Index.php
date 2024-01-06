<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\InventoryLog;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\DeliveryReceive;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Index extends Component
{
    public function render()
    {
        $today = Carbon::now();
        $currentSalesToday = Order::whereDate('created_at', $today)->sum('total_amount');

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $currentSalesWeek = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

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

        $inventoryLogs = InventoryLog::with('inventoryItem')
            ->where('type', 3)
            ->get();
        $totalAmountWastage = $inventoryLogs->sum('amount');
        $wasteItems = [];
        foreach ($inventoryLogs as $inventoryLog) {
            $wasteItems[] = $inventoryLog->inventoryItem->name;
        }
        $wasteItemsCount = count(array_unique($wasteItems));

        // Chart
        $columnChartModel =
            (new ColumnChartModel())
            ->setTitle('Sales');
        $currentDayOfWeek = Carbon::now()->startOfWeek();
        foreach (range(1, 7) as $offset) {
            $dayOfWeek = $currentDayOfWeek;

            $salesData = Order::whereDate('created_at', $dayOfWeek)->sum('total_amount');

            $columnChartModel->addColumn(
                $dayOfWeek->format('D'),
                $salesData,
                '#f6ad55'
            );

            $dayOfWeek->addDay();
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
            'wasteItemsCount' => $wasteItemsCount,
            'totalAmountWastage' => $totalAmountWastage,
        ]);
    }
}
