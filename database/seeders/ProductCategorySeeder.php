<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'Hot Coffee',
            'description' => 'test',
        ]);
        ProductCategory::create([
            'name' => 'Iced Coffee',
            'description' => 'test',
        ]);
        ProductCategory::create([
            'name' => 'Milktea',
            'description' => 'test',
        ]);
        ProductCategory::create([
            'name' => 'Frappe',
            'description' => 'test',
        ]);
    }
}
