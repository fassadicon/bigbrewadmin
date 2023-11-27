<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment1 = Payment::create([
            'payment_received' => 10,
            'amount' => 8,
            'change' => 2
        ]);
        $orderItems1_1of1 = OrderItem::create([
            'order_id' => 1,
            'product_id' => 1,
            'amount' => 8,
        ]);
        $order1 = Order::create([
            'user_id' => 1,
            'payment_id' => 1,
            'total_amount' => 8,
        ]);

        $payment2 = Payment::create([
            'payment_received' => 20,
            'amount' => 15,
            'change' => 5
        ]);
        $orderItems2_1of2 = OrderItem::create([
            'order_id' => 2,
            'product_id' => 2,
            'amount' => 10,
        ]);
        $orderItems2_2of2 = OrderItem::create([
            'order_id' => 2,
            'product_id' => 3,
            'amount' => 5,
        ]);
        $order2 = Order::create([
            'user_id' => 1,
            'payment_id' => 1,
            'total_amount' => 8,
        ]);

    }
}
