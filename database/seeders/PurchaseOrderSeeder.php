<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventoryItem = InventoryItem::where('id', 1)->first();
        $quantity = 5;
        $purchaseOrderItems = [
            [
                'user_id' => 1,
                'inventory_item_id' => $inventoryItem->id,
                'quantity' => $quantity,
                'unit_measurement' => $inventoryItem->measurement,
                'unit_price' => $inventoryItem->unit_price,
                'amount' => $quantity * $inventoryItem->unit_price,
                'description' => '',
                'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
            ]
        ];

        $purchaseOrder = PurchaseOrder::create([
            'user_id' => 1,
            'supplier_id' => 1, // 1 - BigBrew, 2 and others new suppliers
            'total_amount',
            'status' => 1 // 1 - Pending, 2 - Incomplete, 3 - Completed
        ]);

        foreach ($purchaseOrderItems as $purchaseOrderItem) {
            $purchaseOrderItem['purchase_order_id'] = $purchaseOrder->id;
            PurchaseOrderItem::create($purchaseOrderItem);
        }
    }
}
