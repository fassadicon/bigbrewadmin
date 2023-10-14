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
        $milkteas =  Product::whereHas('productDetail', function ($query) {
            $query->where('category_id', 1);
        })->get();

        foreach ($milkteas as $milktea) {
            $milktea->inventoryItems()->attach([
                rand(1, 6) => ['consumption_value' => rand(1, 10)]
            ]);
        }
    }
}
