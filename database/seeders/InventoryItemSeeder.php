<?php

namespace Database\Seeders;

use App\Models\InventoryLog;
use App\Models\InventoryItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventoryItem::create([
            'name' => 'Plastic Cup - Regular',
            'measurement' => 'piece',
            'remaining_stocks' => '100',
            'warning_value' => '20',
        ]);
        InventoryItem::create([
            'name' => 'Plastic Cup - Small',
            'measurement' => 'piece',
            'remaining_stocks' => '100',
            'warning_value' => '20',
        ]);
        InventoryItem::create([
            'name' => 'Plastic Cup - Large',
            'measurement' => 'piece',
            'remaining_stocks' => '100',
            'warning_value' => '20',
        ]);
        InventoryItem::create([
            'name' => 'Plastic Cup - XL',
            'measurement' => 'piece',
            'remaining_stocks' => '100',
            'warning_value' => '20',
        ]);
        InventoryItem::create([
            'name' => 'Big Straw',
            'measurement' => 'piece',
            'remaining_stocks' => '200',
            'warning_value' => '40',
        ]);
        InventoryItem::create([
            'name' => 'Small Straw',
            'measurement' => 'piece',
            'remaining_stocks' => '200',
            'warning_value' => '40',
        ]);

        $inventoryItems = InventoryItem::all();
        foreach ($inventoryItems as $inventoryItem) {
            InventoryLog::create([
                'inventory_item_id' => $inventoryItem->id,
                'user_id' => 1,
                'type' => 'in',
                'amount' => $inventoryItem->remaining_stocks,
                'old_stock' => 0,
                'new_stock' => $inventoryItem->remaining_stocks,
                'remarks' => 'Initial stock for ' . $inventoryItem->name
            ]);
        }
    }
}
