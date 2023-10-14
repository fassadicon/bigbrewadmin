<?php

namespace Database\Seeders;

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
            'category_id' => 3,
            'name' => 'Plastic Cup - Regular',
            'measurement' => 'piece',
            'stock_value' => '100',
            'warning_value' => '20',
        ]);
        InventoryItem::create([
            'category_id' => 3,
            'name' => 'Plastic Cup - Small',
            'measurement' => 'piece',
            'stock_value' => '100',
            'warning_value' => '20',
        ]);
        InventoryItem::create([
            'category_id' => 3,
            'name' => 'Plastic Cup - Large',
            'measurement' => 'piece',
            'stock_value' => '100',
            'warning_value' => '20',
        ]);
        InventoryItem::create([
            'category_id' => 3,
            'name' => 'Plastic Cup - XL',
            'measurement' => 'piece',
            'stock_value' => '100',
            'warning_value' => '20',
        ]);
        InventoryItem::create([
            'category_id' => 4,
            'name' => 'Big Straw',
            'measurement' => 'piece',
            'stock_value' => '200',
            'warning_value' => '40',
        ]);
        InventoryItem::create([
            'category_id' => 4,
            'name' => 'Small Straw',
            'measurement' => 'piece',
            'stock_value' => '200',
            'warning_value' => '40',
        ]);
    }
}
