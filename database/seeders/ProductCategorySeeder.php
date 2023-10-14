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
            'name' => 'milktea',
            'description' => 'with pearl',
        ]);
        ProductCategory::create([
            'name' => 'fruit tea',
            'description' => 'with crystal',
        ]);
        ProductCategory::create([
            'name' => 'hotbrew',
            'description' => 'with cream puff',
        ]);
        ProductCategory::create([
            'name' => 'iced coffee',
            'description' => 'with cream puff',
        ]);
        ProductCategory::create([
            'name' => 'praf',
            'description' => 'with whipped cream',
        ]);
        ProductCategory::create([
            'name' => 'addons',
        ]);
    }
}
