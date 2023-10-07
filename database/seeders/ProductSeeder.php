<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::createMany(
            [
                'name' => 'Iced Coffee Original',
                'description' => 'test',
                'price' => 80.00,
            ],
            [
                'name' => 'Hot Brewed Coffee',
                'description' => 'test',
                'price' => 120.00,
            ],
            [
                'name' => 'Mocha Frappe',
                'description' => 'test',
                'price' => 150.00,
            ],
            [
                'name' => 'Cheese Fries',
                'description' => 'test',
                'price' => 100.00,
            ],
        );
    }
}
