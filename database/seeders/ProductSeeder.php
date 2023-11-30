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
    $milkteas = ProductDetail::where('category_id', 1)->get();

    foreach ($milkteas as $milktea) {
        // Fetch the base price from the related product
        $basePrice = $milktea->product->price;

        // Create medium size with the base price
        $mediumSizePrice = $basePrice;
        $milktea->sizes()->attach([
            2 => ['price' => $mediumSizePrice]
        ]);

        // Create large size with a price 25% higher than the medium size price
        $largeSizePrice = $mediumSizePrice * 1.25;
        $milktea->sizes()->attach([
            3 => ['price' => $largeSizePrice]
        ]);
    }
}


}
