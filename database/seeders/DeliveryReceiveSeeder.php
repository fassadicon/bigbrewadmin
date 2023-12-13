<?php

namespace Database\Seeders;

use App\Models\InventoryLog;
use App\Models\PurchaseOrder;
use App\Models\DeliveryReceive;
use Illuminate\Database\Seeder;
use App\Models\DeliveryReceiveItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeliveryReceiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchaseOrders = PurchaseOrder::all();
        foreach ($purchaseOrders as $purchaseOrder) {
            $totalAmount = 0;
            $deliveryReceiveItems = [];
            foreach ($purchaseOrder->purchaseOrderItems as $purchaseOrderItem) {
                $deliveryReceiveItems[] =
                    [
                        'purchase_order_item_id' => $purchaseOrderItem->id,
                        'user_id' => 1,
                        'inventory_item_id' => $purchaseOrderItem->inventory_item_id,
                        'quantity' => $purchaseOrderItem->quantity,
                        'pending' => 0,
                        'unit_measurement' => $purchaseOrderItem->unit_measurement,
                        'unit_price' => $purchaseOrderItem->unit_price,
                        'amount' => $purchaseOrderItem->quantity * $purchaseOrderItem->unit_price,
                        'description' => $purchaseOrderItem->description
                    ];
                $totalAmount += $purchaseOrderItem->quantity * $purchaseOrderItem->unit_price;
            }

            $deliveryReceive = DeliveryReceive::create([
                'user_id' => 1,
                'purchase_order_id' => $purchaseOrder->id,
                'total_amount' => $totalAmount
            ]);

            foreach ($deliveryReceiveItems as $deliveryReceiveItem) {
                $deliveryReceiveItem['delivery_receive_id'] = $deliveryReceive->id;
                DeliveryReceiveItem::create($deliveryReceiveItem);
            }
        }

        $deliveryReceives = DeliveryReceive::all();
        foreach ($deliveryReceives as $deliveryReceive) {
            foreach ($deliveryReceive->deliveryReceiveItems as $deliveryReceiveItem) {
                $addedStock = $deliveryReceiveItem->quantity;
                $remainingStocks = $deliveryReceiveItem->inventoryitem->remaining_stocks;
                $newStocks = $remainingStocks + $addedStock;
                $deliveryReceiveItem->inventoryItem->update([
                    'remaining_stocks' => $newStocks
                ]);

                InventoryLog::create([
                    'inventory_item_id' => $deliveryReceiveItem->inventoryItem->id,
                    'user_id' => 1,
                    'type' => 'out',
                    'amount' => $addedStock,
                    'old_stock' => $remainingStocks,
                    'new_stock' => $newStocks,
                    'remarks' => "Added stock from PO: " . $deliveryReceive->purchaseOrder->id .
                    "-" .
                    $deliveryReceiveItem->purchaseOrderItem->id .
                    " DR: " .
                    $deliveryReceive->id .
                    "-" .
                    $deliveryReceiveItem->id .
                    " for " .
                    $deliveryReceiveItem->inventoryItem->name
                ]);
            }
        }

        foreach ($purchaseOrders as $purchaseOrder) {
            $purchaseOrder->update([
                'status' => 2
            ]);
        }
    }
}

