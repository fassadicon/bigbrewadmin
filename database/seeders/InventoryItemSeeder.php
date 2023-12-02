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
            'remaining_stocks' => '10000',
            'warning_value' => '200',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'Plastic Cup - Small',
            'measurement' => 'piece',
            'remaining_stocks' => '10000',
            'warning_value' => '200',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'Plastic Cup - Large',
            'measurement' => 'piece',
            'remaining_stocks' => '10000',
            'warning_value' => '200',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'Plastic Cup - XL',
            'measurement' => 'piece',
            'remaining_stocks' => '10000',
            'warning_value' => '200',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'Big Straw',
            'measurement' => 'piece',
            'remaining_stocks' => '20000',
            'warning_value' => '400',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'Small Straw',
            'measurement' => 'piece',
            'remaining_stocks' => '20000',
            'warning_value' => '400',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'okinawa powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'wintermelon powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'red velvet powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'matcha powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'double dutch powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'cheesecake powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'dark choco powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'salted caramel powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'cookies & cream powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'taro powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'strawberry powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'kiwi powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'lyche powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'green apple powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'lemon powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'honey peach powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'mango powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'blueberyy powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'hot brusko coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'hot choco coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'hot moca coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'hot matcha coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'hot karamel coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'kape brusko coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'kape Macch coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'kape Moca coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'kape vanilla coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'kape fudge coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'kape matcha coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'moca powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'coffee jelly coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'caramel macch powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'vanilla coffee powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'cheesecake cream powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'taro cream powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'matcha cream powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'chocolate cream powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'strawberry cream powder',
            'measurement' => 'grams',
            'remaining_stocks' => '10000',
            'warning_value' => '5',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'pearl',
            'measurement' => 'grams',
            'remaining_stocks' => '5000',
            'warning_value' => '2',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'crystal',
            'measurement' => 'grams',
            'remaining_stocks' => '5000',
            'warning_value' => '2',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'cream puff',
            'measurement' => 'grams',
            'remaining_stocks' => '5000',
            'warning_value' => '2',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'water',
            'measurement' => 'ml',
            'remaining_stocks' => '3786',
            'warning_value' => '100',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'sugar',
            'measurement' => 'grams',
            'remaining_stocks' => '50000',
            'warning_value' => '2',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'coffee creamer',
            'measurement' => 'piece',
            'remaining_stocks' => '20000',
            'warning_value' => '500',
            'unit_price' => rand(1, 50)
        ]);
        InventoryItem::create([
            'name' => 'vacuum sealed plastic cover',
            'measurement' => 'meter',
            'remaining_stocks' => '200',
            'warning_value' => '10',
            'unit_price' => rand(1, 50)
        ]);


        $inventoryItems = InventoryItem::all();
        foreach ($inventoryItems as $inventoryItem) {
            InventoryLog::create([
                'inventory_item_id' => $inventoryItem->id,
                'user_id' => 1,
                'type' => 'in',
                'amount' => $inventoryItem->remaining_stocks,
                'old_stock' => 00,
                'new_stock' => $inventoryItem->remaining_stocks,
                'remarks' => 'Initial stock for ' . $inventoryItem->name
            ]);
        }
    }
}
