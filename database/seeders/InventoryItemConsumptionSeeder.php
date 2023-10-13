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
        $icedCoffeeOriginal = Product::findOrFail(1);
        $icedCoffeeOriginal->inventoryItems()->attach([
            1 => ['consumption_value' => 1],
            3 => ['consumption_value' => 1],
            5 => ['consumption_value' => 1],
        ]);

        $hotBrewedCoffee = Product::findOrFail(2);
        $hotBrewedCoffee->inventoryItems()->attach([
            1 => ['consumption_value' => 1],
            2 => ['consumption_value' => 1],
            4 => ['consumption_value' => 1],
        ]);

        $mochaFrappe = Product::findOrFail(3);
        $mochaFrappe->inventoryItems()->attach([
            1 => ['consumption_value' => 1],
            2 => ['consumption_value' => 1],
            6 => ['consumption_value' => 1],
        ]);

        $wintermelon = Product::findOrFail(4);
        $wintermelon->inventoryItems()->attach([
            1 => ['consumption_value' => 1],
            3 => ['consumption_value' => 1],
            4 => ['consumption_value' => 1],
            6 => ['consumption_value' => 1],
        ]);
    }
}
