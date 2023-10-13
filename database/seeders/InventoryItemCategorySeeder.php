<?php

namespace Database\Seeders;

use App\Models\InventoryItemCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventoryItemCategory::create([
            'name' => 'Milktea Powder',
            'description' => 'test',
        ]);
        InventoryItemCategory::create([
            'name' => 'Coffee Powder',
            'description' => 'test',
        ]);
        InventoryItemCategory::create([
            'name' => 'Cups',
            'description' => 'test',
        ]);
        InventoryItemCategory::create([
            'name' => 'Straws',
            'description' => 'test',
        ]);
    }
}
