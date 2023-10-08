<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventory::create([
            'name' => 'Regular Coffee Powder',
            'description' => 'test',
            'type' => 1,
            'measurement' => 'g',
            'stock_value' => 200,
            'warning_value' => 100
        ]);
        Inventory::create([
            'name' => 'Frappe',
            'description' => 'test',
            'type' => 1,
            'measurement' => 'ml',
            'stock_value' => 200,
            'warning_value' => 100
        ]);
        Inventory::create([
            'name' => 'Sugar',
            'description' => 'test',
            'type' => 1,
            'measuremment' => 'g',
            'stock_value' => 200,
            'warning_value' => 100
        ]);
        Inventory::create([
            'name' => 'Mocha Syrup',
            'description' => 'test',
            'type' => 1,
            'measuremment' => 'ml',
            'stock_value' => 200,
            'warning_value' => 100
        ]);
        Inventory::create([
            'name' => 'Plastic Cup',
            'description' => 'test',
            'type' => 1,
            'measuremment' => 'ml',
            'stock_value' => 200,
            'warning_value' => 100
        ]);
        Inventory::create([
            'name' => 'Mocha Syrup',
            'description' => 'test',
            'type' => 1,
            'measuremment' => 'ml',
            'stock_value' => 200,
            'warning_value' => 100
        ]);
    }
}
