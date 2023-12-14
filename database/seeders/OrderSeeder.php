<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\InventoryLog;
use App\Models\InventoryItem;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 50) as $orderCount) {
            $orderItemsCount = rand(0, 2);
            $totalAmount = 0;
            $orderItems = [];
            foreach (range(0, $orderItemsCount) as $orderItem) {
                $product = Product::select('id', 'price')->inRandomOrder()->first();
                $orderItem = [
                    'product_id' => $product->id,
                    'amount' => $product->price,
                    'quantity' => rand(1, 2)
                ];
                $totalAmount += $product->price * $orderItem['quantity'];
                array_push($orderItems, $orderItem);
            }

            $additionalPaymentHanded = rand(1, 100);
            $paymentReceived = $totalAmount + $additionalPaymentHanded;

            $payment = Payment::create([
                'payment_received' => $paymentReceived,
                'amount' => $totalAmount,
                'change' => $paymentReceived - $totalAmount
            ]);

            $order = Order::create([
                'user_id' => 1,
                'payment_id' => $payment->id,
                'total_amount' => $payment->amount,
                'customer_name' => fake()->name(),
                'created_at' => Carbon::now()->subDays(rand(1, 7))
            ]);

            foreach ($orderItems as $orderItem) {
                $orderItem['order_id'] = $order->id;
                OrderItem::create($orderItem);
            }

            // Inventory Consumption
            $orderItemsCreated = OrderItem::all();
            foreach ($orderItemsCreated as $orderItem) {
                $productInventoryItems = $orderItem->product->inventoryItems;
                foreach ($productInventoryItems as $productInventoryItem) {
                    $consumptionValue = $productInventoryItem->pivot->consumption_value * $orderItem->quantity;
                    $remainingStocks = $productInventoryItem->remaining_stocks;
                    $newStocks = $remainingStocks - $consumptionValue;
                    $productInventoryItem->update([
                        'remaining_stocks' => $newStocks
                    ]);

                    InventoryLog::create([
                        'inventory_item_id' => $productInventoryItem->id,
                        'user_id' => 1,
                        'type' => 'out',
                        'amount' => $consumptionValue,
                        'old_stock' => $remainingStocks,
                        'new_stock' => $newStocks,
                        'remarks' => 'Order for ' . $orderItem->product->productDetail->name,
                        'created_at' => Carbon::now()->subDays(rand(1, 7))
                    ]);
                }
            }
        }
    }
}
