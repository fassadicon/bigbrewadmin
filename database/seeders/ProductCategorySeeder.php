<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $icedCoffeeOriginal = Product::findOrFail(1);
        $icedCoffeeOriginal->categories()->attach([1, 3]);

        $hotBrewedCoffee = Product::findOrFail(2);
        $hotBrewedCoffee->categories()->attach([1, 4]);

        $mochaFrappe = Product::findOrFail(3);
        $mochaFrappe->categories()->attach([2, 3]);

        $cheeseFries = Product::findOrFail(4);
        $cheeseFries->categories()->attach([5]);
    }
}
