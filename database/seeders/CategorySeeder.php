<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::createMany(
            [
                'name' => 'Coffee',
                'description' => 'test',
            ],
            [
                'name' => 'Frappes',
                'description' => 'test',
            ],
            [
                'name' => 'Iced Drinks',
                'description' => 'test',
            ],
            [
                'name' => 'Hot Drinks',
                'description' => 'test',
            ],
            [
                'name' => 'Snacks',
                'description' => 'test',
            ],
        );
    }
}
