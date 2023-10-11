<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductDetail::create([
            'category_id' => 2,
            'name' => 'Iced Coffee Original',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'Hot Brewed Coffee',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 4,
            'name' => 'Mocha Frappe',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 3,
            'name' => 'Wintermelon Milktea',
            'description' => 'test',
        ]);
    }
}
