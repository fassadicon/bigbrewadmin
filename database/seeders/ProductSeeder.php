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
        // start comment
        $pricesForMedioGrande = [49, 59];
        $products = ProductDetail::whereIn('category_id', [1, 2, 4, 5])->get();
        foreach ($products as $product) {
            foreach (range(2, 3) as $key => $sizeId) {
                $product->sizes()->attach([
                    $sizeId => ['price' => $pricesForMedioGrande[$key]]
                ]);
            }
        }
        $pricesHotBrews = 35;
        $hotbrews = ProductDetail::where('category_id', 3)->get();
        foreach ($hotbrews as $hotbrew) {
            $hotbrew->sizes()->attach([
                1 => ['price' => $pricesHotBrews]
            ]);
        }

        $pricesAddOns = 9;
        $addons = ProductDetail::where('category_id', 6)->get();
        foreach ($addons as $addon) {
            $addon->sizes()->attach([
                4 => ['price' => $pricesAddOns]
            ]);
        }
        // end comment


    }
}
