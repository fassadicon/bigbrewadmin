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
        $icedCoffeeOriginal = ProductDetail::findOrFail(1);
        $icedCoffeeOriginal->sizes()->attach([
            1 => ['price' => 10],
            3 => ['price' => 20],
        ]);

        $hotBrewedCoffee = ProductDetail::findOrFail(2);
        $hotBrewedCoffee->sizes()->attach([
            1 => ['price' => 10],
            2 => ['price' => 5],
            4 => ['price' => 25],
        ]);

        $mochaFrappe = ProductDetail::findOrFail(3);
        $mochaFrappe->sizes()->attach([
            1 => ['price' => 10],
            2 => ['price' => 5],
        ]);

        $wintermelon = ProductDetail::findOrFail(4);
        $wintermelon->sizes()->attach([
            1 => ['price' => 10],
            3 => ['price' => 15],
            4 => ['price' => 25],
        ]);
    }
}
