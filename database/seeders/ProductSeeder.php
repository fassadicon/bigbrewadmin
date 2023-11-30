<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = ProductDetail::all();
        foreach ($products as $product) {
            foreach(range(1, 3) as $sizeId) {
                $product->sizes()->attach([
                    $sizeId => ['price' => rand(50, 100)]
                ]);
            }
        }
    }
}