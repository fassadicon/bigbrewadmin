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
        $currentSalesToday = Order::whereDate('created_at', Carbon::today())->sum('total_amount');

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
            ->setTitle('Expenses by Type')
            ->addColumn('Food', 100, '#f6ad55')
            ->addColumn('Shopping', 200, '#fc8181')
            ->addColumn('Travel', 300, '#90cdf4');

        return view('livewire.dashboard.index', [
            'columnChartModel' => $columnChartModel,
            'currentSalesToday' => $currentSalesToday,
            'lowInventoryItems' => $lowInventoryItems,
            'purchaseOrdersAmount' => $purchaseOrdersAmount,
            'pendingPurchaseOrdersAmount' => $pendingPurchaseOrdersAmount,
            'deliveryReceivesAmount' => $deliveryReceivesAmount,
            'mostOrderedProducts' => $mostOrderedProducts,
        ]);
    }
}
