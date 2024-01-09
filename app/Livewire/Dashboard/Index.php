<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use App\Models\InventoryLog;
use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\DeliveryReceive;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Index extends Component
{
    public function render()
    {
        $today = Carbon::now();
        $currentSalesToday = Order::whereDate('created_at', $today)->sum('total_amount');

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $currentSalesWeek = Order::where('status', 1)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_amount');

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $currentSalesMonth = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_amount');

        $currentYear = $today->year;
        $startOfYear = Carbon::create($currentYear, 1, 1);
        $endOfYear = Carbon::create($currentYear, 12, 31);
        $currentSalesYear = Order::whereBetween('created_at', [$startOfYear, $endOfYear])->sum('total_amount');

        $inventoryItems = InventoryItem::select('name', 'remaining_stocks', 'warning_value', 'measurement')->get();

        $lowInventoryItems = [];
        foreach ($inventoryItems as $inventoryItem) {
            if ($inventoryItem->warning_value >= $inventoryItem->remaining_stocks) {
                $lowInventoryItems[] = $inventoryItem;
            }
        }

        $purchaseOrders = PurchaseOrder::get();
        $pendingPurchaseOrdersAmount = $purchaseOrders->where('status', 'Pending')->sum('total_amount');
        $purchaseOrdersAmount = number_format($purchaseOrders->sum('total_amount'), 2, '.', '');

        $deliveryReceivesAmount = DeliveryReceive::sum('total_amount');

        $mostOrderedProducts = OrderItem::groupBy('product_id')
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        foreach ($mostOrderedProducts as $mostOrderedProduct) {
            $mostOrderedProduct['product'] = Product::with('productDetail', 'size', 'inventoryItems')->where('id', $mostOrderedProduct['product_id'])->first();
        }

        $inventoryLogs = InventoryLog::with('inventoryItem')
            ->where('type', 3)
            ->get();
        $totalAmountWastage = $inventoryLogs->sum('amount');
        $wasteItems = [];
        foreach ($inventoryLogs as $inventoryLog) {
            $wasteItems[] = $inventoryLog->inventoryItem->name;
        }
        $wasteItemsCount = count(array_unique($wasteItems));

        // Fastest Moving Items
        $inventoryItems = [];
        foreach ($mostOrderedProducts as $mostOrderedProduct) {
            foreach ($mostOrderedProduct['product']->inventoryItems as $inventoryItem) {
                $inventoryItems[] = $inventoryItem->name;
            }
        }
        $fastestMovingItems = array_count_values($inventoryItems);

        arsort($fastestMovingItems);

        $fastestMovingItems = array_map(function ($item) {
            if ($item > 1) {
                return $item;
            }
        }, $fastestMovingItems);

        $fastestMovingItems = array_filter($fastestMovingItems);

        // Chart
        $colors = [
            '#774936',
            '#edc4b3',
            '#8a5a44',
            '#e6b8a2',
            '#9d6b53',
            '#deab90',
            '#b07d62',
        ];

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
                $colors[$offset - 1]
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
            'fastestMovingItems' => $fastestMovingItems
        ]);
    }
}
