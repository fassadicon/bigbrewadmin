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
            $milktea->sizes()->attach([
                rand(2, 4) => ['price' => rand(50, 100)]
            ]);
        }
    }
}
