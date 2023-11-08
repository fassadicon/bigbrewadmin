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
        // Milktea
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'okinawa',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'wintermelon',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'red velvet',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'matcha',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'double dutch',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'cheesecake',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'dark choco',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'chocolate',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'salted caramel',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'cookies & cream',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'taro',
            'description' => 'test',
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'strawberry',
            'description' => 'test',
        ]);
    }
}
