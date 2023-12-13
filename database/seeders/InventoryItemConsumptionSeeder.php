<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\InventoryItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventoryItemConsumptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // comment here
        $products = Product::all();

        foreach ($products as $product) {
            foreach(range(1, 2) as $inventoryItemAttached) {
                $product->inventoryItems()->attach([
                    rand(1, 51) => ['consumption_value' => 1]
                ]);
            }
        }
        // until here

        // Example
        // Get the product with the specific size
        // $okinawaMedio = Product::where('product_id', 1) // product_details 1 - okinawa
        // ->where('size_id', 2) // 2 - medio
        // ->first();

        // $okinawaMedio->inventoryItems()->attach([
        //     // inventory_item_id => ['consumption_value' => kung ilan consume per bili]
        //     51 => ['consumption_value' => 1], // 51 kasi ayun yung plastic cup regular, consumption value 1 kasi isa langg naman need na cup
        //     7 => ['consumption_value' => 2], // 7 - ayun yugn okinawa powder, 2 grams imbento lang
        // ]);

        // after niyo magawa to lahat, comment niyo yung nasa line 17 to 25, yung Product::all() saka foreach loop
    }
}
