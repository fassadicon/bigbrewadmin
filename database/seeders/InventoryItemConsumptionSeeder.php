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
        $products = Product::all();

        foreach ($products as $product) {
            foreach(range(1, 2) as $inventoryItemAttached) {
                $product->inventoryItems()->attach([
                    rand(1, 51) => ['consumption_value' => 1]
                ]);
            }
        }
    }
}
